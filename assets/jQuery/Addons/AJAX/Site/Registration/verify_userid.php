<?php
	require_once('../../Autoloader.php');

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
	$MailSys	=	new MailSys($db,$Setting,$User);
	$Session	=	new Session($db,$Browser,$Setting,$User);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST["UserID"]) && !empty($_POST["UserID"])){
		# Shaiya
#		$sql	=	('
#						SELECT UserID
#						FROM '.$db->get_TABLE("SH_USERDATA").'
#						WHERE UserID=?
#		');

		# Standard
		$sql	=	('
						SELECT UserID
						FROM '.$db->get_TABLE("WEB_PRESENCE").'
						WHERE UserID=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($_POST["UserID"]);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			if(odbc_num_rows($stmt) < 1){
				$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> UserID is available!');
			}
			else{
				$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> UserID is unavailable. Please choose a different UserID.');
			}
		}else{
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Unable to check UserID. This is a problem...');
		}
	}
	else{
		$Tpl->_do_alert('3','AJAX-0x02');
	}
?>