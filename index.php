<?php
	define('IN_CMS',true);

	$cms_root_path=(defined('CMS_ROOT_PATH'))?CMS_ROOT_PATH:'./';
	$phpEx=substr(strrchr(__FILE__,'.'),1);

	# Autoload Classes
	require_once('src/autoloader.'.$phpEx);

	# Initialize php.ini modifications
	$PHP		=	new Classes\Utils\PHP();

	# Load Arrays
	$Arrays		=	new Classes\Base\Arrays;
	# Load Directories List
	$Dirs		=	new Classes\Base\Dirs($Arrays);
	$DirLister	=	new Classes\Utils\DirectoryLister($Arrays);
	# Load Core Dependencies
	$Browser	=	new Classes\Utils\Browser;
	$DateTime	=	new Classes\Utils\DTime;
	$MSSQL		=	new Classes\DB\MSSQL;
#	$MySQL		=	new Classes\DB\MySQL;
	$Parser		=	new Classes\Utils\Parser;
	$Select		=	new Classes\Display\Select;
	$Tbl		=	new Classes\Display\Table;
	# Load DB Dependencies
	$Colors		=	new Classes\Utils\Colors($MSSQL);
	$Stats		=	new Classes\Utils\Stats($MSSQL);
	$Wow		=	new Classes\Settings\Wow($MSSQL);
	# Load Mass Dependencies
	$Data		=	new Classes\Utils\Data($DirLister);
	$Visitors	=	new Classes\Utils\Visitors($Browser);
	$Notices	=	new Classes\Utils\Notices($Data,$MSSQL,$Dirs);
	$Social		=	new Classes\Utils\Social($Arrays,$MSSQL);
	$Setting	=	new Classes\Settings\Settings($Arrays,$MSSQL);
	$Security	=	new Classes\Security\Security($Setting);
	$Theme		=	new Classes\Settings\Theme($Arrays,$MSSQL,$Dirs);
	$Cards		=	new Classes\Display\Cards($Data,$Setting);
	$Tooltips	=	new Classes\Utils\Tooltips($Colors);
	$Style		=	new Classes\Settings\Style($Arrays,$MSSQL,$Dirs,$Theme);
	$XML		=	new Classes\Utils\XML($Data,$Setting,$Tbl);
	$LogSys		=	new Classes\Sys\LogSys($Data,$MSSQL,$Setting);
	$Paging		=	new Classes\Utils\Paging($Arrays,$MSSQL,$Dirs,$Setting);
	$Modal		=	new Classes\Utils\Modal($Colors,$Dirs,$Paging,$Setting,$Style);
	$User		=	new Classes\Utils\User($Browser,$MSSQL,$Setting);
	$Messenger	=	new Classes\Utils\Messenger($Browser);
	$Tpl		=	new Classes\Utils\Template($Colors,$Messenger,$Select,$Style,$Theme,$Tooltips);
	$SQL		=	new Classes\DB\SQL($Arrays,$Colors,$Data,$MSSQL,$Setting,$Tpl,$User);
	$Session	=	new Classes\Utils\Session2($Data,$Browser,$MSSQL,$Setting,$SQL,$User);
	$MailSys	=	new Classes\Sys\MailSys($MSSQL,$Setting,$User);
	$FileSys	=	new Classes\Sys\FileSys($MSSQL,$Dirs,$Tpl);
	$Modules	=	new Classes\Modules\Modules($Data,$Dirs,$Modal,$MSSQL,$Setting,$Tpl);
	$CRC		=	new Classes\Utils\CRC($Dirs,$LogSys,$MSSQL,$Tpl);
	$Version	=	new Classes\Utils\Version($MSSQL,$XML);
	# Load BDSM Dependencies | Available with the BDSM package
	if($Setting->_arr["SITE_TYPE"] == 1){
		$Journal	=	new Classes\BDSM\Journal($Data,$MSSQL,$Tpl,$User);
	}
	else{
		$Journal	=	'';
	}
	# Load Shaiya Dependencies | Only available if you have the Shaiya package
	if($Setting->_arr["SITE_TYPE"] == 3){
		$BossRecord	=	new Classes\Shaiya\BossRecord($MSSQL);
		$Donate		=	new Classes\PayPal\Donate($MSSQL);
		$PayPal		=	new Classes\PayPal\PayPal($Arrays,$MSSQL,$Modules,$Setting);
		$PvP		=	new Classes\Shaiya\PvP;
		$ShChar		=	new Classes\Shaiya\ShaiyaChar($MSSQL,$Data,$Setting,$Tpl);
		$ShUser		=	new Classes\Shaiya\ShaiyaUser($MSSQL,$Data,$Parser);
	}
	else{
		$BossRecord	=	'';
		$Donate		=	'';
		$PayPal		=	'';
		$PvP		=	'';
		$ShChar		=	'';
		$ShUser		=	'';
	}

	$Debug		=	new Classes\Base\Debug($Browser,$DateTime,$Dirs,$MSSQL,$Paging,$Session,$Setting,$Style,$Theme,$Tpl,$User,$Version);
	# Display
	$Display	=	new Classes\Display\Display($CRC,$Dirs,$Modal,$Modules,$MSSQL,$Paging,$Setting,$SQL,$Stats,$Style,$Theme,$Tpl,$User);

	require_once('src/debug.'.$phpEx);

	# Launch display
	$Display->_load();
?>