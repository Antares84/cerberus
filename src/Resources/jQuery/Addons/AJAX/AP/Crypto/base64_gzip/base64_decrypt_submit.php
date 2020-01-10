<?php
	require_once('Autoloader.class.php');

	$Data		=	new Data();

#	echo var_dump($_POST);
#	die();

	if(isset($_POST["Text"]) && !empty($_POST["Text"])){
		echo '<form>';
			echo '<div class="form-group row">';
				echo '<div class="col-sm-12">';
					echo '<div class="input-group">';
						echo '<div class="input-group-addon b_i"><i class="fa fa-info-circle"></i></div>';
						echo '<input type="text" class="form-control b_i" value="'.$Data->urlsafe_b64decode($_POST["Text"]).'" readonly/>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</form>';
	}
?>