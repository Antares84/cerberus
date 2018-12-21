<?php
	require_once('../../Autoloader.php');
	session_start();ob_start();

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

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo '_POST<br>';
			echo var_dump($_POST);
			echo '_GET<br>';
			echo var_dump($_GET);
			echo '_REQUEST<br>';
			echo var_dump($_REQUEST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST) && !empty($_POST)){
		# ACCOUNT
		$DisplayName	=	isset($_POST["DisplayName"])	?	$Data->escData(trim($_POST["DisplayName"]))		:	false;		#0
		$UserID			=	isset($_POST["UserID"])			?	$Data->escData(trim($_POST["UserID"]))			:	false;		#1
		$Password		=	isset($_POST["Password"])		?	$Data->escData(trim($_POST["Password"]))		:	false;		#2
		$c_Password		=	isset($_POST["c_Password"])		?	$Data->escData(trim($_POST["c_Password"]))		:	false;		#3
		$Referer		=	isset($_POST["Referer"])		?	$Data->escData(trim($_POST["Referer"]))			:	false;		#4
		# PERSONAL
		$DOB			=	isset($_POST["DOB"])			?	$Data->escData(trim($_POST["DOB"]))				:	false;		#5
		$Gender			=	isset($_POST["Gender"])			?	$Data->escData(trim($_POST["Gender"]))			:	false;		#6
		$SecQuestion	=	isset($_POST["SecQuestion"])	?	$Data->escData(trim($_POST["SecQuestion"]))		:	false;		#7
		$SecAnswer		=	isset($_POST["SecAnswer"])		?	$Data->escData(trim($_POST["SecAnswer"]))		:	false;		#8
		$EMail			=	isset($_POST["EMail"])			?	$Data->escData(trim($_POST["EMail"]))			:	false;		#9
		# TOS
		$Checkbox		=	isset($_POST["Checkbox"])		?	$Data->escData(trim($_POST["Checkbox"]))		:	false;		#10
		# MISC
		$UserIP			=	$Browser->UserIP;																					#11
		$ActivationKey	=	$Data->rand_str();																					#12
		$ResendURI		=	$Setting->SITE_DOMAIN.'?'.$Setting->PAGE_PREFIX.'=ResendValidation&Key='.$ActivationKey;			#13
		$ValidateURI	=	$Setting->SITE_DOMAIN.'?'.$Setting->PAGE_PREFIX.'=Validate&Key='.$ActivationKey;					#14

		$CheckUser		=	odbc_exec($db->conn,"SELECT UserID,Email FROM ".$db->get_TABLE('WEB_PRESENCE')." WHERE UserID='".$UserID."'");
		$CheckEmail		=	odbc_exec($db->conn,"SELECT Email FROM ".$db->get_TABLE('WEB_PRESENCE')." WHERE Email='".$EMail."'");

		$_SESSION["REG_TEXT"]	=	array(0=>$DisplayName,1=>$UserID,2=>$Password,3=>$c_Password,4=>$Referer,5=>$DOB,6=>$Gender,7=>$SecQuestion,8=>$SecAnswer,9=>$EMail,10=>$Checkbox,11=>$UserIP,12=>$ActivationKey,13=>$ResendURI,14=>$ValidateURI);
		$RegInfo = $_SESSION["REG_TEXT"];

		if($MailSys->ENABLED){
		#	require_once($Plugins->get_PHPMailer_DIR().'PHPMailerAutoload.php');
		}

		if($Setting->DEBUG === "1"){
			echo '<div class="row">';
				echo '<div class="col-md-6">';
					echo 'Array 1<br>';
					echo '<pre>';
						var_dump($_POST);
					echo '</pre><br>';
				echo '</div>';

				echo '<div class="col-md-6">';
					echo 'Array 2<br>';
					echo '<pre>';
						echo 'Display Name: '.$RegInfo[0].'<br>';
						echo 'UserID: '.$RegInfo[1].'<br>';
						echo 'Pw: '.$RegInfo[2].'<br>';
						echo 'Conf Pw: '.$RegInfo[3].'<br>';
						echo 'Referer: '.$RegInfo[4].'<br>';
						echo 'DOB: '.$RegInfo[5].'<br>';
						echo 'Gender: '.$RegInfo[6].'<br>';
						echo 'Question: '.$RegInfo[7].'<br>';
						echo 'Answer: '.$RegInfo[8].'<br>';
						echo 'E-mail: '.$RegInfo[9].'<br>';
						echo 'Checkbox: '.$RegInfo[10].'<br>';
						echo 'UserIP: '.$RegInfo[11].'<br>';
						echo 'ActivationKey: '.$RegInfo[12].'<br>';
						echo 'ResendURI: '.$RegInfo[13].'<br>';
						echo 'ValidateURI: '.$RegInfo[14].'<br>';

					if($MailSys->ENABLED){
						echo $MailSys->get_messages(0,$RegInfo);
					}
					echo '</pre>';
				echo '</div>';
			echo '</div>';
			exit();
		}
		
		# Register with Mailsys class
#		$Mailsys->msg_arr[]=

		# Validate username
		if(empty($UserID)){
			$err[].='UN_1';
			$Tpl->_do_alert('3','R-0x01',$error);
		}elseif(strlen($UserID) < 3 || strlen($UserID) > 16){
			$err[].='UN_2';
			$Tpl->_do_alert('3','R-0x02',$error);
		}elseif(ctype_alnum($UserID) === false){
			$err[].='UN_3';
			$Tpl->_do_alert('3','R-0x03',$error);
		}
		elseif($row = odbc_fetch_array($CheckUser)){
			$Tpl->_do_alert('3','R-0x04',$error);
		}
		# DisplayName
		if(empty($DisplayName)){
			$err[].='DS_1';
			$Tpl->_do_alert('3','R-0x05',$error);
		}
		# Validate Passwords
		if(empty($Password)){
			$err[].='PW_1';
			$Tpl->_do_alert('3','R-0x06',$error);
		}elseif(strlen($Password) < 3 || strlen($Password) > 16){
			$err[].='PW_2';
			$Tpl->_do_alert('3','R-0x07',$error);
		}elseif($Password != $c_Password){
			$err[].='PW_3';
			$Tpl->_do_alert('3','R-0x08',$error);
		}
		# Date of Birth
		if(empty($DOB)){
			$err[].='DOB_1';
			$Tpl->_do_alert('3','R-0x09',$error);
		}
		# Gender
		if(empty($Gender)){
			$err[].='G_1';
			$Tpl->_do_alert('3','R-0x10',$error);
		}
		# Validate Email
		if(empty($EMail)){
			$err[].='EM_1';
			$Tpl->_do_alert('3','R-0x11',$error);
		}elseif(!filter_var($EMail,FILTER_VALIDATE_EMAIL)){
			$err[].='EM_2';
			$Tpl->_do_alert('3','R-0x12',$error);
		}elseif($row = odbc_fetch_array($CheckEmail)){
			$err[].='EM_3';
			$Tpl->_do_alert('3','R-0x13',$error);
		}
		# Sec Question
		if(empty($SecQuestion)){
			$err[].='SQ_1';
			$Tpl->_do_alert('3','R-0x14',$error);
		}
		# Sec Answer
		if(empty($SecAnswer)){
			$err[].='SA_1';
			$Tpl->_do_alert('3','R-0x15',$error);
		}
		# Validate Checkbox
		if(!isset($_POST['Checkbox']) || empty($_POST["Checkbox"])){
			$err[].='TOS_1';
			$Tpl->_do_alert('3','R-0x16',$error);
		}

		if($Setting->DEBUG === "1"){
		#	$Tpl->_do_alert('3','R-0x00',$error);
			echo 'Err Cnt: '.count($_SESSION["MESSAGES"]['type']);
			exit();
		}

		if(count($err) == 0){
			# create clause for different site types

			if($Setting->SITE_TYPE === "SHAIYA"){
				$REG_USER	=	$SQL->_do_REGISTER_USER_GAME($RegInfo[1],$RegInfo[2],$RegInfo[9],$RegInfo[11]);
				$REG_WEB	=	$SQL->_do_REGISTER_USER_WEB($RegInfo[1],$RegInfo[2],$RegInfo[0],$RegInfo[5],$RegInfo[6],$RegInfo[4],$RegInfo[7],$RegInfo[8],$RegInfo[12],$RegInfo[9],$RegInfo[11]);

				if($REG_WEB){
					$Tpl->_do_alert('2','R-0x20',$error);
					if($REG_USER){
						$Tpl->_do_alert('2','R-0x19',$error);
					}
					else{
						$Tpl->_do_alert('2','R-0x18',$error);
					}
				}
				else{
					$Tpl->_do_alert('2','R-0x17',$error);
				}
			}
#			elseif($Setting->SITE_TYPE === 0){
#				$REG_WEB = $SQL->_do_REGISTER_USER_WEB($RegInfo[1],$RegInfo[2],$RegInfo[0],$RegInfo[5],$RegInfo[6],$RegInfo[4],$RegInfo[7],$RegInfo[8],$RegInfo[12],$RegInfo[9],$RegInfo[11]);
#			}

			if($REG_WEB){
				$Tpl->_do_alert('2','R-0x20',$error);
				# Send Registration E-Mail
				if($MailSys->ENABLED){
					$MAIL_FOR	=	"register";
					$MAIL		=	new PHPMailer(true);
					$MailSys->do_SendMail($MAIL,$MAIL_FOR,$RegInfo);

					if(!$MAIL->Send()){
					#	$Tpl->_do_alert('3','R-0x00',$error);
					#	$_SESSION["MESSAGES"]["type"][].='3';
					#	$_SESSION["MESSAGES"]["head"][].='0';
					#	$_SESSION["MESSAGES"]["body"][].='R-0x19';
						echo '<pre>';
							echo "Mailer Error: ".$MAIL->ErrorInfo;
						echo '</pre>';
					}
					else{
					#	$Tpl->_do_alert('3','R-0x00',$error);
					#	$_SESSION["MESSAGES"]["type"][].='0';
					#	$_SESSION["MESSAGES"]["head"][].='0';
					#	$_SESSION["MESSAGES"]["body"][].='R-0x18';

					#	header('location: ?'.$Setting->PAGE_PREFIX.'=REGISTRATION_COMPLETE&Valid=true');
					echo 'Registration complete';
					}
				}
			#	$Tpl->_do_alert('3','R-0x00',$error);
			#	$_SESSION["MESSAGES"]["type"][].='0';
			#	$_SESSION["MESSAGES"]["head"][].='0';
			#	$_SESSION["MESSAGES"]["body"][].='R-0x20';

			#	header('location: ?'.$Setting->PAGE_PREFIX.'=REGISTER&Valid=true');
			}
			else{
				// REG_WEB err_msg
			}
		}
	}
?>