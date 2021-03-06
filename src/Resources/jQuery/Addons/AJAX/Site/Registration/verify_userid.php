<?php
	define('IN_CMS',true);
	require_once('../../Autoloader.php');

	$Arrays		=	new classes\base\Arrays;
	$db			=	new classes\db\Database();
	$Browser	=	new classes\utils\Browser();
	$Select		=	new classes\display\Select();

	$Data		=	new classes\utils\Data($db);
	$Colors		=	new classes\utils\Colors($db);

	$Tooltips	=	new classes\utils\Tooltips($Colors);
	$Dirs		=	new classes\base\Dirs($Arrays);
	$Theme		=	new classes\settings\Theme($Arrays,$db,$Dirs);
	$Messenger	=	new classes\utils\Messenger($Browser);
	$Style		=	new classes\settings\Style($Arrays,$db,$Dirs,$Theme);
	$Tpl		=	new classes\utils\Template($Colors,$Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new classes\settings\Settings($Arrays,$db);
	$User		=	new classes\utils\User($Browser,$Data,$db,$Setting);
	$MailSys	=	new classes\sys\MailSys($db,$Setting,$User);
	$Session	=	new classes\utils\Session2($db,$Browser,$Setting,$SQL,$User);

	if($Setting->_arr["DEBUG"] === "1" || $Setting->_arr["DEBUG"] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->_arr["DEBUG"] === "2"){
			die();
		}
	}

	if(isset($_POST["UserID"]) && !empty($_POST["UserID"])){
		# Standard
		$sql	=	('
						SELECT UserID
						FROM '.$db->_table_list("WEB_PRESENCE").'
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