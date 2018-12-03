<?php
	class LogSys{
		function __construct($DatabaseObj){
			$this->db	=	$DatabaseObj;
		}
		function createLog($Action){
			$sql	=	("INSERT INTO ".$this->db->get_TABLE("LOG_ACCESS")."
							(UserID,UserIP,Action)
						VALUES
							(?,?,?)
						");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($_SESSION["UserID"],$_SERVER['REMOTE_ADDR'],$Action);
			odbc_execute($stmt,$args);

			#return 'Action logged at '.time();
		}
		function do_PAYPAL($t1,$t2){
			$sql	=	("INSERT INTO ".$this->db->get_TABLE("LOG_DONATE")."
							(CODE,MSG)
						VALUES
							(?,?)
						");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($t1,$t2);
			odbc_execute($stmt,$args);

			odbc_free_result($stmt);
			odbc_close($this->conn);
		}
	}