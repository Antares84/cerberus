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
		$RowID			=	isset($_POST["RowID"])			?	trim($_POST["RowID"])			:	false;
		$PLUGIN_ORDER	=	isset($_POST["PLUGIN_ORDER"])	?	trim($_POST["PLUGIN_ORDER"])	:	false;
		$PLUGIN_ENABLE	=	isset($_POST["PLUGIN_ENABLE"])	?	trim($_POST["PLUGIN_ENABLE"])	:	false;

		$sql	=	('
						UPDATE '.$db->get_TABLE("SETTINGS_PLUGINS").'
						SET [PLUGIN_ORDER]=?,[PLUGIN_ENABLED]=?
						WHERE [RowID]=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($PLUGIN_ORDER,$PLUGIN_ENABLE,$RowID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success center-block"><i class="fa fa-info-circle"></i> Plugin successfully updated.</button>';
		}else{
			echo '<button class="btn btn-danger center-block"><i class="fa fa-info-circle"></i> Plugin update failed.</button>';
		}
	}
	else{
		echo 'Unable to locate RowID in post data!';
		die();
	}
?>