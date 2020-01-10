<?php
	require_once('../../Autoloader.php');

	$Arrays		=	new Arrays();
	$DirLister	=	new DirectoryLister($Arrays);
	$Browser	=	new Browser();
	$Dirs		=	new Dirs($Arrays);
	$db			=	new Database();
	$Select		=	new Select();

	$Colors		=	new Colors($db);
	$Data		=	new Data($DirLister);
	$Theme		=	new Theme($Arrays,$db,$Dirs);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($Arrays,$db,$Dirs,$Theme);
	$Tooltips	=	new Tooltips($Colors);
	$Tpl		=	new Template($Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);
	$SQL		=	new SQL($Arrays,$Colors,$Data,$db,$Setting,$Tpl,$User);

	if($Setting->_array["DEBUG"] === "1" || $Setting->_array["DEBUG"] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->_array["DEBUG"] === "2"){
			die();
		}
	}

	if(isset($_POST["id"])){
		$sql	=	('
						DELETE FROM '.$db->_table_list("HOMEPAGE").'
						WHERE RowID=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($_POST["id"]);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> Post successfully deleted.');
		}
		else{
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Post deletion failed.');
		}
	}
?>