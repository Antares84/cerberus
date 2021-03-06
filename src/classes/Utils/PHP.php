<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class PHP{
		function __construct(){
			$this->_load_params();
		}
		private function _load_params(){
			$this->_error_rep();
			$this->_default_ini();
		}
		private function _error_rep(){
			ini_set('error_reporting',E_ALL);
		#	ini_set('error_reporting',E_ALL ^ E_NOTICE);
		}
		private function _session(){
			
		}
		private function _default_ini(){
			# Sets default params without having to edit php.ini config
			# Options are 0/1
			ini_set('display_errors',1);
			ini_set('display_startup_errors',1);
			ini_set('log_errors','On');
			ini_set('track_errors','On');
			ini_set('short_open_tag',1);
			ini_set('max_execution_time',30);
		#	ini_set("session.use_cookies",0);
		#	ini_set("session.use_trans_sid",1);
			ini_set('session.save_path', "./src/Sessions/"); // WINDOWS: modify for IUSR r/w perms - required for storage access
		}
		
		function phpinfo2array(){
			$entitiesToUtf8 = function($input){
				// http://php.net/manual/en/function.html-entity-decode.php#104617
				return preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $input);
			};
			$plainText = function($input) use ($entitiesToUtf8){
				return trim(html_entity_decode($entitiesToUtf8(strip_tags($input))));
			};
			$titlePlainText = function($input) use ($plainText) {
				return '# '.$plainText($input);
			};

			ob_start();
			phpinfo(-1);

			$phpinfo = array('phpinfo' => array());

			// Strip everything after the <h1>Configuration</h1> tag (other h1's)
			if(!preg_match('#(.*<h1[^>]*>\s*Configuration.*)<h1#s',ob_get_clean(),$matches)){
				return array();
			}

			$input = $matches[1];
			$matches = array();

			if(preg_match_all('#(?:<h2.*?>(?:<a.*?>)?(.*?)(?:<\/a>)?<\/h2>)|'.'(?:<tr.*?><t[hd].*?>(.*?)\s*</t[hd]>(?:<t[hd].*?>(.*?)\s*</t[hd]>(?:<t[hd].*?>(.*?)\s*</t[hd]>)?)?</tr>)#s',$input,$matches,PREG_SET_ORDER)){
				foreach ($matches as $match){
					$fn = strpos($match[0],'<th') === false ? $plainText : $titlePlainText;

					if(strlen($match[1])){
						$phpinfo[$match[1]] = array();
					}
					elseif(isset($match[3])){
						$keys1 = array_keys($phpinfo);
						$phpinfo[end($keys1)][$fn($match[2])] = isset($match[4]) ? array($fn($match[3]), $fn($match[4])) : $fn($match[3]);
					}
					else{
						$keys1 = array_keys($phpinfo);
						$phpinfo[end($keys1)][] = $fn($match[2]);
					}
				}
			}

			return $phpinfo;
		}
	}
?>