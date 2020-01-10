<?php 
	# Load PHPMailer
	$mail = new PHPMailer(true);

	if($mail_for == "test"){
		$Subject	=	$MsgTitle;
		$Body		=	"This is an auto-generated message.<br>";
		$Body		.= 	"Message sent from <a href=\"http://ndf-innovations.net\">NDF Innovations</a>.<br>";
		$Body		.= 	"Message:";
		$Body		.= 	$MsgContent;
		$Body 		=	preg_replace('/\\\\/','',$Body);
	}
	elseif($mail_for == "register") {
		$body	=	"Please Verify Your Account.<br><br>";
		$body	.=	"Your Username is $username<br>";
		$body	.=	"Your Password is $password<br>";
		$body	.=	"Your Security Question is: $secquestion.<br>";
		$body	.=	"Please write down your security question and answer somewhere because if anything ever happens to your account you will need it to regain access.<br><br>";
		$body	.=	"You, or someone using your email address, has completed our registration.<br>";
		$body	.=	"<a href=\"".url."/?p=verify&verifyKey=".$activationKey."\">You can complete that registration by clicking here.</a><br>";
		$body	.=	"If you can't click the link, copy and paste this link<br>".url."/?p=verify&verifyKey=".$activationKey."<br>";
		$body	.=	"If this is an error, ignore this email and the account will stay inactive.<br>";
		$body	.=	"Please do not reply to this email.\r\r<br>";
		$body	.=	"Regards,\ Intrusion Staff Team";
		$body	=	preg_replace('/\\\\/','', $body);
	}
	elseif($mail_for == "resend") {
		$Subject = "Intrusion Shaiya Registration";
		$body = "Please Verify Your Account.<br><br>Your Username is $username<br>Your Password is $password<br><br>You, or someone using your email address, has completed our registration.<br>";
		$body .= "<a href=\"".url."/?p=verify&verifyKey=".$activationKey."\">You can complete that registration by clicking here.</a><br>If you can't click the link copy and paste this link<br>".url."/?p=verify&verifyKey=".$activationKey."<br>If this is an error, ignore this email and the account will stay inactive.<br>Please do not reply to this email.\r\r<br>Regards,\ Intrusion Staff Team";
		$body = preg_replace('/\\\\/','', $body); //Strip backslashes
	}
	elseif($mail_for == "forgot") {
		$Subject = "Password Change Request!";
		$body = "You, or someone using your username and email address has requested a password change.<br>";
		$body .= "<a href=\"".url."/?p=forgot&verifyKey=".$activationKey."\">You can complete that password change by clicking here.</a><br>If you can't click the link copy and paste this link<br>".url."/?p=forgot&verifyKey=".$activationKey."<br>If this is an error, ignore this email and the password wont change.\r\rRegards,\ The Management";
		$body = preg_replace('/\\\\/','', $body); //Strip backslashes
	}
	# PHPMailer Settings
	if($Settings->PHPMailer_Host == "localhost"){
		$mail->IsSMTP();
		$mail->Host			=	$Settings->PHPMailer_Host_URI;
		$mail->Port			=	$Settings->PHPMailer_Port;
		$mail->setFrom($_SESSION["UserEmail"],$_SESSION["UserName"]);
		$mail->addAddress($MsgTo,'');
#		$mail->addReplyTo('replyto@example.com', 'First Last');
		$mail->Subject		=	$Subject;
		$mail->IsHTML(true);
		$mail->Body			=	$Body;
	}
	elseif($Settings->PHPMailer_Host == "GMail"){
		date_default_timezone_set('Etc/UTC');
		require '../PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->isSMTP();
		# Enable SMTP debugging
		# 0 = off (for production use)
		# 1 = client messages
		# 2 = client and server messages
		$mail->SMTPDebug = 2;
		$mail->Debugoutput = 'html';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 587;
		# Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		# Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		# Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "username@gmail.com";
		# Password to use for SMTP authentication
		$mail->Password = "yourpassword";
		# Set who the message is to be sent from
		$mail->setFrom('from@example.com', 'First Last');
		# Set an alternative reply-to address
		$mail->addReplyTo('replyto@example.com', 'First Last');
		# Set who the message is to be sent to
		$mail->addAddress('whoto@example.com', 'John Doe');
		# Set the subject line
		$mail->Subject = 'PHPMailer GMail SMTP test';
		# Read an HTML message body from an external file, convert referenced images to embedded,
		# convert HTML into a basic plain-text alternative body
#		$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		# Replace the plain text body with one created manually
#		$mail->AltBody = 'This is a plain-text message body';
		# Attach an image file
		$mail->addAttachment('images/phpmailer_mini.png');
		# send the message, check for errors
		if(!$mail->send()){
			echo "Mailer Error: ".$mail->ErrorInfo;
		}else{
			echo "Message sent!";
		}
	}
?>