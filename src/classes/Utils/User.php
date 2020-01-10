<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class User{

		# SQL
		private $sql;private $res;private $fet;

		# Account Info - Shared
		private $AdminLevel;
		private $Country;
		private $DisplayName;
		private $DOB;
		private $Email;
		private $JoinDate;
		private $LeaveDate;
		public $LoginStatus;
		private $Point;
		private $RegDate;
		private $Status;
		private $UseQueue;
		private $UserUID;
		private $UserID;
		private $UserIP;

		# Status
		public $ADM;
		public $GM;
		public $GS;
		public $Member;

		# Account Info - BDSM
		private $MemberID;private $PartnerID_1;private $PartnerID_2;private $PartnerID_3;

		# Session
		public $LoginGuest;

		public function __construct($Browser,$db,$Setting){
			$this->Browser	=	$Browser;
			$this->db		=	$db;
			$this->Setting	=	$Setting;

			if(isset($_SESSION) && isset($_SESSION["UserUID"])){
				if($this->Setting->_arr["SITE_TYPE"] == 'BDSM'){}
				elseif($this->Setting->_arr["SITE_TYPE"] == 'EVE'){
					$this->sql	=	("
										SELECT TOP 1 *
										FROM ".$this->db->_table_list("WEB_PRESENCE")."
										WHERE [UserUID] = '".$_SESSION["UserUID"]."'
					");
				}
				elseif($this->Setting->_arr["SITE_TYPE"] == 'FORTE'){
					$this->sql	=	("
										SELECT TOP 1 *
										FROM ".$this->db->_table_list("WEB_PRESENCE")."
										WHERE [UserUID] = '".$_SESSION["UserUID"]."'
					");
				}
				elseif($this->Setting->_arr["SITE_TYPE"] == 'JV'){
					$this->sql	=	("
										SELECT TOP 1 *
										FROM ".$this->db->_table_list("WEB_PRESENCE")."
										WHERE [UserUID] = '".$_SESSION["UserUID"]."'
					");
				}
				elseif($this->Setting->_arr["SITE_TYPE"] == 'MUSIC'){
					$this->sql	=	("
										SELECT TOP 1 *
										FROM ".$this->db->_table_list("WEB_PRESENCE")."
										WHERE [UserUID] = '".$_SESSION["UserUID"]."'
					");
				}
				elseif($this->Setting->_arr["SITE_TYPE"] == 'SH'){
					$this->sql	=	("
										SELECT TOP 1
											[UM].[JoinDate],[UM].[LeaveDate],[UM].[Point],
											[WP].*
										FROM ".$this->db->_table_list("SH_USERDATA")."			AS [UM]
										INNER JOIN ".$this->db->_table_list("WEB_PRESENCE")."	AS [WP] ON [UM].[UserUID]=[WP].[UserUID]
										WHERE [UM].[UserUID] = '".$_SESSION["UserUID"]."'
					");
				}
				elseif($this->Setting->_arr["SITE_TYPE"] == 'STD'){
					$this->sql	=	("
										SELECT TOP 1 *
										FROM ".$this->db->_table_list("WEB_PRESENCE")."
										WHERE [UserUID] = '".$_SESSION["UserUID"]."'
					");
				}

				$this->res	=	odbc_exec($this->db->conn,$this->sql);
				$this->fet	=	odbc_fetch_array($this->res);

				if($this->Setting->_arr["SITE_TYPE"] == "BDSM"){
					$this->MemberID		=	$this->fet["MemberID"];
					$this->PartnerID_1	=	$this->fet["PartnerID_1"];
					$this->PartnerID_2	=	$this->fet["PartnerID_2"];
					$this->PartnerID_3	=	$this->fet["PartnerID_3"];
				}
				if($this->Setting->_arr["SITE_TYPE"] == 'SH'){
					$this->JoinDate		=	$this->fet["JoinDate"];
					$this->LeaveDate	=	$this->fet["LeaveDate"];
					$this->Point		=	$this->fet["Point"];
				}

				# Web Presence
				$this->Country		=	$this->fet["Country"];
				$this->DisplayName	=	$this->fet["DisplayName"];
				$this->DOB			=	$this->fet["DateOfBirth"];
				$this->Email		=	$this->fet["Email"];
				$this->Status		=	$this->fet["Status"];
				$this->AdminLevel	=	$this->fet["AdminLevel"];
				$this->UserID		=	$this->fet["UserID"];
				$this->UserIP		=	$this->fet["UserIP"];
				$this->UserUID		=	$this->fet["UserUID"];

				$this->_is_staff($this->AdminLevel);

				# Cleanup
				$this->sql=null;
				$this->fet=null;
				$this->res=null;
			}

			$this->_is_Logged_In();
		}
		public function _class_info($level=false){
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
			}
		}
		public function _get_data($data){
			if($this->$data){
				return $this->$data;
			}

		#	echo '<b>Class ('.get_class($this).'):</b><br>';
		#	echo 'The requested var, <b>'.$data.'</b>, couldn\'t be found.';
		#	exit;
		}
		public function _get_UserInfo($data){
			switch($data){
				case 'JoinDate':
					return date("m/d/Y", strtotime($this->$data));
				break;
				case 'LeaveDate':
					return date("m/d/Y", strtotime($this->$data));
				break;
				case 'LoginDate':
					return date("m/d/Y", strtotime($this->$data));
				break;
				case 'RegDate':
					return date("m/d/Y", strtotime($this->$data));
				break;
				default: return $this->$data;
			}
		}
		public function _is_staff(){
			if(isset($_SESSION["User"])){
				switch($_SESSION["User"]["AdminLevel"]){
					case	'16'	:
						$this->ADM=true;
						return true;
					break;
					case	'32'	:
						$this->GM=true;
						return true;
					break;
					case	'64'	:
						$this->GM=true;
						return true;
					break;
					case	'80'	:
						$this->GM=true;
						return true;
					break;
					case	'128'	:
						$this->GS=true;
						return true;
					break;
					case	'0'	:
						$this->Member=true;
						return true;
					break;
				}
			}

			return false;
		}
		function _is_ADM(){
			if(isset($_SESSION)){
				if($_SESSION["User"]["Status"] == 16){
					return true;
				}
			}

			return false;
		}
		function _is_GM(){
			if($this->Status == 32 || $this->Status == 64 || $this->Status == 80){
				return true;
			}
			return false;
		}
		function _is_GS(){
			if($this->Status == 128){
				return true;
			}
			return false;
		}
		function _is_Logged_In(){
			if(!empty($this->UserUID) && !empty($this->UserID) && is_numeric($this->UserUID)){
				$this->LoginStatus	=	1;
				return true;
			}
			else{
				$this->LoginStatus	=	0;
				return false;
			}
		}
		function get_isCharExist() {
			# Char Existence Check
			$sql	=	("SELECT * FROM ".Chars." WHERE UserUID=?");
			$stmt	=	odbc_prepare($cxn,$sql);
			$args	=	array($this->UserUID);
			if(!odbc_execute($stmt,$args)){
				return false;
			}elseif($row=odbc_fetch_array($stmt)){
				return true;
			}
		}
		function get_isLoggedInName(){
			# User Login Check
			$UserLoginStatus=false;
			if(isset($this->UserUID,$this->UserID)){
				$UserLoginStatus = $this->UserID;
			}else{
				$UserLoginStatus = "Guest";
			}
			return $UserLoginStatus;
		}
		function Auth(){
			if(!$this->_is_Logged_In()){
				header('location: ?'.$this->Setting->_arr["PAGE_PREFIX"].'=AUTH');
				die();
			}
		}
		function get_Status($Status){
			switch($Status){
				case '0':	return 'Player'; break;
				case '10':	return 'Administrator'; break;
				case '32':	return 'GameMaster'; break;
				case '64':	return 'GameMaster Assistant'; break;
				case '80':	return 'GameSage'; break;
			}
		}
		function _fetch_UserInfo($col=false){
			$return=false;

			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list("SH_USERDATA").'
							WHERE UserUID=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($this->UserUID);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				$return=array();
				$cnt=0;
				while($results=odbc_fetch_array($stmt)){
					foreach($results as $key=>$value){
						if($col){
							if($key==$col){
								$return=$results[$col];
								break;
							}
							else{$return = 'Datatype Invalid';}
						}
						else{$return[$key]=$value;}
					}
					$cnt++;
				}
			return $return;
			odbc_free_result($stmt);
			odbc_close($this->db->conn);
			}
		}
		function enc_recovery_key(){}
		function dec_recovery_key(){}
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
		
	}
?>