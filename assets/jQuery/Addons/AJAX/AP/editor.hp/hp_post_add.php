<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Template	=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Template);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	echo '<form class="submit">';
		echo '<div class="form-group">';
			echo '<input type="text" class="form-control tac" id="titleAdd" name="titleAdd" placeholder="Title" />';
		echo '</div>';

		echo '<div class="form-group">';
			echo '<div class="mce_standard_textbox"></div>';
		echo '</div>';

		echo '<div class="row">';
			echo '<button type="button" class="badge badge-primary f_16 m_auto" id="hp_post_submit"><i class="fa fa-check-circle"></i> Submit Post</button>';
		echo '</div>';
	echo '</form>';

	echo '<script charset="utf-8" type="text/javascript" src="'.$Style->_style_array[26].'"></script>';
	echo '<script charset="utf-8" type="text/javascript" src="'.$Style->_style_array[27].'"></script>';
?>
<script>
	$(document).ready(function(){
		$("button#hp_post_submit").click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo $Style->_style_array[9];?>AJAX/AP/editor.hp/hp_post_submit.php",
				data: $('form.submit').serialize(),
				success: function(message){
					$('#hp_editor_modal #dynamic-content').html(message);
					<?php if($Setting->DEBUG === "1"){ ?>
						console.log('Reloading tabular data...');
					<?php } ?>
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>