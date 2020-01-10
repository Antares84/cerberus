<?php 
	$mail = new PHPMailer(true);

	if($mail_for == 'register') {
		$Subject	=	'Registration Verification';
		$Body		=	'You, or someone using your e-mail address, has completed our registration.<br>';
		$Body		.=	'If you believe this to be in error, simply delete this e-mail and the account will stay inactive.<br><br>';
		$Body		.=	'Your UserID:					'.$UserID.'.<br>';
		$Body		.=	'Your Password:					'.$Password.'.<br>';
		$Body		.=	'Your Activation/Recovery Key:	'.$activationKey.'.<br>';
		$Body		.=	'Please save your Activation/Recovery Key in a safe place. If anything ever happens to your account, you will need this key when requesting assistance.<br><br>';
		$Body		.=	'To complete your registration and activate your account, click <a href="'.$this->Lang->get_LANG_URL().'/?'.$this->Setting->PAGE_PREFIX.'=verify&Key="'.$activationKey.'"> here.</a><br>';
		$Body		.=	'If you can\'t click the above link, simply copy and paste the following link into your address bar.<br>';
		$Body		.=	$this->Lang->get_LANG_URL().'/?'.$this->Setting->PAGE_PREFIX.'=verify&Key='.$activationKey.'<br><br>';
		$Body		.=	'Please do not reply to this e-mail as it is not monitored.<br>';
		$Body		.=	'Regards,\ Site Staff';
		$Body = preg_replace('/\\\\/','',$Body); //Strip backslashes
	}
	else if($mail_for == "resend") {
		$Subject	=	'Registration Verification - Resend';
		$Body		=	'You, or someone using your e-mail address, has completed our registration.<br>';
		$Body		.=	'If you believe this to be in error, simply delete this e-mail and the account will stay inactive.<br><br>';
		$Body		.=	'UserID: '.$UserID.'.<br>';
		$Body		.=	'Password: '.$Password.'.<br>';
		$Body		.=	'Security Key: '.$activationKey.'.<br><br>';
		$Body		.=	'<b>Please save your Activation/Recovery Key in a safe place. If anything ever happens to your account, you will need this key when requesting assistance.</b><br><br>';
		$Body		.=	'To complete your registration and activate your account, click <a href="'.$this->Lang->get_LANG_URL().'/?'.$this->Setting->PAGE_PREFIX.'=verify&Key="'.$activationKey.'">here</a>.<br>';
		$Body		.=	'If you can\'t click the above link, simply copy and paste the following link into your address bar.<br>';
		$Body		.=	$this->Lang->get_LANG_URL().'/?'.$this->Setting->PAGE_PREFIX.'=verify&Key='.$activationKey.'<br><br>';
		$Body		.=	'Please do not reply to this e-mail as it is not monitored.<br><br>';
		$Body		.=	'Regards,<br>'.$this->Lang->get_LANG_SITE_TITLE().' Staff';
		$Body = preg_replace('/\\\\/','',$Body); //Strip backslashes
	}
	else if($mail_for == "forgot") {
		$Subject = "Password Change Request!";
		$Body = "You, or someone using your username and email address, has requested a password change.<br>";
		$Body .= "<a href=\"".$this->Lang->get_LANG_URL()."/?p=forgot&verifyKey=".$activationKey."\">You can complete that password change by clicking here.</a><br>If you can't click the link copy and paste this link<br>".$this->Lang->get_LANG_URL()."/?p=forgot&verifyKey=".$activationKey."<br>If this is an error, ignore this email and the password wont change.\r\rRegards,\ The Management";
		$Body = preg_replace('/\\\\/','', $Body); //Strip backslashes
	}

	# PHPMailer Settings
		if($this->Setting->PHPMAILER_HOST == "localhost"){
			$mail->IsSMTP();
			$mail->Host			=	$this->Setting->PHPMAILER_HOST_URI;
			$mail->Port			=	$this->Setting->PHPMAILER_PORT;
			$mail->setFrom($this->Setting->get_PHPMAILER_REPLY_EMAIL(),$this->Setting->get_PHPMAILER_REPLY_NAME());
			$mail->addAddress($this->Messenger->text1,'');
			$mail->Subject		=	$Subject;
			$mail->IsHTML(true);
			$mail->Body			=	$Body;
		}
		elseif($this->Setting->PHPMAILER_HOST == "GMail TLS"){
			date_default_timezone_set('Etc/UTC');
			$mail				=	new PHPMailer;
			$mail				->	isSMTP();
			# Enable SMTP debugging | Options: 0 = off (for production use), 1 = client messages, 2 = client and server messages
			$mail->SMTPDebug	=	0;
			$mail->Debugoutput	=	"html";
			$mail->Host			=	$this->Setting->PHPMAILER_HOST_URI;
			$mail->Port			=	$this->Setting->PHPMAILER_PORT;
			# Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure	=	$this->Setting->PHPMAILER_SECURE;
			# Whether to use SMTP authentication
			$mail->SMTPAuth		=	true;
			# Username to use for SMTP authentication - use full email address for gmail
			$mail->Username		=	$this->Setting->PHPMailer_AccountID;
			# Password to use for SMTP authentication
			$mail->Password		=	$this->Setting->PHPMailer_Pw;
			$mail->setFrom($this->Messenger->text1,$UserID);
			$mail->addAddress($MsgTo,"");
			# Set the subject line
			$mail->Subject		=	$Subject;
			#$mail->Body			=	$Body;
			$mail->MsgHTML($Body);
			$mail->IsHTML(true); // send as HTML

			# Read an HTML message body from an external file, convert referenced images to embedded,
			# convert HTML into a basic plain-text alternative body
			#$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
			# Attach an image file
			
			#$mail->addAttachment('images/phpmailer_mini.png');
		}
		elseif($this->Setting->PHPMAILER_HOST == "GMail SSL"){
			date_default_timezone_set('Etc/UTC');
			$mail				=	new PHPMailer;
			$mail->isSMTP();
			# Enable SMTP debugging | Options: 0 = off (for production use), 1 = client messages, 2 = client and server messages
			$mail->SMTPDebug	=	2;
			$mail->Debugoutput	=	"html";
			$mail->Host			=	$this->Setting->PHPMAILER_HOST_URI;
			$mail->Port			=	$this->Setting->PHPMAILER_PORT;
			# Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure	=	$this->Setting->PHPMAILER_SECURE;
			# Whether to use SMTP authentication
			$mail->SMTPAuth		=	true;
			# Username to use for SMTP authentication - use full email address for gmail
			$mail->Username		=	"nexusdevelopment2013@gmail.com";
			# Password to use for SMTP authentication
			$mail->Password		=	"!@Archangel1520@!";
			$mail->setFrom($this->Messenger->text1,$UserID);
			$mail->addAddress($MsgTo,"");
			# Set the subject line
			$mail->Subject		=	$Subject;
			$mail->Body			=	$Body;

			# Read an HTML message body from an external file, convert referenced images to embedded,
			# convert HTML into a basic plain-text alternative body
			#$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
			# Attach an image file
			
			#$mail->addAttachment('images/phpmailer_mini.png');
		}
?>