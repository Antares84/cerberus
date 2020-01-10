<?php
	require_once('../../Autoloader.php');

	$Browser=new Browser();$db=new Database();$Select=new Select();$Data=new Data($db);$Theme=new Theme($db);$Messenger=new Messenger($Browser);$Style=new Style($db,$Theme);$Tpl=new Template($Data,$Messenger,$Select,$Style,$Theme);$Setting=new Setting($Data,$db,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(isset($_POST["RowID"])){
		$RowID=isset($_POST["RowID"])?trim($_POST["RowID"]):false;
		if(isset($_POST["ENABLE"])){
			$VALUE=isset($_POST["ENABLE"])?trim($_POST["ENABLE"]):false;
		}
		else{
			$VALUE=isset($_POST["VALUE"])?trim($_POST["VALUE"]):false;
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