<?php
	class Nav{
		function __construct($db,$Setting,$Stats,$Theme,$Template,$User){
			$this->db		=	$db;
			$this->Setting	=	$Setting;
			$this->Stats	=	$Stats;
			$this->Theme	=	$Theme;
			$this->Tpl		=	$Template;
			$this->User		=	$User;
		}
		function NAV_SERVER_STATUS(){
			if($this->Theme->_theme_array[2]){
				echo '<nav class="navbar navbar-expand-md navbar-dark fixed-top no_padding">';
					echo '<div class="container no-padding';
					if($this->Theme->_theme_array[11]){echo ' '.$this->Theme->_theme_array[11].'">';}
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
								echo '<li class="nav-item">Welcome, <font class="b_i">'.$this->User->UserID.'</font>, your available DP is '.$this->User->Point.'</li>';
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
		function NAV_TOP($Zone){
			if($Zone == "CMS"){
				if($this->Theme->_theme_array[2]){
					echo '<div class="separator_40"></div>';
					echo '<nav class="navbar navbar-expand-md navbar-dark no_padding">';
				}
				else{
					echo '<nav class="navbar navbar-expand-md navbar-dark fixed-top no_padding">';
				}
					echo '<div class="container no-padding';
					if($this->Theme->_theme_array[11]){echo ' '.$this->Theme->_theme_array[11].'">';}
					else{echo ' no_bg">';}
						echo '<button class="navbar-dark navbar-toggler" style="border:1px solid blue;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
							echo '<span class="navbar-toggler-icon"></span>';
						echo '</button>';
						echo '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
						if(isset($_SESSION["UserUID"])){
							echo '<ul class="navbar-nav mr-auto">';
								$this->ds_nav_link('Main',1,0,'<i class="fa fa-home"></i>');
								$this->ds_nav_dropdown('Info',1,1,'<i class="fa fa-info-circle"></i>');
								$this->ds_nav_dropdown('Member',1,1,'<i class="fa fa-user-circle"></i>');
							echo '</ul>';
							echo '<ul class="nav navbar-nav pull-lg-right">';
								$this->ds_nav_dropdown('Options',1,1,'<i class="fa fa-power-off"></i>');
							echo '</ul>';
						}
						else{
							echo '<ul class="navbar-nav mr-auto">';
								$this->ds_nav_link('Main',1,0,'<i class="fa fa-home"></i>');
								$this->ds_nav_dropdown('Info',1,0,'<i class="fa fa-info-circle"></i>');
								$this->ds_nav_dropdown('Member',1,0,'<i class="fa fa-user-circle"></i>');
						
							echo '</ul>';
							echo '<ul class="nav navbar-nav pull-lg-right">';
								$this->ds_nav_dropdown('Options',1,0,'<i class="fa fa-power-off"></i>');
							echo '</ul>';
						}
						echo '</div>';
					echo '</div>';
				echo '</nav>';
			}
			elseif($Zone == "ACP"){
				echo '<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark nav_top_border">';
				if($this->User->LoggedIn() && $this->User->isAdmin()){
					echo '<a class="navbar-brand col-sm-3 col-md-2 mr-0 hidden-sm-down" href="?'.$this->Setting->PAGE_PREFIX.'=DASHBOARD">NDF Admin Panel</a>';
				}
				else{
					echo '<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">NDF Admin Panel</a>';
				}
					echo '<div class="col-md-8"></div>';
					echo '<div class="col-md-2">';
						echo '<ul class="navbar-nav justify-content-end">';
						if($this->User->LoggedIn() && $this->User->isAdmin()){
							echo '<li class="nav-item"><a class="nav-link m_t_5" href="?'.$this->Setting->PAGE_PREFIX.'=STNG_WARNING"><i class="fa fa-cog"></i></a></li>';
						}
/*
						echo '<li class="nav-item dropdown">';
							echo '<a class="nav-link dropdown-toggle m_t_5" href="javascript:;" id="Alerts" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope"></i></a>';
							echo '<div class="dropdown-menu" aria-labelledby="Alerts">';
								echo '<a class="dropdown-item" href="javascript:;"><span class="badge badge-primary">Alert Badge</span></a>';
								echo '<a class="dropdown-item" href="javascript:;"><span class="badge badge-success">Alert Badge</span></a>';
								echo '<a class="dropdown-item" href="javascript:;"><span class="badge badge-info">Alert Badge</span></a>';
								echo '<a class="dropdown-item" href="javascript:;"><span class="badge badge-warning">Alert Badge</span></a>';
								echo '<a class="dropdown-item" href="javascript:;"><span class="badge badge-danger">Alert Badge</span></a>';
								echo '<a class="dropdown-divider"></a>';
								echo '<a class="dropdown-item" href="javascript:;">View All</a>';
							echo '</div>';
						echo '</li>';
*/
							echo '<li class="dropdown nav-item">';
							if($this->User->LoggedIn()){
								echo '<a href="javascript:;" class="nav-link dropdown-toggle" id="Options" data-toggle="dropdown"><i class="fa fa-user"></i> '.$this->User->UserID.' <b class="caret"></b></a>';
							}
							else{
								echo '<a href="javascript:;" class="nav-link dropdown-toggle" id="Options" data-toggle="dropdown">Options <b class="caret"></b></a>';
							}
								echo '<div class="dropdown-menu" aria-labelledby="Options">';
								if($this->User->isAdmin()){
									#echo '<li class="dropdown-item"><a href="javascript:;"><i class="fa fa-fw fa-user"></i> Profile</a></li>';
									#echo '<li class="dropdown-item"><a href="javascript:;"><i class="fa fa-fw fa-envelope"></i> Inbox</a></li>';
									#echo '<li class="divider"></li>';
									echo '<a class="dropdown-item" href="?'.$this->Setting->PAGE_PREFIX.'=Logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>';
								}
								else{
									echo '<a class="dropdown-item" href="?'.$this->Setting->PAGE_PREFIX.'=HOME"><i class="fa fa-fw fa-power-off"></i> Home</a>';
								}
								echo '</div>';
							echo '</li>';
						echo '</ul>';
					echo '</div>';
				echo '</nav>';
			}
		}
		function NAV_SIDE($Zone){
			if($Zone == "CMS"){
				echo '<div class="container-fluid">';
					echo '<div class="row">';
						echo '<div class="col-md-2 col-sm-2 ndf_side_nav">';
							echo '<div class="logo_sidemenu text-center">';
							if($this->User->get_isLoggedIn()){
								echo '<img src="'.$this->Style->get_STYLE_IMAGES_DIR().'NDF%20Logo.ico" style="width:128px;height:128px;" class="img-responsive">';
								echo '<br>';
								echo '<h5 class="tac b_i">Hello, '.$_SESSION['UID'].'</h5>';
								echo '<h6 class="tac"><img src="'.$this->Style->get_STYLE_IMAGES_DIR().'ap_32x32.png" class="img-responsive"> '.$this->User->get_UserInfo("Point").' <span class="b_i"></span></h6>';
								if($this->User->get_isAdmin()){
									echo '<h6 class="tac b_i"><a href="acp/" target="_blank">Administration Panel</a></h6>';
								}
							}else{
								echo '<img src="'.$this->Style->get_STYLE_IMAGES_DIR().'guest-512.png" style="width:128px;height:128px;" class="img-responsive">';
								echo '<br>';
								echo '<h5 class="tac b_i">Hello, Guest</h5>';
								echo '<h6 class="tac">Please log in to access your menu.</h6>';
								echo '<div class="separator_10></div>';
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
			}
			elseif($Zone == "ACP"){
				echo '<nav class="col-md-2 d-none d-md-block sidebar text-white">';
					echo '<div id="MainMenu">';
						$this->Tpl->Separator('10');
						echo '<div class="list-group panel">';
						if($this->User->LoggedIn()){
							# SINGLE LINK
							$this->Tpl->Separator('10');
							$this->ds_acp_nav_side_link('Dashboard',1,0,'<i class="fa fa-fw fa-dashboard"></i>');
							# DROPDOWN LINK
							$this->ds_acp_nav_side_dd('Site',1,0);
							
							$this->ds_acp_nav_side_dd('Account',1,0);
							$this->ds_acp_nav_side_dd('Player',1,0);
							$this->ds_acp_nav_side_dd('Staff',1,0);
							$this->ds_acp_nav_side_dd('Developer',1,0);
/*
							echo '<a href="#demo3" class="list-group-item list-group-item-dark" data-toggle="collapse" data-parent="#MainMenu">Item 3 <i class="fa fa-caret-down"></i></a>';
							echo '<div class="collapse" id="demo3">';

								echo '<a href="#SubMenu1" class="list-group-item" data-toggle="collapse" data-parent="#SubMenu1">Subitem 1 <i class="fa fa-caret-down"></i></a>';
								echo '<div class="collapse list-group-submenu" id="SubMenu1">';
									echo '<a href="#" class="list-group-item" data-parent="#SubMenu1">Subitem 1 a</a>';
									echo '<a href="#" class="list-group-item" data-parent="#SubMenu1">Subitem 2 b</a>';

									echo '<a href="#SubSubMenu1" class="list-group-item" data-toggle="collapse" data-parent="#SubSubMenu1">Subitem 3 c <i class="fa fa-caret-down"></i></a>';
									echo '<div class="collapse list-group-submenu list-group-submenu-1" id="SubSubMenu1">';
										echo '<a href="#" class="list-group-item" data-parent="#SubSubMenu1">Sub sub item 1</a>';
										echo '<a href="#" class="list-group-item" data-parent="#SubSubMenu1">Sub sub item 2</a>';
									echo '</div>';

									echo '<a href="#" class="list-group-item" data-parent="#SubMenu1">Subitem 4 d</a>';
								echo '</div>';

								echo '<a href="javascript:;" class="list-group-item">Subitem 2</a>';
								echo '<a href="javascript:;" class="list-group-item">Subitem 3</a>';
							echo '</div>';
*/
						}
						echo '</div>';
					echo '</div>';
				echo '</nav>';
			}
		}
		function ds_acp_nav_top_dd($PageCat,$PageShow,$ReqLogin){
			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					echo '<li class="nav-item dropdown">';
						echo '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:;" id="'.$PageCat.'" role="button" aria-haspopup="true" aria-expanded="false">'.$PageCat.'</a>';
						echo '<div class="dropdown-menu w_100_p bg-dark" aria-labelledby="'.$PageCat.'">';
						while($res = odbc_fetch_array($stmt)){
							echo '<a class="dropdown-item" href="?'.$this->Setting->PAGE_PREFIX.'='.$res["PAGE_INDEX"].'"><i class="fa fa-chevron-right"></i> '.$res["PAGE_TITLE"].'</a>';
						}
						echo '</div>';
					echo '</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		function ds_acp_nav_side_link($PageCat,$PageShow,$ReqLogin,$LinkIcon=false){
			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					echo '<a href="?'.$this->Setting->PAGE_PREFIX.'='.$data["PAGE_INDEX"].'" class="list-group-item list-group-item-primary b_i f_18 m_t_10 m_b_5" data-parent="#MainMenu">';
					if($LinkIcon){
						echo $LinkIcon.' ';
					}
					echo $data["PAGE_TITLE"].'</a>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		function ds_acp_nav_side_dd($PageCat,$PageShow,$ReqLogin,$LinkIcon=false){
			$PageSub	=	$PageCat.' Tools';

			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				if(odbc_num_rows($stmt) > 0){
				#	echo '<div class="badge badge-primary b_i f_18 m_t_10 m_b_5">'.$PageSub.'</div>';
					echo '<a href="#'.$PageCat.'" class="list-group-item list-group-item-primary b_i f_18 m_t_10 m_b_5" data-toggle="collapse" data-parent="#MainMenu">'.$PageSub.' <i class="fa fa-caret-down"></i></a>';
					echo '<div class="collapse" id="'.$PageCat.'">';
					while($data = odbc_fetch_array($stmt)){
						echo '<a class="list-group-item" href="?'.$this->Setting->PAGE_PREFIX.'='.$data["PAGE_INDEX"].'">';
						if($LinkIcon){
							echo $LinkIcon;
						}
						echo $data["PAGE_TITLE"].'</a>';
					}
					echo '</div>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		function ds_nav_link($t1,$t2,$t3,$t4){
			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($t1,$t2,$t3);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				while($res = odbc_fetch_array($stmt)){
					echo '<li class="nav-item">';
						echo '<a class="nav-link" href="?'.$this->Setting->PAGE_PREFIX.'='.$res["PAGE_INDEX"].'">'.$t4.' '.$res["PAGE_TITLE"].'</a>';
					echo '</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
		function ds_nav_dropdown($PageCat,$PageShow,$ReqLogin){
			$sql	=	("
							SELECT *
							FROM ".$this->db->get_TABLE('SETTINGS_PAGES')."
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				if(odbc_num_rows($stmt) > 0){
					echo '<li class="nav-item dropdown">';
						echo '<a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$PageCat.'</a>';
						echo '<div class="dropdown-menu';
								if($this->Theme->_theme_array[12]){echo ' '.$this->Theme->_theme_array[12].'>';}
								else{echo ' no_bg';}
								echo '" aria-labelledby="navbarDropdownMenuLink">';
						while($res = odbc_fetch_array($stmt)){
							echo '<a class="dropdown-item" href="?'.$this->Setting->PAGE_PREFIX.'='.$res["PAGE_INDEX"].'"><i class="fa fa-chevron-right"></i> '.$res["PAGE_TITLE"].'</a>';
						}
						echo '</div>';
					echo '</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->db->conn);
			}
		}
	}
?>