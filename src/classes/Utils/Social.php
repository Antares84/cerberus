<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Social{

		public $_arr;

		public function __construct($Arrays,$db){
			$this->Arrays	=	$Arrays;
			$this->db		=	$db;

			$this->_class_info();
		}
		public function _class_info($level=false){
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
				default	:	return $this->_build();	break;
			}
		}
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit;
		}
		public function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

				#	$this->_build();

					echo '<pre>';
						var_dump($this->_array);
					echo '</pre>';
				echo '</div>';
			}
			else{
				echo '<div class="col-md-12">';
					echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
					echo '<pre>';
					foreach($class_methods as $method_name){
						echo $method_name.'<br>';
					}
					echo '</pre>';
				echo '</div>';
				exit;
			}
		}

		# Private Methods
		private function _build(){
			if($this->_arr){
				$this->_arr=null;
			}
			$this->_a=array();

			$class_methods	=	get_class_methods($this);

			foreach($class_methods as $method_name){
				if(!in_array($method_name,$this->Arrays->no_index)){
					try{
						$this->$method_name();
					#	echo $method_name.'<br>';
						$this->_do_close();
					}
					catch(exception $e){
						throw new \classes\errorreporting\SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
					}
				}
			}

			$this->_do_close(true);
		}
		private function _do_query($database,$data,$alert){
			$res	=	$this->db->_do_query($database,0,$data);

			if($alert){
				if(!$res){
					throw new \classes\errorreporting\SystemException('Unable to load var <b>'.$data.'</b> from database!',0,0,__FILE__,__LINE__);
				}
				else{
					return $res;
				}
			}
			else{
				return $res;
			}
		}
		private function _do_close($push=false){
			$this->_arr=$this->_a;

			if($push){
				unset($this->_a);
			}
		}
		function _facebook(){
			$this->_a[] = $this->_do_query("SETTINGS_SOCIAL","SOCIAL_URL_FACEBOOK",0);
		}
		function _google_plus(){
			$this->_a[] = $this->_do_query("SETTINGS_SOCIAL","SOCIAL_URL_GOOGLEPLUS",0);
		}
		function _pinterest(){
			$this->_a[] = $this->_do_query("SETTINGS_SOCIAL","SOCIAL_URL_PINTEREST",0);
		}
		function _twitter(){
			$this->_a[] = $this->_do_query("SETTINGS_SOCIAL","SOCIAL_URL_TWITTER",0);
		}
	}