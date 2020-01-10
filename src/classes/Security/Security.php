<?php
	namespace classes\Security;
	if(!defined('IN_CMS')){
		exit('SECURITY: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title: Security.php																		#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS Security class, used for loading all CMS security resources					#
	#	Last Update Date: 10.20.2019 1318														#
	#############################################################################################

	class Security{
		public function __construct($Settings){
			$this->STNG	=	$Settings;

			$this->_ssl_check();
		}
		private function _ssl_check(){
			# HTTP | HTTPS Protocol
			if($this->STNG->_arr["HTTPS_SSL"] == true || $this->STNG->_arr["HTTPS_SSL"] == "true"){
				if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] == "off"){
					$redirect_url="https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
					header("Location: $redirect_url");
					exit;
				}
			}
		}
	}
?>