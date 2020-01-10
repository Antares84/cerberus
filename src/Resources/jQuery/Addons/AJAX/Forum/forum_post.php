<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Setting	=	new Setting($db);
	$Data		=	new Data();
	$User		=	new User($Data,$db,$Setting);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	if(!$_POST["titleAdd"]){
		echo 'A title is required!<br>';
	}
	if(!$_POST["mce_0"]){
		echo 'There\'s no content here.<br>How is someone supposed to read content when you didn\'t add any??';
	}
	else{
		echo '<form class="submit_post">';
			echo '<div class="alert alert-danger">';
				echo '<i class="fa fa-exclamation-triangle"></i> ';
				echo 'Are you sure you want to post this topic for<br>'.$_POST["titleAdd"].'?';
			echo '</div>';

			echo '<input class="form-control" name="MemberID" type="hidden" value="'.$_POST["MemberID"].'"/>';
			echo '<input class="form-control" name="TopicTitle" type="hidden" value="'.$_POST["titleAdd"].'"/>';
			echo '<input class="form-control" name="TopicBody" type="hidden" value="'.htmlentities($_POST["mce_0"]).'"/>';

			echo '<button type="button" class="btn btn-info center-block" id="submit"><i class="fa fa-check-circle"></i> Post Topic</button>';
		echo '</form>';
	}
?>
<script>
	$(document).ready(function(){
		$("button#submit").click(function(){
			$.ajax({
				type: "POST",
				url: "ajax/site/Forum/forum_post_submit.php",
				data: $('form.submit_post').serialize(),
				success: function(message){
					$('#forum_modal #dynamic-content').html(message);
					<?php if($Setting->DEBUG === "1"){ ?>
//						console.log('Reloading tabular data...');
					<?php } ?>
					window.location.reload(true);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>