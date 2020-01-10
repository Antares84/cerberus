<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title: XML.class.php																	#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS XML class, used for reading from XML resources									#
	#	Last Update Date: 12.31.2018 1743														#
	#############################################################################################
	class XML{

		# From Settings class
		public $updater_key;
		public $updater_uri;

		# From Version xml dataload
		public $codename;
		public $rel_date;
		public $c_version;
		public $c_versionID;
		public $n_version;
		public $n_versionID;
		public $n_version_uri;
		public $n_version_dl;
		public $v_header;
		public $v_info;

		# From Version key xml dataload
		private $k_header;
		public $k_info;

		# Table Builder
		public $output;

		# Other/Misc
		public $debug=false;
		public $level;

		function __construct($Data,$Setting,$Table){
			$this->Data		=	$Data;
			$this->Setting	=	$Setting;
			$this->Table	=	$Table;

		#	$this->_get_version_data();
		}
		function _array_builder(){
			$this->v_header	=	array('Codename','Release Date','Current Version','Current Version ID','New Version','New Version ID');
		}
		function _get_version_data(){
			$this->_array_builder();
			$this->_do_load_vars();
			$this->_do_load_version_xml();
			if($this->n_version){
				$this->_do_load_key_xml();
			}
		}
		function _do_load_vars(){
			$this->cms_version=$this->Setting->VERSION;
			$this->cms_version_id=$this->Setting->VERSION_ID;
			$this->updater_uri=$this->Setting->UPDATER_URI;
		}
		function _get_version_xml_data($data=false,$err_msg=false){
			switch($data){
				case 0 :
					#$xml=@simplexml_load_file($this->Data->urlsafe_b64decode($this->updater_uri));
					$xml=@simplexml_load_file($this->Data->_do_data('urlsafe_b64decode',$this->updater_uri));
					if($xml){
						$this->v_info=$xml;
					}else{
						$err_msg='Version info xml load failed, unable to connect to the xml database. Code: 0x01.';
					#	$this->_get_version_xml_data(2,$err_msg);
					}
				break;
				case 1 :
					if($this->n_version){
						#$xml=@simplexml_load_file($this->Data->urlsafe_b64decode($this->n_version_uri));
						$xml=@simplexml_load_file($this->Data->_do_data('urlsafe_b64decode',$this->n_version_uri));

						if($xml){
							$this->k_info=$xml;
						}else{
							$err_msg='Version key xml load failed, unable to connect to the xml database.<br>Version key uri=<code>'.$this->n_version_uri.'</code><br>Code: 0x02.';
					#		$this->_get_version_xml_data(2,$err_msg);
						}
					}
				break;
				case 2 :
					throw new SystemException($err_msg);
				break;
				default : 
					$this->_get_version_xml_data(0);
				break;
			}
		}
		function _do_split_version($data){
			list($vers,$sub_vers,$sub_vers_2) = explode(".",$this->cms_version);

			switch($data){
				case	0	:	return $vers;		break;
				case	1	:	return $sub_vers;	break;
				case	2	:	return $sub_vers_2;	break;
			}
		}
		function _do_load_version_xml($display=false){
			$this->_get_version_xml_data(0);
			$_array=array();

			if($this->level<3){
				foreach(@$this->v_info->children() as $child){
					$role = $child->attributes();
					foreach($role as $info){
						if($info==$this->_do_split_version($this->level)){
							if($this->level<2){
								$this->level=$this->level+1;
								$this->_do_load_version_xml();
							}
							else{
								foreach($child as $a=>$b){
									# Save needed info to vars
									$this->$a=(string)$b;
								}
								foreach($child as $c){
									# Save needed info to array for later
									$_array[]=(string)$c;
								}
								# Save array back to original var/var recycling for cleaner code
								$this->v_info=$_array;
							#	$this->_do_pre($this->v_info);
								$this->v_info	=	array_slice($this->v_info,0,-2);
							#	$this->_do_pre($this->v_info);
							#	exit;

								# Echo array as header => info - debug
								if($display){
									$this->_do_xml_display('v_info');
								}
							}
						}
					}
				}
			}
		}
		function _do_reset(){
			$this->level=false;
			$this->v_info=false;
			$this->k_info=false;
		}
		function _do_load_key_xml($display=false){
			$this->_get_version_xml_data(1);
			$_array=array();

			foreach($this->k_info->children() as $child){
				$role = $child->attributes();
				foreach($role as $info){
					if($info==$this->n_versionID){
						foreach($child as $c){
							# Save needed info to array for later
							$_array[]=(string)$c;
						}

						# Save array back to original var/var recycling for cleaner code
						$this->k_info=$_array;
						$this->k_header=$this->k_info[0];
						$this->k_info	=	array_slice($this->k_info,1,-1);

						# Echo array as header => info - debug
						if($display){
							$this->_do_xml_display('k_info');
						}
					}
					else{
						echo 'Version key mismatch...<br>';
					}
				}
			}

#			$this->_do_reset();
		}
		function _do_xml_display($source){
			$data	=	array();

			switch($source){
				case	"v_info"	:
										foreach($this->v_header as $k=>$v){
											$data["head"][]	=	$v;
										}
										foreach($this->v_info as $v){
											$data["body"][]	=	$v;
										}
				break;
				case	"k_info"	:
										$data["head"][]	=	$this->k_header;

										foreach($this->k_info as $v){
											$data["body"][]	=	$v;
										}
				break;
			}

			if($data){
				$this->output	=	$data;
				$this->Table->_do_build_table($this->output,$source);
			}
			$this->_do_reset();
	#		$this->_do_pre($this->output);
		}
		function _do_pre($data,$die=false,$exit=false){
			if($data){
				echo '<pre>';
					var_dump($data);
				echo '</pre>';
				if($die){die();}
				if($exit){exit();}
			}
			else{
				echo 'No data to show...<br>';
			}
		}
		# MISC
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		function _get_class_methods(){
			$class_methods	=	get_class_methods($this);
			echo '<div class="col-md-12">';
				echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
				echo '<pre>';
				foreach($class_methods as $method_name){
					echo $method_name.'<br>';
				}
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>