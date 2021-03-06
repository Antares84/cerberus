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

	list($RowID,$PLUGIN_ORDER,$PLUGIN_ENABLE) = explode("~",$_POST['id']);

	echo '<form class="edit_page">';
		echo '<input class="form-control" id="RowID" name="RowID" type="hidden" value="'.$RowID.'" readonly/>';

		$Tpl->input_select($Select->_get_select('plugin_order'));
		$Tpl->input_select($Select->_get_select('plugin_enable'));

		echo '<div class="text-center f_20">';
			echo '<button type="button" class="badge badge-warning" id="edit_page"><i class="fa fa-check-circle"></i> Update Plugin</button>';
		echo '</div>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#edit_page").click(function(){
			$.ajax({
				type: "POST",
				url:"<?php echo $Style->_style_array[9];?>AJAX/AP/Plugins/edit_plugins_submit.php",
				data: $('form.edit_page').serialize(),
				success: function(message){
					$('#pl_stng_modal #dynamic-content').html(message);
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