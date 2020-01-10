<?php
	namespace classes\Display\Templates\CMS;

	class Nav{

		private $SiteType;
		private $output;

		# Public Methods
		public function __construct($MSSQL,$Paging,$Setting,$Stats,$Theme,$Tpl,$User){
			$this->MSSQL	=	$MSSQL;
			$this->Paging	=	$Paging;
			$this->Setting	=	$Setting;
			$this->Stats	=	$Stats;
			$this->Theme	=	$Theme;
			$this->Tpl		=	$Tpl;
			$this->User		=	$User;

			$this->SiteType	=	$this->Setting->_arr["SITE_TYPE"];

			$this->_security();
			$this->html_nav();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}		
		public function _get($method){
			$method	=	'html_'.$method;
			$err='Fatal error in <b>'.get_class($this).'<br>';
			$err.='Error: Method '.$method.' was called, but it doesn\'t exist!';

			try{
				if(method_exists($this,$method)){
					$this->$method();
				#	echo "Retrieved ($method)<br>";
				}
			}
			catch(exception $e){
				throw new \Classes\Exception\SystemException('Error in <b>'.get_class($this).'<br>'.$err,0,0,__FILE__,__LINE__);
				exit;
			}
		}

		# Private Methods
		private function html_nav_server_status(){
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
		private function html_nav(){
			if($this->SiteType=="STD"){
				$this->output.='<nav class="navbar navbar-expand-md navbar-dark no_padding">';
					$this->output.='<div class="container no-padding';
					if($this->Theme->_arr["NAV_BG_COLOR"]){
						$this->output.=' '.$this->Theme->_arr["NAV_BG_COLOR"].'">';}
					else{
						$this->output.=' no_bg">';
					}

						$this->output.='<button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">';
							$this->output.='<span class="navbar-toggler-icon"></span>';
						$this->output.='</button>';

						$this->output.='<div class="collapse navbar-collapse" id="navbarSupportedContent">';
					//	if(isset($this->User->UserUID) && is_numeric($this->User->UserUID)){
						if(isset($_SESSION["User"]["UserUID"])){
							$this->output.='<ul class="navbar-nav mr-auto">';
								# $PageCat,$PageShow,$ReqLogin
								# HOME LINK
								$this->html_nav_link_site_type('Main',1,0);
								# DROPDOWN - INFO
								$this->html_nav_dropdown($this->SiteType,'Info',1,1,'<i class="fa fa-info-circle"></i>');
								# DROPDOWN - MEMBER
								$this->html_nav_dropdown($this->SiteType,'Member',1,1,'<i class="fa fa-user-circle"></i>');
							$this->output.='</ul>';
							$this->output.='<ul class="nav navbar-nav pull-lg-right">';
								# DROPDOWN - OPTIONS
								$this->html_nav_dropdown('STD','Options',1,1,'<i class="fa fa-power-off"></i>');
							$this->output.='</ul>';
						}
						else{
							$this->output.='<ul class="navbar-nav mr-auto">';
								$this->_nav_link_site_type('Main',1,0,'<i class="fa fa-home"></i>');
								$this->html_nav_dropdown($this->SiteType,'Info',1,0,'<i class="fa fa-info-circle"></i>');
								$this->html_nav_dropdown($this->SiteType,'Member',1,0,'<i class="fa fa-user-circle"></i>');
							$this->output.='</ul>';
							$this->output.='<ul class="nav navbar-nav pull-lg-right">';
								$this->html_nav_dropdown('STD','Options',1,0,'<i class="fa fa-power-off"></i>');
							$this->output.='</ul>';
						}
						$this->output.='</div>';
					$this->output.='</div>';
				$this->output.='</nav>';
			}
			elseif($this->SiteType=="BDSM"){
				$this->output.='<nav class="navbar navbar-expand-md navbar-dark no_padding">';
					$this->output.='<div class="container no-padding';
					if($this->Theme->_arr["NAV_BG_COLOR"]){
						$this->output.=' '.$this->Theme->_arr["NAV_BG_COLOR"].'">';}
					else{
						$this->output.=' no_bg">';
					}

						$this->output.='<button class="navbar-dark navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">';
							$this->output.='<span class="navbar-toggler-icon"></span>';
						$this->output.='</button>';

						$this->output.='<div class="collapse navbar-collapse" id="navbarSupportedContent">';
					//	if(isset($this->User->UserUID) && !empty($this->User->UserUID) && is_numeric($this->User->UserUID)){
						if(isset($_SESSION["User"]["UserUID"])){
							$this->output.='<ul class="navbar-nav mr-auto">';
								# $PageCat,$PageShow,$ReqLogin
								# HOME LINK
								$this->html_nav_link_site_type('Main',1,0);
								# DROPDOWN - INFO
								$this->html_nav_dropdown($this->SiteType,'Info',1,1,'<i class="fa fa-info-circle"></i>');
								# DROPDOWN - MEMBER
								$this->html_nav_dropdown($this->SiteType,'Member',1,1,'<i class="fa fa-user-circle"></i>');
							$this->output.='</ul>';
							$this->output.='<ul class="nav navbar-nav pull-lg-right">';
								# DROPDOWN - OPTIONS
								$this->html_nav_dropdown('STD','Options',1,1,'<i class="fa fa-power-off"></i>');
							$this->output.='</ul>';
						}
						else{
							$this->output.='<ul class="navbar-nav mr-auto">';
								$this->html_nav_link_site_type('Main',1,0,'<i class="fa fa-home"></i>');
								$this->html_nav_dropdown($this->SiteType,'Info',1,0,'<i class="fa fa-info-circle"></i>');
								$this->html_nav_dropdown($this->SiteType,'Member',1,0,'<i class="fa fa-user-circle"></i>');
							$this->output.='</ul>';
							$this->output.='<ul class="nav navbar-nav pull-lg-right">';
								$this->html_nav_dropdown('STD','Options',1,0,'<i class="fa fa-power-off"></i>');
							$this->output.='</ul>';
						}
						$this->output.='</div>';
					$this->output.='</div>';
				$this->output.='</nav>';
			}
			elseif($this->SiteType=="MUSIC"){}
			elseif($this->SiteType=="SH"){}
			elseif($this->SiteType=="JV"){}
			elseif($this->SiteType=="EVE"){}
			else{
				# SIDE NAV
					$this->output.='<div class="container-fluid">';
						$this->output.='<div class="row">';
							$this->output.='<div class="col-md-2 col-sm-2 ndf_side_nav">';
								$this->output.='<div class="logo_sidemenu text-center">';
								if($this->User->get_is_is_Logged_In()){
									$this->output.='<img src="'.$this->Style->get_STYLE_IMAGES_DIR().'NDF%20Logo.ico" style="width:128px;height:128px;" class="img-responsive">';
									$this->output.='<br>';
									$this->output.='<h5 class="tac b_i">Hello, '.$_SESSION['UID'].'</h5>';
									$this->output.='<h6 class="tac"><img src="'.$this->Style->get_STYLE_IMAGES_DIR().'ap_32x32.png" class="img-responsive"> '.$this->User->get_UserInfo("Point").' <span class="b_i"></span></h6>';
									if($this->User->get__is_ADM()){
										$this->output.='<h6 class="tac b_i"><a href="acp/" target="_blank">Administration Panel</a></h6>';
									}
								}
								else{
									$this->output.='<img src="'.$this->Style->get_STYLE_IMAGES_DIR().'guest-512.png" style="width:128px;height:128px;" class="img-responsive">';
									$this->output.='<br>';
									$this->output.='<h5 class="tac b_i">Hello, Guest</h5>';
									$this->output.='<h6 class="tac">Please log in to access your menu.</h6>';
									$this->output.='<div class="separator_10"></div>';
								}
								$this->output.='</div>';
								$this->output.='<div class="left-navigation">';
									$this->output.='<div id="tabs_nav">';
										$this->output.='<ul>';
											$this->output.='<li><a href="#tabs-1">Main</a></li>';
										if($this->User->LoginStatus){
											$this->output.='<li><a href="#tabs-2">Info</a></li>';
											$this->output.='<li><a href="#tabs-3">Member</a></li>';
										}
										$this->output.='</ul>';
										$this->output.='<div id="tabs-1">';
											$this->output.='<ul class="list">';
												$this->ds_nav_link('Home',1,0,'<i class="fa fa-home"></i>');
												$this->output.='<li class="separator_10 no_bg"></li>';
												$this->ds_nav_link('Options',1,$this->User->LoginStatus,'<i class="fa fa-power-off"></i>');
											$this->output.='</ul>';
										$this->output.='</div>';
									if($this->User->LoginStatus){
										$this->output.='<div id="tabs-2">';
											$this->output.='<ul class="list">';
												$this->ds_nav_link('Info',1,1,'<i class="fa fa-info-circle"></i>');
											$this->output.='</ul>';
										$this->output.='</div>';
										$this->output.='<div id="tabs-3">';
											$this->output.='<ul class="list">';
												$this->ds_nav_link('Member',1,1,'<i class="fa fa-user-circle"></i>');
											$this->output.='</ul>';
										$this->output.='</div>';
									}
									$this->output.='</div>';
								$this->output.='</div>';
							$this->output.='</div>';
						$this->output.='</div>';
					$this->output.='</div>';
			}
		}
		private function html_nav_link($PageCat,$PageShow,$ReqLogin){
			$sql	=	('
							SELECT *
							FROM '.$this->MSSQL->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt)>0){
					while($data = odbc_fetch_array($stmt)){
						$this->output.='<li class="nav-item">';
							$this->output.='<a class="nav-link" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">';
							if($data["PAGE_ICON"] && $data["PAGE_ICON"] !== ""){
								$this->output.='<i class="'.$data["PAGE_ICON"].'"></i> ';
							}
							$this->output.=$data["PAGE_TITLE"];
							$this->output.='</a>';
						$this->output.='</li>';
					}
				}
				else{
					$this->output.='No results found';
				}

				odbc_free_result($stmt);
				odbc_close($this->MSSQL->conn);
			}
		}
		private function html_nav_link_site_type($PageCat,$PageShow,$ReqLogin){
			$sql	=	('
							SELECT *
							FROM '.$this->MSSQL->_table_list('SETTINGS_PAGES').'
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=? AND SITE_TYPE=?
							ORDER BY PAGE_TITLE ASC
			');
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin,$this->SiteType);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt)>0){
					while($data = odbc_fetch_array($stmt)){
						$this->output.='<li class="nav-item">';
							$this->output.='<a class="nav-link" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">';
							if($data["PAGE_ICON"] && $data["PAGE_ICON"] !== ""){
								$this->output.='<i class="'.$data["PAGE_ICON"].'"></i> ';
							}
							$this->output.=$data["PAGE_TITLE"];
							$this->output.='</a>';
						$this->output.='</li>';
					}
					odbc_free_result($stmt);
				odbc_close($this->MSSQL->conn);
				}
				else{
					$this->_nav_link($PageCat,$PageShow,$ReqLogin);
				}
			}
		}
		private function html_nav_dropdown($SiteType,$PageCat,$PageShow,$ReqLogin,$Icon){
			$sql	=	("
							SELECT *
							FROM ".$this->MSSQL->_table_list('SETTINGS_PAGES')."
							WHERE PAGE_CAT=? AND PAGE_SHOW=? AND REQ_LOGIN=? AND SITE_TYPE=?
							ORDER BY PAGE_TITLE ASC
			");
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array($PageCat,$PageShow,$ReqLogin,$SiteType);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$this->output.='<li class="nav-item dropdown">';
						$this->output.='<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">';
							$this->output.=$Icon.' '.$PageCat;
						$this->output.='</a>';
						$this->output.='<div class="dropdown-menu';
						if($this->Theme->_arr["NAV_BG_COLOR"]){$this->output.=' '.$this->Theme->_arr["NAV_BG_COLOR"].'>';}
						else{$this->output.=' no_bg';}
						$this->output.='" aria-labelledby="navbarDropdown">';
						while($data = odbc_fetch_array($stmt)){
							$this->output.='<a class="dropdown-item" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">';
								$this->output.='<i class="fa fa-chevron-right"></i> ';
								$this->output.=$data["PAGE_TITLE"];
							$this->output.='</a>';
						}
						$this->output.='</div>';
					$this->output.='</li>';
				}
				odbc_free_result($stmt);
				odbc_close($this->MSSQL->conn);
			}
		}
		public function _output(){
			echo $this->output;
		}

		# MISC
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
	}
?>