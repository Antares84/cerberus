<?php
	namespace classes\Utils;

	class Stats{
		public function __construct($MSSQL){
			$this->MSSQL	=	$MSSQL;
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		private function _get_IP($data){
			switch($data){
				case 0	:	return '::1';			break;
				case 1	:	return '192.168.20.50';	break;
			}
		}
		private function _get_Port($data){
			switch($data){
				case 'game'		: return '30810';	break;
				case 'login'	: return '30800';	break;
			}
		}
		function _get_Total_Users(){
			$sql	=	('
							SELECT *
							'.$this->MSSQL->_table_list('SH_USERDATA').'
							WHERE Status >= ?
			');
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array(0);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				return odbc_num_rows($stmt);
				odbc_free_result($stmt);
				odbc_close($this->conn);
			}
		}
		function _get_Total_Users_Online(){
			$ret	=	false;

			$fp = @fsockopen($this->getIP(1),$this->getPort('login'),$errno,$errstr,1);

			if(!$fp){
				$ret	=	0;
				return $ret;
			}else{
				$sql	=	('
								SELECT *
								FROM '.$this->MSSQL->_table_list('SH_CHARDATA').'
								WHERE [LoginStatus]=?
				');
				$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
				$args	=	array(1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					return odbc_num_rows($stmt);
					odbc_free_result($stmt);
					odbc_close($this->conn);
				}
			}
		}
		# Shows Login Server status
		function _get_Login_Status(){
			$IP		=	'192.168.20.50';
			$Port	=	'30800';

			$ret = false;

			$fp = @fsockopen($IP,$Port,$errno,$errstr,1);

			if(!$fp){
				$ret = '<span class="badge badge-pill badge-danger text-white">Offline</span>';
			}else{
				$ret = '<span class="badge badge-pill badge-success text-white">Online</span>';
			}

			return $ret;
		}
		# Shows Game Server status
		function GameStatus(){
			$ret = false;

			if($fp = @fsockopen($this->getIP(1),$this->getPort('game'),$errno,$errstr,1)){
				$ret	=	'<span class="badge badge-pill badge-success text-white">Online</span>';
				fclose($fp);
			}else{
				$ret	=	'<span class="badge badge-pill badge-danger text-white">Offline</span>';
			}

			return $ret;
		}
		# Shows local webserver status - not used in production
		function _get_Web_Status(){
			$IP		=	'192.168.20.50';
			$Port	=	'80';

			$ret = false;

			$fp = @fsockopen($IP,$Port,$errno,$errstr,1);

			if(!$fp){
				$ret	=	'<font style="color:red;">Offline</font>';
			}else{
				$ret	=	'<font style="color:lime;">Online</font>';
			}

			return $ret;
		}
		# Shows web status for PayPal
		function _get_PayPal_Status(){
			$IP		=	'66.211.169.3';
			$Port	=	'443';

			$ret = false;

			$fp = @fsockopen($IP,$Port,$errno,$errstr,1);

			if(!$fp){
				$ret = '<span class="badge badge-pill badge-danger text-white">Offline</span>';
			}else{
				$ret	= '<span class="badge badge-pill badge-success text-white">Online</span>';
			}

			return $ret;
		}
	}
?>