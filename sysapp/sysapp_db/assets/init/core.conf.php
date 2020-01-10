	<?php
	# Site Security
		if(!defined('SQL_Secure')){die('You have entered a restricted Area. Direct access is not allowed.');}

	# Main Config
		# CMS Title | Can use your server name here as well
			$ServerName		= 'NDF SQL Repo';
		# CMS Server E-Mail Address
			$ServerEmail	= 'nexusdevelopment2013@gmail.com';
		# Footer Info
			$SiteFooter = '&copy 2010-2016 Nexus Development Foundation. All Rights Reserved.';

	# CMS Core Constants
		$SQL_Style = $SQL_Root.'assets/template/tpl.';
		$SQL_Classes = $SQL_Root.'assets/classes/class.';
#		$SQL_Modules = $SQL_Root.'assets/modules/mod.';
	
	# CMS Modules | Choose which module(s) you would like to use in your CMS. Values are 0 | 1
#		$Mod_Login = 1;
#		$Mod_Register = 0;
#		$Mod_ResetPW = 0;
#		$Mod_ServerStatus = 1;
#		$Mod_ServerTime = 1;
#		$Mod_Sponsors = 1;
		
	# CMS Setup | Set to "true" once you have installed the CMS
#		$SQL_Installed=true;

	# Include CMS Functions
#		require $SQL_Root.'assets/init/functions.php';

	# Add CMS Classes
#		require($SQL_Classes.'dbConn.'.$phpEx);
#		require($SQL_Classes.'downloads.'.$phpEx);
#		require($SQL_Classes.'email.'.$phpEx);
#		require($SQL_Classes.'errorrep.'.$phpEx);
		require($SQL_Classes.'pagination.'.$phpEx);
#		require($SQL_Classes.'ports.'.$phpEx);
#		require($SQL_Classes.'theme.'.$phpEx);
#		require($SQL_Classes.'version.'.$phpEx);
#		require($SQL_Classes.'voting.'.$phpEx);
?>