<?php
	require_once('../../Autoloader.php');

	$Arrays		=	new Arrays();
	$Browser	=	new Browser();
	$Dirs		=	new Dirs();
	$db			=	new Database();
	$Select		=	new Select();

	$Data		=	new Data($db);
	$Theme		=	new Theme($db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($db,$Dirs,$Theme);
	$Tpl		=	new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);
	$SQL		=	new SQL($Data,$db,$Setting,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST)){
		if(isset($_POST["RowID"])){
			$RowID	=	isset($_POST["RowID"])	?	trim($_POST["RowID"])	:	false;
		}
		else{
			echo 'Unable to locate setting ID';
			exit;
		}

		if(isset($_POST["ENABLE"])){
			$VALUE	=	isset($_POST["ENABLE"])	?	trim($_POST["ENABLE"])	:	false;
		}
		elseif(isset($_POST["VALUE"])){
			$VALUE	=	isset($_POST["VALUE"])	?	trim($_POST["VALUE"])	:	false;
		}
		else{
			echo 'Unable to locate new setting value';
			exit;
		}

		$sql	=	('
						UPDATE '.$db->get_TABLE("SETTINGS_THEME").'
						SET VALUE=?
						WHERE RowID=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($VALUE,$RowID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> Setting successfully updated.');
		}else{
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Setting update failed.');
		}
	}
?>