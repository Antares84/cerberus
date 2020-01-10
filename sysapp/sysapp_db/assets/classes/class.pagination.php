<?php
	# Site Security
	if(!defined('SQL_Secure')){die('You have entered a restricted Area. Direct access is not allowed.');}

	# Paging & CMS Path Configuration
	$SQL_Root			= "./";

	# CMS Initialization dir
	$SQL_Init		= $SQL_Root."assets/init/";

	# CMS Paging System Symlink
	$SQL_Pages		= $SQL_Init."pages.conf.php";

	# CMS Content Pages Symlink | Tells the CMS where your content pages are located.
	$SQL_Content	= $SQL_Root."assets/content/pages/";

	# CMS Admin Panel Symlink | Links to the Admin Panel content directory
	$SQL_Admin		= $SQL_Content."web.acp/";

	# CMS Registration Symlink 
	$SQL_Reg		= $SQL_Content."register/";

	# CMS Live Support symlink
	$SQL_LiveChat	= $SQL_Content.'live_support/';

	# CMS JavaScript | jQuery Symlink
	$SQL_JS			= $SQL_Root."assets/jQuery/";

	# Pages Config
	require($SQL_Pages);
?>