<?php
	require_once('../Autoloader.php');

	$Arrays		=	new Arrays;
	$Dirs		=	new Dirs($Arrays);
	$db			=	new Database;
	$Setting	=	new Setting($Arrays,$db);

	if($Setting->_array["DEBUG"] === "1" || $Setting->_array["DEBUG"] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
	}
	if($Setting->_array["DEBUG"] === "2"){
		die();
	}

	if(isset($_POST["Title"]) && !empty($_POST["Title"])){
		echo '<form class="entry_save" name="entry_save">';
			echo '<div class="alert alert-info">';
				echo '<i class="fa fa-exclamation-triangle"></i> ';
				echo 'Are you sure you\'re ready to save the entry for <span class="b_i">'.$_POST["Title"].'</span>?';
			echo '</div>';
			echo '<input name="Title" type="hidden" value="'.$_POST["Title"].'"/>';
			echo '<input name="Text" type="hidden" value="'.htmlentities($_POST["mce_0"]).'"/>';

			echo '<div class="text-center">';
				echo '<button type="button" class="btn btn-warning" id="submit_entry"><i class="fa fa-check-circle"></i> Save Entry</button>';
			echo '</div>';
		echo '</form>';
	}
?>
<script>
	$(document).ready(function(){
		$("button#submit_entry").click(function(){
			$.ajax({
				type	:	"POST",
				url		:	'<?php echo $Dirs->_array[32];?>Journal/journal_submit.php',
				data	:	$('form.entry_save').serialize(),
				success	:	function(message){
					$('#journal_modal #dynamic-content').html(message);
					<?php if($Setting->_array["DEBUG"] === "1"){ ?>
						console.log('Reloading tabular data...');
					<?php } ?>
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error	:	function(){
					alert("Error");
				}
			});
		});
	});
</script>