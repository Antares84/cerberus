<?php
	require_once('../../Autoloader.php');

	$Browser	=	new Browser();
	$Dirs		=	new Dirs();
	$db			=	new Database();
	$Select		=	new Select();
	$Table		=	new Table();

	$Data		=	new Data($db);
	$Theme		=	new Theme($db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($db,$Dirs,$Theme);
	$Tpl		=	new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);
	$XML		=	new XML($Data,$Setting,$Table);
	$Version	=	new Version($db,$Data,$XML);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	$XML->_do_load_version_xml(true);

	if($XML->n_version && !empty($XML->n_version)){
		$Tpl->Separator(20);
		$XML->_do_load_key_xml(true);
	}

	if($XML->n_version_uri){
		echo '<div class="row">';
			echo '<div class="col-md-12 text-center">';
				echo '<a class="badge badge-pill badge-primary f_20" href="'.$Data->urlsafe_b64decode($XML->n_version_uri).'">Download</a>';
			echo '</div>';
		echo '</div>';
	}
?>