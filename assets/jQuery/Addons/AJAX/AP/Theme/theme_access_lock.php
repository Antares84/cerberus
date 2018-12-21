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

	list($RowID,$EDIT) = explode("~",$_POST['id']);

	if(isset($_POST['id'])){
		echo '<form class="theme_lock" name="theme_lock">';
			echo '<div class="alert alert-danger">';
				echo '<i class="fa fa-exclamation-triangle"></i> ';
				echo 'Are you sure you want to lock this setting?';
			echo '</div>';

			echo '<input class="form-control" name="id" type="hidden" value="'.$RowID.'~'.$EDIT.'"/>';

			echo '<div class="text-center f_20">';
				echo '<button type="button" class="badge badge-primary" id="theme_lock_submit"><i class="fa fa-check-circle"></i> Update Setting</button>';
			echo '</div>';
		echo '</form>';
	}
?>
<script>
	$(document).ready(function(){
		$("button#theme_lock_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"<?php echo $Style->_style_array[9];?>AJAX/AP/Theme/theme_access_submit.php",
				data: $('form.theme_lock').serialize(),
				success: function(message){
					$('#theme_lock_modal #dynamic-content').html(message);
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