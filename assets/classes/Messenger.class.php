<?php
	class Messenger{

		public $msg_arr=array();

		function __construct($Browser){
			$this->Browser	=	$Browser;
		}
		function Init(){
			$_systemMessage				=	array();
			$_systemMessage["type"]		=	array();
			$_systemMessage["head"]		=	array();
			$_systemMessage["body"]		=	array();
			$_systemMessage["footer"]	=	array();

			return $_systemMessage;
		}
		function Display($data){
			$return = false;
			if(isset($data["type"]) && count($data["type"]) > 0){
				for($i=0; $i < count($data["type"]); $i++){
					$return	.=	'<div class="container no_padding">';
						$return	.=	'<div class="row">';
							$return	.=	'<div class="col-md-12">';
								$return	.=	$this->Display_Alert_Type($data["type"][$i]);
								if(isset($data["head"]) && !empty($data["head"])){
									$return	.=	$this->Display_Header_Type($data["head"][$i]);
								}
	//								$return	.=	$this->Display_Header($data["type"][$i],$data["body"][$i]);
									$return	.=	$this->MessagesArr($data["body"][$i]);
								$return	.=	'</div>';
							$return	.=	'</div>';
						$return	.=	'</div>';
					$return	.=	'</div>';
				}
			}
			echo $return;
		}
		function Display_Header_Type($head){
			switch($head){
				case '0':	return '<h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> <strong>Danger!</strong></h4>';	break;
				case '1':	return '<h4 class="alert-heading"><i class="fa fa-info-circle"></i> <strong>Warning</strong></h4>';				break;
				case '2':	return '<h4 class="alert-heading"><i class="fa fa-info-circle"></i> <strong>Notice</strong></h4>';				break;
				case '3':	return '<h4 class="alert-heading"><i class="fa fa-check-circle"></i> <strong>Success</strong></h4>';			break;
			}
		}
		function Display_Alert_Type($type){
			switch($type){
				case '0':
					return '
						<div class="alert badge-danger alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					';
					break;
				case '1':
					return '
						<div class="alert badge-warning alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					';
					break;
				case '2':
					return '
						<div class="alert badge-info alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					';
					break;
				case '3':
					return '
						<div class="alert badge-success alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					';
					break;
			}
		}
		function Display_Header($type,$body){
			switch($type){
				case '0':	return '<legend><font class="red">Error: '.$body.'</font></legend>';		break;
				case '1':	return '<legend><font class="orange">Warning: '.$body.'</font></legend>';	break;
				case '2':	return '<legend><font class="green">Notice: '.$body.'</font></legend>';		break;
				case '3':	return '<legend><font class="green">Success: '.$body.'</font></legend>';	break;
			}
		}
		function MessagesArr($data){
			switch($data){
				# SITE-WIDE MESSAGES
				case 'ERR-0x01':return 'The page you are looking for either doesn\'t exist or has been moved.'; break;
				# LOGIN MSGS - VALIDATION
				case 'SL-0x00':return 'Validating credentials...'; break;
				# LOGIN MSGS - USERNAME
				case 'SL-0x01':return 'A UserID is required. How else would you be able to log in?'; break;
				case 'SL-0x02':return 'Your UserID must be between 3 and 16 characters in length.'; break;
				case 'SL-0x03':return 'Your UserID must consist of numbers and letters only.<br>Special characters are not allowed.'; break;
				case 'SL-0x04':return 'UserID looks good...'; break;
				# LOGIN MSGS - PASSWORD
				case 'SL-0x05':return 'A password is required for all accounts.<br>Please provide a password.'; break;
				case 'SL-0x06':return 'Your password must be between 3 and 16 characters in length.'; break;
				case 'SL-0x07':return 'Your password must consist of numbers and letters only.<br>Special characters are not allowed.'; break;
				case 'SL-0x08':return 'Password looks good...'; break;
				# LOGIN MSGS - SUCCESS
				case 'SL-0x09':return 'So far, so good...'; break;
				case 'SL-0x10':return 'Account located, checking account status...';break;
				case 'SL-0x11':return 'Account status is good, logging you in...';break;
				case 'SL-0x12':return 'Login successful.<br>Loading your homepage now...'; break;
				# LOGIN MSGS - FAIL
				case 'SL-0x13':return 'Well, this is unfortunate. I was unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.'; break;
				case 'SL-0x14':return 'Unfortunately, your status wasn\'t recognized.<br>Login access is denied.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.'; break;
				# LOGIN MSGS - SHAIYA
				case 'SL-0x15':return 'Your account status shows that it has been banned from the game due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a GM or GS.<br>You will be logged in, but with limited usage of our site.'; break;

				# Registration Messages
				# UserID
				case 'R-0x01': return 'Please provide a UserID.'; break;
				case 'R-0x02': return 'UserID must be between 3 and 16 characters in length.'; break;
				case 'R-0x03': return 'UserID must consist of numbers and letters only.'; break;
				case 'R-0x04': return 'UserID already exists, please choose a different UserID.'; break;
				# DisplayName
				case 'R-0x05': return 'Please provide a display name for others to see.'; break;
				# Password
				case 'R-0x06': return 'Please provide a password.'; break;
				case 'R-0x07': return 'Password must be between 3 and 16 characters in length.'; break;
				case 'R-0x08': return 'Passwords do not match.'; break;
				# Date of Birth
				case 'R-0x09': return 'Please provide a Date of birth.'; break;
				# Gender
				case 'R-0x10': return 'Please provide your Gender.'; break;
				# E-Mail
				case 'R-0x11': return 'Please provide your e-mail.'; break;
				case 'R-0x12': return 'Invalid e-mail format'; break;
				case 'R-0x13': return 'The e-mail address provided has already been used. Please choose a different e-mail address.'; break;
				# Security Q & A
				case 'R-0x14': return 'Please provide a Security Question.'; break;
				case 'R-0x15': return 'Please provide a Security Answer.'; break;
				# ToS
				case 'R-0x16': return 'You must agree to our Terms Of Use to register.'; break;
				# Validation - User
				case 'R-0x17': return 'Game account creation has failed. Please contact an admin for assistance.'; break;
				case 'R-0x18': return 'Your account, <font class="b_i">'.$_SESSION["REG_TEXT"][1].',</font> has been successfully created!'; break;
				# Validation - Web
				case 'R-0x19': return 'Web account creation has failed. Please contact an admin for assistance.'; break;
				case 'R-0x20': return 'Your web account, <font class="b_i">'.$_SESSION["REG_TEXT"][0].' for '.$_SESSION["REG_TEXT"][1].',</font> has been successfully created!'; break;
				# Validation - Email
				case 'R-0x21': return 'Verification e-mail failed to send to the e-mail that you provided. Please contact an administrator for further assistance.'; break;
				case 'R-0x22': return 'A verification email has been sent to <font class="b_i">'.$_SESSION["REG_TEXT"][9].'</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.'; break;
				# Resend
				case 'R-0x23': return 'A verification email has been resent to <font class="b_i">'.$_SESSION["REG_TEXT"][9].'</font> with an activation key for the account <font class="b_i">'.$_SESSION["REG_TEXT"][1].'</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.<br>Still didn\'t receive the e-mail? Contact an administrator for further assistance.'; break;

				# Misc
				case 'M-0x01': return 'I see that you\'re new here. You must <strong>Register</strong> in order to view the rest of <font class="b_i">My Domain</font>.<br>If you already have an account, you can update it by clicking <strong><a href="javascript:;" class="open_acct_reset_modal" data-id="UserIP~'.$this->Browser->UserIP.'" data-target="#acct_reset_modal" data-toggle="modal">here</a></strong>'; break;
				case 'M-0x02': return 'Welcome back, <strong>'.$this->User->UserID.'</strong>.<br>Please <strong>Log In</strong> and enjoy your stay here at <font class="b_i">'.$this->Setting->SITE_TITLE().'</font>.'; break;

				# ACP E-Mail Test System
				case "EM-0x01": return "Check the receiver e-mail for the message you just sent.<br>";break;
				case "EM-0x02": return "<br>";break;
				case "EM-0x03": return "<br>";break;
				case "EM-0x04": return "<br>";break;
				case "EM-0x05": return "Validation email failed to send. Contact an administrator.<br>";break;

				# AJAX Error Message
				case "AJAX-0x01": return 'You have to at least enter some letters for a Display name...';break;
				case "AJAX-0x02": return 'What, too good to enter a Username that you\'d like to have?';break;
				default			: return $data;break;
			}
		}
		function Close(){
			unset($CMS_MSGS);
			unset($_SESSION["MESSAGES"]);
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
?>