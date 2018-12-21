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

	if(isset($_POST["id"])){
		$sql	=	('
						DELETE FROM '.$db->get_TABLE("HOMEPAGE").'
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