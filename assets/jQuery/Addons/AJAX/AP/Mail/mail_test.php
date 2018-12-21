<?php
	require_once('../../Autoloader.php');
	session_start();ob_start();

	$Dirs		=	new Dirs();
	$db			=	new Database();
	$Browser	=	new Browser();
	$Select		=	new Select();

	$Data		=	new Data($db);
	$Theme		=	new Theme($db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($db,$Theme);
	$Tpl		=	new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);
	$User		=	new User($Browser,$Data,$db,$Setting);
	$SQL		=	new SQL($Data,$db,$Setting,$Tpl,$User);
	$MailSys	=	new MailSys($db,$Setting,$User);
	$Session	=	new Session($db,$Browser,$Setting,$User);

	$err		=	array();
	$error		=	false;

#	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo '_POST<br>';
			echo var_dump($_POST);
			echo '_GET<br>';
			echo var_dump($_GET);
			echo '_REQUEST<br>';
			echo var_dump($_REQUEST);
		echo '</pre>';

#		if($Setting->DEBUG === "2"){
#			die();
#		}
#	}

	if(isset($_POST) && !empty($_POST)){
		$Msg_To			=	isset($_POST["MsgTo"])		?	$Data->escData(trim($_POST["MsgTo"]))		:	false;
		$Msg_Title		=	isset($_POST["MsgTitle"])	?	$Data->escData(trim($_POST["MsgTitle"]))	:	false;
		$Msg_Content	=	isset($_POST["mce_0"])		?	$Data->escData(trim($_POST["mce_0"]))		:	false;

#		$RegInfo	=	array(0=>$Msg_To,1=>$Msg_Title,2=>$Msg_Content);
		$RegInfo	=	array(0=>"",1=>"",2=>"",3=>"",4=>"",5=>"",6=>"",7=>"",8=>"",9=>$Msg_To,10=>"",11=>"",12=>"",13=>"",14=>$Msg_Title,15=>$Msg_Content);

		echo 'POST Data<br>';
		echo '<pre>';
#			var_dump($_POST);
		echo '</pre>';

		echo 'RegInfo Arr<br>';
		echo '<pre>';
#			var_dump($RegInfo);
		echo '</pre>';

		# MailSys Vars
		echo '<pre>';
			echo "Sender's Name: ".$User->UserID."<br>";
			echo "Sender's E-Mail: ".$User->Email."<br>";
			echo "PHPMailer Host: ".$MailSys->PHPMAILER_HOST."<br>";
			echo "PHPMailer Pw: ".$MailSys->PHPMAILER_ACCOUNT_PW()."<br>";
			echo "PHPMailer URI: ".$MailSys->PHPMAILER_HOST_URI."<br>";
			echo "PHPMailer Port: ".$MailSys->PHPMAILER_PORT."<br>";
			echo "PHPMailer Secure: ".$MailSys->PHPMAILER_SECURE."<br>";
			echo 'Recipient:	'.$Msg_To.'<br>';
			echo 'Message Title: '.$Msg_Title.'<br>';
			echo 'Message Content: '.$Msg_Content.'<br>';
		echo '</pre>';

#		echo 'Var Dump<br>';
#		echo '<pre>';
#			var_dump($RegInfo);
#		echo '</pre>';
#		die();

		# Load PHPMailer
		$MAIL_FOR	=	"MailTest";
		$MAIL		=	new PHPMailer(true);
		$MailSys->do_SendMail($MAIL,$MAIL_FOR,$RegInfo);

		if($MAIL->Send()) {
			#$success .= "An email has been sent to ".$email." with an activation key.<br />";
			#$success .= "Please check your mail to complete registration.<br />";
			#$success .= "If the email is not in your main inbox please check your spam folder or disable spam filtering.<br />";
			#$success .= "didnt recieve an email? please try to resend the email. Click <a href=".$emailaddy.">Here.</a><br />";
			$Tpl->_do_alert('2','EM-0x01',$error);
		}
		else{
			$Tpl->_do_alert('3','EM-0x05',$error);
			echo '<pre>';
				echo "Mailer Error: ".$MAIL->ErrorInfo;
			echo '</pre>';
		}
	}
?>