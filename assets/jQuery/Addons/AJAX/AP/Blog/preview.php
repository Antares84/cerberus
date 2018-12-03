<?php
	require_once('Autoloader.class.php');
	$db			=	new Database();
	$Setting	=	new Setting($db);
	$Data		=	new Data();

	if($Setting->DEBUG === "1"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
	#	die();
	}

	$titleAdd	=	isset($_POST["titleAdd"])	?	$Data->escData(trim($_POST["titleAdd"]))	:	false;
	$descAdd	=	isset($_POST["descAdd"])	?	$Data->escData(trim($_POST["descAdd"]))	:	false;
	$catAdd		=	isset($_POST["catAdd"])		?	$Data->escData(trim($_POST["catAdd"]))	:	false;
	$imageAdd	=	isset($_POST["imageAdd"])	?	$Data->escData(trim($_POST["imageAdd"]))	:	false;
	$detailAdd	=	isset($_POST["detailAdd"])	?	$Data->escData(trim($_POST["detailAdd"]))	:	false;

	echo '<pre>';
		var_dump($_POST);
	echo '</pre>';

	echo '<form class="edit_page">';
		echo '<div class="form-group row">';
			echo '<label for="Input-RowID" class="col-sm-4 col-form-label tar">Title</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="RowID" name="RowID" type="text" value="'.$titleAdd.'" readonly/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_INDEX" class="col-sm-4 col-form-label tar">Description</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="PAGE_INDEX" name="PAGE_INDEX" type="text" value="'.$descAdd.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_URI" class="col-sm-4 col-form-label tar">Catalog</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="PAGE_URI" name="PAGE_URI" type="text" value="'.$catAdd.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_URI" class="col-sm-4 col-form-label tar">Image Name</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="PAGE_URI" name="PAGE_URI" type="text" value="'.$imageAdd.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_URI" class="col-sm-4 col-form-label tar">Detail</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="PAGE_URI" name="PAGE_URI" type="text" value="'.$detailAdd.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</form>';
?>