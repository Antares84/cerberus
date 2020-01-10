<?php
	require_once($this->Dirs->_array[22].'PHPMailer/PHPMailerAutoload.php');

	$Alert		=	array();
	$err		=	array();
	$error		=	false;

	if(isset($_POST['submit'])){
		$Msg_To			=	isset($_POST["MsgTo"])		?	$this->Data->_do('escData',trim($_POST["MsgTo"]))		:	false;
		$Msg_Title		=	isset($_POST["MsgTitle"])	?	$this->Data->_do('escData',trim($_POST["MsgTitle"]))	:	false;
		$Msg_Content	=	isset($_POST["MsgContent"])	?	$this->Data->_do('escData',trim($_POST["MsgContent"]))	:	false;

#		$RegInfo	=	array(0=>$Msg_To,1=>$Msg_Title,2=>$Msg_Content);
		$RegInfo	=	array(0=>"",1=>"",2=>"",3=>"",4=>"",5=>"",6=>"",7=>"",8=>"",9=>$Msg_To,10=>"",11=>"",12=>"",13=>"",14=>$Msg_Title,15=>$Msg_Content);

		echo 'POST Data<br>';
		echo '<pre>';
			var_dump($_POST);
		echo '</pre>';

		echo 'RegInfo Arr<br>';
		echo '<pre>';
			var_dump($RegInfo);
		echo '</pre>';

		# Load PHPMailer
		$MAIL_FOR	=	"MailTest";
		$MAIL		=	new PHPMailer(true);
		$this->MailSys->do_SendMail($MAIL,$MAIL_FOR,$RegInfo);

		if($MAIL->Send()) {
			#$success .= "An email has been sent to ".$email." with an activation key.<br />";
			#$success .= "Please check your mail to complete registration.<br />";
			#$success .= "If the email is not in your main inbox please check your spam folder or disable spam filtering.<br />";
			#$success .= "didnt recieve an email? please try to resend the email. Click <a href=".$emailaddy.">Here.</a><br />";
			$err[]		.=	'T_1';
			$Alert[]	=	$this->Tpl->_do_alert('0','EM-0x05',$error);
		#	$_SESSION["MESSAGES"]["type"][].='3';
		#	$_SESSION["MESSAGES"]["head"][].='3';
		#	$_SESSION["MESSAGES"]["body"][].='EM-0x01';
		}
		else{
			$err[]		.=	'T_2';
			$Alert[]	=	$this->Tpl->_do_alert('3','EM-0x01',$error);
		#	$_SESSION["MESSAGES"]["type"][].='0';
		#	$_SESSION["MESSAGES"]["head"][].='0';
		#	$_SESSION["MESSAGES"]["body"][].='EM-0x05';
			echo '<pre>';
				echo "Mailer Error: ".$MAIL->ErrorInfo;
			echo '</pre>';
		}
	}

	echo '<div id="page-wrapper">';
		echo '<div class="container-fluid">';

#		if(count($err) == 0){
			echo '<div class="black_base bordered_tf_lc_rc_bc">';
				echo '<div class="container">';
					foreach($Alert as $Alerts){
						echo $Alerts;
					}
				echo '</div>';
			echo '</div>';
#		}else{
			echo '<div class="container"><br>';
				echo '<form class="acp_form" action="" method="post">';
					echo '<pre>';
						echo "Sender's Name: ".$this->User->UserID."<br>";
						echo "Sender's E-Mail: ".$this->User->Email."<br>";
						echo "PHPMailer Host: ".$this->MailSys->PHPMAILER_HOST."<br>";
						echo "PHPMailer Pw: ".$this->MailSys->PHPMAILER_ACCOUNT_PW()."<br>";
						echo "PHPMailer URI: ".$this->MailSys->PHPMAILER_HOST_URI."<br>";
						echo "PHPMailer Port: ".$this->MailSys->PHPMAILER_PORT."<br>";
						echo "PHPMailer Secure: ".$this->MailSys->PHPMAILER_SECURE."<br>";
					echo '</pre>';

					echo '<div class="blue_base">';
						echo '<div class="form-group">';
							echo '<input type="text" class="form-control f16 b" id="MsgTo" name="MsgTo" placeholder="Receiver E-Mail Address" value=""	>';
						echo '</div>';
					echo '</div>';

					echo '<div class="blue_base">';
						echo '<div class="form-group">';
							echo '<input type="text" class="form-control f16 b" id="MsgTitle" name="MsgTitle" placeholder="Message Title">';
						echo '</div>';
					echo '</div>';

					echo '<div class="blue_base">';
						echo '<div class="form-group">';
							echo '<label for="message">Message: </label><br>';
							echo '<textarea class="mail form-control" id="MsgContent" name="MsgContent" rows="3" placeholder="Have a message to send?"></textarea>';
						echo '</div>';
					echo '</div>';

					echo '<button type="submit" name="submit" class="btn btn-primary center-block">Send E-Mail</button>';
				echo '</form>';
			echo '</div>';
	#	}
		echo '</div>';
	echo '</div>';
?>