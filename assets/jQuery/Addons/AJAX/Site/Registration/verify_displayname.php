<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Tpl		=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST["DisplayName"])){
		$sql	=	('
						SELECT DisplayName
						FROM '.$db->get_TABLE("WEB_PRESENCE").'
						WHERE DisplayName=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($_POST["DisplayName"]);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			if(odbc_num_rows($stmt) < 1){
				$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i>DisplayName is available!');
			}
			else{
				$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i>DisplayName is unavailable. Please choose a different DisplayName.');
			}
		}else{
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Unable to check DisplayName. This is a problem...');
		}
	}
?>