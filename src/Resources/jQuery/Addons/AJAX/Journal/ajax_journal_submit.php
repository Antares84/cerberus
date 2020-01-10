<?php
	require_once('../Autoloader.php');

	$db			=	new Database();
	$Setting	=	new Setting($db);

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
							(Title,Text)
						VALUES
							(?,?)
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($_POST["Title"],$_POST["Text"]);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success btn-lg center-block"><i class="fa fa-info-circle"></i> Jornal entry saved successfully.</button>';
		}else{
			echo '<button class="btn btn-danger btn-lg center-block"><i class="fa fa-info-circle"></i> Journal entry save failed.</button>';
		}
	}
?>