<?php
	require_once('../../Autoloader.php');

	$Browser	=	new Browser();
	$db			=	new Database();
	$Data		=	new Data($db);
	$Setting	=	new Setting($db);
	$User		=	new User($Browser,$Data,$db,$Setting);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	list($Column,$MemberID,$Value) = explode("~",$_POST['id']);

	echo '<form class="edit_setting">';
		echo '<input class="form-control" id="Column" name="Column" type="hidden" value="'.$Column.'"/>';
		echo '<input class="form-control" id="MemberID" name="MemberID" type="hidden" value="'.$MemberID.'"/>';

		echo '<div class="form-group row">';
			echo '<label for="Input-Value" class="col-sm-4 col-form-label tar">Value</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="Value" name="Value" type="text" value="'.$Value.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<button type="button" class="btn btn-primary center-block" id="edit_setting"><i class="fa fa-check-circle"></i> Update Setting</button>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#edit_setting").click(function(){
			$.ajax({
				type: "POST",
				url: "ajax/Profile/update_profile_submit.php",
				data: $('form.edit_setting').serialize(),
				success: function(message){
					$('#settings_modal #dynamic-content').html(message);
					window.location.reload(true);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>