<?php
	# STRIP .PHP EXT
	$phpEx = substr(strrchr(__FILE__,'.'),1);

	# INIT AUTOLOADER
	require_once("../../classes/PHP-Config.class.".$phpEx);
	require('autoloader.php');
	$DatabaseObj	=	new Database();
	$DataObj		=	new Data();
	$ColorsObj		=	new Colors($DataObj,$DatabaseObj);
	$PayPalObj		=	new PayPal($DatabaseObj);
	$SettingObj		=	new Setting($DatabaseObj);
	$ReadObj		=	new Readable($DatabaseObj,$PayPalObj);
	$PaypalIPN		=	new Paypal();

	// Use the sandbox endpoint during testing.
	$PaypalIPN->useSandbox();
	$verified = $PaypalIPN->verifyIPN();
	if($verified){
		# Process IPN
		# A list of variables is available here:
		# https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
		
	}

	// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
	header("HTTP/1.1 200 OK");
?>