<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('SESSION: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title: Session2.php																		#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS session class, used for loading all session resources							#
	#	Last Update Date: 09.29.2019	1147													#
	#############################################################################################

	class Session2{

		# Debugging
		public $_arr;public $_tmp;
		private $debug=true;private $report=true;

		# Session
		public $sess_id		=	"";
		public $write_data	=	"";

		private $action;
		private $pageview	=	"0";
		private $crypto		=	"sha512";
		private $login		=	false;
		private $name;
		private $session_key;

		# User
		private $UserUID;
		private $UserID;
		private $Auth;

		# Public Methods
		public function __construct($Data,$Browser,$MSSQL,$Setting,$SQL,$User){
			$this->Data		=	$Data;
			$this->Browser	=	$Browser;
			$this->MSSQL	=	$MSSQL;
			$this->Setting	=	$Setting;
			$this->SQL		=	$SQL;
			$this->User		=	$User;

			$this->_debug(true,__FUNCTION__,'Session class initialised',false,true);
			$this->_init();
		}
		public function _class_info($level=false){
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
				default	:	return $this->_init();			break;
			}
		}
		public function _init(){
		#	$this->name=$this->Data->_do('rand_str');
		#	session_name($this->name);
			session_name("CMS");

			$this->_debug(false,__FUNCTION__,'Set session name ('.session_name().')',false,true);

			session_set_save_handler(
				array(&$this,'_open'),
				array(&$this,'_close'),
				array(&$this,'_read'),
				array(&$this,'_write'),
				array(&$this,'_destroy'),
				array(&$this,'_clean')
			);

			session_start();
			setcookie(session_name(), session_id(), NULL, NULL, NULL, 0);
			$this->_debug(false,__FUNCTION__,'Session started, Session ID: ('.session_id().')',false,true);

			$this->_debug(false,__FUNCTION__,'SessionID: ('.session_id().')',false,true);

			$this->_counter();
#			$this->_login();
			$this->_set_sid();
		}
		public function _open($path,$name){
			$this->_debug(false,__FUNCTION__,'Path: '.$path,false,true);
			$this->_debug(false,__FUNCTION__,'Name: '.$name,false,true);
			$this->_debug(false,__FUNCTION__,'SessionID: ('.session_id().')',false,true);

			return true;
		}
		public function _read($sid){
			$this->_debug(false,__FUNCTION__,'Entered read mode...',false,true);
			$this->_debug(false,__FUNCTION__,'Data: '.$sid,false,true);

			$CurrentTime = time();

			$res = odbc_exec($this->MSSQL->conn,"SELECT Data FROM ".$this->MSSQL->_table_list("LOG_SESSION")." WHERE SessionID='$sid' AND Active=1");

			if(!odbc_num_rows($res)){
				odbc_exec($this->MSSQL->conn,"INSERT INTO ".$this->MSSQL->_table_list("LOG_SESSION")." (LogType,SessionID,UpdateDate) VALUES ('Session','$sid', $CurrentTime)");
				$this->_debug(false,__FUNCTION__,'Attempted to read SID from db, SID not found. SID: '.$sid,false,true);

				return '';
			}
			else{
				extract(odbc_fetch_array($res),EXTR_PREFIX_ALL,'sess');
				odbc_exec($this->MSSQL->conn, "UPDATE ".$this->MSSQL->_table_list("LOG_SESSION")." SET UpdateDate = $CurrentTime WHERE SessionID = '$sid';");
				$this->_debug(false,__FUNCTION__,'Read sid from db...',false,true);

				return $sess_Data;
			}
		}
		public function _write($sid,$data){
			$this->_debug(false,__FUNCTION__,'Entered write mode...',false,true);
			$this->_debug(false,__FUNCTION__,'SessionID: ('.$sid.')',false,true);
			$this->_debug(false,__FUNCTION__,'$Data: ('.$data.')',false,true);

			$CurrentTime = time();

			if(!empty($data)){$data=$data;}
			else{$data="";}
			$this->write_data	=	$data;


			odbc_exec($this->MSSQL->conn,"UPDATE ".$this->MSSQL->_table_list("LOG_SESSION")." SET Data='$data' WHERE SessionID='$sid'");

			return true;
		}
		public function _close(){
			$this->_debug(false,__FUNCTION__,'Closed db connection',false,true);

			$_SESSION["CMS"]["Name"]=$this->name;
			$this->_debug(false,__FUNCTION__,false,true,false);

			return $this->MSSQL->_close_conn();
		}
		public function _destroy($sid){
/*
			$q = "DELETE FROM `sessions` WHERE `id` = '".$this->MSSQLc->real_escape_string($sid)."'"; 
			$this->MSSQLc->query($q);

			$_SESSION = array();

			$this->debug(false,__FUNCTION__,'Deleted data from db (_destroy)',false,true);

			return $this->MSSQLc->affected_rows;
*/
		}
		public function _clean($expire){
			$this->debug(false,__FUNCTION__,'Deleted data from db (_clean)',false,true);
		}
		public function _delete(){
			if(ini_get('session.use_cookies')){
				$params=session_get_cookie_params();
				setcookie(session_name(),'',time()-42000,$params['path'],$params['domain'],$params['secure'],$params['httponly']);
			}

			session_destroy();

			$this->alive = false;
			$this->_debug(false,__FUNCTION__,'Session destroyed',false,true);
		}
		public function _action($action=false){
			if($action){
				$this->action	=	 $action;
			}

			/*
			$sql	=	("	
							UPDATE ".$this->MSSQL->_table_list("LOG_SESSION")."
							SET Action=?
							WHERE SID=?
			");
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array($_SESSION["Action"],$this->sess_id);
			odbc_execute($stmt,$args);
			*/

			$this->_debug(false,__FUNCTION__,'Updated action data for member/visitor to db',false,true);
		}
		public function _get_var($data){
			try{
				if($this->$data){
					return $this->$data;
				}
			}
			catch(exception $e){
				throw new \classes\Exception\SystemException('<b>Class ('.get_class($this).'):</b><br>The requested variable, <b>'.$data.'</b>, couldn\'t be found.',0,0,__FILE__,__LINE__);
			}
		#	exit;
		}
		private function _login(){
			if(isset($_SESSION)){
				if(!isset($_SESSION["login"])){
					$this->login=false;
				}
				else{
					$this->login=true;
					$_SESSION["login"]=$this->login;
				}
			}
		}
		public function _do_login($UserUID,$UserID,$Status,$AdminLevel,$Email,$SID){

			$_SESSION["User"]["UserUID"]		=	$UserUID;
			$_SESSION["User"]["UserID"]			=	$UserID;
		#	$_SESSION["User"]["Status"]			=	$Status;
			$_SESSION["User"]["AdminLevel"]		=	$AdminLevel;
			$_SESSION["User"]["Email"]			=	$Email;
			$_SESSION["Browser"]["OS"]			=	$this->Browser->OS;
			$_SESSION["Browser"]["Browser"]		=	$this->Browser->Browser;
			$_SESSION["Browser"]["UA"]			=	$this->Browser->UA;
			$_SESSION["Browser"]["IP"]			=	$this->Browser->IP;
			$_SESSION["Browser"]["REQUEST_URI"]	=	$_SERVER["REQUEST_URI"];
			$_SESSION["Browser"]["CMS_SID"]		=	$this->_create($UserID);

			$this->login=true;
			$this->_write($SID,'Logged In - UserID/Pw Access for '.$UserID.' from '.$this->Browser->IP);
		}
		public function _do_logout($sid){
			odbc_exec($this->MSSQL->conn,"UPDATE ".$this->MSSQL->_table_list("LOG_SESSION")." SET Active=0 WHERE SessionID='$sid'");
			//remove PHPSESSID from browser
			if(isset($_COOKIE[session_name()])){
				setcookie(session_name(),"",time()-3600,"/");
			}
			//clear session from globals
			$_SESSION = array();
			//clear session from disk
			session_destroy();
			session_write_close();
		#	header("Location: ?".$this->Setting->_arr["PAGE_PREFIX"]."=HOME");
		}

		# Hashing
		private function _create($data){
			$this->session_key	=	hash($this->crypto,$_SERVER["REMOTE_ADDR"].$_SESSION["User"]["UserID"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);

			return $this->session_key;
		}
		private function _validate(){
			$CHECK	=	hash($this->crypto,$_SERVER["REMOTE_ADDR"].$_SESSION["User"]["UserID"].$_SERVER["COMPUTERNAME"],$_SERVER["HTTP_USER_AGENT"]);
			if($CHECK !== $this->session_key){
				session_destroy();
				header('location: ?'.$this->Setting->_arr["PAGE_PREFIX"].'=HOME');
				exit();
			}
			else{
				return true;
			}
		}

		# Misc
		private function _debug($init=false,$method=false,$action,$close=false,$report=false){
			if($init){
				if($this->_arr){$this->_arr=null;}
				$this->_tmp=array();
			}

			if($this->debug==true && $report == true){
				$this->_tmp[]	=	$method.': '.$action;
			}

			if($close){
				$this->_arr=$this->_tmp;
				unset($this->_tmp);
			}
		}
		private function _set_sid(){
			if(!isset($_SESSION["CMS"]['sid'])){
				$_SESSION["CMS"]['sid'] = session_id();
			}

			$this->_debug(false,__FUNCTION__,'Updated sid: '.$_SESSION["CMS"]['sid'],false,true);
			$this->_debug(false,__FUNCTION__,'Session write_data: '.$this->write_data,false,true);
		}
		private function _counter(){
			if(isset($_SESSION)){
				if(isset($_SESSION["CMS"]['Counter'])){
					$_SESSION["CMS"]['PageView']++;
					$this->pageview=$_SESSION["CMS"]['PageView']+1;
					$_SESSION["CMS"]['PageView'] = $this->pageview;
				}
				else{
					$this->pageview=1;
					$_SESSION["CMS"]['PageView'] = $this->pageview;
				}
			}

			$this->_debug(false,__FUNCTION__,'PageView set, current value: '.$this->pageview,false,true);
			$this->_debug(false,__FUNCTION__,'Updated PageView: '.$_SESSION["CMS"]['PageView'],false,true);

			return $_SESSION["CMS"]['PageView'];
		}
		public function _get($key1,$key2=false){
			if($key2==true){
				if(isset($_SESSION["key1"]["key2"])){
					return $_SESSION["key1"]["key2"];
				}
				else{
					if(isset($_SESSION["key1"])){
						return $_SESSION["key1"];
					}
				}
			}

			return false;
		}
		public function _set($key1,$key2=false,$value){
			if(empty($key2)){
				$_SESSION[$key1]=$value;
			}
			else{
				$_SESSION[$key1][$key2]=$value;
			}
		}
		private function _closeOtherSessions(){
			if(is_null($this->id)){
				return;
			}

			if(session_status()==PHP_SESSION_ACTIVE){
				/* Delete all account Sessions with session_id different from the current one */
				$query = 'DELETE FROM myschema.account_sessions WHERE (session_id != :sid) AND (account_id = :account_id)';

				/* Values array for PDO */
				$values = array(':sid' => session_id(), ':account_id' => $this->id);

				/* Execute the query */
				try{
					$res = $pdo->prepare($query);
					$res->execute($values);
				}
				catch (PDOException $e){
				/* If there is a PDO exception, throw a standard exception */
				throw new Exception('Database query error');
				}
			}
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
		
	}
?>