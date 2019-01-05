<?php
	# Initialize Session
	session_start();ob_start();
	# Set Home
	define("DOC_ROOT","./");require_once(DOC_ROOT."assets/classes/Autoloader.class.php");
	# Load Core Dependencies
	$db=new Database();
	$Browser=new Browser();
	$Dirs=new Dirs();
	$Parser=new Parser();
	$PHP=new PHP();
	$PvP=new PvP();
	$Select=new Select();
	$Tbl=new Table();
	# Load DB Dependencies
	$BossRecord=new BossRecord($db);$Data=new Data($db);$Donate=new Donate($db);$Colors=new Colors($db);$Notices=new Notices($db);$Read=new Readable($db);$Social=new Social($db);$Stats=new Stats($db);$Theme=new Theme($db);$Wow=new Wow($db);
	# Load Mass Dependencies
	
	$Style=new Style($db,$Theme);
	$Setting=new Setting($Data,$db);
	$XML=new XML($Data,$Setting,$Tbl);
	$LogSys=new LogSys($Data,$db,$Setting);
	$Paging=new Paging($db,$Setting);
	$Modal=new Modal($Colors,$Paging,$Setting,$Style);
	$User=new User($Browser,$Data,$db,$Setting);
	$MailSys=new MailSys($db,$Setting,$User);
	$Messenger=new Messenger($Browser);
	$Template=new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Nav=new Nav($db,$Setting,$Stats,$Theme,$Template,$User);
	$Session=new Session($db,$Browser,$Setting,$User);
	$SQL=new SQL($Data,$db,$Setting,$Template);
	$Plugins=new Plugins($db,$Dirs,$Modal,$SQL,$Style,$Template);
	$PayPal=new PayPal($db,$Plugins,$Setting);
	$Version=new Version($db,$Data,$XML);
	# Load Shaiya Dependencies
	$ShChar=new ShaiyaChar($db,$Data,$Setting,$Template);$ShUser=new ShaiyaUser($db,$Data,$Parser);
	# Load Content
	$Content=new Content($BossRecord,$Browser,$Colors,$Data,$db,$Dirs,$Donate,$LogSys,$MailSys,$Messenger,$Modal,$Nav,$Notices,$Paging,$PayPal,$PHP,$Plugins,$PvP,$Read,$Select,$Session,$Setting,$ShChar,$ShUser,$SQL,$Style,$Tbl,$Template,$Theme,$User,$Version,$Wow,$XML);
	# Display
	$Display=new Display($Content,$Data,$db,$Messenger,$Modal,$Nav,$Paging,$Setting,$Stats,$Style,$Tbl,$Template,$Theme,$User,$Version);
	# Load the display
	$Paging->_do_LAUNCH_PAGE();
	$Display->_do_LAUNCH_DISPLAY();
#	$Setting->Props();
#	$Session->Props();
#	$Paging->Props();
#	$Style->Props();
#	$Theme->Props();
#	$Data->_get_class_methods();
#	$LogSys->_get_class_methods();
#	$Version->Props();
?>