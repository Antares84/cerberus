<?php
	class Style{

		private $QUERY;
		public $_style_array=array();

		function __construct($DatabaseObj,$ThemeObj){
			# CONSTRUCT DB
			$this->db 		=	$DatabaseObj;
			$this->Theme	=	$ThemeObj;

			$this->_style_array();
		}
		function _style_array($ZONE=false,$TYPE=false,$CSS_NAME=false){
			$_array		=	array();

			# JQUERY CORE
			array_push($this->_style_array,$this->JQUERY_HOME_DIR());			#0
			array_push($this->_style_array,$this->JQUERY_VERSION());			#1
			array_push($this->_style_array,$this->JQUERY_JS());					#2
			# JQUERYUI CORE
			array_push($this->_style_array,$this->JQUERYUI_HOME_DIR());			#3
			array_push($this->_style_array,$this->JQUERYUI_VERSION());			#4
			array_push($this->_style_array,$this->JQUERYUI_JS());				#5
			array_push($this->_style_array,$this->JQUERYUI_THEME_NAME());		#6
			array_push($this->_style_array,$this->JQUERYUI_STYLE_CSS());		#7
			array_push($this->_style_array,$this->JQUERYUI_THEME_CSS());		#8
			# JQUERY EXTRAS
			array_push($this->_style_array,$this->JQUERY_ADDONS_DIR());			#9
			array_push($this->_style_array,$this->JQUERY_CUSTOM_DIR());			#10
			# ADDONS - BOOTSTRAP
			array_push($this->_style_array,$this->JQUERY_BS_DIR());				#11
			array_push($this->_style_array,$this->JQUERY_BS_VERSION());			#12
			array_push($this->_style_array,$this->JQUERY_BS_CSS());				#13
			array_push($this->_style_array,$this->JQUERY_BS_JS());				#14
			# ADDONS - EASING
			array_push($this->_style_array,$this->JQUERY_EASING_DIR());			#15
			array_push($this->_style_array,$this->JQUERY_EASING_VERSION());		#16
			array_push($this->_style_array,$this->JQUERY_EASING_JS());			#17
			array_push($this->_style_array,$this->JQUERY_EASING_COMPAT_JS());	#18
			# ADDONS - GOOGLE ANALYTICS
			array_push($this->_style_array,$this->JQUERY_GA_DIR());				#19
			array_push($this->_style_array,$this->JQUERY_GA_JS());				#20
			# ADDONS - MDB
			array_push($this->_style_array,$this->JQUERY_MDB_DIR());			#21
			array_push($this->_style_array,$this->JQUERY_MDB_VERSION());		#22
			array_push($this->_style_array,$this->JQUERY_MDB_CSS_DIR());		#23
			array_push($this->_style_array,$this->JQUERY_MDB_CSS());			#24
			array_push($this->_style_array,$this->JQUERY_MDB_JS_DIR());			#25
			array_push($this->_style_array,$this->JQUERY_MDB_JS());				#26
			# ADDONS - MODERNIZR
			array_push($this->_style_array,$this->JQUERY_MODERNIZR_DIR());		#27
			array_push($this->_style_array,$this->JQUERY_MODERNIZR_VERSION());	#28
			array_push($this->_style_array,$this->JQUERY_MODERNIZR_JS());		#29
			# ADDONS - POPPERJS
			array_push($this->_style_array,$this->JQUERY_POPPERJS_DIR());		#30
			array_push($this->_style_array,$this->JQUERY_POPPERJS_VERSION());	#31
			array_push($this->_style_array,$this->JQUERY_POPPERJS_JS());		#32
			# ADDONS - TINYMCE
			array_push($this->_style_array,$this->JQUERY_TINYMCE_DIR());		#33
			array_push($this->_style_array,$this->JQUERY_TINYMCE_VERSION());	#34
			array_push($this->_style_array,$this->JQUERY_TINYMCE_JS());			#35
			array_push($this->_style_array,$this->JQUERY_TINYMCE_INIT());		#36
			# ADDONS - TETHER
			array_push($this->_style_array,$this->JQUERY_TETHER_DIR());			#37
			array_push($this->_style_array,$this->JQUERY_TETHER_VERSION());		#38
			array_push($this->_style_array,$this->JQUERY_TETHER_JS());			#39
			# ADDONS - WOW
			array_push($this->_style_array,$this->JQUERY_WOW_DIR());			#40
			array_push($this->_style_array,$this->JQUERY_WOW_VERSION());		#41
			array_push($this->_style_array,$this->JQUERY_WOW_JS());				#42
			array_push($this->_style_array,$this->JQUERY_WOW_CSS());			#43
			# STYLES
			array_push($this->_style_array,$this->STYLES_DIR());				#44
			array_push($this->_style_array,$this->THEMES_DIR());				#45
			array_push($this->_style_array,$this->CORE_CSS_DIR());				#46
			array_push($this->_style_array,$this->UNI_CSS_DIR($ZONE,$TYPE));	#47
			array_push($this->_style_array,$this->FONTS_DIR());					#48
			array_push($this->_style_array,$this->FONTAWESOME_DIR());			#49
			array_push($this->_style_array,$this->FONTAWESOME_CSS());			#50
			array_push($this->_style_array,$this->FONTICONS_DIR());				#51
			array_push($this->_style_array,$this->FONTICONS_CSS());				#52
			array_push($this->_style_array,$this->CUSTOM_DIR());				#53
			array_push($this->_style_array,$this->ICONS_DIR());					#54
			array_push($this->_style_array,$this->LOADLAB_DIR());				#55
			array_push($this->_style_array,$this->LOADER_CSS());				#56
		}
		function QUERY($DB,$DATA,$ALERT=false){
			$this->QUERY = $this->db->do_QUERY("VALUE",$DB,"STYLE",$DATA);

			if($ALERT){
				if(!$this->QUERY){
					throw new SystemException('Unable to load var <b>'.$DATA.'</b> from database!',0,0,__FILE__,__LINE__);
				}
				else{
					return $this->QUERY;
				}
			}
			else{
				return $this->QUERY;
			}
		}
		function SET_DEFAULTS(){
			$sql	=	('
							UPDATE '.$this->db->TABLE("SETTINGS_STYLE").'
							SET EDIT=?
			');
			$stmt	=	odbc_prepare($db->conn,$sql);
			$args	=	array(0);
			odbc_execute($stmt,$args);
		}
		# JQUERY CORE
		function JQUERY_HOME_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_HOME_DIR");
			return $this->QUERY;
		}
		function JQUERY_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_VERSION",0);
			return $this->QUERY;
		}
		function JQUERY_JS(){
			return $this->_style_array[0].$this->_style_array[1]."/"."jquery-".$this->_style_array[1].".js";
		}
		# JQUERYUI CORE
		function JQUERYUI_HOME_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERYUI_HOME_DIR");
			return $this->_style_array[0].$this->QUERY;
		}
		function JQUERYUI_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERYUI_VERSION");
			return $this->QUERY;
		}
		function JQUERYUI_JS(){
			return $this->_style_array[3].$this->_style_array[4]."/"."js/jquery-".$this->_style_array[4].".ui.js";
		}
		function JQUERYUI_THEME_NAME(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERYUI_THEME_NAME");
			return $this->QUERY;
		}
		function JQUERYUI_STYLE_CSS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERYUI_STYLE_CSS");
			return $this->_style_array[3].$this->_style_array[4]."/themes/".$this->_style_array[6]."/".$this->QUERY;
		}
		function JQUERYUI_THEME_CSS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERYUI_THEME_CSS");
			return $this->_style_array[3].$this->_style_array[4]."/themes/".$this->_style_array[6]."/".$this->QUERY;
		}
		# JQUERY EXTRAS
		function JQUERY_ADDONS_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_ADDONS_DIR");
			return $this->_style_array[0].$this->QUERY;
		}
		function JQUERY_CUSTOM_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_CUSTOM_DIR");
			return $this->_style_array[0].$this->QUERY;
		}
		# JQUERY ADDONS - BOOTSTRAP
		function JQUERY_BS_DIR(){
			$this->QUERY=$this->QUERY("SETTINGS_STYLE","JQUERY_BS_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_BS_VERSION(){
			$this->QUERY=$this->QUERY("SETTINGS_STYLE","JQUERY_BS_VERSION");
			return $this->QUERY;
		}
		function JQUERY_BS_CSS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_BS_CSS");
			return $this->_style_array[11].$this->_style_array[12].'/css/'.$this->QUERY;
		}
		function JQUERY_BS_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_BS_JS");
			return $this->_style_array[11].$this->_style_array[12].'/js/'.$this->QUERY;
		}
		# EASING
		function JQUERY_EASING_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_EASING_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_EASING_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_EASING_VERSION");
			return $this->QUERY;
		}
		function JQUERY_EASING_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_EASING_JS");
			return $this->_style_array[15].$this->_style_array[16].'/'.$this->QUERY;
		}
		function JQUERY_EASING_COMPAT_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_EASING_COMPAT_JS");
			return $this->_style_array[15].$this->_style_array[16].'/'.$this->QUERY;
		}
		# GOOGLE ANALYTICS
		function JQUERY_GA_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_GA_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_GA_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_GA_JS");
			return $this->_style_array[19].$this->QUERY;
		}
		# MDB
		function JQUERY_MDB_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MDB_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_MDB_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MDB_VERSION");
			return $this->_style_array[21].$this->QUERY;
		}
		function JQUERY_MDB_CSS_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MDB_CSS_DIR");
			return $this->_style_array[22].'/'.$this->QUERY;
		}
		function JQUERY_MDB_CSS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MDB_CSS");
			return $this->_style_array[23].$this->QUERY;
		}
		function JQUERY_MDB_JS_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MDB_JS_DIR");
			return $this->_style_array[22].'/'.$this->QUERY;
		}
		function JQUERY_MDB_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MDB_JS");
			return $this->_style_array[25].$this->QUERY;
		}
		# MODERNIZR
		function JQUERY_MODERNIZR_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MODERNIZR_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_MODERNIZR_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MODERNIZR_VERSION");
			return $this->_style_array[27].$this->QUERY;
		}
		function JQUERY_MODERNIZR_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_MODERNIZR_JS");
			return $this->_style_array[27].$this->QUERY;
		}
		# POPPERJS
		function JQUERY_POPPERJS_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_POPPERJS_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_POPPERJS_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_POPPERJS_VERSION");
			return $this->_style_array[30].$this->QUERY;
		}
		function JQUERY_POPPERJS_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_POPPERJS_JS");
			return $this->_style_array[31].'/'.$this->QUERY;
		}
		# TINYMCE
		function JQUERY_TINYMCE_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_TINYMCE_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_TINYMCE_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_TINYMCE_VERSION");
			return $this->_style_array[33].$this->QUERY;
		}
		function JQUERY_TINYMCE_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_TINYMCE_JS");
			return $this->_style_array[34].'/js/'.$this->QUERY;
		}
		function JQUERY_TINYMCE_INIT(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_TINYMCE_INIT");
			return $this->_style_array[34].'/js/'.$this->QUERY;
		}
		# TETHER
		function JQUERY_TETHER_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_TETHER_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_TETHER_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_TETHER_VERSION");
			return $this->_style_array[37].$this->QUERY;
		}
		function JQUERY_TETHER_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_TETHER_JS");
			return $this->_style_array[38].'/js/'.$this->QUERY;
		}
		# WOW
		function JQUERY_WOW_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_WOW_DIR");
			return $this->_style_array[9].$this->QUERY;
		}
		function JQUERY_WOW_VERSION(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_WOW_VERSION");
			return $this->_style_array[40].$this->QUERY;
		}
		function JQUERY_WOW_JS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_WOW_JS");
			return $this->_style_array[41]."/".$this->QUERY;
		}
		function JQUERY_WOW_CSS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","JQUERY_WOW_CSS");
			return $this->_style_array[41]."/".$this->QUERY;
		}
		# STYLES
		function STYLES_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","STYLES_DIR");
			return $this->QUERY;
		}
		function THEMES_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","THEMES_DIR");
			return $this->QUERY;
		}
		function CORE_CSS_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","CORE_CSS_DIR");
			return $this->_style_array[44].$this->QUERY;
		}
		function UNI_CSS_DIR($ZONE,$TYPE){
			if($ZONE == "CMS"){
				if($TYPE == "STYLE"){
					return $this->_style_array[44].$this->Theme->_theme_array[3]."css/";
				}
				elseif($TYPE == "THEME"){
					return $this->_style_array[45].$this->Theme->_theme_array[4]."css/";
				}
			}
			elseif($ZONE == "ACP"){
				return $this->_style_array[44].$this->Theme->_theme_array[5]."css/";
			}
		}
		function UNI_CSS($ZONE,$TYPE,$CSS_NAME){
			return $this->UNI_CSS_DIR($ZONE,$TYPE).$this->QUERY("SETTINGS_STYLE",$ZONE."_".$CSS_NAME);
		}
		function UNI_IMAGES($ZONE,$IMG_TYPE=false){
			if($ZONE == "CMS"){
				if($IMG_TYPE == "LOGO"){
					return $this->_style_array[44].$this->Theme->_theme_array[3].'images/logo/';
				}
				elseif($IMG_TYPE == "C_LOGO"){
					return $this->_style_array[45].$this->Theme->_theme_array[4].'images/logo/';
				}
				elseif($IMG_TYPE == "WP"){
					return $this->_style_array[44].$this->Theme->_theme_array[3].'images/wp/';
				}
				elseif($IMG_TYPE == "C_WP"){
					return $this->_style_array[45].$this->Theme->_theme_array[4].'images/wp/';
				}
				elseif($IMG_TYPE == "ICON"){
					return $this->_style_array[44].$this->Theme->_theme_array[3].'images/icon/';
				}
				elseif($IMG_TYPE == "C_ICON"){
					return $this->_style_array[45].$this->Theme->_theme_array[4].'images/icon/';
				}
				elseif($IMG_TYPE == "MISC"){
					return $this->_style_array[44].$this->Theme->_theme_array[3].'images/misc/';
				}
				elseif($IMG_TYPE == "C_MISC"){
					return $this->_style_array[45].$this->Theme->_theme_array[4].'images/misc/';
				}
				elseif($IMG_TYPE == "AJAX"){
					return $this->_style_array[44].$this->Theme->_theme_array[4].'images/ajax/';
				}
				else{}
			}
			elseif($ZONE == "ACP"){
				if($IMG_TYPE == "WP"){
					return $this->_style_array[44].$this->Theme->_theme_array[5].$this->QUERY("SETTINGS_STYLE","IMAGES_DIR");
				}
				elseif($IMG_TYPE == "C_WP"){
					return $this->_style_array[44].$this->Theme->_theme_array[5].$this->QUERY("SETTINGS_STYLE","IMAGES_DIR");
				}
			}
		}
		function UNI_IMAGES_DIR($ZONE){
			$IMG_DIR	=	$this->QUERY("SETTINGS_STYLE","IMAGES_DIR");

			if($ZONE == "CMS"){
				return $this->UNI_THEME_CSS_DIR($ZONE).$this->Theme->_theme_array[4]($ZONE)."css/";
			}
			elseif($Zone == "ACP"){
				return $this->_style_array[31].$this->Theme->_theme_array[5].$this->QUERY("SETTINGS_STYLE","IMAGES_DIR");
			}
		}
		function FONTS_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","FONTS_DIR");
			return $this->_style_array[46].$this->QUERY;
		}
		function FONTAWESOME_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","FONTAWESOME_DIR");
			return $this->_style_array[48].$this->QUERY;
		}
		function FONTAWESOME_CSS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","FONTAWESOME_CSS");
			return $this->_style_array[49].'css/'.$this->QUERY;
		}
		function FONTICONS_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","FONTICONS_DIR");
			return $this->_style_array[48].$this->QUERY;
		}
		function FONTICONS_CSS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","FONTICONS_CSS");
			return $this->_style_array[51].'css/'.$this->QUERY;
		}
		function CUSTOM_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","CUSTOM_DIR");
			return $this->_style_array[46].$this->QUERY;
		}
		function ICONS_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","ICONS_DIR");
			return $this->_style_array[46].$this->QUERY;
		}
		function LOADLAB_DIR(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","LOADLAB_DIR");
			return $this->_style_array[46].$this->QUERY;
		}
		function LOADER_CSS(){
			$this->QUERY	=	$this->QUERY("SETTINGS_STYLE","LOADER_CSS");
			return $this->_style_array[53].$this->QUERY;
		}
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>