<?php
	require_once('../Autoloader.php');

	$db			=	new Database();
	$Setting	=	new Setting($db);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
	}
	if($Setting->DEBUG === "2"){
		die();
	}

	if(isset($_POST["Title"]) && !empty($_POST["Title"])){
		echo '<form class="entry_save" name="entry_save">';
			echo '<div class="alert alert-info">';
				echo '<i class="fa fa-exclamation-triangle"></i> ';
				echo 'Are you sure you\'re ready to save the entry for<br><span class="b_i">'.$_POST["Title"].'</span>?';
			echo '</div>';
			echo '<input name="Title" type="hidden" value="'.$_POST["Title"].'"/>';
			echo '<input name="Text" type="hidden" value="'.$_POST["mce_0"].'"/>';

			echo '<button type="button" class="btn btn-warning center-block" id="submit_entry"><i class="fa fa-check-circle"></i> Save Entry</button>';
		echo '</form>';
	}
?>
<script>
	$(document).ready(function(){
		$("button#submit_entry").click(function(){
			$.ajax({
				type: "POST",
				url: "ajax/journal/ajax_journal_submit.php",
				data: $('form.entry_save').serialize(),
				success: function(message){
					$('#journal_modal #dynamic-content').html(message);
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