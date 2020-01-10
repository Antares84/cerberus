<?php
	namespace Classes\Settings;

	#############################################################################################
	#	Title: Settings.php																		#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS Setting class, used for loading all CMS core settings resources				#
	#	Last Update Date: 03.10.2019 1403														#
	#############################################################################################
	class Settings{

		public $_arr;

		# Public Methods
		public function __construct($Arrays,$MSSQL){
			$this->Arrays	=	$Arrays;
			$this->MSSQL	=	$MSSQL;

			$this->_security();
			$this->_class_info();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _do_maint_chk($CURR_PAGE=false){
			if($CURR_PAGE && $CURR_PAGE !== ""){
				if($this->_array[19] == true || $this->_array[19] == 'true'){
					if($CURR_PAGE !== 'MAINTENANCE'){
						header("location: ?".$this->_array[0]."=MAINTENANCE");
					}
				}

				if($this->_array[19] == false || $this->_array[19] == 'false'){
					if($CURR_PAGE == 'MAINTENANCE'){
						header("location: ?".$this->_array[0]."=HOME");
					}
				}
			}
			else{
				echo 'Current page is undefined!';
				exit;
			}
		}
		public function _class_info($level=false){
			if($level){
				echo '<b>ClassInfo Level: '.$level.'<br>';
			}
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
			exit();
		}
		public function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

					$this->_build();

					echo '<pre>';
						echo 'Pre Node<br>';
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
						$this->$method_name(true);
					}
					catch(exception $e){
						throw new \classes\errorreporting\SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
					}
				}
			}

			$this->_do_close(true);
		}
		private function _do_close($push=false){
			$this->_arr=$this->_a;

			if($push){unset($this->_a);}
		}
		private function _do_query($database,$data,$alert){
			$res	=	$this->MSSQL->_do_query($database,0,$data);

			if($alert){
				if(!$res){throw new \classes\Exception\SystemException('Unable to load var <b>'.$data.'</b> from database!',0,0,__FILE__,__LINE__);}
				else{return $res;}
			}else{return $res;}
		}
		public function _do_set_defaults(){
			$sql	=	('
							UPDATE '.$this->MSSQL->_table_list("SETTINGS_MAIN").'
							SET EDIT=?
							WHERE EDIT=?
			');
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array(0,1);
			odbc_execute($stmt,$args);
		}
		# MAIN
		private function _do_load_xml_settings(){
			$Settings = @simplexml_load_file("http://cdn.ndf-innovations.net/cms/version.xml") or die('XMLParser: Failed to read object!');

			foreach($Settings as $STNG){
				$Site		=	$STNG->site;
				$Meta		=	$STNG->meta;
				$SiteType	=	$STNG['type'];

				if($SiteType == $this->SITE_TYPE){
					
				}
			}
		}
		private function _page_prefix(){						#0
			$this->_a["PAGE_PREFIX"]			=	$this->_do_query("SETTINGS_MAIN","PAGE_PREFIX",0);
			$this->_do_close();
		}
		private function _setup(){								#1
			$this->_a["SETUP_STATUS"]			=	$this->_do_query("SETTINGS_MAIN","SETUP_STATUS",0);
			$this->_do_close();
		}
		# ADDRESS
		private function _address_1(){
			return $this->_do_query("SETTINGS_MAIN","ADDRESS_1",1);
		}
		private function _address_2(){
			return $this->_do_query("SETTINGS_MAIN","ADDRESS_2",1);
		}
		private function _address_3(){
			return $this->_do_query("SETTINGS_MAIN","ADDRESS_3",1);
		}
		private function _address_comp(){						#2
			$this->_a["some"]					=	$this->_address_1().'<br>'.$this->_address_2().'<br>'.$this->_address_3();
		}
		# E-MAIL
		private function _em_sales(){							#3
			$this->_a["EMAIL_SALES"]			=	$this->_do_query("SETTINGS_MAIN","EMAIL_SALES",1);
		}
		private function _em_support(){							#4
			$this->_a["EMAIL_SUPPORT"]			=	$this->_do_query("SETTINGS_MAIN","EMAIL_SUPPORT",1);
		}
		# PHONE
		private function _phn_pri(){							#5
			$this->_a["PHONE_PRIMARY"]			=	$this->_do_query("SETTINGS_MAIN","PHONE_PRIMARY",1);
		}
		private function _phn_pri_alnum(){						#5
			$this->_a["PHONE_PRIMARY_ALNUM"]	=	$this->_do_query("SETTINGS_MAIN","PHONE_PRIMARY_ALNUM",0);
		}
		private function _phn_sec(){							#6
			$this->_a["PHONE_SECONDARY"]		=	$this->_do_query("SETTINGS_MAIN","PHONE_SECONDARY",1);
		}
		# META
		private function _cms_author(){							#7
			$this->_a["AUTHOR"]					=	$this->_do_query("SETTINGS_MAIN","AUTHOR",1);
		}
		private function _cms_webmaster(){						#8
			$this->_a["WEBMASTER"]				=	$this->_do_query("SETTINGS_MAIN","WEBMASTER",1);
		}
		private function _cms_title(){							#9
			$this->_a["SITE_TITLE"]				=	$this->_do_query("SETTINGS_MAIN","SITE_TITLE",1);
		}
		private function _ap_title(){							#10
			$this->_a["ACP_SITE_TITLE"]			=	$this->_do_query("SETTINGS_MAIN","ACP_SITE_TITLE",1);
		}
		private function _site_domain(){						#11
			$this->_a["SITE_DOMAIN"]			=	$this->_do_query("SETTINGS_MAIN","SITE_DOMAIN",1);
		}
		# DEV
		private function _debug(){								#12
			$this->_a["DEBUG"]					=	$this->_do_query("SETTINGS_MAIN","DEBUG",0);
		}
		private function _logging(){							#13
			$this->_a["LOGGING"]				=	$this->_do_query("SETTINGS_MAIN","LOGGING",0);
		}
		private function _https(){								#14
			$this->_a["HTTPS_SSL"]				=	$this->_do_query("SETTINGS_MAIN","HTTPS_SSL",0);
		}
		private function _cms_type(){							#15
			$this->_a["SITE_TYPE"]				=	$this->_do_query("SETTINGS_MAIN","SITE_TYPE",1);
		}
		private function _maint(){								#16
			$this->_a["MAINTENANCE"]			=	$this->_do_query("SETTINGS_MAIN","MAINTENANCE",0);
		}
		# RECAPTCHA
		private function _recap_site_key(){						#17
			$this->_a["RECAPTCHA_SITE_KEY"]		=	$this->_do_query("SETTINGS_MAIN","RECAPTCHA_SITE_KEY",1);
		}
		private function _recap_sec_key(){						#18
			$this->_a["RECAPTCHA_SEC_KEY"]		=	$this->_do_query("SETTINGS_MAIN","RECAPTCHA_SEC_KEY",1);
		}
		# VERSIONING
		private function _version(){							#19
			$this->_a["VERSION"]				=	$this->_do_query("SETTINGS_MAIN","VERSION",1);
		}
		private function _version_id(){							#20
			$this->_a["VERSION_ID"]				=	$this->_do_query("SETTINGS_MAIN","VERSION_ID",1);
		}
		private function _updater_uri(){						#21
			$this->_a["UPDATER_URI"]			=	$this->_do_query("SETTINGS_MAIN","UPDATER_URI",1);
		}
	}
?>