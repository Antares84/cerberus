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
	$Theme		=	new Theme($Arrays,$db);

	$Messenger	=	new Messenger($Browser);
	$Style		=	new Style($Arrays,$db,$Dirs,$Theme);
	$Tooltips	=	new Tooltips($Colors);
	$Tpl		=	new Template($Messenger,$Select,$Style,$Theme,$Tooltips);
	$Setting	=	new Setting($Arrays,$db);
	$User		=	new User($Browser,$db,$Setting);
	$SQL		=	new SQL($Arrays,$Colors,$Data,$db,$Setting,$Tpl,$User);

#	if($Setting->_array[12] === "1" || $Setting->_array[12] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->_array[12] === "2"){
			die();
		}
#	}

	list($RowID,$EDIT,$DB) = explode("~",$_POST['id']);

	if(isset($_POST['id'])){
		echo '<form class="record_unlock" name="record_unlock">';
			echo '<div class="alert alert-danger">';
				echo '<i class="fa fa-exclamation-triangle"></i> ';
				echo 'Are you sure you want to un-lock this setting?';
			echo '</div>';

			echo '<input class="form-control" name="id" type="hidden" value="'.$RowID.'~'.$EDIT.'~'.$DB.'"/>';

			echo '<div class="text-center f_20">';
				echo '<button type="button" class="badge badge-warning" id="submit_unlock"><i class="fa fa-check-circle"></i> Un-lock Setting</button>';
			echo '</div>';
		echo '</form>';
	}
?>
<script>
	$(document).ready(function(){
		$("button#submit_unlock").click(function(){
			$.ajax({
				type: "POST",
				url:"<?php echo $Dirs->_array[32];?>AP/Access/access_submit.php",
				data: $('form.record_unlock').serialize(),
				success: function(message){
					console.log(message);
					$('#unlock_modal #dynamic-content').html(message);
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>