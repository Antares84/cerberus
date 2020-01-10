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
	$Theme		=	new Theme($Arrays,$db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($Arrays,$db,$Dirs,$Theme);
	$Tooltips	=	new Tooltips($Colors);
	$Tpl		=	new Template($Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);
	$SQL		=	new SQL($Arrays,$Colors,$Data,$db,$Setting,$Tpl,$User);

	$Edit_Arr	=	array(0=>1,1=>0);

	list($RowID,$EDIT,$DB) = explode("~",$_POST['id']);

#	if($Setting->_array[12] === "1" || $Setting->_array[12] === "2"){
		echo '<pre>';
			echo var_dump($_POST).'<br>';

			echo 'RowID Value: '.$RowID.'<br>';
			echo 'Edit Value:  '.$EDIT.'<br>';
			echo 'DB Value:    '.$DB;
		echo '</pre>';

		if($Setting->_array[12] === "2"){
			die();
		}
#	}

	if(isset($_POST["id"])){
		if($EDIT == "0"){
			$sql	=	('
							UPDATE '.$db->_table_list($DB).'
							SET EDIT=?
							WHERE RowID=?
			');
			$stmt	=	odbc_prepare($db->conn,$sql);
			$args	=	array(1,$RowID);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> Setting successfully unlocked.');
			}else{
				$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Setting un-lock failed.');
			}
		}
		if($EDIT == "1"){
			$sql	=	('
							UPDATE '.$db->_table_list($DB).'
							SET EDIT=?
							WHERE RowID=?
			');
			$stmt	=	odbc_prepare($db->conn,$sql);
			$args	=	array(0,$RowID);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$Tpl->BADGE_AJAX('badge-success','<i class="fa fa-info-circle"></i> Setting successfully locked.');
			}else{
				$Tpl->BADGE_AJAX('badge-danger','<i class="fa fa-info-circle"></i> Setting un-lock failed.');
			}
		}
	}
?>