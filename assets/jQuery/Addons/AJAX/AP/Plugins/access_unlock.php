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
			die();
		}
	}

	list($RowID,$EDIT) = explode("~",$_POST['id']);

	if(isset($_POST['id'])){
		echo '<form class="record_unlock" name="record_unlock">';
			echo '<div class="alert alert-danger">';
				echo '<i class="fa fa-exclamation-triangle"></i> ';
				echo 'Are you sure you want to un-lock this setting?';
			echo '</div>';

			echo '<input class="form-control" name="id" type="hidden" value="'.$RowID.'~'.$EDIT.'"/>';

			echo '<button type="button" class="btn btn-warning w_100_p" id="submit_unlock"><i class="fa fa-check-circle"></i> Un-lock Setting</button>';
		echo '</form>';
	}
?>
<script>
	$(document).ready(function(){
		$("button#submit_unlock").click(function(){
			$.ajax({
				type: "POST",
				url:"<?php echo $Style->_style_array[9];?>AJAX/AP/Plugins/access_submit.php",
				data: $('form.record_unlock').serialize(),
				success: function(message){
					$('#unlock_modal #dynamic-content').html(message);	// load response
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