<?php
	require_once('../Autoloader.php');

	$Browser	=	new Browser();
	$db			=	new Database();
	$Data		=	new Data($db);
	$Setting	=	new Setting($db);
	$User		=	new User($Browser,$Data,$db,$Setting);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST["Column"])){
		$Column		=	isset($_POST["Column"])		?	trim($_POST["Column"])		:	false;
		$MemberID	=	isset($_POST["MemberID"])	?	trim($_POST["MemberID"])	:	false;
		$Value		=	isset($_POST["Value"])		?	trim($_POST["Value"])		:	false;

		$sql	=	('UPDATE '.$db->get_TABLE("USER_DATA").' SET '.$Column.'=? WHERE MemberID=?');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($Value,$MemberID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success btn-lg" style="width:100%;"><i class="fa fa-info-circle"></i> Setting successfully updated.</button>';
		}else{
			echo '<button class="btn btn-danger btn-lg" style="width:100%;"><i class="fa fa-info-circle"></i> Setting update failed.</button>';
		}
	}
?>