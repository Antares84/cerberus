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
				url: "<?php echo $Dirs->_array[32];?>AP/editor.hp/hp_del_post_submit.php",
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