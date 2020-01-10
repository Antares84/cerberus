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

	die();
	echo dirname(__FILE__);
	echo '<form class="edit_page">';
		echo '<input class="form-control" id="RowID" name="RowID" type="hidden" value="'.$RowID.'" readonly/>';

		echo '<div class="form-group row">';
			echo '<label for="Input-DESC" class="col-sm-4 col-form-label tar">Description</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="DESC" name="DESC" type="text" value="'.$DESC.'" readonly/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-VALUE" class="col-sm-4 col-form-label tar">Value</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="VALUE" name="VALUE" type="text" value="'.$VALUE.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<button type="button" class="btn btn-warning center-block" id="edit_page"><i class="fa fa-check-circle"></i> Update Setting</button>';
	echo '</form>';

	echo '<script charset="utf-8" type="text/javascript" src="'.dirname(__FILE__).'js/acct_ban.js"></script>';
?>