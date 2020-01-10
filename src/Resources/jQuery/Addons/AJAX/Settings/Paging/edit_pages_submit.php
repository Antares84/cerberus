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
		$RowID				=	isset($_POST["RowID"])				?	trim($_POST["RowID"])				:	false;
		$PAGE_INDEX			=	isset($_POST["PAGE_INDEX"])			?	trim($_POST["PAGE_INDEX"])			:	false;
		$PAGE_URI			=	isset($_POST["PAGE_URI"])			?	trim($_POST["PAGE_URI"])			:	false;
		$PAGE_SHOW			=	isset($_POST["PAGE_SHOW"])			?	trim($_POST["PAGE_SHOW"])			:	false;
		$METATAG_TITLE		=	isset($_POST["METATAG_TITLE"])		?	trim($_POST["METATAG_TITLE"])		:	false;
		$METATAG_DESC		=	isset($_POST["METATAG_DESC"])		?	trim($_POST["METATAG_DESC"])		:	false;
		$METATAG_KEYWORDS	=	isset($_POST["METATAG_KEYWORDS"])	?	trim($_POST["METATAG_KEYWORDS"])	:	false;

		$sql	=	('
						UPDATE '.$db->get_TABLE("SETTINGS_PAGES").'
						SET PAGE_INDEX=?,PAGE_URI=?,PAGE_SHOW=?,METATAG_TITLE=?,METATAG_DESC=?,METATAG_KEYWORDS=?
						WHERE RowID=?'
		);
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($PAGE_INDEX,$PAGE_URI,$PAGE_SHOW,$METATAG_TITLE,$METATAG_DESC,$METATAG_KEYWORDS,$RowID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="badge badge-success text-center w_100_p f_20"><i class="fa fa-info-circle"></i> Page data successfully updated.</button>';
		}else{
			echo '<button class="badge badge-danger text-center w_100_p f_20"><i class="fa fa-info-circle"></i> Page data update failed.</button>';
		}
	}
?>