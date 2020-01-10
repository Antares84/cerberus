<?php
	require_once('../Autoloader.php');

	$Arrays		=	new Arrays;
	$db			=	new Database();
	$Browser	=	new Browser();
	$DirLister	=	'';
	$Data		=	new Data($DirLister);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);

	if($Setting->_array["DEBUG"] === "1" || $Setting->_array["DEBUG"] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
	}
	if($Setting->_array["DEBUG"] === "2"){
		die();
	}

	if(isset($_POST["Title"]) && !empty($_POST["Title"])){
		$sql	=	('
						INSERT INTO '.$db->_table_list("JOURNAL").'
							(MemberID,Title,Detail)
						VALUES
							(?,?,?)
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($User->_get_data("MemberID"),$_POST["Title"],$_POST["Text"]);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success btn-lg center-block"><i class="fa fa-info-circle"></i> Jornal entry saved successfully.</button>';
		}else{
			echo '<button class="btn btn-danger btn-lg center-block"><i class="fa fa-info-circle"></i> Journal entry save failed.</button>';
		}
	}
?>