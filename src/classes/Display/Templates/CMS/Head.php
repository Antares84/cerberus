<?php
	namespace classes\Display\Templates\CMS;

	class Head{

		# Debugging
		public $_debug;
		# Pagination
		private $ServerBase;private $TestURL;
		# Output
		public $output;

		public function __construct($Dirs,$Paging,$Setting,$Style,$Theme){
			$this->Dirs		=	$Dirs;
			$this->Paging	=	$Paging;
			$this->Setting	=	$Setting;
			$this->Style	=	$Style;
			$this->Theme	=	$Theme;

			$this->_security();
			$this->_run();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
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
		private function _Mthds(){
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
		private function _run(){
			if($this->_debug){
				$this->output.='<head>';
					$this->_load_core();
					$this->_load_title();
					$this->_load_style();
				$this->output.='</head>';

				$this->_debug->_run($class,$level);
			}else{
				# Build page head
				$this->output.='<head>';
					$this->_load_core();
					$this->_load_pagination();
					$this->_load_meta();
					$this->_load_cache();
					$this->_load_title();
					$this->_load_style();
					$this->_load_js();
				$this->output.='</head>';
				# Build content
				#$this->Container->_load();
			}
		}
		private function _load_core(){
		#	$this->Data->is_ajax();
			$this->output.='<!DOCTYPE html>';
			$this->output.='<html lang="en">';
		}
		private function _load_pagination(){
			ucwords(str_ireplace(array('-','_','.php'),array(' ',''),$this->Paging->_arr["Page"]));

			$this->ServerBase	=	(ucwords(str_ireplace(array('-','.php'),array(' ',''),$this->Paging->_arr["Page"])));
			$this->TestURL		=	$this->ServerBase;

			if(substr_count($this->TestURL,'/') > 0){
				$this->TestURL = substr($this->TestURL,(strrpos($this->TestURL,'/') +1));
			}else{
				$this->TestURL = substr($this->TestURL,(strrpos($this->TestURL,'/')));
			}
		}
		private function _load_meta(){
			$this->output.='<meta charset="utf-8">';
			$this->output.='<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
			$this->output.='<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			$this->output.='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
			$this->output.='<meta name="Author" content="'.$this->Setting->_arr["AUTHOR"].'">';
		#	$this->output.='<meta name="Copyrights" content="&copy;2010-2019 Nexus Development Foundation. All Rights Reserved.">';
			$this->output.='<meta name="Copyrights" content="'.$this->Theme->_arr["FOOTER_COPYRIGHT"].'">';
			$this->output.='<meta name="Designer" content="'.$this->Setting->_arr["AUTHOR"].'">';
			$this->output.='<meta name="Description" content="">';
			$this->output.='<meta name="Robots" content="all">';
			$this->output.='<meta name="Version" content="'.$this->Setting->_arr["VERSION"].'">';
			$this->output.='<meta name="Webmaster" content="'.$this->Setting->_arr["WEBMASTER"].'">';
		}
		private function _load_cache(){
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Cache-Control: no-store, no-cache, must-revalidate');
			header('Cache-Control: post-check=0, pre-check=0', FALSE);
			header('Pragma: no-cache');
		}
		private function _load_title(){
			$this->output.='<title>';
				if(isset($this->Paging->PAGE_TITLE)){
					$this->output.=$this->Setting->_arr["SITE_TITLE"]." | ".$this->Paging->_arr["PageTitle"];
				}else{
					$this->output.=$this->Setting->_arr["SITE_TITLE"]." | ".str_ireplace('_',' ',$this->TestURL);
				}
			$this->output.='</title>';
		}
		private function _load_style(){
			# FAVICON
			$this->output.='<link rel="Shortcut Icon" type="image/png" href="'.$this->Theme->_arr["FAVICON_IMAGE"].'">';
			$this->output.='<link rel="icon" type="image/png" href="'.$this->Theme->_arr["FAVICON_IMAGE"].'">';
			# CUSTOM FONT
			$this->output.='<link href="https://fonts.googleapis.com/css?family=Tillana" rel="stylesheet" type="text/css">';
			# BOOTSTRAP
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["BS_CSS"].'" media="all">';
			# WOW
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["WOW_CSS"].'" media="all">';
			# MAIN
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_uni_css($this->Paging->_arr["PageZone"],"STYLE","MASTER_CSS").'" media="all">';
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_uni_css($this->Paging->_arr["PageZone"],"STYLE","CUSTOM_CSS").'" media="all">';
			# MDB
			if($this->Paging->_arr["PageIndex"] === "LANDING" || $this->Paging->_arr["PageIndex"] === "MAINTENANCE"){
				$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["MDB_CSS"].'" media="screen">';
			}
			# THEME
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_uni_css($this->Paging->_arr["PageZone"],"THEME","THEME_CSS").'" media="all">';
			# LOADLAB
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Dirs->_arr["LL"].'bt-spinner.css" media="all">';
			# FONTSAWESOME
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["FONTAWESOME_CSS"].'" media="screen">';
			# JQUERYUI
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["JQUERYUI_STYLE_CSS"].'" media="all">';
			$this->output.='<link rel="stylesheet" type="text/css" href="'.$this->Style->_arr["JQUERYUI_THEME_CSS"].'" media="all">';
		}
		private function _load_js(){
			# JQUERY
			$this->output.='<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["JQUERY_JS"].'"></script>';
			# JQUERYUI
			$this->output.='<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["JQUERY_UI_JS"].'"></script>';
			# GOOGLE ANALYTICS
			#$this->output.='<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr[6].'"></script>';
			# GOOOGLE RECAPTCHA V2.0
			#$this->output.='<script src="https://www.google.com/recAPtcha/APi.js"></script>';
			# INITIALIZERS - MUST BE LOADED LAST!
			#$this->output.='<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr[42].'jquery_init.js"></script>';
		}
		public function _output(){
			echo $this->output;
		}
	}
?>