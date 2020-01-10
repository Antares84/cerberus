<?php
	require_once('../../Autoloader.php');

	$Arrays		=	new Arrays();
	$DirLister	=	new DirectoryLister($Arrays);
	$Browser	=	new Browser();
	$Dirs		=	new Dirs($Arrays);
	$db			=	new Database();
	$Select		=	new Select();

	$Colors		=	new Colors($db);
	$Data		=	new Data($DirLister);
	$Theme		=	new Theme($Arrays,$db,$Dirs);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($Arrays,$db,$Dirs,$Theme);
	$Tooltips	=	new Tooltips($Colors);
	$Tpl		=	new Template($Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);
	$SQL		=	new SQL($Arrays,$Colors,$Data,$db,$Setting,$Tpl,$User);

	if($Setting->_array["DEBUG"] === "1" || $Setting->_array["DEBUG"] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->_array["DEBUG"] === "2"){
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

	echo '<script charset="utf-8" type="text/javascript" src="'.$Style->_array["JQUERY_JS"].'"></script>';
	echo '<script charset="utf-8" type="text/javascript" src="'.$Style->_array["TINYMCE_JS"].'"></script>';
	echo '<script charset="utf-8" type="text/javascript" src="'.$Style->_array["TINYMCE_INIT"].'"></script>';
?>
<script>
	$(document).ready(function(){
		$("button#hp_post_submit").click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo $Dirs->_array[32];?>AP/editor.hp/hp_post_submit.php",
				data: $('form.submit').serialize(),
				success: function(message){
					$('#hp_editor_modal #dynamic-content').html(message);
					<?php if($Setting->_array["DEBUG"] === "1"){ ?>
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