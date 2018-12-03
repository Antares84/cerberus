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

	if(isset($_POST['id'])){
		echo '<form class="record_lock" name="record_lock">';
			echo '<div class="alert alert-danger">';
				echo '<i class="fa fa-exclamation-triangle"></i> ';
				echo 'Are you sure you want to delete this post?';
			echo '</div>';

			echo '<input class="form-control" name="id" type="hidden" value="'.$_POST['id'].'"/>';

			echo '<div class="text-center f_16">';
				echo '<button type="button" class="badge badge-warning" id="delete_post"><i class="fa fa-check-circle"></i> Delete Post</button>';
			echo '</div>';
		echo '</form>';
	}
?>
<script>
	$(document).ready(function(){
		$("button#delete_post").click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo $Style->_style_array[9];?>AJAX/AP/editor.hp/hp_del_post_submit.php",
				data: $('form.record_lock').serialize(),
				success: function(message){
					$('#delete_post_modal #dynamic-content').html(message);
//					console.log('Reloading tabular data...');
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>