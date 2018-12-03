<?php
	# STRIP .PHP EXT
	$phpEx = substr(strrchr(__FILE__,'.'),1);

	# INIT AUTOLOADER
	require('autoloader.php');
	$db				=	new Database();

	$Browser		=	new Browser();
	$Data			=	new Data($db);
	$Colors			=	new Colors($db);
	$Lang			=	new Lang($db);
	$Theme			=	new Theme($db);
	$Setting		=	new Setting($db);

	$Style			=	new Style($db,$Theme);
	$Plugins		=	new Plugins($db,$Setting,$Style,$Colors);
	$User			=	new User($Browser,$Data,$db,$Setting);
	$Messenger		=	new Messenger($User,$Browser,$Lang);
	$PayPal			=	new PayPal($db,$Lang,$Plugins,$Setting);
	$MailSys		=	new MailSys($db,$Setting,$Lang,$Messenger,$User);
	$Read			=	new Readable($db,$PayPal);

	# Set this to true to use the sandbox endpoint during testing:
	$enable_sandbox		=	$db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_SANDBOX");
	# Use this to specify all of the email addresses that you have attached to paypal:
	$my_email_addresses = array();
	$acp_email_1		=	$db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_EMAIL_1");
	$acp_email_2		=	$db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_EMAIL_2");
	$acp_email_3		=	$db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_EMAIL_3");
	# Set Valid PayPal Email Addresses
	if(isset($acp_email_1)){$my_email_addresses = array($acp_email_1);}
	if(isset($acp_email_2)){$my_email_addresses = array($acp_email_1,$acp_email_2);}
	if(isset($acp_email_3)){$my_email_addresses = array($acp_email_1,$acp_email_2,$acp_email_3);}
	# Set this to true to send a confirmation email:
	$send_conf_email	=	$db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_CONF_EMAIL");
	# Set this to true to save a log file:
	$save_log_file		=	$db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_LOG_TO_FILE");
	# Log file directory(relative to plugin folder)
	$log_file_dir		=	$db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_LOG_DIR");
	# Set this to true to save to database
	$save_log_db		=	$db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_LOG_TO_DB");

	$db_res		=	"";
	$p_res		=	"";
	$email_res	=	"";
	$data_text	=	"";
	$test_text 	=	"";

	if($enable_sandbox === "true"){
		$PayPal->useSandbox();
	}

	$verified = $PayPal->verifyIPN();

	foreach($_POST as $key=>$value){
		$data_text .= $key." = ".$value."\r\n";
	}

	if($_POST["test_ipn"] == 1){
		$test_text = "Test ";
	}

	# Check the receiver email to see if it matches your list of paypal email addresses
	$receiver_email_found = false;
	foreach($my_email_addresses as $a){
		if(strtolower($_POST["receiver_email"]) == strtolower($a)){
			$receiver_email_found = true;
			break;
		}
	}

	list($year,$month,$day,$hour,$minute,$second,$timezone)=explode(":",date("Y:m:d:H:i:s:T"));
	$date				=	$year."-".$month."-".$day;
	$log_time			=	$hour."_".$minute."_".$second;
	$timestamp			=	$date." ".$hour.":".$minute.":".$second." ".$timezone;
	$dated_log_file_dir	=	$log_file_dir."/".$year."/".$month."-".$day."-".$year;

	$paypal_ipn_status = "VERIFICATION FAILED";
	if($verified){
		$paypal_ipn_status = "RECEIVER EMAIL MISMATCH - E-mail A MUST Be Receiver E-mail!";
		if($receiver_email_found){
			$paypal_ipn_status = "Completed Successfully";

			// Process IPN
			// A list of variables are available here:
			// https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
			$Payment_Status = $_POST['payment_status'];
			if(
				$Payment_Status === "Canceled_Reversal" ||
				$Payment_Status === "Created" ||
				$Payment_Status === "Denied" ||
				$Payment_Status === "Failed" ||
				$Payment_Status === "Pending" ||
				$Payment_Status === "Processed" ||
				$Payment_Status === "Completed"
			){

				list($RewardID,$UserUID) = explode("_",$_POST['item_number']);
				$Reward			=	$db->do_QUERY("Reward","DONATE_OPTIONS","RowID",$RewardID);
				$Payer_Email	=	$_POST['payer_email'];
				$Payment_Type	=	$_POST['payment_type'];
				$Price			=	$_POST["mc_gross"];
				$Txn_ID			=	$_POST['txn_id'];
				$UserID			=	$db->do_QUERY("UserID","SH_USERDATA","UserUID",$UserUID);
				$UserPoint		=	$db->do_QUERY("Point","SH_USERDATA","UserUID",$UserUID);
				$Verify_Key		=	$_POST['verify_sign'];

				if($save_log_db == true){
					$sql	=	("INSERT INTO ".$db->get_TABLE("LOG_PAYMENTS")."
									(UserID,Paid,Reward,DonatorEmail,PaymentStatus,TransID,TransValidationKey,PaymentType)
								VALUES
									(?,?,?,?,?,?,?,?)"
								);
					$stmt	=	odbc_prepare($db->conn,$sql);
					$args	=	array($UserID,$Price,$Reward,$Payer_Email,$Payment_Status,$Txn_ID,$Verify_Key,$Payment_Type);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						$db_res	=	'Payment inserted.';
					}

					$addPoints		=	$UserPoint + $Reward;
					$insertPoints	=	("UPDATE ".$db->get_TABLE("SH_USERDATA")." SET Point=? WHERE UserUID=?");
					$stmt			=	odbc_prepare($db->conn,$insertPoints);
					$args			=	array($addPoints,$UserUID);
					$prep			=	odbc_execute($stmt,$args);
					
					if($prep){
						$p_res = 'Points added.';
					}
				}
				if($send_conf_email){
					require_once('../PHPMailer/PHPMailerAutoload.php');
					$mail_for = "donate_debug";
					require_once("mail.php");

					if($mail->Send()){
						$email_res = 'Confirmation email sent.';
					}
				}
			}
		}else{}
	}elseif($enable_sandbox === ""){
		if($_POST["test_ipn"] != 1){
			$paypal_ipn_status = "RECEIVED FROM LIVE WHILE SANDBOXED";
		}
	}elseif($_POST["test_ipn"] == 1){
		$paypal_ipn_status = "RECEIVED FROM SANDBOX WHILE LIVE";
	}
	if($save_log_file){
		// Create log file directory
		if(!is_dir($dated_log_file_dir)){
			if(!file_exists($dated_log_file_dir)){
				mkdir($dated_log_file_dir, 0777, true);
				if(!is_dir($dated_log_file_dir)){
					$save_log_file = false;
				}
			}else{
				$save_log_file = false;
			}
		}
		// Restrict web access to files in the log file directory
		$htaccess_body = "<?php"."\r\n"."You have entered a restricted area."."\r\n"."Access Denied."."\r\n"."?>";
		if($save_log_file && (!is_file($log_file_dir."/index.php") || file_get_contents($log_file_dir . "/index.php") !== $htaccess_body)){
			if(!is_dir($log_file_dir."/index.php")){
				file_put_contents($log_file_dir."/index.php",$htaccess_body);
				if(!is_file($log_file_dir."/index.php") || file_get_contents($log_file_dir."/index.php") !== $htaccess_body){
					$save_log_file = false;
				}
			}else{
				$save_log_file = false;
			}
		}
		# Save data to text file
		if($save_log_file){
			file_put_contents($dated_log_file_dir."/"."paypal_ipn_".$log_time.".txt","paypal_ipn_status=".$paypal_ipn_status."\r\n"."paypal_ipn_date=".$timestamp."\r\n".$data_text."\r\n".$db_res."\r\n".$p_res."\r\n".$email_res."\r\n");
		}
	}
	// Reply with an empty 200 response to indicate to paypal the IPN was received correctly
	header("HTTP/1.1 200 OK");
?>