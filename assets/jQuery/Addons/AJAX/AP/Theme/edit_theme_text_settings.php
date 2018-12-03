<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Tpl		=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
#			die();
		}
	}

	list($RowID,$DESC,$VALUE) = explode("~",$_POST['id']);

	echo '<form class="edit_setting">';
		echo '<input class="form-control" id="RowID" name="RowID" type="hidden" value="'.$RowID.'"/>';

		echo '<div class="input-group mb-3">';
			echo '<label for="Input-DESC" class="col-sm-3 col-form-label tar b_i">Description</label>';
			echo '<div class="input-group-prepend">';
				echo '<span class="input-group-text"><i class="fa fa-info-circle"></i></span>';
			echo '</div>';
			echo '<input type="text" class="form-control col-md-6 tac" id="DESC" name="DESC" value="'.$DESC.'" readonly>';
		echo '</div>';

		echo '<div class="input-group mb-3">';
			echo '<label for="Input-VALUE" class="col-sm-3 col-form-label tar b_i">Value</label>';
			echo '<div class="input-group-prepend">';
				echo '<span class="input-group-text"><i class="fa fa-info-circle"></i></span>';
			echo '</div>';
			echo '<input type="text" class="form-control col-md-6 tac" id="VALUE" name="VALUE" value="'.$VALUE.'">';
		echo '</div>';

		echo '<button type="button" class="btn btn-primary text-center tac" id="edit_setting"><i class="fa fa-check-circle"></i> Update Setting</button>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#edit_setting").click(function(){
			$.ajax({
				type: "POST",
				url:"<?php echo $Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_settings_submit.php",
				data: $('form.edit_setting').serialize(),
				success: function(message){
					$('#text_modal #dynamic-content').html(message);
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>