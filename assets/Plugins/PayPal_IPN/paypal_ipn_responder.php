<?php
	# Initialize Autoloader
	require('autoloader.php');
	$DatabaseObj	=	new Database();
	$LangObj		=	new Lang($DatabaseObj);
	$PayPalObj		=	new PayPal($DatabaseObj);
	$SettingObj		=	new Setting($DatabaseObj);

	if($PayPalObj->IPN_DEBUG() === true){
	#	$this->LogSys->do_PAYPAL('0x01','Debugging Enabled.')
		error_log(date('[Y-m-d H:i]')." > Code 0x01 > DEBUGGING ENABLED".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
	}
	if($PayPalObj->IPN_DEBUG() === true){
		error_log(date('[Y-m-d H:i]')." > Code 0x02 > IPN Core Location: ".$PayPalObj->GW_LOGFILE()."".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
	}

	# Read POST data
	$raw_post_data		=	file_get_contents('php://input');
	$raw_post_array		=	explode('&', $raw_post_data);
	$myPost				=	array();
	foreach($raw_post_array as $keyval){
		$keyval = explode('=',$keyval);
		if(count($keyval) == 2){
			$myPost[$keyval[0]] = urldecode($keyval[1]);
		}
	}

	# Read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	if(function_exists('get_magic_quotes_gpc')){
		$get_magic_quotes_exists = true;
	}
	foreach($myPost as $key=>$value){
		if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1){
			$value = urlencode(stripslashes($value));
		}
		else{$value = urlencode($value);}
		$req .= "&$key=$value";
	}

	# Post IPN data back to PayPal to validate the IPN data is genuine.
	# Without this step, anyone can fake IPN data.
	if($PayPalObj->use_SANDBOX() === true){
		$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	}else{
		$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
	}

	$ch = curl_init($paypal_url);
	if($ch == FALSE){
		return FALSE;
	}
	curl_setopt($ch,CURLOPT_POST,			true);
	curl_setopt($ch,CURLOPT_POSTFIELDS,		$req);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,	1);
	curl_setopt($ch,CURLOPT_TIMEOUT,		15);
	curl_setopt($ch,CURLOPT_PORT,			443);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,	true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,	false);

	if($PayPalObj->IPN_DEBUG() === true){
		curl_setopt($ch,CURLOPT_HEADER,1);
		curl_setopt($ch,CURLINFO_HEADER_OUT,1);
	}
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,30);
	curl_setopt($ch,CURLOPT_HTTPHEADER,array('Connection: Close'));
	$res = curl_exec($ch);

	# cURL error
	if(curl_errno($ch) != 0){
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i] '). "Can't connect to PayPal to validate IPN message: ".curl_error($ch).PHP_EOL,3,$PayPalObj->IPN_LOGFILE());
		}
		curl_close($ch);
		exit;
	}else{
		# Log the entire HTTP response if debug is switched on.
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i] ')."HTTP request of validation request:".curl_getinfo($ch,CURLINFO_HEADER_OUT)." for IPN payload: $req".PHP_EOL,3, $PayPalObj->IPN_LOGFILE());
			error_log(date('[Y-m-d H:i] ')."HTTP response of validation request: $res".PHP_EOL,3,$PayPalObj->IPN_LOGFILE());
		}
		curl_close($ch);
	}
	# Inspect IPN validation result and act accordingly
	# Split response headers and payload, a better way for strcmp
	$tokens	=	explode("\r\n\r\n",trim($res));
	$res	=	trim(end($tokens));
	if(strcmp($res,"VERIFIED") == 0){
		$payment_status = $_POST['payment_status'];
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i]')." > Code 0x03 > Payment status selected, posted as: $payment_status".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
		}
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i]')." > Code 0x04 > Payment received from $payer_email, delivered to $receiver_email".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
		}

		list($reward_id,$user_id) = explode("_",$_POST['item_number']);
		$mc_gross = $_POST['mc_gross'];
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i]')." > Code 0x05 > Amount: $mc_gross".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
		}
		$txn_id = $_POST['txn_id'];
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i]')." > Code 0x06 > TransID: $txn_id".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
		}

#		verifyTxnId($txn_id,$cxn);

		$getxn_id	=	$PayPalObj->fetch_verify_Txn_Id($txn_id);
		$pp_email	=	$SettingObj->get_PAYPAL_RECEIVER();
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i]')." > Code 0x12 > Gateway e-mail selected as: ".$cfg["PAYPAL_RECEIVER"]."".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
		}
	
	#	Check if Payment status is Completed
		if($payment_status == "Completed"){
			$PayPal_Price		=	$PayPalObj->fetch_price($reward_id);
			$PayPal_Reward		=	$PayPalObj->fetch_reward($reward_id);
			$PayPal_UserID		=	$PayPalObj->fetch_user_id($user_id);
			$PayPal_UserPoint	=	$PayPalObj->fetch_user_points($user_id);
			
			if($receiver_email == $pp_email && $mc_gross == $PayPal_Price && $getxn_id == false) {
				$sql	=	("INSERT INTO ".$DatabaseObj->get_TABLE("ACP_PAYMENTS")."
								(Paid,Reward,UserID,Email,tid)
							VALUES
								(?,?,?,?,?)"
							);
				$stmt	= odbc_prepare($DatabaseObj->conn,$sql);
				$args	= array($PayPal_Price,$PayPal_Reward,$PayPal_UserID,$_POST['payer_email'],$txn_id);
				$exec	= odbc_execute($stmt,$args);
				if($PayPalObj->IPN_DEBUG() === true){
					error_log(date('[Y-m-d H:i]')." > Code 0x13 > Data inserted into Payments records.".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
				}

				$addPoints		= $PayPal_UserPoint + $PayPal_Reward;
				$insertPoints	= ("UPDATE ".$DatabaseObj->get_TABLE("SH_USERDATA")." SET Point=? WHERE UserUID=?");
				$stmt			= odbc_prepare($cxn,$insertPoints);
				$args			= array($addPoints,$user_id);
				$exec			= odbc_execute($stmt,$args);
				if($PayPalObj->IPN_DEBUG() === true){
					error_log(date('[Y-m-d H:i]')." > Code 0x14 > User donation points updated, posted as: $exec".PHP_EOL,3,$PayPalObj->GW_LOGFILE());
				}
			}
		}
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i]'). " > Code 0x15 > Verified E-Mail: ".$pp_email."". PHP_EOL, 3, $PayPalObj->GW_LOGFILE());
			error_log(date('[Y-m-d H:i]'). " > Code 0x16 > Verified Price: ".$mc_gross."". PHP_EOL, 3, $PayPalObj->GW_LOGFILE());
			error_log(date('[Y-m-d H:i]'). " > Code 0x17 > Verified TransID: ".$txn_id."\r\n". PHP_EOL, 3, $PayPalObj->GW_LOGFILE());
		}
	}elseif(strcmp($res,"INVALID") == 0){
		if($PayPalObj->IPN_DEBUG() === true){
			error_log(date('[Y-m-d H:i] '). "Invalid IPN: $req" . PHP_EOL, 3, $PayPalObj->IPN_LOGFILE());
		}
	}
?>