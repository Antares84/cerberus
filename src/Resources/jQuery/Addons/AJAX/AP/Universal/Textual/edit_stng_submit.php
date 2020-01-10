<?php
	require_once('../../Autoloader.UNI.php');

	$Arrays		=	new Arrays();
	$DirLister	=	new DirectoryLister($Arrays);
	$Browser	=	new Browser();
	$Dirs		=	new Dirs($Arrays);
	$db			=	new Database();
	$Select		=	new Select();

	$Colors		=	new Colors($db);
	$Data		=	new Data($DirLister);
	$Theme		=	new Theme($Arrays,$db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($Arrays,$db,$Dirs,$Theme);
	$Tooltips	=	new Tooltips($Colors);
	$Tpl		=	new Template($Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);
	$SQL		=	new SQL($Arrays,$Colors,$Data,$db,$Setting,$Tpl,$User);

	if($Setting->_array[12] === "1" || $Setting->_array[12] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->_array[12] === "2"){
			die();
		}
	}

	if(isset($_POST["RowID"])){
		$RowID	=	isset($_POST["RowID"])	?	trim($Data->_do('escData',$_POST["RowID"]))	:	false;
		$VALUE	=	isset($_POST["VALUE"])	?	trim($Data->_do('escData',$_POST["VALUE"]))	:	false;
		$DB		=	isset($_POST["DB"])		?	trim($Data->_do('escData',$_POST["DB"]))	:	false;

		$sql	=	('
						UPDATE '.$db->_table_list($DB).'
						SET VALUE=?
						WHERE RowID=?
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($VALUE,$RowID);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> Setting saved.');
		}else{
			$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Update failed.');
		}
	}
?>