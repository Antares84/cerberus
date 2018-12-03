<?php
	class Display{

		# MAIN VARS
		public $PAGE_TITLE;public $PAGE_SUB;public $PAGEURI;public $PAGE_INDEX;public $PAGE;public $PAGE_ZONE;
		# PAGINATION
		public $ServerBase;public $TestURL;
		# PAYPAL VARS
		public $PP_DEBUG;public $PP_USE_SB;public $PP_URI;

		# CONSTRUCTOR
		function __construct($Content,$Data,$db,$Messenger,$Nav,$Paging,$Setting,$Stats,$Style,$Table,$Template,$Theme,$User,$Version){
			$this->Content		=	$Content;
			$this->Data			=	$Data;
			$this->db			=	$db;
			$this->Messenger	=	$Messenger;
			$this->Nav			=	$Nav;
			$this->Paging		=	$Paging;
			$this->Setting		=	$Setting;
			$this->Stats		=	$Stats;
			$this->Style		=	$Style;
			$this->Tbl			=	$Table;
			$this->Tpl			=	$Template;
			$this->Theme		=	$Theme;
			$this->User			=	$User;
			$this->Version		=	$Version;

			$this->Tpl->NoMsgArr();
		}
		# HEAD
		function UNI_HEAD_CORE(){
			echo '<!DOCTYPE html>';
			echo '<html lang="en">';
		}
		function UNI_HEAD_PAGINATION(){
			ucwords(str_ireplace(array('-','_','.php'),array(' ',''),$this->Paging->PAGE));

			$this->ServerBase = (ucwords(str_ireplace(array('-', '.php'),array(' ',''),$this->Paging->PAGE)));
			$this->TestURL = $this->ServerBase;

			if(substr_count($this->TestURL,'/') > 0){
				$this->TestURL = substr($this->TestURL,(strrpos($this->TestURL,'/') +1));
			}else{
				$this->TestURL = substr($this->TestURL,(strrpos($this->TestURL,'/')));
			}
		}
		function UNI_HEAD_META(){
			echo '<meta charset="utf-8">';
			echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
			echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
			echo '<meta name="Author" content="'.$this->Setting->AUTHOR.'"/>';
			echo '<meta name="Copyrights" content="'.$this->Setting->SITE_TITLE.'"/>';
			echo '<meta name="Designer" content="'.$this->Setting->SITE_TITLE.'"/>';
			echo '<meta name="Description" content=""/>';
			echo '<meta name="Robots" content="all"/>';
			echo '<meta name="Version" content="'.$this->Setting->VERSION().'"/>';
			echo '<meta name="Webmaster" content="'.$this->Setting->WEBMASTER.'"/>';
		}
		function UNI_HEAD_CACHE(){
			# Headers | Caching
				header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
				header('Cache-Control: no-store, no-cache, must-revalidate');
				header('Cache-Control: post-check=0, pre-check=0', FALSE);
				header('Pragma: no-cache');
		}
		function UNI_HEAD_TITLE(){
			if($this->Paging->PAGE_ZONE == "CMS"){
				echo '<title>';
					if(isset($this->Paging->PAGE_TITLE)){
						echo $this->Setting->SITE_TITLE." | ".$this->Paging->PAGE_TITLE;
					}
					else{
						echo $this->Setting->SITE_TITLE." | ".str_ireplace('_',' ',$this->TestURL);
					}
				echo '</title>';
			}
			if($this->Paging->PAGE_ZONE == "ACP"){
				echo '<title>';
					if(isset($this->Paging->PAGE_TITLE)){
						echo $this->Setting->ACP_SITE_TITLE." | ".$this->Paging->PAGE_TITLE;
					}
					else{
						echo $this->Setting->ACP_SITE_TITLE." | ".str_ireplace('_',' ',$this->TestURL);
					}
				echo '</title>';
			}
		}
		function UNI_HEAD_SS(){
			# FAVICON
			echo '<link rel="Shortcut Icon" type="image/png" href="'.$this->Style->_style_array[45].$this->Theme->_theme_array[10].'">';
			echo '<link rel="icon" type="image/png" href="'.$this->Style->_style_array[45].$this->Theme->_theme_array[10].'">';
			# CUSTOM FONT
			echo '<link href="https://fonts.googleapis.com/css?family=Tillana" rel="stylesheet" type="text/css">';
			# BOOTSTRAP
			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[13].'" media="all">';
			# WOW
#			echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[34].'" media="all">';

			if($this->Paging->PAGE_INDEX === "LANDING" || $this->Paging->PAGE_INDEX === "MAINTENANCE"){
				# MDB
				echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[9].'MDB/CSS/mdb.css" media="screen">'; # add to class {STYLE}
			}
			else{
				# MAIN
				echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->UNI_CSS($this->Paging->PAGE_ZONE,"STYLE","MASTER_CSS").'" media="all">';
				echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->UNI_CSS($this->Paging->PAGE_ZONE,"STYLE","CUSTOM_CSS").'" media="all">';
				# THEME
				if($this->Paging->PAGE_ZONE == "CMS"){
					echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->UNI_CSS($this->Paging->PAGE_ZONE,"THEME","THEME_CSS").'" media="all">';
				}
				# LoadLab Loaders
				echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[46].'bt-spinner.css" media="all">';
				# FONTSAWESOME
				echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[41].'" media="screen">';
				# JQUERYUI
				echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[7].'" media="all">';
				echo '<link rel="stylesheet" type="text/css" href="'.$this->Style->_style_array[8].'" media="all">';
			}
		}
		function UNI_HEAD_JS(){
			# JQUERY
			echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[2].'"></script>';
			# JQUERYUI
			echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[5].'"></script>';
			# GOOGLE ANALYTICS - fix loading error
			echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[18].'"></script>';

			if($this->Paging->PAGE_ZONE == "CMS"){
				# GOOOGLE RECAPTCHA V2.0
				#echo '<script src="https://www.google.com/recaptcha/api.js"></script>';
			}
			elseif($this->Paging->PAGE_ZONE == "ACP"){
				# PLUPLOAD
#				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[1].'PlUpload/plupload.full.min.js"></script>';
#				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[1].'PlUpload/init.plupload.js"></script>';
			}
		}
		function UNI_JS_ADDONS(){
			echo '<div class="addons_js">';
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';
				# TETHER
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[30].'"></script>';
				# BOOTSTRAP
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[14].'"></script>';
				# MODERNIZR
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[23].'"></script>';
				# JQUERY FADERS
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[10].'custom.faders.js"></script>';
				# TINYMCE TEXTBOX
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[26].'"></script>';
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[27].'"></script>';
				# WOW
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[33].'"></script>';

			if($this->Paging->PAGE_ZONE == "CMS"){
				# TICKET SYSTEM
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[10].'TicketSys.js"></script>';
			}
			if($this->Paging->PAGE_ZONE == "CMS" && $this->Paging->PAGE_TITLE === "Landing"){
				# MDB
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[10].'MDB/v4.3.2/mdb.js"></script>'; # add to class {STYLE}
			}
			elseif($this->Paging->PAGE_ZONE == "ACP"){
				# PLUPLOAD
				#echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[1].'PlUpload/init.plupload.js"></script>';
			}

				# INITIALIZERS - MUST BE LOADED LAST!
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[10].'jquery_init.js"></script>';
				# CUSTOM THEME JS
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[9].'Themes/'.$this->Theme->_theme_array[4].'theme.js"></script>';
			echo '</div>';
		}
		# DISPLAY LOADERS
		function LaunchDisplay(){
			$this->Load_Head();
			$this->Load_Content($this->Paging->PAGE_ZONE);
		}
		function Load_Head(){
			echo '<head>';
				$this->UNI_HEAD_CORE();
				$this->UNI_HEAD_PAGINATION();
				$this->UNI_HEAD_META();
				$this->UNI_HEAD_CACHE();
				$this->UNI_HEAD_TITLE();
				$this->UNI_HEAD_SS();
				$this->UNI_HEAD_JS(); # fix loading error for Google Analytics
			echo '</head>';
		}
		function Load_Nav($Zone){
			if($Zone == "CMS"){
				if($this->Paging->PAGE_INDEX === "LANDING" || $this->Paging->PAGE_INDEX === "MAINTENANCE"){
					
				}
				else{
					if($this->Theme->_theme_array[2]){
						$this->Nav->NAV_SERVER_STATUS();
						$this->Nav->NAV_TOP($Zone);
					}
					else{
						$this->Nav->NAV_TOP($Zone);
						echo $this->Tpl->Separator("40");
					}

				//	if($this->Paging->PAGE_INDEX === "AUTH"){}
				}
			}
			elseif($Zone == "ACP"){
				$this->Nav->NavTop($this->Paging->PAGE_ZONE);
			}
		}
		function Load_Content($Zone){
			$this->Tpl->BG_IMG($Zone);

			if($Zone == "CMS"){
				$this->Load_Nav($Zone);

				if($this->Paging->PAGE_INDEX === "LANDING" || $this->Paging->PAGE_INDEX === "MAINTENANCE"){
					$this->Content->PAGE_landing($this->Paging->PAGE);
				}
				elseif(
					$this->Paging->PAGE_INDEX === "AUTH" ||
					$this->Paging->PAGE_INDEX === "REGISTER" ||
					$this->Paging->PAGE_INDEX === "USER_PROFILE" ||
					$this->Paging->PAGE_INDEX === "PvP"
				){
					if(!empty($this->Tpl->LOGO_IMG($Zone,"LOGO"))){
						echo $this->Tpl->LOGO_IMG($Zone,"LOGO");
					}
					elseif(!empty($this->Tpl->LOGO_IMG($Zone,"C_LOGO"))){
						echo $this->Tpl->LOGO_IMG($Zone,"C_LOGO");
					}

					$this->Content->C_MESSENGER();
					echo $this->Tpl->Separator('10');

					if($this->Theme->_theme_array[0] === "1"){
						$this->Content->C_CONTENT($Zone);
					}
					else{
						if($this->Theme->_theme_array[1] === "0"){
							$this->Content->C_CONTENT($this->Paging->PAGE_ZONE);
						}
						elseif($this->Theme->_theme_array[1] === "1"){
							$this->Content->C_CONTENT($this->Paging->PAGE_ZONE);
						}
						elseif($this->Theme->_theme_array[1] === "2"){
							$this->Content->C_CONTENT($this->Paging->PAGE_ZONE);
						}
					}
					echo $this->Tpl->Separator('60');
					$this->Content->body_footer($Zone);
				}
				else{
					if(!empty($this->Tpl->LOGO_IMG($this->Paging->PAGE_ZONE,"LOGO"))){
						echo $this->Tpl->LOGO_IMG($this->Paging->PAGE_ZONE,"LOGO");
					}
					elseif(!empty($this->Tpl->LOGO_IMG($this->Paging->PAGE_ZONE,"C_LOGO"))){
						echo $this->Tpl->LOGO_IMG($this->Paging->PAGE_ZONE,"C_LOGO");
					}
					echo $this->Tpl->Separator('10');
					$this->Content->C_HEADER();

					$this->Content->C_MESSENGER();
					echo $this->Tpl->Separator('10');

					if($this->Theme->_theme_array[0] === "1"){
						$this->Content->C_CONTENT($this->Paging->PAGE_ZONE);
					}
					else{
						if($this->Theme->_theme_array[1] === "0"){
							$this->Content->C_CONTENT($this->Paging->PAGE_ZONE);
						}
						elseif($this->Theme->_theme_array[1] === "1"){
							$this->Content->C_CONTENT($this->Paging->PAGE_ZONE);
						}
						elseif($this->Theme->_theme_array[1] === "2"){
							$this->Content->C_CONTENT($this->Paging->PAGE_ZONE);
						}
					}
					echo $this->Tpl->Separator('60');
					$this->Content->body_footer($this->Paging->PAGE_ZONE);
				}
			}
			elseif($Zone == "ACP"){
				$this->Content->C_CONTENT($Zone);
			}

			$this->Messenger->Close();
			// Load jQuery Addons Array
			$this->UNI_JS_ADDONS();
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
	}
?>