<?php
	session_start();
	ob_start();
	define("DOC_ROOT","./");

	require_once(DOC_ROOT."assets/classes/Autoloader.class.php");

	# Core Dependencies
	$PHP		=	new PHP();
	$Parser		=	new Parser();
	$db			=	new Database();
	$Browser	=	new Browser();
	$Dirs		=	new Dirs();
	$PvP		=	new PvP();
	$Select		=	new Select();

	# DB Dependencies
	$BossRecord	=	new BossRecord($db);
	$Data		=	new Data($db);
	$Colors		=	new Colors($db);
	$LogSys		=	new LogSys($db);
	$Notices	=	new Notices($db);
	$Read		=	new Readable($db);
	$Social		=	new Social($db);
	$Stats		=	new Stats($db);
	$Theme		=	new Theme($db);
	$Wow		=	new Wow($db);

	# Mass Dependencies
	$Donate		=	new Donate($db);
	$Style		=	new Style($db,$Theme);
	$Template	=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Template);
	$Paging		=	new Paging($db,$Setting);
	$Modal		=	new Modal($Colors,$Paging,$Style);
	$User		=	new User($Browser,$Data,$db,$Setting);
	$MailSys	=	new MailSys($db,$Setting,$User);
	$Messenger	=	new Messenger($Browser,$Setting,$User);
	$Nav		=	new Nav($db,$Setting,$Stats,$Theme,$Template,$User);
	$Session	=	new Session($db,$Browser,$Setting,$User);
	$SQL		=	new SQL($Data,$db,$Setting,$Template,$User);
	$Tbl		=	new Table($SQL,$Template);
	$Plugins	=	new Plugins($db,$Dirs,$Modal,$SQL,$Style,$Template);
	$PayPal		=	new PayPal($db,$Plugins,$Setting);
	$Version	=	new Version($db,$Data,$Setting);

	# Shaiya Dependencies
	$ShChar		=	new ShaiyaChar($db,$Data,$Setting,$Template);
	$ShUser		=	new ShaiyaUser($db,$Data,$Parser);

	$Content	=	new Content(
								$BossRecord,
								$Browser,
								$Colors,
								$Data,
								$db,
								$Dirs,
								$Donate,
								$LogSys,
								$MailSys,
								$Messenger,
								$Modal,
								$Nav,
								$Notices,
								$Paging,
								$PayPal,
								$PHP,
								$Plugins,
								$PvP,
								$Read,
								$Select,
								$Session,
								$Setting,
								$ShChar,
								$ShUser,
								$SQL,
								$Style,
								$Tbl,
								$Template,
								$Theme,
								$User,
								$Version,
								$Wow
	);

	# Display
	$Display	=	new Display(
								$Content,
								$Data,
								$db,
								$Messenger,
								$Nav,
								$Paging,
								$Setting,
								$Stats,
								$Style,
								$Tbl,
								$Template,
								$Theme,
								$User,
								$Version
	);

	$Paging->LaunchPageLoader();
	$Display->LaunchDisplay();
#	$Theme->Props();
#	$Style->Props();
#	$Setting->Props();
#	$Messenger->Props();
?>