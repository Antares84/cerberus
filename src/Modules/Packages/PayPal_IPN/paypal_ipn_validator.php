<?php
	# This file is to validate R/W ability of IPN as well as make sure that it's pulling relevant data from
	# the databases. It is strongly advised that you do not change any of the settings here, or you risk
	# damaging your IPN script and making it a lot harder to set it up properly.

	# IPN Simulator URI
	# https://developer.paypal.com/developer/ipnSimulator/?mark=IPN

	# IPN URI
	# http://omni.ndf-innovations.net/assets/plugins/PayPal_IPN/paypal_ipn_responder.php

	# IPN URI ADVANCED
	# http://omni.ndf-innovations.net/assets/plugins/PayPal_IPN/listener_adv.php

	# STRIP .PHP EXT
	$phpEx = substr(strrchr(__FILE__,'.'),1);

	# INIT AUTOLOADER
	require_once("../classes/class.php-config.".$phpEx);
	require('autoloader.php');
	$DatabaseObj	=	new Database();
	$DataObj		=	new Data();
	$ColorsObj		=	new Colors($DataObj,$DatabaseObj);
	$PayPalObj		=	new PayPal($DatabaseObj);
	$SettingObj		=	new Setting($DatabaseObj);
	$ReadObj		=	new Readable($DatabaseObj,$PayPalObj);

	if($PayPalObj->IPN_DEBUG() === true){
		if($ReadObj->get_readable_gateway() === false){
			echo '<font style="'.$ColorsObj->get_COLOR("RED","10").'font-weight:bold;">'.$ReadObj->GW_STATUS.'</font><br>';
		}
		if($ReadObj->get_readable_ipn() === false){
			echo '<font style="'.$ColorsObj->get_COLOR("RED","10").'font-weight:bold;">'.$ReadObj->IPN_STATUS.'</font><br>';
		}else{
			$reward_id	=	1;
			echo 'Reward ID: '.$reward_id.'<br>';

			$user_id	=	5;
			echo 'UserID: '.$user_id.'<br>';

			echo "Donation Amount = ".$PayPalObj->fetch_price($reward_id)."<br>";
			echo "Reward Amount = ".$PayPalObj->fetch_reward($reward_id)."<br>";
			echo "Donator UserID = ".$PayPalObj->fetch_user_id($user_id)."<br>";
			echo "Current Points of ".$PayPalObj->fetch_user_id($user_id)." = ".$PayPalObj->fetch_user_points($user_id)."<br><br>";

			echo "IPN Logfile Loc: ".$PayPalObj->IPN_LOGFILE()."<br>";
			echo "Gateway Logfile Loc: ".$PayPalObj->GW_LOGFILE()."<br>";
		}
	}else{
		require_once('paypal_ipn_responder.'.$phpEx);
	}
?>