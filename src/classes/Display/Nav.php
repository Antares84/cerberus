<?php
	namespace classes\display;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Nav{

		private $PAGE_ZONE;private $SITE_TYPE;

		# Public Methods
		public function __construct($db,$Paging,$Setting,$Stats,$Theme,$Tpl,$User){
			$this->db		=	$db;
			$this->Paging	=	$Paging;
			$this->Setting	=	$Setting;
			$this->Stats	=	$Stats;
			$this->Theme	=	$Theme;
			$this->Tpl		=	$Tpl;
			$this->User		=	$User;

			$this->PAGE_ZONE	=	$this->Paging->_arr["PAGE_ZONE"];
			$this->SITE_TYPE	=	$this->Setting->_arr["SITE_TYPE"];
		}
		public function _load($type){
			$method	=	'_nav_'.$this->PAGE_ZONE;
			$err	=	'Method doesn\'t exist!';

			try{
				if(method_exists($this,$method)){
					return $this->$method($type);
				}
			}
			catch(exception $e){
				throw new SystemException('Error in <b>'.get_class($this).'<br>'.$err,0,0,__FILE__,__LINE__);
			}
		}

		# Private Methods
		private function _nav_server_status(){
			if($this->Theme->_arr["NAV_SERVER_STATUS"] && $this->Setting->_arr["SITE_TYPE"] == 3){
				echo '<nav id="main" class="navbar navbar-expand-md navbar-dark no_padding nav--sub">';
					echo '<div class="container no-padding';
					if($this->Theme->_arr["NAV_BG_COLOR"]){echo ' '.$this->Theme->_arr["NAV_BG_COLOR"].'">';}
					else{echo ' no_bg">';}
						echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
							echo '<span class="navbar-toggler-icon"></span>';
						echo '</button>';
						echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
							echo '<ul class="navbar-nav mr-auto">';
								echo '<li class="nav-item"><font class="nav-link">Game Server: '.$this->Stats->GameStatus().'</font></li>';
								echo '<li class="nav-item"><font class="nav-link">Login Server: '.$this->Stats->LoginStatus().'</font></li>';
							echo '</ul>';

							echo '<ul class="navbar-nav pull-lg-right tar">';
							if($this->User->LoginStatus == 1){
								echo '<li class="nav-item">Welcome, <font class="b_i">'.$this->User->_get_UserInfo('DisplayName').'</font>, your available DP is '.$this->User->_get_UserInfo('Point').'</li>';
							}
							else{
								echo '<li class="nav-item">Welcome <font class="b_i">Guest</font>, please log in.</li>';
							}
							echo '</ul>';
						echo '</div>';
					echo '</div>';
				echo '</nav>';
			}
		}
		private function _nav_cms($type){
			switch($type){
				case	0	:
					// TOP NAV
					echo '<nav class="navbar navbar-expand-md navbar-dark no_padding">';
						echo '<div class="container no-padding';
							if($this->Theme->_arr["NAV_BG_COLOR"]){echo ' '.$this->Theme->_arr["NAV_BG_COLOR"].'">';}
							else{echo ' no_bg">';}
							echo '<button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">';
								echo '<span class="navbar-toggler-icon"></span>';
							echo '</button>';

							echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
						//	if(isset($this->User->UserUID) && is_numeric($this->User->UserUID)){
							if(isset($_SESSION["User"]["UserUID"])){
								echo '<ul class="navbar-nav mr-auto">';
									# $PageCat,$PageShow,$ReqLogin
									# HOME LINK
									$this->_nav_link_site_type('Main',1,0);
									# DROPDOWN - INFO
									$this->ds_nav_dropdown($this->SITE_TYPE,'Info',1,1,'<i class="fa fa-info-circle"></i>');
									# DROPDOWN - MEMBER
									$this->ds_nav_dropdown($this->SITE_TYPE,'Member',1,1,'<i class="fa fa-user-circle"></i>');
								echo '</ul>';
								echo '<ul class="nav navbar-nav pull-lg-right">';
									# DROPDOWN - OPTIONS
									$this->ds_nav_dropdown('STD','Options',1,1,'<i class="fa fa-power-off"></i>');
								echo '</ul>';
							}
							else{
								echo '<ul class="navbar-nav mr-auto">';
									$this->_nav_link_site_type('Main',1,0,'<i class="fa fa-home"></i>');
									$this->ds_nav_dropdown($this->SITE_TYPE,'Info',1,0,'<i class="fa fa-info-circle"></i>');
									$this->ds_nav_dropdown($this->SITE_TYPE,'Member',1,0,'<i class="fa fa-user-circle"></i>');
								echo '</ul>';
								echo '<ul class="nav navbar-nav pull-lg-right">';
									$this->ds_nav_dropdown('STD','Options',1,0,'<i class="fa fa-power-off"></i>');
								echo '</ul>';
							}
							echo '</div>';
						echo '</div>';
					echo '</nav>';
					$this->_nav_server_status();
				break;
				case	1	:
					# SIDE NAV
					echo '<div class="container-fluid">';
						echo '<div class="row">';
							echo '<div class="col-md-2 col-sm-2 ndf_side_nav">';
								echo '<div class="logo_sidemenu text-center">';
								if($this->User->get_is_is_Logged_In()){
									echo '<img src="'.$this->Style->get_STYLE_IMAGES_DIR().'NDF%20Logo.ico" style="width:128px;height:128px;" class="img-responsive">';
									echo '<br>';
									echo '<h5 class="tac b_i">Hello, '.$_SESSION['UID'].'</h5>';
									echo '<h6 class="tac"><img src="'.$this->Style->get_STYLE_IMAGES_DIR().'ap_32x32.png" class="img-responsive"> '.$this->User->get_UserInfo("Point").' <span class="b_i"></span></h6>';
									if($this->User->get__is_ADM()){
										echo '<h6 class="tac b_i"><a href="acp/" target="_blank">Administration Panel</a></h6>';
									}
								}
								else{
									echo '<img src="'.$this->Style->get_STYLE_IMAGES_DIR().'guest-512.png" style="width:128px;height:128px;" class="img-responsive">';
									echo '<br>';
									echo '<h5 class="tac b_i">Hello, Guest</h5>';
									echo '<h6 class="tac">Please log in to access your menu.</h6>';
									echo '<div class="separator_10"></div>';
								}
								echo '</div>';
								echo '<div class="left-navigation">';
									echo '<div id="tabs_nav">';
										echo '<ul>';
											echo '<li><a href="#tabs-1">Main</a></li>';
										if($this->User->LoginStatus){
											echo '<li><a href="#tabs-2">Info</a></li>';
											echo '<li><a href="#tabs-3">Member</a></li>';
										}
										echo '</ul>';
										echo '<div id="tabs-1">';
											echo '<ul class="list">';
												$this->ds_nav_link('Home',1,0,'<i class="fa fa-home"></i>');
												echo '<li class="separator_10 no_bg"></li>';
												$this->ds_nav_link('Options',1,$this->User->LoginStatus,'<i class="fa fa-power-off"></i>');
											echo '</ul>';
										echo '</div>';
									if($this->User->LoginStatus){
										echo '<div id="tabs-2">';
											echo '<ul class="list">';
												$this->ds_nav_link('Info',1,1,'<i class="fa fa-info-circle"></i>');
											echo '</ul>';
										echo '</div>';
										echo '<div id="tabs-3">';
											echo '<ul class="list">';
												$this->ds_nav_link('Member',1,1,'<i class="fa fa-user-circle"></i>');
											echo '</ul>';
										echo '</div>';
									}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				break;
				case	2	:
					# FORTE HOME NAV
					echo '<div class="container">';
						echo '<nav class="navbar navbar-full navbar-inverse bg-inverse">';
							echo '<a class="navbar-brand" href="#"><i class="fa fa-motorcycle"></i> '.$this->Lang->SITE_TITLE().'</a>';
							echo '<button type="button" class="navbar-toggler hidden-md-up d-inline-block mx-auto" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i> Menu</button>';
							echo '<div class="collapse navbar-toggleable-md" id="navbar-header">';
								echo '<ul class="nav navbar-nav pull-lg-right">';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=Home">Home</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=AboutUS">About Us</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=Contract">FTW Contract</a></li>';
								#	echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=Blog">Blog</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=RequestInfo">Request Info</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=ContactUs">Contact</a></li>';
								echo '</ul>';
							echo '</div>';
						echo '</nav>';
					echo '</div>';
				break;
				case	3	:
					# FORTE NAV OTHER
					echo '<div class="container no-padding nav_bg">';
						echo '<nav class="navbar">';
						#	echo '<a class="navbar-brand" href="#"><i class="fa fa-motorcycle"></i> Full Throttle Warranty</a>';
							echo '<button type="button" class="navbar-toggler hidden-md-up d-inline-block mx-auto" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i> Menu</button>';
							echo '<div class="collapse navbar-toggleable-md" id="navbar-header">';
								echo '<ul class="nav navbar-nav pull-right">';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=Home">Home</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=AboutUS">About Us</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=Contract">Our Contract</a></li>';
								#	echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=Blog">Blog</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=RequestInfo">Request Info</a></li>';
									echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=ContactUs">Contact Us</a></li>';
								/*	echo '<li class="nav-item"><a class="nav-link" href="?'.$this->Setting->_arr[0].'=Shop">Shop</a></li>'; */
								echo '</ul>';
							echo '</div>';
						echo '</nav>';
					echo '</div>';
					echo '<div class="separator_15"></div>';
				break;
			}
		}
		private function _nav_ap($type){
			switch($type){
				case	0	:
					# TOP NAV
					echo '<nav class="navbar navbar-expand navbar-dark bg-dark static-top">';
					if($this->User->_is_Logged_In() && $this->User->_is_ADM()){
						echo '<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">';
							echo '<i class="fa fa-bars"></i>';
						echo '</button>';
						echo '<a class="navbar-brand col-sm-3 col-md-3 hidden-sm-down" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=DASHBOARD">NDF Admin Panel</a>';
					}
					else{
						echo '<a class="navbar-brand col-sm-3 col-md-3" href="#">NDF Admin Panel</a>';
					}

						echo '<ul class="navbar-nav ml-auto">';
							# Alerts
							echo '<li class="nav-item dropdown no-arrow mx-1">';
								echo '<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown">';
									echo '<i class="fa fa-bell fa-fw"></i>';
									echo '<span class="badge badge-danger">9+</span>';
								echo '</a>';
								echo '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-primary">Alert Badge</span></a>';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-success">Alert Badge</span></a>';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-info">Alert Badge</span></a>';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-warning">Alert Badge</span></a>';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-danger">Alert Badge</span></a>';
									echo '<a class="dropdown-divider"></a>';
									echo '<a class="dropdown-item" href="#">View All</a>';
								echo '</div>';
							echo '</li>';

							# Messages
							echo '<li class="nav-item dropdown no-arrow mx-1">';
								echo '<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown">';
									echo '<i class="fa fa-envelope fa-fw"></i>';
									echo '<span class="badge badge-danger">7</span>';
								echo '</a>';
								echo '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">';
									echo '<a class="dropdown-item" href="#">Action</a>';
									echo '<a class="dropdown-item" href="#">Another action</a>';
									echo '<div class="dropdown-divider"></div>';
									echo '<a class="dropdown-item" href="#">Something else here</a>';
								echo '</div>';
							echo '</li>';

							# User/Login
							echo '<li class="nav-item dropdown no-arrow mx-1">';
							if($this->User->_is_Logged_In()){
								echo '<a class="nav-link dropdown-toggle" href="#" id="Options" role="button" data-toggle="dropdown">';
									echo '<i class="fa fa-user-circle"></i>';
								echo '</a>';

								echo '<div class="dropdown-menu dropdown-menu-right">';
								if($this->User->_is_ADM()){
									# Settings
									echo '<a class="dropdown-item" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=STNG_WARNING">';
										echo '<i class="fa fa-cog"></i> ';
										echo 'Settings';
									echo '</a>';
								#	echo '<li class="dropdown-item"><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>';
								#	echo '<li class="dropdown-item"><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>';
									echo '<div class="dropdown-divider"></div>';
									echo '<a class="dropdown-item" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=LOGOUT">';
										echo '<i class="fa fa-fw fa-power-off"></i> ';
										echo 'Log Out';
									echo '</a>';
								}
								else{
									echo '<a class="dropdown-item" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=HOME">';
										echo '<i class="fa fa-fw fa-power-off"></i>';
										echo 'Home';
									echo '</a>';
								}
								echo '</div>';
							}
							else{
								echo '<a class="nav-link dropdown-toggle" href="#" id="Options" role="button" data-toggle="dropdown">';
									echo '<i class="fa fa-user-circle fa-fw"></i>';
									echo 'Guest';
								echo '</a>';

								echo '<div class="dropdown-menu dropdown-menu-right">';
									echo '<a class="dropdown-item" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=HOME"><i class="fa fa-fw fa-power-off"></i> Home</a>';
								echo '</div>';
							}

							echo '</li>';
						echo '</ul>';
					echo '</nav>';
				break;
				case	1	:
					# SIDE NAV
					echo '<nav class="col-md-2 d-none d-md-block sidebar text-white ndf_side_nav">';
						echo '<div id="MainMenu">';
							$this->Tpl->Separator('10');
							echo '<div class="list-group panel">';
							if($this->User->_is_Logged_In()){
								# SINGLE LINK
								$this->Tpl->Separator('10');
								$this->ds_acp_nav_side_link('Dashboard',1,0,'<i class="fa fa-fw fa-dashboard"></i>');
								# DROPDOWN LINK
								$this->ds_acp_nav_side_dd('Site',1,0);
								$this->ds_acp_nav_side_dd('Account',1,0);
								$this->ds_acp_nav_side_dd('Player',1,0);
								$this->ds_acp_nav_side_dd('Staff',1,0);
								$this->ds_acp_nav_side_dd('Developer',1,0);
							}
							echo '</div>';
						echo '</div>';
					echo '</nav>';
				break;
				case	2	:
					# SIDE NAV 2
					echo '<nav class="d-none d-md-block" id="sidebar">';
						echo '<div class="sidebar-sticky bg-dark">';
							echo '<ul class="nav flex-column">';
								$this->ds_acp_nav_side_link('Dashboard',1,0,'<i class="fa fa-fw fa-dashboard"></i>');
							echo '</ul>';

							echo '<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">';
							echo '<span>Saved reports</span>';
							echo '<a class="d-flex align-items-center text-muted" href="#"></a></h6>';
							echo '<ul class="nav flex-column mb-2">';
								echo '<li class="nav-item"><a class="nav-link" href="#">Current month</a></li>';
								echo '<li class="nav-item"><a class="nav-link" href="#">Last quarter</a></li>';
								echo '<li class="nav-item"><a class="nav-link" href="#">Social engagement</a></li>';
								echo '<li class="nav-item"><a class="nav-link" href="#">Year-end sale</a></li>';
							echo '</ul>';
							echo '<ul class="nav flex-column">';
								echo '<li class="nav-item">';
									echo '<a class="nav-link collapsed" href="#submenu1" data-toggle="collapse" data-target="#submenu1">Reports</a>';
									echo '<div class="collapse" id="submenu1" aria-expanded="false">';
										echo '<ul class="flex-column nav">';
										echo '<li class="nav-item"><a class="nav-link py-0" href="#">Orders</a></li>';
											echo '<li class="nav-item">';
												echo '<a class="nav-link collapsed py-1" href="#submenu1sub1" data-toggle="collapse" data-target="#submenu1sub1">';
													echo 'Customers';
												echo '</a>';
												echo '<div class="collapse" id="submenu1sub1" aria-expanded="false">';
													echo '<ul class="flex-column nav pl-4">';
														echo '<li class="nav-item">';
															echo '<a class="nav-link p-1" href="#"><i class="fa fa-fw fa-clock-o"></i> Daily</a>';
														echo '</li>';
														echo '<li class="nav-item">';
															echo '<a class="nav-link p-1" href="#"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>';
														echo '</li>';
														echo '<li class="nav-item">';
															echo '<a class="nav-link p-1" href="#"><i class="fa fa-fw fa-bar-chart"></i> Charts</a>';
														echo '</li>';
														echo '<li class="nav-item">';
															echo '<a class="nav-link p-1" href="#"><i class="fa fa-fw fa-compass"></i> Areas</a>';
														echo '</li>';
													echo '</ul>';
												echo '</div>';
											echo '</li>';
										echo '</ul>';
									echo '</div>';
								echo '</li>';
							echo '</ul>';
						echo '</div>';
					echo '</nav>';
				break;
				case	3	:
					# AP NAV TOP 3
					echo '<nav class="navbar navbar-expand navbar-dark bg-dark static-top">';
					if($this->User->_is_Logged_In() && $this->User->_is_ADM()){
						echo '<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">';
							echo '<i class="fa fa-bars"></i>';
						echo '</button>';
						echo '<a class="navbar-brand col-sm-3 col-md-3 hidden-sm-down" href="?'.$this->Setting->_arr[0].'=DASHBOARD">NDF Admin Panel</a>';
					}
					else{
						echo '<a class="navbar-brand col-sm-3 col-md-3" href="#">NDF Admin Panel</a>';
					}

						echo '<ul class="navbar-nav ml-auto">';
							# Alerts
							echo '<li class="nav-item dropdown no-arrow mx-1">';
								echo '<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown">';
									echo '<i class="fa fa-bell fa-fw"></i>';
									echo '<span class="badge badge-danger">9+</span>';
								echo '</a>';
								echo '<div class="dropdown-menu dropdown-menu-right m_t_5" aria-labelledby="alertsDropdown">';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-primary">Alert Badge</span></a>';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-success">Alert Badge</span></a>';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-info">Alert Badge</span></a>';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-warning">Alert Badge</span></a>';
									echo '<a class="dropdown-item" href="#"><span class="badge badge-danger">Alert Badge</span></a>';
									echo '<a class="dropdown-divider"></a>';
									echo '<a class="dropdown-item" href="#">View All</a>';
								echo '</div>';
							echo '</li>';

							# Messages
							echo '<li class="nav-item dropdown no-arrow mx-1">';
								echo '<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown">';
									echo '<i class="fa fa-envelope fa-fw"></i>';
									echo '<span class="badge badge-danger">7</span>';
								echo '</a>';
								echo '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">';
									echo '<a class="dropdown-item" href="#">Action</a>';
									echo '<a class="dropdown-item" href="#">Another action</a>';
									echo '<div class="dropdown-divider"></div>';
									echo '<a class="dropdown-item" href="#">Something else here</a>';
								echo '</div>';
							echo '</li>';

							# User/Login
							echo '<li class="nav-item dropdown no-arrow mx-1">';
							if($this->User->_is_Logged_In()){
								echo '<a class="nav-link dropdown-toggle" href="#" id="Options" role="button" data-toggle="dropdown">';
									echo '<i class="fa fa-user-circle"></i>';
								echo '</a>';

								echo '<div class="dropdown-menu dropdown-menu-right">';
								if($this->User->_is_ADM()){
									# Settings
									echo '<a class="dropdown-item" href="?'.$this->Setting->_arr[0].'=STNG_WARNING">';
										echo '<i class="fa fa-cog"></i> ';
										echo 'Settings';
									echo '</a>';
								#	echo '<li class="dropdown-item"><a href="#"><i class="fa fa-fw fa-user"></i> Profile</a></li>';
								#	echo '<li class="dropdown-item"><a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>';
									echo '<div class="dropdown-divider"></div>';
									echo '<a class="dropdown-item" href="?'.$this->Setting->_arr[0].'=Logout">';
										echo '<i class="fa fa-fw fa-power-off"></i> ';
										echo 'Log Out';
									echo '</a>';
								}
								else{
									echo '<a class="dropdown-item" href="?'.$this->Setting->_arr[0].'=HOME">';
										echo '<i class="fa fa-fw fa-power-off"></i>';
										echo 'Home';
									echo '</a>';
								}
								echo '</div>';
							}
							else{
								echo '<a class="nav-link dropdown-toggle" href="#" id="Options" role="button" data-toggle="dropdown">';
									echo '<i class="fa fa-user-circle fa-fw"></i>';
									echo 'Guest';
								echo '</a>';

								echo '<div class="dropdown-menu dropdown-menu-right">';
									echo '<a class="dropdown-item" href="?'.$this->Setting->_arr[0].'=HOME"><i class="fa fa-fw fa-power-off"></i> Home</a>';
								echo '</div>';
							}

							echo '</li>';
						echo '</ul>';
					echo '</nav>';
				break;
			}
		}
		private function nav_side_2(){
		#	echo '<nav id="sidebar">';
/*
				echo '<div id="MainMenu">';
					$this->Tpl->Separator('10');
					echo '<div class="list-group">';
					if($this->User->_is_Logged_In()){
						# SINGLE LINK
						$this->Tpl->Separator('10');
						$this->ds_acp_nav_side_link('Dashboard',1,0,'<i class="fa fa-fw fa-dashboard"></i>');
						# DROPDOWN LINK
						$this->ds_acp_nav_side_dd('Site',1,0);
						$this->ds_acp_nav_side_dd('Account',1,0);
						$this->ds_acp_nav_side_dd('Player',1,0);
						$this->ds_acp_nav_side_dd('Staff',1,0);
						$this->ds_acp_nav_side_dd('Developer',1,0);
					}
					echo '</div>';
				echo '</div>';
			echo '</nav>';
*/
			
		}

		# AP Navigation - Sidebar
		private function ds_acp_nav_top_dd($PageCat,$PageShow,$ReqLogin){
			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					echo '<li class="nav-item dropdown">';
						echo '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="'.$PageCat.'" role="button" aria-haspopup="true" aria-expanded="false">'.$PageCat.'</a>';
						echo '<div class="dropdown-menu w_100_p bg-dark" aria-labelledby="'.$PageCat.'">';
						while($res = odbc_fetch_array($stmt)){
							echo '<a class="dropdown-item" href="?'.$this->Setting->_arr[0].'='.$res["PAGE_INDEX"].'"><i class="fa fa-chevron-right"></i> '.$res["PAGE_TITLE"].'</a>';
						}
						echo '</div>';
					echo '</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		private function ds_acp_nav_side_link($PageCat,$PageShow,$ReqLogin,$LinkIcon=false){
			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=? AND SITE_TYPE=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin,$this->Setting->_arr["SITE_TYPE"]);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					echo '<li class="nav-item">';
						echo '<a class="nav-link hvr-underline-from-center bg-dark b_i f_18 m_t_10 m_b_5" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">';
						if($LinkIcon){echo $LinkIcon.' ';}
						echo $data["PAGE_TITLE"];
						echo '</a>';
					echo '</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		private function ds_acp_nav_side_dd($PageCat,$PageShow,$ReqLogin,$LinkIcon=false){
			$PageSub	=	$PageCat.' Tools';

			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				if(odbc_num_rows($stmt) > 0){
					echo '<a href="#'.$PageCat.'" class="list-group-item bg-dark b_i f_18" data-toggle="collapse" data-parent="#MainMenu">'.$PageSub.' <i class="fa fa-caret-down"></i></a>';
					echo '<div class="collapse" id="'.$PageCat.'">';
					while($data = odbc_fetch_array($stmt)){
						echo '<a class="list-group-item bg-secondary text-white" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">';
						if($LinkIcon){echo $LinkIcon;}
						echo $data["PAGE_TITLE"].'</a>';
					}
					echo '</div>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		private function _nav_link($PageCat,$PageShow,$ReqLogin){
			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt)>0){
					while($data = odbc_fetch_array($stmt)){
						echo '<li class="nav-item">';
							echo '<a class="nav-link" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">';
							if($data["PAGE_ICON"] && $data["PAGE_ICON"] !== ""){
								echo '<i class="'.$data["PAGE_ICON"].'"></i> ';
							}
							echo $data["PAGE_TITLE"];
							echo '</a>';
						echo '</li>';
					}
				}
				else{
					echo 'No results found';
				}

				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		private function _nav_link_site_type($PageCat,$PageShow,$ReqLogin){
			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=? AND SITE_TYPE=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin,$this->SITE_TYPE);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt)>0){
					while($data = odbc_fetch_array($stmt)){
						echo '<li class="nav-item">';
							echo '<a class="nav-link" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">';
							if($data["PAGE_ICON"] && $data["PAGE_ICON"] !== ""){
								echo '<i class="'.$data["PAGE_ICON"].'"></i> ';
							}
							echo $data["PAGE_TITLE"];
							echo '</a>';
						echo '</li>';
					}
					odbc_free_result($stmt);
				odbc_close($this->db->conn);
				}
				else{
					$this->_nav_link($PageCat,$PageShow,$ReqLogin);
				}

				
			}
		}
		private function ds_nav_dropdown($SiteType,$PageCat,$PageShow,$ReqLogin,$Icon){
			$sql	=	("
							SELECT *
							FROM ".$this->db->_table_list('SETTINGS_PAGES')."
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=? AND SITE_TYPE=?
							ORDER BY PAGE_TITLE ASC
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin,$SiteType);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				if(odbc_num_rows($stmt) > 0){
					echo '<li class="nav-item dropdown">';
						echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">';
							echo $Icon.' '.$PageCat;
						echo '</a>';
						echo '<div class="dropdown-menu';
						if($this->Theme->_arr["NAV_BG_COLOR"]){echo ' '.$this->Theme->_arr["NAV_BG_COLOR"].'>';}
						else{echo ' no_bg';}
						echo '" aria-labelledby="navbarDropdown">';
						while($data = odbc_fetch_array($stmt)){
							echo '<a class="dropdown-item" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">';
								echo '<i class="fa fa-chevron-right"></i> ';
								echo $data["PAGE_TITLE"];
							echo '</a>';
						}
						echo '</div>';
					echo '</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		private function _nav_side_ap_link(){
			
		}
		private function _nav_side_ap_dd($DD_ID,$DD_HEADER,$PAGE_CAT,$PAGE_SHOW,$REQ_LOGIN){
			$sql	=	("
							SELECT *
							FROM ".$this->db->_table_list('SETTINGS_PAGES')."
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=? AND SITE_TYPE=?
							ORDER BY PAGE_TITLE ASC
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PAGE_CAT,$PAGE_SHOW,$REQ_LOGIN,$this->SITE_TYPE);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				if(odbc_num_rows($stmt) > 0){
					echo '<li class="nav-item dropdown">';
						echo '<a class="nav-link dropdown-toggle" href="#" id="'.$DD_ID.'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
						#	echo $Icon.' '.$PAGE_CAT;
							echo $PAGE_CAT;
						#	echo '<i class="fa fa-fw fa-folder"></i>';
							echo '<span>'.$DD_HEADER.'</span>';
						echo '</a>';
						echo '<div class="dropdown-menu" aria-labelledby="'.$DD_ID.'">';
						/*
							echo '<h6 class="dropdown-header">Login Screens:</h6>';
							echo '<a class="dropdown-item" href="login.html">Login</a>';
							echo '<a class="dropdown-item" href="register.html">Register</a>';
							echo '<a class="dropdown-item" href="forgot-password.html">Forgot Password</a>';
							echo '<div class="dropdown-divider"></div>';
							echo '<h6 class="dropdown-header">Other Pages:</h6>';
							echo '<a class="dropdown-item" href="404.html">404 Page</a>';
							echo '<a class="dropdown-item" href="blank.html">Blank Page</a>';
						*/
						while($data = odbc_fetch_array($stmt)){
							echo '<a class="dropdown-item" href="?'.$this->Setting->_arr[0].'='.$data["PAGE_INDEX"].'">';
								echo $data["PAGE_TITLE"];
							echo '</a>';
						}
						echo '</div>';
					echo '</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
					
		}
		function _do_build_ap_nav_sb($type){
			switch($type){
				case	0	:
					echo '<nav class="col-md-2 d-none d-md-block sidebar text-white ndf_side_nav">';
					echo '<div id="MainMenu">';
						$this->Tpl->Separator('10');
						echo '<div class="list-group panel">';
						if($this->User->_is_Logged_In()){
							# SINGLE LINK
							$this->Tpl->Separator('10');
							$this->ds_acp_nav_side_link('Dashboard',1,0);

							# DROPDOWN LINK
							$this->ds_acp_nav_side_dd('Site',1,0);
							$this->ds_acp_nav_side_dd('Account',1,0);
							$this->ds_acp_nav_side_dd('Player',1,0);
							$this->ds_acp_nav_side_dd('Staff',1,0);
							$this->ds_acp_nav_side_dd('Developer',1,0);
						}
						echo '</div>';
					echo '</div>';
				echo '</nav>';
				break;
				case	1	:
					echo '<nav id="sidebar" class="d-none d-md-block">';
					echo '<div class="sidebar-sticky bg-dark">';
					# Single Links
					if($this->_do_build_ap_nav_sb_s_link("ACP","Single",1,0,1) == true){
						echo '<ul class="nav flex-column mb-2">';
							$this->_do_build_ap_nav_sb_s_link("ACP","Single",1,0);
						echo '</ul>';
					}
						echo '<ul class="nav flex-column">';
							echo '<li class="nav-item">';
								echo '<a class="nav-link hvr-underline-from-center collapsed" href="#Tools" data-toggle="collapse" data-target="#Tools">Tools</a>';
								echo '<div class="collapse" id="Tools" aria-expanded="false">';
									echo '<ul class="flex-column nav">';
										# Dropdown Sub-menu
										if($this->_do_build_ap_sb_dd_sub_link("Site",1,1,1)==true){
											$this->_do_build_ap_sb_dd_sub_link("Site",1,1);
										}
										if($this->_do_build_ap_sb_dd_sub_link("Account",1,1,1)==true){
											$this->_do_build_ap_sb_dd_sub_link("Account",1,1);
										}
										if($this->_do_build_ap_sb_dd_sub_link("Player",1,1,1)==true){
											$this->_do_build_ap_sb_dd_sub_link("Player",1,1);
										}
										if($this->_do_build_ap_sb_dd_sub_link("Staff",1,1,1)==true){
											$this->_do_build_ap_sb_dd_sub_link("Staff",1,1);
										}
										if($this->_do_build_ap_sb_dd_sub_link("Developer",1,1,1)==true){
											$this->_do_build_ap_sb_dd_sub_link("Developer",1,1);
										}
									echo '</ul>';
								echo '</div>';
							echo '</li>';
						echo '</ul>';
					echo '</div>';
				echo '</nav>';
				break;
				case	2	:
					echo '<ul class="sidebar navbar-nav">';
					echo '<li class="nav-item active">';
						# SINGLE LINK
						$this->Tpl->Separator('10');
						$this->ds_acp_nav_side_link('Dashboard',1,0,'<i class="fa fa-fw fa-dashboard"></i>');
						echo '<a class="nav-link" href="index.html">';
							echo '<i class="fa fa-fw fa-tachometer-alt"></i>';
							echo '<span>Dashboard</span>';
						echo '</a>';
					echo '</li>';
					echo '<li class="nav-item dropdown">';
						echo '<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
							echo '<i class="fa fa-fw fa-folder"></i>';
							echo '<span>Pages</span>';
						echo '</a>';
						$this->_nav_side_ap_dd('pages_dd','Forte','FORTE',0,0);
					echo '</li>';
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="charts.html">';
							echo '<i class="fas fa-fw fa-chart-area"></i>';
							echo '<span>Charts</span>';
						echo '</a>';
					echo '</li>';
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="tables.html">';
							echo '<i class="fa fa-fw fa-table"></i>';
							echo '<span>Tables</span>';
						echo '</a>';
					echo '</li>';
				echo '</ul>';
				break;
			}
		}
		function _do_build_ap_sb_s_link($Zone,$URI_Type,$PageShow,$ReqLogin,$Check=false){
			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list('SETTINGS_PAGES').'
							WHERE ZONE=? AND URI_TYPE=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($Zone,$URI_Type,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt)>0){
					if($Check){
						return true;
					}
					while($data = odbc_fetch_array($stmt)){
						echo '<li class="nav-item">';
							echo '<a class="nav-link hvr-underline-from-center bg-dark b_i f_18 m_t_10 m_b_5" href="?'.$this->Setting->PAGE_PREFIX.'='.$data["PAGE_INDEX"].'">';
							if($data["PAGE_ICON"]){echo $data["PAGE_ICON"].' ';}
							echo $data["PAGE_TITLE"];
							echo '</a>';
						echo '</li>';
					}
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		private function _do_build_ap_sb_list_link($Zone,$URI_Type,$PageShow,$ReqLogin,$Check=false){}
		function _do_build_ap_sb_dd_link($Zone,$URI_Type,$PageShow,$ReqLogin,$Check=false){
			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_fetch_array($stmt)>0){
					if($Check){
						return true;
					}
					while($data = odbc_fetch_array($stmt)){
						echo '<li class="nav-item">';
							echo '<a class="nav-link hvr-underline-from-center bg-dark b_i f_18 m_t_10 m_b_5" href="?'.$this->Setting->_arr[0].'='.$data["PAGE_INDEX"].'">';
							if($LinkIcon){echo $LinkIcon.' ';}
							echo $data["PAGE_TITLE"];
							echo '</a>';
						echo '</li>';
					}
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		function _do_build_ap_sb_dd_sub_link($PageCat,$PageShow,$ReqLogin,$Check=false){
			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt)>0){
					if($Check){
						return true;
					}
					echo '<li class="nav-item">';
						echo '<a class="nav-link hvr-underline-from-center collapsed py-1" href="#'.$PageCat.'" data-toggle="collapse" data-target="#'.$PageCat.'">'.$PageCat.' Tools</a>';
						echo '<div class="collapse" id="'.$PageCat.'" aria-expanded="false">';
							echo '<ul class="flex-column nav">';
							while($data = odbc_fetch_array($stmt)){
								echo '<li class="nav-item">';
									echo '<a class="nav-link hvr-shutter-out-horizontal bg-dark b_i f_18" href="?'.$this->Setting->_arr[0].'='.$data["PAGE_INDEX"].'">';
										if($data["PAGE_ICON"]){echo $data["PAGE_ICON"].' ';}
										echo $data["PAGE_TITLE"];
									echo '</a>';
								echo '</li>';
							}
							echo '</ul>';
						echo '</div>';
					echo '</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}

		# MISC
		private function _Props(){
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
	}
?>