<?php
	namespace classes\settings;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title: Style.class.php																	#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS Style class, used for loading all CMS style-specific resources					#
	#	Last Update Date: 01.11.2019 1459														#
	#############################################################################################

	class Style{

		public $_arr;

		# PUBLIC METHODS
		public function __construct($Arrays,$db,$Dirs,$Theme){
			$this->Arrays	=	$Arrays;
			$this->db 		=	$db;
			$this->Dirs		=	$Dirs;
			$this->Theme	=	$Theme;

			$this->_class_info();
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
		public function _set_defaults(){
			$sql	=	('
							UPDATE '.$this->db->_table_list("SETTINGS_STYLE").'
							SET EDIT=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array(0);
			odbc_execute($stmt,$args);
		}
		public function _uni_css_dir($ZONE,$TYPE){
			if($ZONE == "CMS"){
				if($TYPE == "STYLE"){
					return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["CMS_STYLE_NAME"]."css/";
				}
				elseif($TYPE == "THEME"){
					return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["CMS_THEME_NAME"]."css/";
				}
			}
			elseif($ZONE == "AP"){
				if($TYPE == "STYLE"){
					return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["ACP_STYLE_NAME"]."css/";
				}
				elseif($TYPE == "THEME"){
					return $this->Dirs->_arr[59].$this->Theme->_arr["ACP_THEME_NAME"]."css/";
				}
			}
		}
		public function _uni_css($ZONE,$TYPE,$CSS_NAME){
			return $this->_uni_css_dir($ZONE,$TYPE).$this->_do_query("SETTINGS_STYLE",$ZONE."_".$CSS_NAME);
		}
		public function _uni_images($ZONE,$IMG_TYPE=false){
			if($ZONE == "CMS" && $IMG_TYPE == "S_AJAX"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["CMS_STYLE_NAME"].'Images/Ajax/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "S_AJAX"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["ACP_STYLE_NAME"].'Images/Ajax/';
			}

			if($ZONE == "CMS" && $IMG_TYPE == "T_AJAX"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["CMS_THEME_NAME"].'images/Ajax/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "T_AJAX"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["ACP_THEME_NAME"].'images/Ajax/';
			}

			if($ZONE == "CMS" && $IMG_TYPE == "S_ICON"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["CMS_STYLE_NAME"].'Images/Icon/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "S_ICON"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["ACP_STYLE_NAME"].'Images/Icon/';
			}

			if($ZONE == "CMS" && $IMG_TYPE == "T_ICON"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["CMS_THEME_NAME"].'Images/Icon/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "T_ICON"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["ACP_THEME_NAME"].'Images/Icon/';
			}

			if($ZONE === "CMS" && $IMG_TYPE === "S_LOGO"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["CMS_STYLE_NAME"].'Images/Logo/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "S_LOGO"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["ACP_STYLE_NAME"].'Images/Logo/';
			}

			if($ZONE == "CMS" && $IMG_TYPE == "T_LOGO"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["CMS_THEME_NAME"].'Images/Logo/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "T_LOGO"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["ACP_THEME_NAME"].'Images/Logo/';
			}

			if($ZONE == "CMS" && $IMG_TYPE == "S_MISC"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["CMS_STYLE_NAME"].'Images/Misc/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "S_MISC"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["ACP_STYLE_NAME"].'Images/Misc/';
			}

			if($ZONE == "CMS" && $IMG_TYPE == "T_MISC"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["CMS_THEME_NAME"].'Images/Misc/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "T_MISC"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["ACP_THEME_NAME"].'Images/Misc/';
			}

			if($ZONE == "CMS" && $IMG_TYPE == "S_WP"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["CMS_STYLE_NAME"].'Images/Wallpaper/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "S_WP"){
				return $this->Dirs->_arr["STYLES"].$this->Theme->_arr["ACP_STYLE_NAME"].'Images/Wallpaper/';
			}

			if($ZONE == "CMS" && $IMG_TYPE == "T_WP"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["CMS_THEME_NAME"].'Images/Wallpaper/';
			}elseif($ZONE == "AP" && $IMG_TYPE == "T_WP"){
				return $this->Dirs->_arr["THEMES"].$this->Theme->_arr["ACP_THEME_NAME"].'Images/Wallpaper/';
			}
		}
		public function _uni_images_dir($ZONE){
			$IMG_DIR	=	$this->_do_query("SETTINGS_STYLE","IMAGES_DIR");

			if($ZONE == "CMS"){
				return $this->_uni_css_dir($ZONE).$this->Theme->_arr["CMS_THEME_NAME"]($ZONE)."css/";
			}
			elseif($Zone == "ACP"){
				return $this->Dirs->_arr[31].$this->Theme->_arr["ACP_STYLE_NAME"].$this->_do_query("SETTINGS_STYLE","IMAGES_DIR");
			}
		}
		# PRIVATE METHODS
		private function _build(){
			if($this->_arr){$this->_arr=null;}
			$this->_a=array();

			$class_methods	=	get_class_methods($this);

			foreach($class_methods as $method_name){
				if(!in_array($method_name,$this->Arrays->no_index)){
					try{
						$this->$method_name(true);
					#	echo $method_name.'<br>';
					}
					catch(exception $e){
						throw new SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
					}
				}
			}

			$this->_do_close(true);
		}
		private function _do_query($database,$data,$alert=false){
			$res	=	$this->db->_do_query($database,1,$data);

			if($alert){
				if(!$res){throw new SystemException('Unable to load var <b>'.$data.'</b> from database!',0,0,__FILE__,__LINE__);}
				else{return $res;}
			}
			else{return $res;}
		}
		# JQUERY CORE
		private function _jquery_version(){
			return $this->_do_query("SETTINGS_STYLE","JQUERY_VERSION",1);
		}
		private function _jquery_js(){
			$this->_a["JQUERY_JS"]	=	$this->Dirs->_arr["JS_CORE"].$this->_jquery_version().'/'.'jquery-'.$this->_jquery_version().'.js';
		}
		# JQUERYUI CORE
		private function _jquery_ui_version(){
			return $this->_do_query("SETTINGS_STYLE","JQUERYUI_VERSION");
		}
		private function _jquery_ui_js(){
			$this->_a["JQUERY_UI_JS"]	=	$this->Dirs->_arr["UI"].$this->_jquery_ui_version()."/"."js/jquery-".$this->_jquery_ui_version().".ui.js";
		}
		private function _jquery_ui_theme_name(){
			return $this->_do_query("SETTINGS_STYLE","JQUERYUI_THEME_NAME");
		}
		private function _jquery_ui_style_css(){
			$this->_a["JQUERYUI_STYLE_CSS"]	=	$this->Dirs->_arr["UI"].$this->_jquery_ui_version()."/themes/".$this->_jquery_ui_theme_name()."/".$this->_do_query("SETTINGS_STYLE","JQUERYUI_STYLE_CSS");
		}
		private function _jquery_ui_theme_css(){
			$this->_a["JQUERYUI_THEME_CSS"]	=	$this->Dirs->_arr["UI"].$this->_jquery_ui_version()."/themes/".$this->_jquery_ui_theme_name()."/".$this->_do_query("SETTINGS_STYLE","JQUERYUI_THEME_CSS");
		}
		# JQUERY ADDONS - BOOTSTRAP
		private function _bs_version(){
			return $this->_do_query("SETTINGS_STYLE","BS_VERSION");
		}
		private function _bs_css(){
			$this->_a["BS_CSS"]	=	$this->Dirs->_arr["BOOTSTRAP"].$this->_bs_version().'/css/'.$this->_do_query("SETTINGS_STYLE","BS_CSS");
		}
		private function _bs_js(){
			$this->_a["BS_JS"]	=	$this->Dirs->_arr["BOOTSTRAP"].$this->_bs_version().'/js/'.$this->_do_query("SETTINGS_STYLE","BS_JS");
		}
		# GOOGLE ANALYTICS
		private function _google_analytics_js(){
			$this->_a["GA_JS"]	=	$this->Dirs->_arr["GOOGLE"].$this->_do_query("SETTINGS_STYLE","GA_JS");
		}
		# MDB
		private function _mdb_version(){
			return $this->_do_query("SETTINGS_STYLE","MDB_VERSION");
		}
		private function _mdb_css(){
			$this->_a["MDB_CSS"]	=	$this->Dirs->_arr["MDB"].$this->_mdb_version().'/css/'.$this->_do_query("SETTINGS_STYLE","MDB_CSS");
		}
		private function _mdb_js(){
			$this->_a["MDB_JS"]	=	$this->Dirs->_arr["MDB"].$this->_mdb_version().'/js/'.$this->_do_query("SETTINGS_STYLE","MDB_JS");
		}
		# POPPERJS
		private function _popperjs_version(){
			return $this->_do_query("SETTINGS_STYLE","POPPERJS_VERSION");
		}
		private function _popperjs_js(){
			$this->_a["POPPERJS"]	=	$this->Dirs->_arr["POPPERJS"].$this->_popperjs_version().'/js/'.$this->_do_query("SETTINGS_STYLE","POPPERJS_JS");
		}
		# TINYMCE
		private function _tinymce_version(){
			return $this->_do_query("SETTINGS_STYLE","TINYMCE_VERSION");
		}
		private function _tinymce_js(){
			$this->_a["TINYMCE_JS"]	=	$this->Dirs->_arr["TINYMCE"].$this->_tinymce_version().'/js/'.$this->_do_query("SETTINGS_STYLE","TINYMCE_JS");
		}
		private function _tinymce_init(){
			$this->_a["TINYMCE_INIT"]	=	$this->Dirs->_arr["TINYMCE"].$this->_tinymce_version().'/js/'.$this->_do_query("SETTINGS_STYLE","TINYMCE_INIT");
		}
		# WOW
		private function _wow_version(){
			return $this->_do_query("SETTINGS_STYLE","WOW_VERSION");
		}
		private function _wow_css(){
			$this->_a["WOW_CSS"]	=	$this->Dirs->_arr["WOW"].$this->_wow_version()."/".$this->_do_query("SETTINGS_STYLE","WOW_CSS");
		}
		private function _wow_js(){
			$this->_a["WOW_JS"]	=	$this->Dirs->_arr["WOW"].$this->_wow_version()."/".$this->_do_query("SETTINGS_STYLE","WOW_JS");
		}
		# STYLES
		private function _fa_version(){
			return $this->_do_query("SETTINGS_STYLE","FONTAWESOME_VERSION");
		}
		private function _fa_css(){
			$this->_a["FONTAWESOME_CSS"]	=	$this->Dirs->_arr["FA"].$this->_fa_version().'/css/'.$this->_do_query("SETTINGS_STYLE","FONTAWESOME_CSS");
		}
		private function _fa_js(){
			$this->_a["FONTAWESOME_JS"]	=	$this->Dirs->_arr["FA"].$this->_fa_version().'/js/'.$this->_do_query("SETTINGS_STYLE","FONTAWESOME_JS");
		}
		private function _fi_css(){
			$this->_a["FONTICONS_CSS"]	=	$this->Dirs->_arr["FI"].'css/'.$this->_do_query("SETTINGS_STYLE","FONTICONS_CSS");
		}
		private function _preloader_css(){
			$this->_a["LOADER_CSS"]	=	$this->Dirs->_arr["CUSTOM"].$this->_do_query("SETTINGS_STYLE","LOADER_CSS");
		}
		# MISC
		private function _do_close($push=false){
			$this->_arr=$this->_a;

			if($push){
				unset($this->_a);
			}
		}
	}
?>