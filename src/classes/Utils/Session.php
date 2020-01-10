<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

#	NOTE : fix session creation, add {CREATE_SESSION} to {STORE_SESSION} or fix in login/registration ajax

	#############################################################################################
	#	Title: Session.class.php																#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS Session API, used for managing all session resources							#
	#	Last Update Date: 06.14.2019	1112													#
	#############################################################################################

	class Session{

		private $crypt			=	"sha512";
		private $inactive		=	"1200";
		private $logged_in;
		private $login_status;
		private $sess_id;
		private $sess_key;
		private $sess_life;
		

		public function __construct($db,$Browser,$Setting,$User){
			$this->db		=	$db;
			$this->Browser	=	$Browser;
			$this->Setting	=	$Setting;
			$this->User		=	$User;

		#	$this->_load_session();
			$this->_ssl_check();
		#	$this->_session_check();
		}
		private function _set_sess_id(){
			$this->sess_id	=	session_id();

			if($this->sess_id == ''){
				$this->_start();
			}
			if(!$this->logged_in == true){
				session_unset(); //destroys variables
				session_destroy(); //destroys session;

				$this->sess_id	=	session_id();

				if($this->sess_id == ""){
					$this->_start();
				}
			}

			if(!isset($_SESSION['safety'])){
				session_regenerate_id(true);
				$_SESSION['safety'] = true;
			}

			$_SESSION['sess_id'] = session_id();
		}
		private function _start(){
		//	session_cache_expire(1);
			session_start();
			ob_start();

		/*
			if(isset($_SESSION['Start'])){
				$this->sess_life = time() - $_SESSION['Start'];
				if($this->sess_life > $this->inactive){
					header("Location: user_logout.php");
				}
			}

			$_SESSION['Start'] = time();

			if($_SESSION['valid_user'] != true){
				header('Location: ../index.php');
			}
		*/
		}
		private function _login(){
			$this->logged_in=true;
		}
		private function _logout(){
			$this->logged_in=false;
		}
		private function _login_status(){
			return $this->logged_in;
		}
		private function _session_check(){
			if(isset($this->sess_id) && $this->sess_id !== ""){
				$sql	=	("
								SELECT TOP 1 SessionID
								FROM ".$this->db->_table_list("LOG_SESSION")."
								WHERE SessionID=?
				");
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(session_id());
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					if(odbc_num_rows == 1){}
					else{
						while($data=odbc_fetch_array($stmt)){
							
						}
					}
				}
			}
			else{
				
			}
		}
		private function _hash_basic(){}
		private function _hash_auth(){
			$this->session_key	=	hash($crypt,$_SERVER["REMOTE_ADDR"].$_SESSION["UserID"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
		}
		private function _create($data){
			$this->session_key	=	hash($crypt,$_SERVER["REMOTE_ADDR"].$_SESSION["UserID"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			$this->_do_login();

			return $this->session_key;
		}
		private function _validate(){
			$CHECK	=	hash($crypt,$_SERVER["REMOTE_ADDR"].$_SESSION["UserID"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			if($CHECK !== $this->session_key){
				session_destroy();
				header('location: ?'.$this->Setting->PAGE_PREFIX.'=HOME');
				exit();
			}
			else{
				return true;
			}
		}
		public function _store_basic(){
			$sql	=	(
							"INSERT INTO ".$this->db->_table_list("LOG_SESSION")."
								(OS,Browser,BrowserVer,UserIP,SessionID,Page)
							VALUES
								(?,?,?,?,?,?,?,?,?)"
			);
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array(
								$this->Browser->OS_Platform,
								$this->Browser->BrowserType,
								$this->Browser->UserAgent,
								$this->Browser->UserIP,
								$_SESSION["CMS_SID"],
								$_SERVER["REQUEST_URI"]
			);
			odbc_execute($stmt,$args);
			
		}
		public function _store_acct($Action){
			$sql	=	(
							"INSERT INTO ".$this->db->_table_list("LOG_SESSION")."
								(UserUID,UserID,AcctStatus,Action,OS,Browser,BrowserVer,UserIP,SessionID)
							VALUES
								(?,?,?,?,?,?,?,?,?)"
			);
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array(
								$_SESSION['UserUID'],
								$_SESSION['UserID'],
								$_SESSION['Status'],
								$Action,
								$this->Browser->OS_Platform,
								$this->Browser->BrowserType,
								$this->Browser->UserAgent,
								$this->Browser->UserIP,
								$_SESSION["CMS_SID"]
			);
			odbc_execute($stmt,$args);

			if($this->Setting->_arr["SITE_TYPE"] == "3"){
				$sql	=	('
								UPDATE '.$this->db->_table_list("SH_USERDATA").'
								SET JoinDate	=	?,
									Leave		=	?
								WHERE UserUID	=	?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(date('Y-m-d H:i:s'),1,$_SESSION['UserUID']);
				odbc_execute($stmt,$args);
			}
		}
		private function _close($UserUID){
			if($UserUID){
				$sql	=	('
								UPDATE '.$this->db->_table_list("LOG_SESSION").'
								SET LogoutDate	=	?
								WHERE UserUID	=	?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(date('Y-m-d H:i:s'),$UserUID);
				odbc_execute($stmt,$args);

				if($this->Setting->_arr["SITE_TYPE"] == 3){

					$sql	=	('
									UPDATE '.$this->db->_table_list("SH_USERDATA").'
									SET LeaveDate	=	?,
										Leave		=	?
									WHERE UserUID	=	?
					');
					$stmt	=	odbc_prepare($this->db->conn,$sql);
					$args	=	array(date('Y-m-d h:i:s'),0,$UserUID);
					@odbc_execute($stmt,$args);
				}
				$this->_logout();

				unset($_SESSION);
				session_unset();
				session_destroy();
			}
			else{
				unset($_SESSION);
				session_unset();
				session_destroy();
			}
		}
		private function _do_login($UserUID,$UserID,$Status,$AdminLevel,$Email){
			session_name("CMS_AUTH");

			$_SESSION["UserUID"]		=	$UserUID;
			$_SESSION["UserID"]			=	$UserID;
			$_SESSION["Status"]			=	$Status;
			$_SESSION["AdminLevel"]		=	$AdminLevel;
			$_SESSION["Email"]			=	$Email;

			$_SESSION["CMS_SID"]		=	$this->_create_session($UserID);
			$this->_store_session_acct('Logged In - UserID/Pw Access for '.$UserID.' from '.$this->Browser->UserIP);
		}
		public function _ssl_check(){
			# HTTP | HTTPS Protocol
			if($this->Setting->_arr["HTTPS_SSL"] == true || $this->Setting->_arr["HTTPS_SSL"] == "true"){
				if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] == "off"){
					$redirect_url="https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
					header("Location: $redirect_url");
					exit;
				}
			}
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

/*
	$member = new Member();
	$member->username = "Fred";
	echo $member->username . " is " . ( $member->isLoggedIn() ? "logged in" : "logged out" ) . "<br>";
	$member->login();
	echo $member->username . " is " . ( $member->isLoggedIn() ? "logged in" : "logged out" ) . "<br>";
	$member->logout();
	echo $member->username . " is " . ( $member->isLoggedIn() ? "logged in" : "logged out" ) . "<br>";
 */