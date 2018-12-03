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

	if(isset($_POST["RowID"])){
		$RowID			=	isset($_POST["RowID"])		?	trim($_POST["RowID"])		:	false;
		$PAGE_INDEX		=	isset($_POST["PAGE_INDEX"])	?	trim($_POST["PAGE_INDEX"])	:	false;
		$PAGE_URI		=	isset($_POST["PAGE_URI"])	?	trim($_POST["PAGE_URI"])	:	false;
		$PAGE_SHOW		=	isset($_POST["PAGE_SHOW"])	?	trim($_POST["PAGE_SHOW"])	:	false;
		$REQ_LOGIN		=	isset($_POST["REQ_LOGIN"])	?	trim($_POST["REQ_LOGIN"])	:	false;

		$sql	=	('
						UPDATE '.$db->get_TABLE("SETTINGS_PAGES").'
						SET PAGE_INDEX=?,
							PAGE_URI=?,
							PAGE_SHOW=?,
							REQ_LOGIN=?
						WHERE RowID=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($PAGE_INDEX,$PAGE_URI,$PAGE_SHOW,$REQ_LOGIN,$RowID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> Page data successfully updated.');
		}else{
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Page data update failed.');
		}
	}
?>