<?php
	class Content{

		public $PAGE_TITLE;public $PAGE_SUB;public $PAGEURI;public $PAGE_INDEX;public $PAGE;

		public $FULL_WIDTH_ARR;

		function __construct($BossRecord,$Browser,$Colors,$Data,$db,$Dirs,$Donate,$LogSys,$MailSys,$Messenger,$Modal,$Nav,$Notices,$Paging,$PayPal,$PHP,$Plugins,$PvP,$Read,$Select,$Session,$Setting,$ShaiyaChar,$ShaiyaUser,$SQL,$Style,$Table,$Template,$Theme,$User,$Version,$Wow,$XML){
			$this->BossRecord	=	$BossRecord;
			$this->Browser		=	$Browser;
			$this->Colors		=	$Colors;
			$this->Data			=	$Data;
			$this->db			=	$db;
			$this->Dirs			=	$Dirs;
			$this->Donate		=	$Donate;
			$this->LogSys		=	$LogSys;
			$this->MailSys		=	$MailSys;
			$this->Messenger	=	$Messenger;
			$this->Modal		=	$Modal;
			$this->Nav			=	$Nav;
			$this->Notices		=	$Notices;
			$this->Paging		=	$Paging;
			$this->PayPal		=	$PayPal;
			$this->PHP			=	$PHP;
			$this->Plugins		=	$Plugins;
			$this->PvP			=	$PvP;
			$this->Read			=	$Read;
			$this->Select		=	$Select;
			$this->Session		=	$Session;
			$this->Setting		=	$Setting;
			$this->ShChar		=	$ShaiyaChar;
			$this->ShUser		=	$ShaiyaUser;
			$this->SQL			=	$SQL;
			$this->Style		=	$Style;
			$this->Tbl			=	$Table;
			$this->Tpl			=	$Template;
			$this->Theme		=	$Theme;
			$this->User			=	$User;
			$this->Version		=	$Version;
			$this->Wow			=	$Wow;
			$this->XML			=	$XML;

			$this->_array_builder();
		}
		function _array_builder(){
			$this->FULL_WIDTH_ARR = array(
										"USER_PROFILE",
										"REGISTER",
										"VALIDATE",
										"ISSUE_TRKR",
										"TOOLS"
			);
		}
		function _get_MESSENGER(){
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
		function _get_BREADCRUMB(){
			if($this->Paging->PAGE_ZONE == "CMS"){
				echo '<div id="bread" class="container" style="background-color:rgba('.$this->Theme->_theme_array[17].','.$this->Theme->_theme_array[18].');">';
					echo '<div class="row">';
						echo '<div class="col-md-12">';
							echo '<nav aria-label="breadcrumb">';
								echo '<ol class="breadcrumb';
								if($this->Theme->_theme_array[14]){echo ' '.$this->Theme->_theme_array[14].'">';}
								else{echo ' no_bg">';}
								if($this->Paging->PAGE_INDEX != "HOME"){
									echo '<li class="breadcrumb-item"><a href="?'.$this->Setting->PAGE_PREFIX.'=HOME">Home</a></li>';
									if($this->Paging->PAGE_SUB){
										echo '<li class="breadcrumb-item active" aria-current="PAGE">'.$this->Paging->PAGE_SUB.'</li>';
									}
									echo '<li class="breadcrumb-item active" aria-current="PAGE">'.$this->Paging->PAGE_TITLE.'</li>';
								}else{
									echo '<li class="breadcrumb-item active" aria-current="PAGE">Home</li>';
								}
								echo '</ol>';
							echo '</nav>';
						echo '</div>';
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
									echo '<li class="breadcrumb-item"><a href="?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD">Dashboard</a></li>';
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
		function _get_CONTENT($Zone){
			if($Zone == "CMS"){
				if($this->Setting->MAINTENANCE){
					require_once($this->Paging->PAGE);
				}
				else{
					echo '<div id="content" class="container" style="background-color:rgba('.$this->Theme->_theme_array[17].','.$this->Theme->_theme_array[18].');">';
						echo '<div class="row">';
						if($this->Paging->PAGE_TITLE === "Login"){
							echo '<div class="col-md-3"></div>';
							echo '<div class="col-md-6">';
								require_once($this->Paging->PAGE);
							echo '</div>';
						}
						elseif(in_array($this->Paging->PAGE_INDEX,$this->FULL_WIDTH_ARR) || $this->Theme->_theme_array[1] === "0"){
							# No Sidebar
							echo '<div class="col-md-12">';
								require_once($this->Paging->PAGE);
							echo '</div>';
						}
						else{
							# No Sidebar
							if($this->Theme->_theme_array[1] === "1"){
								echo '<div class="col-md-12">';
									require_once($this->Paging->PAGE);
								echo '</div>';
							}
							# Sidebar Left
							elseif($this->Theme->_theme_array[1] === "1"){
								echo '<div class="col-md-12">';
									echo '<div class="row">';
										echo '<div class="col-md-3">';
											$this->_get_SIDEBAR();
										echo '</div>';
										echo '<div class="col-md-9">';
											require_once($this->Paging->PAGE);
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
							# Sidebar Right
							elseif($this->Theme->_theme_array[1] === "2"){
								echo '<div class="col-md-12">';
									echo '<div class="row">';
										echo '<div class="col-md-9">';
											require_once($this->Paging->PAGE);
										echo '</div>';
										echo '<div class="col-md-3">';
											$this->_get_SIDEBAR();
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						}
						echo '</div>';
					echo '</div>';
				}
			}
			elseif($Zone == "ACP"){
				$this->Nav->NAV_TOP($Zone);
				echo $this->Tpl->Separator('50');
				echo '<div class="wrapper">';
					#	$this->Nav->NAV_SIDE($Zone);
						$this->Nav->_do_Build_AP_Nav();
						echo '<div id="content">';
							echo '<div class="col-md-1">';
								echo '<button type="button" id="sidebarCollapse" class="badge badge-dark" style="border:transparent;border-radius:20px;">';
									echo '<span></span>';
									echo '<span></span>';
									echo '<span></span>';
								echo '</button>';
							echo '</div>';
							echo $this->Tpl->Separator('20');

							echo $this->_get_BREADCRUMB();
							require_once($this->Paging->PAGE);

					echo '</div>';
				echo '</div>';
				echo '<div class="separator_50"></div>';
				$this->_get_FOOTER($Zone);
			}
		}
		function _get_SIDEBAR(){
			if($this->Theme->_theme_array[0] == '2'){
				if($this->Theme->_theme_array[15]){
					$this->Plugins->plugin_search();
				}
			}
		}
		function _get_LANDING($data){
			include($data);
		}
		function _get_FOOTER($Zone){
			if($Zone == "CMS"){
				echo '<div class="cms_footer">';
					echo '<div class="container">';

						if($this->Theme->_theme_array[19] == "true"){
							$this->_do_build_footer_links_1($Zone);
						}
						if($this->Theme->_theme_array[20] == "true"){
							$this->_do_build_footer_links_2($Zone);
						}
						if($this->Theme->_theme_array[21] == "true"){
							$this->_do_build_footer_links_3($Zone);
						}

						echo '<div class="row">';
							echo '<div class="col-md-12 col-sm-12 tac">';
							if($this->User->_is_ADM() || $this->User->_is_GM() && $this->User->is_Logged_In()){
								echo $this->Tpl->Separator("10");
								echo '<a href="?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD" target="_blank" class="badge badge-primary b_i f_14">Administration Control Panel</a><br>';
								echo $this->Tpl->Separator("10");
							}
								echo $this->Theme->_theme_array[16].'<br>';
								echo 'Powered By: <font class="b_i">Cerberus CMS </font><label class="badge badge-primary b_i f14">v'.$this->Setting->VERSION.'</label>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
			elseif($Zone == "ACP"){
				echo '<div class="row hidden-sm-down acp_footer text-center b_i f_20 bg-dark no_padding">';
					echo '<div class="col-md-2"></div>';
					echo '<div class="col-md-10 tac posh">';
						echo $this->Theme->_theme_array[16].' <label class="badge badge-primary b_i f_14">v'.$this->Setting->VERSION.'</label>';
					echo '</div>';
				echo '</div>';
			}
			echo '</body>';
			echo '</html>';
		}
		function _do_build_footer_links_1($Zone){
			echo '<div class="row">';
				echo '<div class="col-md-4 col-sm-12 tac"></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="mailto:'.$this->Setting->EMAIL_SUPPORT.'">Contact Us</a></div>';
			echo '</div>';
		}
		function _do_build_footer_links_2($Zone){
			echo '<div class="row">';
				echo '<div class="col-md-4 col-sm-12 tac"></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="mailto:'.$this->Setting->EMAIL_SUPPORT.'">Contact Us</a></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="#">Sponsor 3</a></div>';
			echo '</div>';
		}
		function _do_build_footer_links_3($Zone){}
		function _do_build_footer_links_4($Zone){}
		function _do_build_footer_links_5($Zone){}
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