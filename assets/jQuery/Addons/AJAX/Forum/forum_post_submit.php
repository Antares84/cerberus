<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Setting	=	new Setting($db);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if($_POST["TopicTitle"]){
		$sql	=	('
						INSERT INTO '.$db->get_TABLE("FORUM").'
							(MemberID,TopicTitle,TopicBody)
						VALUES
							(?,?,?)
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($_POST["MemberID"],$_POST["TopicTitle"],$_POST["TopicBody"]);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success btn-lg center-block"><i class="fa fa-info-circle"></i> Topic successfully submitted.</button>';
		}else{
			echo '<button class="btn btn-danger btn-lg center-block"><i class="fa fa-info-circle"></i> Topic submission failed.</button>';
		}
	}else{
		echo 'Unable to locate a title in post data!';
		die();
	}
?>