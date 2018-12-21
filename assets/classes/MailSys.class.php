<?php
	class MailSys{

		# GENERAL SETTINGS
		public $ENABLED;public $MSG_SUBJECT;public $MSG_CONTENT;

		# PHPMAILER SETTINGS
		public $PHPMAILER_ACCOUNT_ID;
		public $PHPMAILER_ACCOUNT_PW;
		public $PHPMAILER_REPLY_NAME;
		public $PHPMAILER_REPLY_EMAIL;
		public $PHPMAILER_HOST;
		public $PHPMAILER_HOST_URI;
		public $PHPMAILER_PORT;
		public $PHPMAILER_SECURE;

		function __construct($db,$Setting,$User){
			$this->db			=	$db;
			$this->Setting		=	$Setting;
			$this->User			=	$User;

			$this->INIT_MAILSYS();
		}
		#GENERAL
		function MAILSYS_STATUS(){
			$this->ENABLED = $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","MAILSYS_ENABLE");
		}
		function INIT_MAILSYS(){
			$this->MAILSYS_STATUS();

			if($this->ENABLED){
				$this->PHPMAILER_ACCOUNT_ID();
				$this->PHPMAILER_ACCOUNT_PW();
				$this->PHPMAILER_REPLY_NAME();
				$this->PHPMAILER_REPLY_EMAIL();
				$this->PHPMAILER_HOST();
			}
		}
		# PHPMAILER
		function PHPMAILER_ACCOUNT_ID(){
			return $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PHPMAILER_ACCOUNT_ID");
		}
		function PHPMAILER_ACCOUNT_PW(){
			return $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PHPMMAILER_ACCOUNT_PW");
		}
		function PHPMAILER_REPLY_NAME(){
			return $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PHPMAILER_REPLY_NAME");
		}
		function PHPMAILER_REPLY_EMAIL(){
			return $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PHPMAILER_REPLY_EMAIL");
		}
		function PHPMAILER_HOST(){
			$this->PHPMAILER_HOST = $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PHPMAILER_HOST");

			if($this->PHPMAILER_HOST == "localhost"){
				$this->PHPMAILER_HOST_URI = "localhost";
				$this->PHPMAILER_PORT = 25;
			}elseif($this->PHPMAILER_HOST == "Gmail_TLS"){
				$this->PHPMAILER_HOST_URI = "smtp.gmail.com";
				$this->PHPMAILER_PORT = 587;
				$this->PHPMAILER_SECURE = "tls";
			}elseif($this->PHPMAILER_HOST == "Gmail_SSL"){
				$this->PHPMAILER_HOST_URI = "smtp.gmail.com";
				$this->PHPMAILER_PORT = 465;
				$this->PHPMAILER_SECURE = "ssl";
			}
		}
		function do_SendMail($mail,$mail_for,$RegInfo){
			if($mail_for === "register"){
				$this->messages(0,$RegInfo);
			}
			elseif($mail_for === "resend"){
				$this->messages(1,$RegInfo);
			}
			elseif($mail_for === "MailTest"){
				$this->messages(2,$RegInfo);
			}

			if($this->PHPMAILER_HOST === "localhost"){
				$this->mail_local($mail,$RegInfo);
			}
			elseif($this->PHPMAILER_HOST == "Gmail_SSL" || $this->PHPMAILER_HOST == "Gmail_TLS"){
				$this->mail_gmail($mail,$RegInfo);
			}
		}
		function mail_local($mail,$RegInfo){
#			echo 'Mail Local Dump<br>';
#			echo '<pre>';
#				var_dump($RegInfo);
#			echo '</pre>';
#			die();
			$mail->IsSMTP();
			$mail->Host			=	$this->PHPMAILER_HOST_URI;
			$mail->Port			=	$this->PHPMAILER_PORT;
			$mail->setFrom($this->PHPMAILER_REPLY_EMAIL(),$this->PHPMAILER_REPLY_NAME());
			$mail->addAddress($RegInfo[9],$RegInfo[0]);
			$mail->Subject		=	$this->MSG_SUBJECT;
			$mail->IsHTML(true);
			$mail->Body			=	$this->MSG_CONTENT;
		}
		function mail_gmail($mail,$RegInfo){
			$mail				->	isSMTP();
			# Enable SMTP debugging | Options: 0 = off (for production use), 1 = client messages, 2 = client and server messages
			$mail->SMTPDebug	=	2;
			$mail->Debugoutput	=	"html";
			$mail->Host			=	gethostbyname($this->PHPMAILER_HOST_URI);
			$mail->Port			=	$this->PHPMAILER_PORT;
			# Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure	=	$this->PHPMAILER_SECURE;
			# Whether to use SMTP authentication
			$mail->SMTPAuth		=	true;
			# Username to use for SMTP authentication - use full email address for gmail
			$mail->Username		=	$this->PHPMAILER_ACCOUNT_ID();
			# Password to use for SMTP authentication
			$mail->Password		=	$this->PHPMAILER_ACCOUNT_PW();
			$mail->setFrom($this->PHPMAILER_REPLY_EMAIL(),$this->PHPMAILER_REPLY_NAME());
			$mail->addAddress($RegInfo[9],$RegInfo[0]);
			# Set the subject line
			$mail->Subject		=	$this->MSG_SUBJECT;
			$mail->Body			=	$this->MSG_CONTENT;
#			$mail->MsgHTML($this->MSG_CONTENT);
			$mail->IsHTML(true); // send as HTML

			# Read an HTML message body from an external file, convert referenced images to embedded,
			# convert HTML into a basic plain-text alternative body
			#$mail->msgHTML(file_contents('contents.html'), dirname(__FILE__));
			# Attach an image file
			
			#$mail->addAttachment('images/phpmailer_mini.png');
		}
		function messages($MsgType,$RegInfo){
			if($MsgType === 0){
				$this->MSG_SUBJECT	=	'Registration Verification';
				$this->MSG_CONTENT	=	'You, or someone using your e-mail address, has completed our registration.<br>';
				$this->MSG_CONTENT	.=	'If you believe this to be in error, simply delete this e-mail and the account will stay inactive.<br><br>';
				$this->MSG_CONTENT	.=	'Your UserID is: '.$RegInfo[1].'.<br>';
				$this->MSG_CONTENT	.=	'Your Password is: '.$RegInfo[2].'.<br>';
				$this->MSG_CONTENT	.=	'Your SecurID is: '.$RegInfo[13].'.<br><br>';
				$this->MSG_CONTENT	.=	'Please save your <font class="b_i">SecurID</font> in a safe place.<br>';
				$this->MSG_CONTENT	.=	'If anything ever happens to your account, you will need your <font class="b_i">SecurID</font> when requesting assistance.<br><br>';
				$this->MSG_CONTENT	.=	'To complete your registration and activate your account, click <a href="'.$RegInfo[15].'">here</a>.<br>';
				$this->MSG_CONTENT	.=	'If you can\'t click the above link, simply copy and paste the following link into your address bar.<br>';
				$this->MSG_CONTENT	.=	$RegInfo[15].'<br><br>';
				$this->MSG_CONTENT	.=	'Please do not reply to this e-mail as it is not monitored.<br>';
				$this->MSG_CONTENT	.=	'Regards,<br>Site Staff';
				$this->MSG_CONTENT	=	preg_replace('/\\\\/','',$this->MSG_CONTENT);
			}
			elseif($MsgType === 1){
				$this->MSG_SUBJECT	=	'Registration Verification - Resend';
				$this->MSG_CONTENT	=	'You, or someone using your e-mail address, has completed our registration.<br>';
				$this->MSG_CONTENT	.=	'If you believe this to be in error, simply delete this e-mail and the account will stay inactive.<br><br>';
				$this->MSG_CONTENT	.=	'Your UserID is: '.$RegInfo[1].'.<br>';
				$this->MSG_CONTENT	.=	'Your Password is: '.$RegInfo[2].'.<br>';
				$this->MSG_CONTENT	.=	'Your Activation/Recovery Key is: '.$RegInfo[13].'.<br>';
				$this->MSG_CONTENT	.=	'Please save your Activation/Recovery Key in a safe place.';
				$this->MSG_CONTENT	.=	'If anything ever happens to your account, you will need this key when requesting assistance.<br><br>';
				$this->MSG_CONTENT	.=	'To complete your registration and activate your account, click <a href="'.$RegInfo[15].'"> here.</a><br>';
				$this->MSG_CONTENT	.=	'If you can\'t click the above link, simply copy and paste the following link into your address bar.<br>';
				$this->MSG_CONTENT	.=	$RegInfo[15].'<br><br>';
				$this->MSG_CONTENT	.=	'Please do not reply to this e-mail as it is not monitored.<br>';
				$this->MSG_CONTENT	.=	'Regards,\ Site Staff';
				$this->MSG_CONTENT	=	preg_replace('/\\\\/','',$this->MSG_CONTENT);
			}
			elseif($MsgType === 2){
				$this->MSG_SUBJECT	=	'E-mail System Test';
				$this->MSG_CONTENT	=	'This is an auto-generated message.<br>';
				$this->MSG_CONTENT	.=	'Message sent from <a href=\"http://ndf-innovations.net\">NDF Innovations</a>.<br>';
				$this->MSG_CONTENT	.=	'Message:';
				$this->MSG_CONTENT	.=	$RegInfo[2];
				$this->MSG_CONTENT	=	preg_replace('/\\\\/','',$this->MSG_CONTENT);
			}
		}
		function MAILDIAG(){
			$ret	=	false;

			$ret	.=	'<div class="col-md-12">';
				$ret	.=	'<div class="row">';
					$ret	.=	'<div class="col-md-4">Account ID</div>';
					$ret	.=	'<div class="col-md-8">'.$this->PHPMAILER_ACCOUNT_ID().'</div>';
				$ret	.=	'</div>';

				$ret	.=	'<div class="row">';
					$ret	.=	'<div class="col-md-4">Account Pw</div>';
					$ret	.=	'<div class="col-md-8">'.$this->PHPMAILER_ACCOUNT_PW().'</div>';
				$ret	.=	'</div>';

				$ret	.=	'<div class="row">';
					$ret	.=	'<div class="col-md-4">Reply-To Name</div>';
					$ret	.=	'<div class="col-md-8">'.$this->PHPMAILER_REPLY_NAME().'</div>';
				$ret	.=	'</div>';

				$ret	.=	'<div class="row">';
					$ret	.=	'<div class="col-md-4">Reply-To E-mail</div>';
					$ret	.=	'<div class="col-md-8">'.$this->PHPMAILER_REPLY_EMAIL().'</div>';
				$ret	.=	'</div>';

				$ret	.=	'<div class="row">';
					$ret	.=	'<div class="col-md-4">Host</div>';
					$ret	.=	'<div class="col-md-8">'.$this->PHPMAILER_HOST.'</div>';
				$ret	.=	'</div>';

				$ret	.=	'<div class="row">';
					$ret	.=	'<div class="col-md-4">Host URI</div>';
					$ret	.=	'<div class="col-md-8">'.$this->PHPMAILER_HOST_URI.'</div>';
				$ret	.=	'</div>';

				$ret	.=	'<div class="row">';
					$ret	.=	'<div class="col-md-4">Port</div>';
					$ret	.=	'<div class="col-md-8">'.$this->PHPMAILER_PORT.'</div>';
				$ret	.=	'</div>';

				$ret	.=	'<div class="row">';
					$ret	.=	'<div class="col-md-4">Security Type</div>';
					$ret	.=	'<div class="col-md-8">'.$this->PHPMAILER_SECURE.'</div>';
				$ret	.=	'</div>';
			$ret	.=	'</div>';

			return $ret;
		}
		# MISC
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}