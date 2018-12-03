<?php 
	$mail = new PHPMailer(true);

	if($mail_for == 'donate_debug'){
		$Subject	=	'Donation Information';
		$Body		=	$Payment_Status.'<br>';
		$Body		.=	$RewardID.'<br>';
		$Body		.=	$UserUID.'<br>';
		$Body		.=	$Reward.'<br>';
		$Body		.=	$Payer_Email.'<br>';
		$Body		.=	$Payment_Type.'<br>';
		$Body		.=	$Price.'<br>';
		$Body		.=	$Txn_ID.'<br>';
		$Body		.=	$UserID.'<br>';
		$Body		.=	$UserPoint.'<br>';
		$Body		.=	$Verify_Key.'<br>';
		$Body		.=	$acp_email_1.'<br>';
		$Body		.=	$acp_email_2.'<br>';
		$Body		.=	$acp_email_3.'<br>';
		$Body		=	preg_replace('/\\\\/','',$Body);
	}

	if($MailSys->PHPMAILER_HOST == "localhost"){
		$mail->IsSMTP();
		$mail->Host			=	$MailSys->PHPMAILER_HOST_URI;
		$mail->Port			=	$MailSys->PHPMAILER_PORT;
		$mail->setFrom($LangObj->get_LANG_EMAIL_SUPPORT(),$LangObj->get_LANG_SITE_TITLE()." - Admin");
		$mail->addAddress('admin@ndf-innovations.net','');
		$mail->Subject		=	$Subject;
		$mail->IsHTML(true);
		$mail->Body			=	$Body;
	}elseif($MailSys->PHPMAILER_HOST == "GMail TLS"){
		date_default_timezone_set('Etc/UTC');
		$mail				=	new PHPMailer;
		$mail				->	isSMTP();
		# Enable SMTP debugging | Options: 0 = off (for production use), 1 = client messages, 2 = client and server messages
		$mail->SMTPDebug	=	0;
		$mail->Debugoutput	=	"html";
		$mail->Host			=	$MailSys->PHPMAILER_HOST_URI;
		$mail->Port			=	$MailSys->PHPMAILER_PORT;
		# Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure	=	$MailSys->PHPMAILER_SECURE;
		# Whether to use SMTP authentication
		$mail->SMTPAuth		=	true;
		# Username to use for SMTP authentication - use full email address for gmail
		$mail->Username		=	$MailSys->get_PHPMAILER_ACCOUNT_ID();
		# Password to use for SMTP authentication
		$mail->Password		=	$MailSys->get_PHPMMAILER_ACCOUNT_PW();
		$mail->setFrom($_SESSION["UserEmail"],$_SESSION["UserName"]);
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
	}elseif($MailSys->PHPMAILER_HOST == "GMail SSL"){
		date_default_timezone_set('Etc/UTC');
		$mail->isSMTP();
		# Enable SMTP debugging | Options: 0 = off (for production use), 1 = client messages, 2 = client and server messages
		$mail->SMTPDebug	=	2;
		$mail->Debugoutput	=	"html";
		$mail->Host			=	$MailSys->PHPMAILER_HOST_URI;
		$mail->Port			=	$MailSys->PHPMAILER_PORT;
		# Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure	=	$MailSys->PHPMAILER_SECURE;
		# Whether to use SMTP authentication
		$mail->SMTPAuth		=	true;
		# Username to use for SMTP authentication - use full email address for gmail
		$mail->Username		=	$MailSys->get_PHPMAILER_REPLY_EMAIL();
		# Password to use for SMTP authentication
		$mail->Password		=	$MailSys->get_PHPMMAILER_ACCOUNT_PW();
		$mail->setFrom($_SESSION["UserEmail"],$_SESSION["UserName"]);
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