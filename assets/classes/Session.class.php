<?php
	class Session{

		public $CMS_SESSION;
		public $LoggedIn;

		public function __construct($Database,$Browser,$Setting,$User){
			$this->db		=	$Database;
			$this->Browser	=	$Browser;
			$this->Setting	=	$Setting;
			$this->User		=	$User;
		}
		function LOGIN(){
			$this->LoggedIn=true;
		}
		function LOGOUT(){
			$this->LoggedIn=false;
		}
		function IS_LOGGED_IN(){
			return $this->LoggedIn;
		}
		function CREATE_SESSION($data){
			$this->CMS_SESSION	=	hash("sha512",$_SERVER["REMOTE_ADDR"].$_SESSION["UserID"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			$this->LOGIN();

			return $this->CMS_SESSION;
		}
		function CHECK_SESSION(){
			$CHECK	=	hash("sha512",$_SERVER["REMOTE_ADDR"].$_SESSION["UserID"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			if($CHECK !== $this->CMS_SESSION){
				session_destroy();
				header('location: ?'.$this->Setting->PAGE_PREFIX.'=HOME');
				exit();
			}
			else{
				return true;
			}
		}
		function STORE_SESSION($Action){
			$sql	=	(
							"INSERT INTO ".$this->db->get_TABLE("LOG_SESSION")."
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

			if($this->Setting->SITE_TYPE == "SHAIYA"){
/*
				$sql	=	('
								UPDATE '.$this->db->get_TABLE("SH_USERDATA").'
								SET JoinDate	=	?,
									Leave		=	?
								WHERE UserUID	=	?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(date('Y-m-d H:i:s'),1,$_SESSION['UserUID']);
				odbc_execute($stmt,$args);
*/
			}
		}
		function CLOSE_SESSION($UserUID){
			if($UserUID){
				$sql	=	('
								UPDATE '.$this->db->get_TABLE("LOG_SESSION").'
								SET LogoutDate	=	?
								WHERE UserUID	=	?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(date('Y-m-d H:i:s'),$UserUID);
				odbc_execute($stmt,$args);

				if($this->Setting->SITE_TYPE == "SHAIYA"){

					$sql	=	('
									UPDATE '.$this->db->get_TABLE("SH_USERDATA").'
									SET LeaveDate	=	?,
										Leave		=	?
									WHERE UserUID	=	?
					');
					$stmt	=	odbc_prepare($this->db->conn,$sql);
					$args	=	array(date('Y-m-d h:i:s'),0,$UserUID);
					@odbc_execute($stmt,$args);
				}
				$this->LOGOUT();

				session_unset();
				session_destroy();
			}
			else{
				session_unset();
				session_destroy();
			}
		}
		function _do_login($UserUID,$UserID,$Status,$AdminLevel,$Email){
			session_name("CMS_SESS_VALIDATED");

			$_SESSION["UserUID"]		=	$UserUID;
			$_SESSION["UserID"]			=	$UserID;
			$_SESSION["Status"]			=	$Status;
			$_SESSION["AdminLevel"]		=	$AdminLevel;
			$_SESSION["Email"]			=	$Email;

			$_SESSION["CMS_SID"]		=	$this->CREATE_SESSION($UserID);
			$this->STORE_SESSION('Logged In - UserID/Pw Access for '.$UserID.' from '.$this->Browser->UserIP);
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