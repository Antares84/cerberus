<?php
	class Register{
		function Register_0(){}
		function Register_1(){
			# ACCOUNT
			$DisplayName	=	isset($_POST["DisplayName"])	?	$this->Data->escData(trim($_POST["DisplayName"]))	:	false;	#0
			$UserID			=	isset($_POST["UserID"])			?	$this->Data->escData(trim($_POST["UserID"]))		:	false;	#1
			$Password		=	isset($_POST["Password"])		?	$this->Data->escData(trim($_POST["Password"]))		:	false;	#2
			$c_Password		=	isset($_POST["c_Password"])		?	$this->Data->escData(trim($_POST["c_Password"]))	:	false;	#3
			$Referer		=	isset($_POST["Referer"])		?	$this->Data->escData(trim($_POST["Referer"]))		:	false;	#4
			# PERSONAL
			$DOB			=	isset($_POST["DOB"])			?	$this->Data->escData(trim($_POST["DOB"]))			:	false;	#5
			$Gender			=	isset($_POST["Gender"])			?	$this->Data->escData(trim($_POST["Gender"]))		:	false;	#6
			$SecQuestion	=	isset($_POST["SecQuestion"])	?	$this->Data->escData(trim($_POST["SecQuestion"]))	:	false;	#7
			$SecAnswer		=	isset($_POST["SecAnswer"])		?	$this->Data->escData(trim($_POST["SecAnswer"]))		:	false;	#8
			$EMail			=	isset($_POST["EMail"])			?	$this->Data->escData(trim($_POST["EMail"]))			:	false;	#9
			# TOS
			$Checkbox		=	isset($_POST["Checkbox"])		?	$this->Data->escData(trim($_POST["Checkbox"]))		:	false;	#10
			# MISC
			$UserIP			=	$this->Browser->UserIP;																				#11
			$VerifyKey		=	isset($_GET["VerifyKey"])		?	$this->Data->escData(trim($_GET["VerifyKey"]))		:	false;	#12 delete && update array
			$ActivationKey	=	$this->Data->rand_str();																			#13
			$ResendURI		=	$this->Lang->LANG_URL().'?'.$this->Setting->PAGE_PREFIX.'=ResendValidation&Key='.$ActivationKey;	#14
			$ValidateURI	=	$this->Lang->LANG_URL().'?'.$this->Setting->PAGE_PREFIX.'=Validate&Key='.$ActivationKey;			#15

			$_SESSION["REG_TEXT"]	=	array(0=>$DisplayName,1=>$UserID,2=>$Password,3=>$c_Password,4=>$Referer,5=>$DOB,6=>$Gender,7=>$SecQuestion,8=>$SecAnswer,9=>$EMail,10=>$Checkbox,11=>$UserIP,12=>$VerifyKey,13=>$ActivationKey,14=>$ResendURI,15=>$ValidateURI);
			$RegInfo = $_SESSION["REG_TEXT"];

			if($this->Setting->DEBUG === "1"){
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
							echo 'VerifyKey: '.$RegInfo[12].'<br>';
							echo 'ActivationKey: '.$RegInfo[13].'<br>';
							echo 'ResendURI: '.$RegInfo[14].'<br>';
							echo 'ValidateURI: '.$RegInfo[15].'<br>';

						#	echo $this->MailSys->get_messages(0,$RegInfo);
						echo '</pre>';
					echo '</div>';
				echo '</div>';
			}

			# Validate username
			if(empty($UserID)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x01';
			}elseif(strlen($UserID) < 3 || strlen($UserID) > 16){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x02';
			}elseif(ctype_alnum($UserID) === false){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x03';
			}
			# DisplayName
			if(empty($DisplayName)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x05';
			}
			# Validate Passwords
			if(empty($Password)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x06';
			}elseif(strlen($Password) < 3 || strlen($Password) > 16){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x07';
			}elseif($Password != $c_Password){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x08';
			}
			# Date of Birth
			if(empty($DOB)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x09';
			}
			# Gender
			if(empty($Gender)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x10';
			}
			# Validate Email
			if(empty($EMail)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x11';
			}elseif(!filter_var($EMail,FILTER_VALIDATE_EMAIL)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x12';
			}
			# Validate Checkbox
			if(!isset($_POST['Checkbox']) || empty($_POST["Checkbox"])){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x16';
			}

#			echo 'Err Cnt: '.count($_SESSION["MESSAGES"]['type']);
#			die();

			# Submit Information To Database
			if(count($_SESSION["MESSAGES"]['type']) < 1){
				echo 'in err check zone';
				# Shaiya Account Registration
#				$REG_USER = $this->SQL->REGISTER_USER_GAME($RegInfo[1],$RegInfo[2],$RegInfo[9],$RegInfo[11]);
#				if(!$REG_USER){
#					$_SESSION["MESSAGES"]["type"][].='3';
#					$_SESSION["MESSAGES"]["head"][].='0';
#					$_SESSION["MESSAGES"]["body"][].='R-0x17';
					#die();
#				}else{
#					$_SESSION["MESSAGES"]["type"][].='3';
#					$_SESSION["MESSAGES"]["head"][].='0';
#					$_SESSION["MESSAGES"]["body"][].='R-0x18';
#				}
#				echo 'passed reg_user';

				# Standard Web Account Registration
				$REG_WEB = $this->SQL->REGISTER_USER_WEB($RegInfo[1],$RegInfo[0],$RegInfo[5],$RegInfo[6],$RegInfo[4],$RegInfo[7],$RegInfo[8],$RegInfo[12],$RegInfo[13]);
				if(!$REG_WEB){
					$_SESSION["MESSAGES"]["type"][].='3';
					$_SESSION["MESSAGES"]["head"][].='0';
					$_SESSION["MESSAGES"]["body"][].='R-0x19';
				}
				else{
					$_SESSION["MESSAGES"]["type"][].='3';
					$_SESSION["MESSAGES"]["head"][].='0';
					$_SESSION["MESSAGES"]["body"][].='R-0x20';
				}

				echo 'passed reg_web';
#				if($REG_USER && $REG_WEB){
				if($REG_WEB){
					header('location: ?'.$this->Setting->PAGE_PREFIX.'=REGISTRATION_COMPLETE&Valid=true');
				}
/*
				# Send Registration E-Mail
				$MAIL_FOR	=	"register";
				$MAIL		=	new PHPMailer(true);
				$this->MailSys->do_SendMail($MAIL,$MAIL_FOR,$RegInfo);

				if(!$MAIL->Send()){
					$_SESSION["MESSAGES"]["type"][].='3';
					$_SESSION["MESSAGES"]["head"][].='0';
					$_SESSION["MESSAGES"]["body"][].='R-0x19';
					echo '<pre>';
						echo "Mailer Error: ".$MAIL->ErrorInfo;
					echo '</pre>';
				}
				else{
					$_SESSION["MESSAGES"]["type"][].='0';
					$_SESSION["MESSAGES"]["head"][].='0';
					$_SESSION["MESSAGES"]["body"][].='R-0x18';

					header('location: ?'.$this->Setting->PAGE_PREFIX.'=REGISTRATION_COMPLETE&Valid=true');
				}
*/
			}
			else{
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x20';
			}
		}
		function Register_2(){
			# ACCOUNT
			$DisplayName	=	isset($_POST["DisplayName"])	?	$this->Data->escData(trim($_POST["DisplayName"]))	:	false;	#0
			$UserID			=	isset($_POST["UserID"])			?	$this->Data->escData(trim($_POST["UserID"]))		:	false;	#1
			$Password		=	isset($_POST["Password"])		?	$this->Data->escData(trim($_POST["Password"]))		:	false;	#2
			$c_Password		=	isset($_POST["c_Password"])		?	$this->Data->escData(trim($_POST["c_Password"]))	:	false;	#3
			$Referer		=	isset($_POST["Referer"])		?	$this->Data->escData(trim($_POST["Referer"]))		:	false;	#4
			# PERSONAL
			$DOB			=	isset($_POST["DOB"])			?	$this->Data->escData(trim($_POST["DOB"]))			:	false;	#5
			$Gender			=	isset($_POST["Gender"])			?	$this->Data->escData(trim($_POST["Gender"]))		:	false;	#6
			$SecQuestion	=	isset($_POST["SecQuestion"])	?	$this->Data->escData(trim($_POST["SecQuestion"]))	:	false;	#7
			$SecAnswer		=	isset($_POST["SecAnswer"])		?	$this->Data->escData(trim($_POST["SecAnswer"]))		:	false;	#8
			$EMail			=	isset($_POST["EMail"])			?	$this->Data->escData(trim($_POST["EMail"]))			:	false;	#9
			# TOS
			$Checkbox		=	isset($_POST["Checkbox"])		?	$this->Data->escData(trim($_POST["Checkbox"]))		:	false;	#10
			# MISC
			$UserIP			=	$this->Browser->UserIP;																				#11
			$VerifyKey		=	isset($_GET["VerifyKey"])		?	$this->Data->escData(trim($_GET["VerifyKey"]))		:	false;	#12 delete && update array
			$ActivationKey	=	$this->Data->rand_str();																			#13
			$ResendURI		=	$this->Lang->LANG_URL().'?'.$this->Setting->PAGE_PREFIX.'=ResendValidation&Key='.$ActivationKey;	#14
			$ValidateURI	=	$this->Lang->LANG_URL().'?'.$this->Setting->PAGE_PREFIX.'=Validate&Key='.$ActivationKey;			#15

			$_SESSION["REG_TEXT"]	=	array(0=>$DisplayName,1=>$UserID,2=>$Password,3=>$c_Password,4=>$Referer,5=>$DOB,6=>$Gender,7=>$SecQuestion,8=>$SecAnswer,9=>$EMail,10=>$Checkbox,11=>$UserIP,12=>$VerifyKey,13=>$ActivationKey,14=>$ResendURI,15=>$ValidateURI);
			$RegInfo = $_SESSION["REG_TEXT"];

			if($this->Setting->DEBUG === "1"){
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
							echo 'VerifyKey: '.$RegInfo[12].'<br>';
							echo 'ActivationKey: '.$RegInfo[13].'<br>';
							echo 'ResendURI: '.$RegInfo[14].'<br>';
							echo 'ValidateURI: '.$RegInfo[15].'<br>';

						#	echo $this->MailSys->get_messages(0,$RegInfo);
						echo '</pre>';
					echo '</div>';
				echo '</div>';
			}

			# Validate username
			if(empty($UserID)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x01';
			}elseif(strlen($UserID) < 3 || strlen($UserID) > 16){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x02';
			}elseif(ctype_alnum($UserID) === false){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x03';
			}
			# DisplayName
			if(empty($DisplayName)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x05';
			}
			# Validate Passwords
			if(empty($Password)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x06';
			}elseif(strlen($Password) < 3 || strlen($Password) > 16){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x07';
			}elseif($Password != $c_Password){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x08';
			}
			# Date of Birth
			if(empty($DOB)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x09';
			}
			# Gender
			if(empty($Gender)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x10';
			}
			# Validate Email
			if(empty($EMail)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x11';
			}elseif(!filter_var($EMail,FILTER_VALIDATE_EMAIL)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x12';
			}
			# Validate Checkbox
			if(!isset($_POST['Checkbox']) || empty($_POST["Checkbox"])){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x16';
			}

#			echo 'Err Cnt: '.count($_SESSION["MESSAGES"]['type']);
#			die();

			# Submit Information To Database
			if(count($_SESSION["MESSAGES"]['type']) < 1){
				echo 'in err check zone';
				# Shaiya Account Registration
				$REG_USER = $this->SQL->REGISTER_USER_GAME($RegInfo[1],$RegInfo[2],$RegInfo[9],$RegInfo[11]);
#				if(!$REG_USER){
#					$_SESSION["MESSAGES"]["type"][].='3';
#					$_SESSION["MESSAGES"]["head"][].='0';
#					$_SESSION["MESSAGES"]["body"][].='R-0x17';
					#die();
#				}else{
#					$_SESSION["MESSAGES"]["type"][].='3';
#					$_SESSION["MESSAGES"]["head"][].='0';
#					$_SESSION["MESSAGES"]["body"][].='R-0x18';
#				}
#				echo 'passed reg_user';

				# Standard Web Account Registration
				$REG_WEB = $this->SQL->REGISTER_USER_WEB($RegInfo[1],$RegInfo[0],$RegInfo[5],$RegInfo[6],$RegInfo[4],$RegInfo[7],$RegInfo[8],$RegInfo[12],$RegInfo[13]);
				if(!$REG_WEB){
					$_SESSION["MESSAGES"]["type"][].='3';
					$_SESSION["MESSAGES"]["head"][].='0';
					$_SESSION["MESSAGES"]["body"][].='R-0x19';
				}
				else{
					$_SESSION["MESSAGES"]["type"][].='3';
					$_SESSION["MESSAGES"]["head"][].='0';
					$_SESSION["MESSAGES"]["body"][].='R-0x20';
				}

				echo 'passed reg_web';
#				if($REG_USER && $REG_WEB){
				if($REG_WEB){
					header('location: ?'.$this->Setting->PAGE_PREFIX.'=REGISTRATION_COMPLETE&Valid=true');
				}

	/*			# Send Registration E-Mail
				$MAIL_FOR	=	"register";
				$MAIL		=	new PHPMailer(true);
				$this->MailSys->do_SendMail($MAIL,$MAIL_FOR,$RegInfo);

				if(!$MAIL->Send()){
					$_SESSION["MESSAGES"]["type"][].='3';
					$_SESSION["MESSAGES"]["head"][].='0';
					$_SESSION["MESSAGES"]["body"][].='R-0x19';
					echo '<pre>';
						echo "Mailer Error: ".$MAIL->ErrorInfo;
					echo '</pre>';
				}
				else{
					$_SESSION["MESSAGES"]["type"][].='0';
					$_SESSION["MESSAGES"]["head"][].='0';
					$_SESSION["MESSAGES"]["body"][].='R-0x18';

					header('location: ?'.$this->Setting->PAGE_PREFIX.'=REGISTRATION_COMPLETE&Valid=true');
				}
*/
			}
			else{
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x20';
			}
		}
	}