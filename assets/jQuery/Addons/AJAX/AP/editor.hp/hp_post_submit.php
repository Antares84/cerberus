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

	if(isset($_POST) && !empty($_POST)){
		$titleAdd	=	isset($_POST['titleAdd'])	?	$Data->escData(trim(htmlentities($_POST['titleAdd'])))	:	false;
		$mce_0		=	isset($_POST['mce_0'])		?	$Data->escData(trim(htmlentities($_POST['mce_0'])))		:	false;

		$sql	=	('
						INSERT INTO '.$db->get_TABLE("HOMEPAGE").'
							(Title,Detail)
						VALUES
							(?,?)
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($titleAdd,$mce_0);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> Post submitted successfully.');
		}
		else{
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Post submission failed.');
		}
	}
?>