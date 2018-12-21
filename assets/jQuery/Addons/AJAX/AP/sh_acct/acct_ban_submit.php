<?php
	require_once('../../Autoloader.php');

	$Browser	=	new Browser();
	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($db,$Theme);
	$Tpl		=	new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST["RowID"])){
		$RowID			=	isset($_POST["RowID"])	?	trim($_POST["RowID"])	:	false;
		$VALUE			=	isset($_POST["VALUE"])	?	trim($_POST["VALUE"])	:	false;

		$sql	=	('UPDATE '.$db->get_TABLE("ACP_LANG").' SET VALUE=? WHERE RowID=?');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($VALUE,$RowID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success btn-lg" style="width:100%;"><i class="fa fa-info-circle"></i> Style data successfully updated.</button>';
		}else{
			echo '<button class="btn btn-danger btn-lg" style="width:100%;"><i class="fa fa-info-circle"></i> Style data update failed.</button>';
		}
	}else{
		echo 'Unable to locate RowID in post data!';
		die();
	}
?>