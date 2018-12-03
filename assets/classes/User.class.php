<?php
	class User{

		private $sql;
		private $res;
		private $fet;

		public $UserUID;
		public $UserID;
		public $Status;
		public $UseQueue;
		public $RegDate;
		public $LeaveDate;
		public $Point;
		public $UserIP;
		public $Email;

		public $LoginStatus;
		public $LoginGuest;

		function __construct($v2,$v4,$v1,$v3){
			$this->Browser	=	$v2;
			$this->Data		=	$v4;
			$this->db		=	$v1;
			$this->Setting	=	$v3;

			if(isset($_SESSION) && isset($_SESSION["UserID"])){
				$this->sql		=	("
										SELECT TOP 1 *
										FROM ".$this->db->get_TABLE("SH_USERDATA")."
										WHERE UserID = '".$_SESSION["UserID"]."'
				");
				$this->res	=	odbc_exec($this->db->conn,$this->sql);
				$this->fet	=	odbc_fetch_array($this->res);

				$this->UserUID		=	$this->fet["UserUID"];
				$this->UserID		=	$this->fet["UserID"];
			#	$this->RegDate		=	$this->fet["RegDate"];
				$this->LeaveDate	=	$this->fet["LeaveDate"];
				$this->Status		=	$this->fet["Status"];
				$this->UserIP		=	$this->fet["UserIp"];
				$this->Point		=	$this->fet["Point"];
				$this->Email		=	$this->fet["Email"];
			}

			$this->LoggedIn();
		}
		function isAdmin(){
			if($this->Status == 16){
				return true;
			}
			return false;
		}
		function isGameMaster(){
			if($this->Status == 32 || $this->Status == 64 || $this->Status == 80){
				return true;
			}
			return false;
		}
		function isGameSage(){
			if($this->Status == 128){
				return true;
			}
			return false;
		}
		function LoggedIn(){
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
		function get_isLoggedIn(){
			# User Login Check
			if(isset($this->UserUID) && isset($this->UserID) && is_numeric($this->UserUID)){
				return true;
			}
			return false;
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
			if(!$this->LoggedIn()){
				header('location: ?'.$this->Setting->PAGE_PREFIX.'=AUTH');
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
		function get_UserInfo($col=false){
			$return=false;

			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE("SH_USERDATA").'
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
		function pagination($page,$max_page,$url="",$number=4,$get_name="page"){
			$a		=	"";
			$b		=	"";
			$sheet	=	"";
			# function for showing next pages
			if(preg_match("/\?/",$url )){$appendix = "&amp;";}
			else{$appendix = "?";}
			if(substr($url,-1,1)=="&"){
				$url = substr_replace($url,"",-1,1);
			}elseif(substr($url,-1,1)=="?"){
				$appendix	= "?";
				$url		= substr_replace($url,"",-1,1);
			}
			if($number %2 != 0){
				$number++;
				$a			= $page - ($number/2);
				$b			= 0;
				$sheet	= array();
			}
			while($b<=$number){
				if($a>0&&$a<=$max_page){
					$sheet[]=$a;
					$b++;
				}elseif($a>$max_page&&($a-$number-2)>=0){ 
					$sheet	=	array();
					$a		-=	($number+2);
					$b		=	0;
				}elseif($a>$max_page&&($a-$number-2)<0){
					break;
				}
				$a++;
			}
			$return = "";
			if(!in_array(1,$sheet) && count($sheet) > 1){
				if(!in_array(2,$sheet)){
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=1\"><img src=\"left.png\" alt=\"\"></a></li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=1\">1</a></li>";
				}
			}
			foreach($sheet as $sheets){
				if($sheets==$page){
					$return	.=	"<li class=\"page-item\">$sheets</li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$sheets\">$sheets</a></li>";
				}
			}
			if(!in_array($max_page,$sheet)&&count($sheet)>1){
				if(!in_array(($max_page-1),$sheet)){
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$max_page\"><img src=\"next.png\" alt=\"\"></a></li>";
				}else{
					$return	.=	"<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}{$appendix}{$get_name}=$max_page\">$max_page</a></li>";
				}
			}
			if(empty($return)){
				return "<li class=\"page-item\">1</li>";
			}else{
				return $return;
			}
		}
		function Props(){
			echo '<b>User Class => Display Properties:</b>';
			echo '<pre>';
				print_r(get_object_vars($this));
			echo '</pre>';
		}
	}
?>