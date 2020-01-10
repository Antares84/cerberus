<?php
	namespace Classes\Base;

	#############################################################################################
	#	Title: Dirs.class.php																	#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS Dirs class, used for loading all CMS directory-specific resources				#
	#	Last Update Date: 01.09.2019 1633														#
	#############################################################################################
	class Dirs{

		public $_arr;

		public function __construct($Arrays){
			$this->Arrays	=	$Arrays;

			$this->_class_info();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _class_info($level=false){
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
				default	:	return $this->_build();	break;
			}
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
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit;
		}

		# Private Methods
		private function _build(){
			if($this->_arr){$this->_arr=null;}
			$this->_a=array();

			$class_methods	=	get_class_methods($this);

			foreach($class_methods as $method_name){
				if(@!in_array($method_name,$this->Arrays->no_index)){
					try{
						$this->$method_name();
						$this->_do_close();
					#	echo $method_name.'<br>';
					}
					catch(exception $e){
						throw new SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
					}
				}
			}

			$this->_do_close(true);
		}
		private function _do_close($push=false){
			$this->_arr=$this->_a;

			if($push){unset($this->_a);}
		}
		# \src
		private function _src(){
			$this->_a["SRC"]='src/';
		}
		private function _src_classes(){
			$this->_a["CLASSES"]=$this->_arr["SRC"].'Classes/';
		}
		# \src\Content
		private function _src_content(){
			$this->_a["CONTENT"]=$this->_arr["SRC"].'Content/';
		}
		# \src\Content\AP
		private function _src_content_ap(){
			$this->_a["AP"]=$this->_arr["CONTENT"].'AP/';
		}
		private function _src_content_ap_account(){
			$this->_a["ACCOUNT"]=$this->_arr["AP"].'Account/';
		}
		private function _src_content_ap_developer(){
			$this->_a["DEVELOPER"]=$this->_arr["AP"].'Developer/';
		}
		private function _src_content_ap_jts3servermod(){
			$this->_a["JTS3"]=$this->_arr["AP"].'JTS3ServerMod/';
		}
		private function _src_content_ap_main(){
			$this->_a["MAIN"]=$this->_arr["AP"].'Main/';
		}
		private function _src_content_ap_paging(){
			$this->_a["PAGING"]=$this->_arr["AP"].'Paging/';
		}
		private function _src_content_ap_player(){
			$this->_a["PLAYER"]=$this->_arr["AP"].'Player/';
		}
		private function _src_content_ap_pmt_office(){
			$this->_a["PMTOFFICE"]=$this->_arr["AP"].'PmtOffice/';
		}
		private function _src_content_ap_session(){
			$this->_a["SESSION"]=$this->_arr["AP"].'Session/';
		}
		private function _src_content_ap_settings(){
			$this->_a["SETTINGS"]=$this->_arr["AP"].'Settings/';
		}
		private function _src_content_ap_site(){
			$this->_a["SITE"]=$this->_arr["AP"].'Site/';
		}
		private function _src_content_ap_staff(){
			$this->_a["STAFF"]=$this->_arr["AP"].'Staff/';
		}
		private function _src_content_ap_tracker(){
			$this->_a["TRACKER"]=$this->_arr["AP"].'Tracker/';
		}
		# src\Content\CMS
		private function _src_content_cms(){
			$this->_a["CMS"]=$this->_arr["CONTENT"].'CMS/';
			$this->_do_close();
		}
		private function _src_content_cms_auth(){
			$this->_a["AUTH"]=$this->_arr["CMS"].'Auth/';
		}
		private function _src_content_cms_info(){
			$this->_a["INFO"]=$this->_arr["CMS"].'Info/';
		}
		private function _src_content_cms_it(){
			$this->_a["IT"]=$this->_arr["CMS"].'IT/';
		}
		private function _src_content_cms_mail(){
			$this->_a["MAIL"]=$this->_arr["CMS"].'Mail/';
		}
		private function _src_content_cms_main(){
			$this->_a["MAIN"]=$this->_arr["CMS"].'Main/';
		}
		private function _src_content_cms_member(){
			$this->_a["MEMBER"]=$this->_arr["CMS"].'Member/';
		}
		# \src\Installer
		private function _src_installer(){
			$this->_a["INSTALLER"]=$this->_arr["SRC"].'Installer/';
			$this->_do_close();
		}
		# \src\Modules
		private function _src_modules(){
			$this->_a["MODULES"]=$this->_arr["SRC"].'Modules/';
			$this->_do_close();
		}
		private function _src_modules_pkgs(){
			$this->_a["MOD_PKGS"]=$this->_arr["MODULES"].'Packages/';
			$this->_do_close();
		}
		private function _src_modules_xml(){
			$this->_a["MOD_XML"]=$this->_arr["MODULES"].'XML';
			$this->_do_close();
		}
		private function _src_modules_pkgs_ipn(){
			$this->_a["IPN"]=$this->_arr["MOD_PKGS"].'PayPal_IPN/';
		}
		private function _src_modules_pkgs_phpmailer(){
			$this->_a["PHPMAILER"]=$this->_arr["MOD_PKGS"].'PHPMailer/';
		}
		private function _src_modules_pkgs_recaptcha(){
			$this->_a["RECAPTCHA"]=$this->_arr["MOD_PKGS"].'ReCaptcha_v2/';
		}
		# \src\Resources
		private function _src_res(){
			$this->_a["RES"]=$this->_arr["SRC"].'Resources/';
			$this->_do_close();
		}
		private function _src_res_downloads(){
			$this->_a["DOWNLOADS"]=$this->_arr["RES"].'Downloads/';
		}
		private function _src_res_filestore(){
			$this->_a["FILESTORE"]=$this->_arr["RES"].'Filestore/';
		}
		# \src\Resources\jQuery
		private function _src_res_jquery(){
			$this->_a["JQUERY"]=$this->_arr["RES"].'jQuery/';
			$this->_do_close();
		}
		private function _src_res_jquery_addons(){
			$this->_a["ADDONS"]=$this->_arr["JQUERY"].'Addons/';
			$this->_do_close();
		}
		# \src\Resources\jQuery\Addons
		private function _src_res_jquery_addons_ajax(){
			$this->_a["AJAX"]=$this->_arr["ADDONS"].'AJAX/';
		}
		private function _src_res_jquery_addons_bootstrap(){
			$this->_a["BOOTSTRAP"]=$this->_arr["ADDONS"].'Bootstrap/';
		}
		private function _src_res_jquery_addons_google(){
			$this->_a["GOOGLE"]=$this->_arr["ADDONS"].'Google/';
		}
		private function _src_res_jquery_addons_mdb(){
			$this->_a["MDB"]=$this->_arr["ADDONS"].'MDB/';
		}
		private function _src_res_jquery_addons_morris(){
			$this->_a["MORRISJS"]=$this->_arr["ADDONS"].'MorrisJS/';
		}
		private function _src_res_jquery_addons_popper(){
			$this->_a["POPPERJS"]=$this->_arr["ADDONS"].'PopperJS/';
		}
		private function _src_res_jquery_addons_themes(){
			$this->_a["THEMES"]=$this->_arr["ADDONS"].'Themes/';
		}
		private function _src_res_jquery_addons_tinymce(){
			$this->_a["TINYMCE"]=$this->_arr["ADDONS"].'TinyMCE/';
		}
		private function _src_res_jquery_addons_wow(){
			$this->_a["WOW"]=$this->_arr["ADDONS"].'Wow/';
		}
		# src\Resources\jQuery\Core
		private function _src_res_jquery_core(){
			$this->_a["JS_CORE"]=$this->_arr["JQUERY"].'Core/';
		}
		# \src\Resources\jQuery\Custom
		private function _src_res_jquery_custom(){
			$this->_a["JS_CUSTOM"]=$this->_arr["JQUERY"].'Custom/';
		}
		# \src\Resources\jQuery\Tools
		private function _src_res_jquery_tools(){
			$this->_a["TOOLS"]=$this->_arr["JQUERY"].'Tools/';
		}
		# \src\Resources\jQuery\UI
		private function _src_res_jquery_ui(){
			$this->_a["UI"]=$this->_arr["JQUERY"].'UI/';
		}
		# \src\Resources\Styles
		private function _src_res_styles(){
			$this->_a["STYLES"]=$this->_arr["RES"].'Styles/';
		}
		# \src\Resources\Styles\AP
		private function _src_res_styles_ap(){
			$this->_a["AP"]=$this->_arr["STYLES"].'AP/';
			$this->_do_close();
		}
		# \src\Resources\Styles\AP\CSS
		private function _src_res_styles_ap_css(){
			$this->_a["CSS"]=$this->_arr["AP"].'CSS/';
		}
		# \src\Resources\Styles\AP\Images
		private function _src_res_styles_ap_images(){
			$this->_a["IMG"]=$this->_arr["AP"].'Images/';
		}
		# \src\Resources\Styles\Core
		private function _src_res_styles_core(){
			$this->_a["S_CORE"]=$this->_arr["STYLES"].'Core/';
		}
		# \src\Resources\Styles\Core\Custom
		private function _src_res_styles_core_custom(){
			$this->_a["CUSTOM"]=$this->_arr["S_CORE"].'Custom/';
		}
		# \src\Resources\Styles\Core\Fonts
		private function _src_res_styles_core_fonts(){
			$this->_a["FONTS"]=$this->_arr["S_CORE"].'Fonts/';
		}
		# \src\Resources\Styles\Core\Fonts\FontAwesome
		private function _src_res_styles_core_fonts_fontawesome(){
			$this->_a["FA"]=$this->_arr["FONTS"].'FontAwesome/';
		}
		# \src\Resources\Styles\Core\Fonts\FontIcons
		private function _src_res_styles_core_fonts_fonticons(){
			$this->_a["FI"]=$this->_arr["FONTS"].'FontIcons/';
		}
		# \src\Resources\Styles\Core\Icons
		private function _src_res_styles_core_icons(){
			$this->_a["ICO"]=$this->_arr["S_CORE"].'Icons/';
		}
		# \src\Resources\Styles\Core\LoadLab
		private function _src_res_styles_core_loadlab(){
			$this->_a["LL"]=$this->_arr["S_CORE"].'LoadLab/';
		}
		# \src\Resources\Styles\Standard
		private function _src_res_styles_std(){
			$this->_a["STD"]=$this->_arr["STYLES"].'Standard/';
		}
		private function _src_res_styles_std_css(){
			$this->_a["CSS"]=$this->_arr["STD"].'CSS/';
		}
		private function _src_res_styles_std_images(){
			$this->_a["IMG"]=$this->_arr["STD"].'Images/';
		}
		# src\Resources\Themes
		private function _src_res_themes(){
			$this->_a["THEMES"]=$this->_arr["RES"].'Themes/';
		}
		private function _src_res_themes_gl(){
			$this->_a["GLAZED"]=$this->_arr["THEMES"].'Glazed/';
		}
		private function _src_res_themes_sh(){
			$this->_a["SHADOWS"]=$this->_arr["THEMES"].'Shadows/';
		}
		private function _src_res_themes_su(){
			$this->_a["SURFACE"]=$this->_arr["THEMES"].'Surface/';
		}
		# src\Resources\Uploads
		private function _src_res_uploads(){
			$this->_a["UPL"]=$this->_arr["RES"].'Uploads/';
		}
		# src\Resources\XML
		private function _src_res_xml(){
			$this->_a["XML"]=$this->_arr["RES"].'XML/';
		}
		# src\Updates
		private function _src_res_updates(){
			$this->_a["UPD"]=$this->_arr["RES"].'Updates/';
		}
		# \src\Updates\Downloader
		private function _src_res_updates_downloader(){
			$this->_a["DL"]=$this->_arr["UPD"].'Downloader/';
		}
		# \src\Updates\SQL
		private function _src_res_updates_sql(){
			$this->_a["SQL"]=$this->_arr["UPD"].'SQL/';
		}
		# MISC
		function _is_Writable_Path($home,$xpath){
			$isOK = false;
			$path = trim($xpath);

			if(($path!="") && (strpos($path,$home) !== false) && is_dir($path) && is_writable($path)){
				$tmpfile = "mPC_".uniqid(mt_rand()).'.writable';
				$fullpathname = str_replace('//','/',$path."/".$tmpfile);
				$fp = @fopen($fullpathname,"w");
				if($fp !== false){
					$isOK = true;
				}

				@fclose($fp);
				@unlink($fullpathname);
			}

			return $isOK;
		}
	}
?>