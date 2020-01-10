<?php
	require_once('../Autoloader.php');

	$db			=	new Database();
	$Browser	=	new Browser();
	$Data		=	new Data($db);
	$Setting	=	new Setting($db);
	$User		=	new User($Browser,$Data,$db,$Setting);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
	}
	if($Setting->DEBUG === "2"){
		die();
	}

	if(isset($_POST["Title"]) && !empty($_POST["Title"])){
		$sql	=	('
						INSERT INTO '.$db->get_TABLE("JOURNAL").'
							(MemberID,Title,Detail)
						VALUES
							(?,?,?)
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($User->MemberID,$_POST["Title"],$_POST["Text"]);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success btn-lg center-block"><i class="fa fa-info-circle"></i> Jornal entry saved successfully.</button>';
		}else{
			echo '<button class="btn btn-danger btn-lg center-block"><i class="fa fa-info-circle"></i> Journal entry save failed.</button>';
		}
	}
?>