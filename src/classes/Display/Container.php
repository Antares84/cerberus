<?php
	namespace classes\display;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Container{

		public $container_type;
		private $PAGE_TITLE;private $PAGE_SUB;private $PAGEURI;private $PAGE_INDEX;private $PAGE;
		private $STANDALONE;private $COLUMNS;
		private $SITE_TYPE;
		private $target;
		private $dev_block=false;

		# Public Methods
		public function __construct($Arrays,$BossRecord,$Browser,$Cards,$Colors,$Data,$DateTime,$Dirs,$Donate,$FileSys,$Journal,$LogSys,$MailSys,$Messenger,$Modal,$Modules,$MSSQL,$Nav,$Notices,$Paging,$PayPal,$PHP,$PvP,$Select,$Session,$Setting,$ShChar,$ShUser,$SQL,$Style,$Tbl,$Tpl,$Theme,$Tooltips,$User,$Version,$Visitors,$Wow,$XML
		){
			$this->Arrays		=	$Arrays;
			$this->BossRecord	=	$BossRecord;
			$this->Browser		=	$Browser;
			$this->Cards		=	$Cards;
			$this->Colors		=	$Colors;
			$this->Data			=	$Data;
			$this->DateTime		=	$DateTime;
			$this->Dirs			=	$Dirs;
			$this->Donate		=	$Donate;
			$this->FileSys		=	$FileSys;
			$this->Journal		=	$Journal;
			$this->LogSys		=	$LogSys;
			$this->MailSys		=	$MailSys;
			$this->Messenger	=	$Messenger;
			$this->Modal		=	$Modal;
			$this->Modules		=	$Modules;
			$this->MSSQL		=	$MSSQL;
			$this->Nav			=	$Nav;
			$this->Notices		=	$Notices;
			$this->Paging		=	$Paging;
			$this->PayPal		=	$PayPal;
			$this->PHP			=	$PHP;
			$this->PvP			=	$PvP;
			$this->Select		=	$Select;
			$this->Session		=	$Session;
			$this->Setting		=	$Setting;
			$this->ShChar		=	$ShChar;
			$this->ShUser		=	$ShUser;
			$this->SQL			=	$SQL;
			$this->Style		=	$Style;
			$this->Tbl			=	$Tbl;
			$this->Tpl			=	$Tpl;
			$this->Theme		=	$Theme;
			$this->Tooltips		=	$Tooltips;
			$this->User			=	$User;
			$this->Version		=	$Version;
			$this->Visitors		=	$Visitors;
			$this->Wow			=	$Wow;
			$this->XML			=	$XML;

			# Paging
			$this->PAGE			=	$this->Paging->_arr["PAGE"];
			$this->PAGE_INDEX	=	$this->Paging->_arr["PAGE_INDEX"];
			$this->PAGE_SUB		=	$this->Paging->_arr["PAGE_SUB"];
			$this->PAGE_TITLE	=	$this->Paging->_arr["PAGE_TITLE"];
			$this->PAGE_URI		=	$this->Paging->_arr["PAGE_URI"];
			$this->PAGE_ZONE	=	$this->Paging->_arr["PAGE_ZONE"];
			$this->STANDALONE	=	$this->Paging->_arr["STANDALONE"];
			$this->COLUMNS		=	$this->Paging->_arr["COLUMNS"];

			# Settings
			$this->SITE_TYPE	=	$this->Setting->_arr["SITE_TYPE"];
		}
		public function _load(){
		//	$this->Paging->_page_stats();
		//	$this->_container_stats();
			$this->_load_content();
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
		public function _Mthds(){
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
		

		# Private Methods
		# Nav Builder
		private function _load_nav($type){
			$method	=	'_nav_'.$this->PAGE_ZONE;
			$err	=	'Method doesn\'t exist!';

			if(method_exists($this,$method)){
				return $this->$method($type);
			}

			return $err;
		}
		private function _nav_cms($type=false){
			$this->Nav->_load($type);
		}
		private function _nav_ap($type=false){
			$this->Nav->_load($type);
		}
		private function _breadcrumb(){
			if($this->PAGE_ZONE == "CMS"){
				echo '<div id="bread" class="container"';
				if($this->Theme->_arr["PANE_BG_COLOR"] && $this->Theme->_arr["PANE_BG_TRANS"]){
					echo ' style="background-color:rgba('.$this->Theme->_arr["PANE_BG_COLOR"].','.$this->Theme->_arr["PANE_BG_TRANS"].');"';
				}
				else{
					echo '>';
				}
					echo '<div class="col-md-12 no_padding">';
						echo '<nav>';
							echo '<ol class="breadcrumb';
							if($this->Theme->_arr["BREAD_BG_COLOR"]){echo ' '.$this->Theme->_arr["BREAD_BG_COLOR"].'">';}
							else{echo ' no_bg">';}
							if($this->PAGE_INDEX != "HOME"){
								echo '<li class="breadcrumb-item">';
									echo '<a href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=HOME">Home</a>';
								echo '</li>';
								if($this->PAGE_SUB){
									echo '<li class="breadcrumb-item" aria-current="PAGE">'.$this->PAGE_SUB.'</li>';
								}
								echo '<li class="breadcrumb-item active" aria-current="PAGE">';
									echo '<a href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$this->PAGE_INDEX.'">'.$this->PAGE_TITLE.'</a>';
								echo '</li>';
							}else{
								echo '<li class="breadcrumb-item active" aria-current="PAGE">Home</li>';
							}
							echo '</ol>';
						echo '</nav>';
					echo '</div>';
				echo '</div>';
			}
			elseif($this->Paging->PAGE_ZONE == "ACP"){
				if($this->User->_is_Logged_In()){
					echo '<div class="row">';
						echo '<div class="col-lg-12">';
							
							echo '<nav aria-label="breadcrumb">';
								echo '<ol class="breadcrumb bg-dark">';
									echo '<h1 class="PAGE-header">'.$this->Paging->PAGE_TITLE;if(!empty($this->Paging->PAGE_SUB)){echo '<small> - '.$this->Paging->PAGE_SUB.'</small>';}echo '</h1>';
								echo '</ol>';

								echo '<ol class="breadcrumb bg-dark">';
								if($this->Paging->PAGE_INDEX != "DASHBOARD"){
									echo '<li class="breadcrumb-item"><a href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=DASHBOARD">Dashboard</a></li>';
									if($this->Paging->PAGE_SUB){
										echo '<li class="breadcrumb-item active" aria-current="PAGE">'.$this->Paging->PAGE_SUB.'</li>';
									}
									echo '<li class="breadcrumb-item active" aria-current="PAGE">'.$this->Paging->PAGE_TITLE.'</li>';
								}else{
									echo '<li class="breadcrumb-item active" aria-current="PAGE">Dashboard</li>';
								}
								echo '</ol>';
							echo '</nav>';
						echo '</div>';
					echo '</div>';
				}
			}
		}
		# Content Builder
		private function _load_content(){
			$method	=	'_content_'.$this->PAGE_ZONE;
			$err	=	'Method doesn\'t exist!';

			if(method_exists($this,$method)){
				return $this->$method();
			}

			return $err;
		}
		private function _content_cms(){
			$Tpl_Header		=	new Templates\CMS\Header($this->Paging,$this->Tpl);
			$Tpl_Sidebar	=	new Templates\CMS\Sidebar($this->Modules,$this->Theme);
		#	$this->Setting->_do_maint_chk($this->Paging->PAGE_INDEX);
			# Load body && background + styling
			$this->Tpl->_do_build_bg($this->PAGE_ZONE);
			# Load nav
			$this->_load_nav(0);
			# Load content
			echo '<div class="container-fluid page-wrapper">';
			# Check if current page is set to standalone
			if($this->STANDALONE == 1){
				if($this->COLUMNS == 1){
					# Load header/logo
					$this->_header($this->PAGE_ZONE);
					# Load Dev Block
					if($this->dev_block){
						$this->_dev_block();
					}
				# Load messenger/error container
				#	$this->Content->_get_MESSENGER();
				#	echo $this->Tpl->Separator('10');
					echo '<div id="content" class="container"';
						if($this->Theme->_arr["PANE_BG_COLOR"] && $this->Theme->_arr["PANE_BG_TRANS"]){
							echo ' style="background-color:rgba('.$this->Theme->_arr["PANE_BG_COLOR"].','.$this->Theme->_arr["PANE_BG_TRANS"].');"';
						}
						else{
							echo '>';
						}
						echo '<div class="row">';
						if($this->Theme->_arr["SIDEBAR_POS"] == "0" || $this->Theme->_arr["MODULES_STATUS"] ==  false){
							# Content full-width + no sidebar
							echo '<div class="col-md-12">';
								require_once($this->PAGE);
							echo '</div>';
						}
						else{
							# Sidebar Left
							if($this->Theme->_arr["SIDEBAR_POS"] === "1"){
								echo '<div class="col-md-12">';
									echo '<div class="row">';
										echo '<div class="col-md-3">';
											$this->_sidebar();
										echo '</div>';
										echo '<div class="col-md-9">';
											require_once($this->PAGE);
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
							# Sidebar Right
							elseif($this->Theme->_arr["SIDEBAR_POS"] === "2"){
								echo '<div class="col-md-12">';
									echo '<div class="row">';
										echo '<div class="col-md-9">';
											require_once($this->PAGE);
										echo '</div>';
										echo '<div class="col-md-3">';
											$this->_sidebar();
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						}
						echo '</div>';
					echo '</div>';
				}
				else{
					# Load header/logo
					$Tpl_Header->PageZone	=	$this->PAGE_ZONE;
					$Tpl_Header->_run();
					# Load Dev Block
					if($this->dev_block){
						$this->_dev_block();
					}
					# Load page content
					require_once($this->PAGE);
					# Load Sidebar
					$Tpl_Sidebar->output;
				}
			}
			else{
				# Load header/logo
				$Tpl_Header->PageZone	=	$this->PAGE_ZONE;
				$Tpl_Header->_run();

				# Load Dev Block
				if($this->dev_block){$this->_dev_block();}

				# Load messenger/error container
			#	$this->Content->_get_MESSENGER();
			#	echo $this->Tpl->Separator('10');


				# Load Page Container
				echo '<div id="content" class="container"';
					if($this->Theme->_arr["PANE_BG_COLOR"] && $this->Theme->_arr["PANE_BG_TRANS"]){
						echo ' style="background-color:rgba('.$this->Theme->_arr["PANE_BG_COLOR"].','.$this->Theme->_arr["PANE_BG_TRANS"].');"';
					}
					else{
						echo '>';
					}
					echo '<div class="row">';
					if($this->Theme->_arr["SIDEBAR_POS"] == "0" || $this->Theme->_arr["MODULES_STATUS"] ==  false){
						# Content full-width + no sidebar
						echo '<div class="col-md-12">';
							require_once($this->PAGE);
						echo '</div>';
					}
					else{
						# Sidebar Left
						if($this->Theme->_arr["SIDEBAR_POS"] === "1"){
						echo '<div class="col-md-12">';
								echo '<div class="row">';
									echo '<div class="col-md-3">';
										$T_Sidebar=new Templates\CMS\Sidebar;
										echo $T_Sidebar->output;
									echo '</div>';
									echo '<div class="col-md-9">';
										require_once($this->PAGE);
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
						# Sidebar Right
						elseif($this->Theme->_arr["SIDEBAR_POS"] === "2"){
							echo '<div class="col-md-12">';
								echo '<div class="row">';
									echo '<div class="col-md-9">';
										require_once($this->PAGE);
									echo '</div>';
									echo '<div class="col-md-3">';
										$this->_sidebar();
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					}
					echo '</div>';
				echo '</div>';
			}

			$this->Tpl->Separator(100);

			# Load footer resources
			$this->_load_footer();

			# Load modal resources
			$this->Modal->_get_MDOAL_LINKS();
			$this->Modal->_get_MODAL_SCRIPTS();

			# Close html
			$this->_close_content();
		}
		private function _content_ap(){
			# Load background
			$this->Tpl->_do_build_bg($this->PAGE_ZONE);

			# Load top nav
			$this->_load_nav(0);

			# Load wrapper for sidebar/main content
			echo '<div id="wrapper">';
				$this->Nav->_do_build_ap_nav_sb(2);

				# Load content-wrapper for breadcrumb && main content
				echo '<div id="content-wrapper">';
					echo '<div class="container-fluid">';
						echo $this->_breadcrumb();
					echo '</div>';

					echo '<div class="container-fluid">';
						require_once($this->PAGE);
					echo '</div>';
				echo '</div>';
			echo '</div>';
			$this->_load_footer();
		}
		private function _close_content(){
			$this->_js_addons_shared();
			echo '</body>';
			echo '</html>';
		}
		private function _sidebar(){
			
		}
		# Footer Builder
		private function _load_footer(){
			switch($this->PAGE_ZONE){
				case 'AP'	:	$T_Footer=new Templates\AP\Footer($this->Paging,$this->Setting,$this->Theme,$this->Tpl,$this->User);break;
				case 'CMS'	:	$T_Footer=new Templates\CMS\Footer($this->Paging,$this->Setting,$this->Theme,$this->Tpl,$this->User);break;
			}

			$T_Footer->_run();
			echo $T_Footer->output;
		}
		private function _footer_cms(){
			echo '<div class="cms_footer">';
				echo '<div class="container">';

					if(!empty($this->Theme->_arr["FOOTER_STATUS"])){$this->_footer_links_1($this->PAGE_ZONE);}
					if(!empty($this->Theme->_arr[19])){$this->_footer_links_2($this->PAGE_ZONE);}
					if(!empty($this->Theme->_arr[19])){$this->_footer_links_3($this->PAGE_ZONE);}

					echo '<div class="row">';
						echo '<div class="col-md-12 col-sm-12 tac">';
						if(isset($_SESSION)){
							if($this->User->ADM && $this->User->_is_Logged_In()){
							echo $this->Tpl->Separator("10");
							echo '<a href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=DASHBOARD" target="_blank" class="badge badge-primary b_i f_14">Administration Control Panel</a><br>';
							echo $this->Tpl->Separator("10");
						}
						}
						
							echo $this->Theme->_arr["FOOTER_COPYRIGHT"].'<br>';
							echo 'Powered By: <font class="b_i">Cerberus CMS </font><label class="badge badge-primary b_i f14">v'.$this->Setting->_arr["VERSION"].'</label>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		private function _footer_ap(){
			echo '<div class="row hidden-sm-down acp_footer text-center b_i f_20 bg-dark no_padding">';
				echo '<div class="col-md-2"></div>';
				echo '<div class="col-md-10 tac posh">';
					echo $this->Theme->_arr["COPYRIGHT"].' <label class="badge badge-primary b_i f_14">v'.$this->Setting->_arr["VERSION"].'</label>';
				echo '</div>';
			echo '</div>';
		}
		private function _footer_links_1($Zone){
			echo '<div class="row">';
				echo '<div class="col-md-4 col-sm-12 tac"></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="mailto:'.$this->Setting->_arr["EMAIL_SUPPORT"].'">Contact Us</a></div>';
			echo '</div>';
		}
		private function _footer_links_2($Zone){
			echo '<div class="row">';
				echo '<div class="col-md-4 col-sm-12 tac"></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="mailto:'.$this->Setting->_stng_array[7].'">Contact Us</a></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="#">Sponsor 3</a></div>';
			echo '</div>';
		}
		private function _footer_links_3($Zone){}
		private function _footer_links_4($Zone){}
		private function _footer_links_5($Zone){}
		private function _load_js_addons(){
			$method	=	'_js_addons_'.$this->PAGE_ZONE;
			$err	=	'Method doesn\'t exist!';

			if(method_exists($this,$method)){
				return $this->$method();
			}

			return $err;
		}
		private function _js_addons_shared(){
			echo '<div class="addons_js">';
				# BOOTSTRAP
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["BS_JS"].'"></script>';
				# FONTAWESOME
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["FONTAWESOME_JS"].'"></script>';
				# JQUERY FADERS
			#	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr[42].'custom.faders.js"></script>';
				# TINYMCE TEXTBOX
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["TINYMCE_JS"].'"></script>';
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["TINYMCE_INIT"].'"></script>';
				# WOW
			#	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["WOW_JS"].'"></script>';

				$this->_load_js_addons();

				# INITIALIZERS - MUST BE LOADED LAST!
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr["JS_CUSTOM"].'jquery_init.js"></script>';
			echo '</div>';
		}
		private function _js_addons_cms(){
			# TICKET SYSTEM
		#	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr[10].'TicketSys.js"></script>';
			# CUSTOM THEME JS
		#	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr[59].$this->Theme->_arr["CMS_THEME_NAME"].'JS/theme_core.js"></script>';
			if($this->PAGE_INDEX === "LANDING" || $this->Paging->PAGE_INDEX === "MAINTENANCE"){
				# MDB
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_arr["MDB_JS"].'"></script>';
			}
		}
		private function _js_addons_ap(){
			# PLUPLOAD
				#echo '<script charset="utf-8" type="text/javascript" src="'.$this->Style->_style_array[1].'PlUpload/init.plupload.js"></script>';
				# CUSTOM THEME JS
				echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr[59].$this->Theme->_arr["ACP_THEME_NAME"].'JS/theme_core.js"></script>';
				# Custom Scrollbars
			#	echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr[31].'MCS/jquery.mCustomScrollbar.concat.min.js"></script>';
		}
		private function _messenger(){
			if(!isset($_SESSION["MESSAGES"])){
				$_SESSION["MESSAGES"] = $this->Messenger->Init();
			}
			elseif(isset($_SESSION["MESSAGES"]) && !empty($_SESSION["MESSAGES"])){
				echo '<div class="container no_padding msg_container">';
					echo '<div class="row msg_data" style="border:1px solid lime;">';
						echo '<div class="col-md-12">';
							echo $this->Messenger->Display($_SESSION["MESSAGES"]);
							#$this->Messenger->Close();
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}
		private function _container_stats(){
			echo '<div class="container-fluid page-wrapper">';
				echo '<div id="content" class="container">';
					echo '<div class="row">';
						echo '<div class="col-md-4"></div>';
						echo '<div class="col-md-4">';
							echo '<div class="table-responsive">';
								echo '<table class="table table-sm table-bordered table-striped acp_table tac">';
									echo '<tr>';
										echo '<td>Page</td>';
										echo '<td>'.$this->PAGE.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page Index</td>';
										echo '<td>'.$this->PAGE_INDEX.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page Sub</td>';
									if(empty($this->PAGE_SUB)){echo '<td>NULL</td>';}
									else{echo '<td>'.$this->PAGE_SUB.'</td>';}
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page Title</td>';
										echo '<td>'.$this->PAGE_TITLE.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page URI</td>';
										echo '<td>'.$this->PAGE_URI.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page Zone</td>';
										echo '<td>'.$this->PAGE_ZONE.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Standalone</td>';
										echo '<td>'.$this->STANDALONE.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Columns</td>';
										echo '<td>'.$this->COLUMNS.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Site Type</td>';
										echo '<td>'.$this->SITE_TYPE.'</td>';
									echo '</tr>';
								echo '</table>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			exit;
		}

		# Modal-specific
		# Misc
		private function _dev_block(){
			echo '<div class="container" style="border:2px dashed red;">';
				$this->Tpl->TitleBar('Session Array Data','w_100_p');
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						echo 'Current Session ID: '.$this->Session->sess_id.'<br>';
						if(isset($this->Session->_arr) && !empty($this->Session->_arr)){
							echo '<pre>';
								var_dump($this->Session->_arr);
							echo '</pre><br>';
						}
						else{
							echo 'No data found...';
						}
					echo '</div>';
				echo '</div>';
/*
				$this->Tpl->TitleBar('Session Tmp Data','w_100_p');
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						if(isset($this->Session->_tmp) && !empty($this->Session->_tmp)){
							echo '<pre>';
								var_dump($this->Session->_tmp);
							echo '</pre>';
						}
					echo '</div>';
				echo '</div>';
*/
				$this->Tpl->TitleBar('Session Data','w_100_p');
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						if(isset($_SESSION) && !empty($_SESSION)){
							echo '<pre>';
								var_dump($_SESSION);
							echo '</pre>';
						}
					echo '</div>';
				echo '</div>';

				$this->Tpl->TitleBar('Session Debug Data','w_100_p');
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						echo '<pre>';
							var_dump($this->Session->_arr);
						echo '</pre>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}

	}
?>