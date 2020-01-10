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

	if(isset($_POST['id'])){
		$sql	=	('DELETE FROM '.$db->get_TABLE("JOURNAL").' WHERE RowID=?');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($_POST['id']);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success btn-lg center-block"><i class="fa fa-info-circle"></i> Account information successfully updated.</button>';
		}else{
			echo '<button class="btn btn-danger btn-lg center-block"><i class="fa fa-info-circle"></i> Account information update failed.</button>';
		}
	}
?>