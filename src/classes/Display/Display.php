<?php
	namespace Classes\Display;

	class Display{

		# Settings
		private $SITE_TYPE;

		# Content
		private $Head;
		private $Nav;
		private $Content;
		private $Footer;
		private $crc_update=true;

		# CONSTRUCTOR
		public function __construct($CRC,$Dirs,$Modal,$Modules,$MSSQL,$Paging,$Setting,$SQL,$Stats,$Style,$Theme,$Tpl,$User){
			$this->CRC		=	$CRC;
			$this->Dirs		=	$Dirs;
			$this->Modal	=	$Modal;
			$this->Modules	=	$Modules;
			$this->MSSQL	=	$MSSQL;
			$this->Paging	=	$Paging;
			$this->Setting	=	$Setting;
			$this->SQL		=	$SQL;
			$this->Stats	=	$Stats;
			$this->Style	=	$Style;
			$this->Theme	=	$Theme;
			$this->Tpl		=	$Tpl;
			$this->User		=	$User;

		#	$this->SITE_TYPE	=	$this->Setting->_arr["SITE_TYPE"];
			self::_security();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _init(){
			echo 'Display loaded...';
		}

		# HEAD
		private function _load_core(){
		#	$this->Data->is_ajax();
			echo '<!DOCTYPE html>';
			echo '<html lang="en">';
		}
		private function _load_pagination(){
			ucwords(str_ireplace(array('-','_','.php'),array(' ',''),$this->PAGE));

			$this->ServerBase	=	(ucwords(str_ireplace(array('-','.php'),array(' ',''),$this->PAGE)));
			$this->TestURL		=	$this->ServerBase;

			if(substr_count($this->TestURL,'/') > 0){
				$this->TestURL = substr($this->TestURL,(strrpos($this->TestURL,'/') +1));
			}else{
				$this->TestURL = substr($this->TestURL,(strrpos($this->TestURL,'/')));
			}
		}
		private function _load_meta(){
			echo '<meta charset="utf-8">';
			echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
			echo '<meta name="Author" content="'.$this->Setting->_arr["AUTHOR"].'">';
			echo '<meta name="Copyrights" content="&copy;2010-2019 Nexus Development Foundation. All Rights Reserved.">';
		#	echo '<meta name="Copyrights" content="'.$this->Theme->_array[18].'">';
			echo '<meta name="Designer" content="'.$this->Setting->_arr["AUTHOR"].'">';
			echo '<meta name="Description" content="">';
			echo '<meta name="Robots" content="all">';
			echo '<meta name="Version" content="'.$this->Setting->_arr["VERSION"].'">';
			echo '<meta name="Webmaster" content="'.$this->Setting->_arr["WEBMASTER"].'">';
		}
		private function _load_cache(){
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Cache-Control: no-store, no-cache, must-revalidate');
			header('Cache-Control: post-check=0, pre-check=0', FALSE);
			header('Pragma: no-cache');
		}
		private function _load_title(){
			if($this->PAGE_ZONE == "CMS"){
				echo '<title>';
					if(isset($this->PAGE_TITLE)){
						echo $this->Setting->_arr["SITE_TITLE"]." | ".$this->PAGE_TITLE;
					}
					else{
						echo $this->Setting->_arr["SITE_TITLE"]." | ".str_ireplace('_',' ',$this->TestURL);
					}
				echo '</title>';
			}
			if($this->PAGE_ZONE == "ACP"){
				echo '<title>';
					if(isset($this->PAGE_TITLE)){
						echo $this->Setting->_arr["ACP_SITE_TITLE"]." | ".$this->PAGE_TITLE;
					}
					else{
						echo $this->Setting->_arr["ACP_SITE_TITLE"]." | ".str_ireplace('_',' ',$this->TestURL);
					}
				echo '</title>';
			}
		}
		private function _load_styles($external=false){
			$method	=	'_load_styles_'.$this->PAGE_ZONE;
			$err	=	'Method doesn\'t exist!';

			if(method_exists($this,$method)){
				return $this->$method();
			}
			else{
				throw new \Classes\errorreporting\SystemException('Error in <b>'.get_class($this).'<br>'.$err,0,0,__FILE__,__LINE__);
			}
		}
		private function _load_styles_cms(){
			# FAVICON
			echo '<link rel="Shortcut Icon" type="image/png" href="'.$this->Theme->_arr["FAVICON_IMAGE"].'">';
			echo '<link rel="icon" type="image/png" href="'.$this->Theme->_arr["FAVICON_IMAGE"].'">';
			# CUSTOM FONT
			echo '<link href="https://fonts.googleapis.com/css?family=Tillana" rel="stylesheet" type="text/css">';
			# BOOTSTRAP
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["BS_CSS"].'" media="all">';
			# WOW
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["WOW_CSS"].'" media="all">';
			# MAIN
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_uni_css($this->PAGE_ZONE,"STYLE","MASTER_CSS").'" media="all">';
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_uni_css($this->PAGE_ZONE,"STYLE","CUSTOM_CSS").'" media="all">';
			# MDB
			if($this->PAGE_INDEX === "LANDING" || $this->PAGE_INDEX === "MAINTENANCE"){
				echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["MDB_CSS"].'" media="screen">';
			}
			# THEME
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_uni_css($this->PAGE_ZONE,"THEME","THEME_CSS").'" media="all">';
			# LOADLAB
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Dirs->_arr["LL"].'bt-spinner.css" media="all">';
			# FONTSAWESOME
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["FONTAWESOME_CSS"].'" media="screen">';
			# JQUERYUI
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["JQUERYUI_STYLE_CSS"].'" media="all">';
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["JQUERYUI_THEME_CSS"].'" media="all">';
		}
		private function _load_styles_ap(){
			# FAVICON
			echo '<link rel="Shortcut Icon" type="image/png" href="'.$this->Theme->_arr["FAVICON_IMAGE"].'">';
			echo '<link rel="icon" type="image/png" href="'.$this->Theme->_arr["FAVICON_IMAGE"].'">';
			# CUSTOM FONT
			echo '<link href="https://fonts.googleapis.com/css?family=Tillana" rel="stylesheet" type="text/css">';
			# BOOTSTRAP
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["BS_CSS"].'" media="all">';
			# WOW
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["WOW_CSS"].'" media="all">';
			# MAIN
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_uni_css($this->PAGE_ZONE,"STYLE","MASTER_CSS").'" media="all">';
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_uni_css($this->PAGE_ZONE,"STYLE","CUSTOM_CSS").'" media="all">';
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Dirs->_arr["ADDONS"].'MCS/jquery.mCustomScrollbar.css" media="all">';
			# LOADLAB
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Dirs->_arr["LL"].'bt-spinner.css" media="all">';
			# FONTSAWESOME
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["FONTAWESOME_CSS"].'" media="screen">';
			# JQUERYUI
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["JQUERYUI_STYLE_CSS"].'" media="all">';
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["JQUERYUI_THEME_CSS"].'" media="all">';
		}
		private function _load_js(){
			$method	=	'_load_js_'.$this->PAGE_ZONE;
			$err	=	'Method doesn\'t exist!';

			try{
				if(method_exists($this,$method)){
					return $this->$method();
				}
			}
			catch(exception $e){
				throw new SystemException('Error in <b>'.get_class($this).'<br>'.$err,0,0,__FILE__,__LINE__);
			}
		}
		private function _load_js_cms(){
			# JQUERY
			echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["JQUERY_JS"].'"></script>';
			# JQUERYUI
			echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["JQUERY_UI_JS"].'"></script>';
			# GOOGLE ANALYTICS
		//	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr[6].'"></script>';
			# GOOOGLE RECAPTCHA V2.0
		//	echo '<script src="https://www.google.com/recAPtcha/APi.js"></script>';
			# INITIALIZERS - MUST BE LOADED LAST!
			#echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr[42].'jquery_init.js"></script>';
		}
		private function _load_js_ap(){
			# JQUERY
			echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["JQUERY_JS"].'"></script>';
			# JQUERYUI
			echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["JQUERY_UI_JS"].'"></script>';
			# GOOGLE ANALYTICS
		//	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr[6].'"></script>';
			# PLUPLOAD
		//	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr[1].'PlUpload/plupload.full.min.js"></script>';
		//	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr[1].'PlUpload/init.plupload.js"></script>';
			# INITIALIZERS - MUST BE LOADED LAST!
			#echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr[42].'jquery_init.js"></script>';
		}
		# DISPLAY BUILDER
		public function _load($debug=false,$class=false,$level=false){
			# Head
			$this->Head		=	new Templates\CMS\Head($this->Dirs,$this->Paging,$this->Setting,$this->Style,$this->Theme);
			$this->Head->_output();

			# CRC Check/Update
		#	$this->_validate_checksums();
		#	exit;

			# Content
			$this->Content	=	new Templates\CMS\Content($this->Dirs,$this->Modal,$this->Modules,$this->MSSQL,$this->Paging,$this->Setting,$this->SQL,$this->Stats='',$this->Theme,$this->Tpl,$this->User);
			$this->Content->_output();

			# Modal
		}
		# MISC
		private function _validate_checksums(){
			if($this->crc_update==true){
				$this->CRC->_run();
				$this->CRC->_output();
			}
		}
		public function _class_info($level=false){
			if($level){
				echo '<b>ClassInfo Level: '.$level.'<br>';
			}
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
				default	:	return $this->_do_build_display();	break;
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
						var_dump($this->_arr);
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
	}
?>