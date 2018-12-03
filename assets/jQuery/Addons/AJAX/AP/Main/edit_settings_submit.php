<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Template	=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Template);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST["RowID"])){
		$RowID	=	isset($_POST["RowID"])	?	trim($_POST["RowID"])	:	false;
		$VALUE	=	isset($_POST["VALUE"])	?	trim($_POST["VALUE"])	:	false;

		$sql	=	('
						UPDATE '.$db->get_TABLE("SETTINGS_MAIN").'
						SET VALUE=?
						WHERE RowID=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($VALUE,$RowID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="badge badge-success text-center w_100_p f_20"><i class="fa fa-info-circle"></i> Setting successfully updated.</button>';
		}
		else{
			echo '<button class="badge badge-danger text-center w_100_p f_20"><i class="fa fa-info-circle"></i> Setting update failed.</button>';
		}
	}
?>