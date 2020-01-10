<?php
	require_once('../Autoloader.php');

	$db			=	new Database();
	$Setting	=	new Setting($db);

	if($Setting->_array[12] === "1" || $Setting->_array[12] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
	}
	if($Setting->_array[12] === "2"){
		die();
	}

	list($RowID,$Title) = explode("~",$_POST['id']);

	if($RowID){
		echo '<form class="record_delete" name="record_delete">';
			echo '<div class="alert alert-danger">';
				echo '<i class="fa fa-exclamation-triangle"></i> ';
				echo 'Are you sure you want to delete this record for <span class="b_i">'.$Title.'</span>?';
			echo '</div>';

			echo '<input class="form-control" name="id" type="hidden" value="'.$RowID.'"/>';

			echo '<button type="button" class="btn btn-warning center-block" id="submit_delete"><i class="fa fa-check-circle"></i> Delete Permanently</button>';
		echo '</form>';
	}
?>
<script>
	$(document).ready(function(){
		$("button#submit_delete").click(function(){
			$.ajax({
				type	:	'POST',
				url		:	'<?php echo $this->Dirs->_array[32];?>Siteajax/Journal/entry_delete.php',
				data	:	$('form.record_delete').serialize(),
				success	:	function(message){
					$('#delete_modal #dynamic-content').html(message);
					window.location.reload(true);
				},
				error	:	function(){
					alert('Error');
				}
			});
		});
	});
</script>