<?php
	require_once('../../Autoloader.php');

	$Browser=new Browser();$db=new Database();$Select=new Select();$Data=new Data($db);$Theme=new Theme($db);$Messenger=new Messenger($Browser);$Style=new Style($db,$Theme);$Tpl=new Template($Data,$Messenger,$Select,$Style,$Theme);$Setting=new Setting($Data,$db,$Tpl);

	$Edit_Arr	=	array(0=>1,1=>0);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	list($RowID,$EDIT) = explode("~",$_POST['id']);

	if(isset($_POST["id"])){
		if($EDIT === "0"){
			$sql	=	('
							UPDATE '.$db->get_TABLE("SETTINGS_THEME").'
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
		if($EDIT === "1"){
			$sql	=	('
							UPDATE '.$db->get_TABLE("SETTINGS_THEME").'
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