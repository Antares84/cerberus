<?php
	# Access Security
	if($cfg["ACP_SECURE"] != 1){
		die('You have entered a restricted area.<br />
			 Direct access is not allowed.<br />
			 Area: Cfg - Init'
		);
	}

	# Fetch Real Access IP From Incoming Connection
	function getRealIpAddr() {
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}else{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	$_SERVER['REMOTE_ADDR'] = getRealIpAddr();

	# Database Connection
	include('assets/config/cfg.db.php');

	# Database Connection String | DO NOT EDIT
	$cxn1 = @odbc_connect('Driver={SQL Server};Server='.$cfg["dbHost1"].';',$cfg["dbUser1"],$cfg["dbPass1"]) or 
	die('
		Database <b>0x01</b> Connection Error!<br />
		Website will be back online momentarily.'
	);
	$cxn2 = @odbc_connect('Driver={SQL Server};Server='.$cfg["dbHost2"].';',$cfg["dbUser2"],$cfg["dbPass2"]) or 
	die('
		Database <b>0x02</b> Connection Error!<br />
		Website will be back online momentarily.'
	);

#	$cxn1 = new dbConn(, DB_USERNAME, DB_PASSWORD, DATABASE, TABLE);

	# Include CMS Functions
	foreach(glob($cfg["ACP_Func"].'*.'.$phpEx) as $FuncFile){require_once $FuncFile;}

	# Include CMS Classes
	foreach(glob($cfg["ACP_Class"].'*.'.$phpEx) as $ClassFile){require_once $ClassFile;}
	$ChkUser = new user_fn;
#	$stats = new stats;
?>