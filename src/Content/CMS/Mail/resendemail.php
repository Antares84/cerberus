<?php
	require_once($this->Plugins->get_PHPMailer_DIR().'PHPMailerAutoload.php');

	$Key	=	isset($_GET["Key"])	?	trim($_GET["Key"])	:	'';

	if(empty($Key)){
		$MSNGR["MESSAGES"]["type"][].='0';
		$MSNGR["MESSAGES"]["body"][].='R-0x01';
	}elseif(isset($Key) && !empty($Key)){
		# Load Messenger Array
		if(isset($MSNGR["MESSAGES"])){unset($MSNGR["MESSAGES"]);$MSNGR["MESSAGES"] = $this->Messenger->Init_Messenger();}
		elseif(!isset($MSNGR["MESSAGES"])){$MSNGR["MESSAGES"] = $this->Messenger->Init_Messenger();}

		$sql	=	"SELECT * FROM ".$this->db->get_TABLE('SH_USERDATA')." WHERE RecoveryKey = ?";
		$stmt	=	odbc_prepare($this->db->conn,$sql);
		$args	=	array($Key);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			while($data = odbc_fetch_array($stmt)){
				$UserID					=	$data["UserID"];
				$this->Messenger->text0	=	$data["UserID"];
				$Password				=	$data["PwPlain"];
				$this->Messenger->text1	=	$data["PwPlain"];
				$Email					=	$data["Email"];
				$this->Messenger->text2	=	$data["Email"];
				$activationKey			=	$data["RecoveryKey"];
				$this->Messenger->text3	=	$data["RecoveryKey"];
			}

			# Resend Registration Validation E-Mail
			$mail_for = "resend";
			require_once("mail.php");
			if($mail->Send()) {
				$MSNGR["MESSAGES"]["type"][].='3';
				$MSNGR["MESSAGES"]["body"][].='R-0x20';
			}else{
				$MSNGR["MESSAGES"]["type"][].='0';
				$MSNGR["MESSAGES"]["body"][].='R-0x18';
			}
		}else{}
	}
	# Content
	echo '<div class="title">'.$this->Lang->get_LANG_SITE_TITLE().' Registration</div>';
	if(isset($MSNGR["MESSAGES"])){
		echo $this->Messenger->get_Messenger_Display($MSNGR["MESSAGES"]);
		$this->Messenger->get_Messenger_Close($MSNGR["MESSAGES"]);
	}
?>