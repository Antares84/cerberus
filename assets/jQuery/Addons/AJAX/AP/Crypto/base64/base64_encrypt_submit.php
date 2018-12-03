<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Template	=	new Template($Data,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Template);
	$db			=	new Database();

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

#	echo var_dump($_POST);
#	die();

	if(isset($_POST["Text"]) && !empty($_POST["Text"])){
		echo '<form>';
			echo '<div class="form-group row">';
				echo '<div class="col-sm-12">';
					echo '<div class="input-group">';
						echo '<div class="input-group-addon b_i"><i class="fa fa-info-circle"></i></div>';
						echo '<input type="text" class="form-control b_i" value="'.$Data->urlsafe_b64encode($_POST["Text"]).'" readonly/>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</form>';
	}
?>