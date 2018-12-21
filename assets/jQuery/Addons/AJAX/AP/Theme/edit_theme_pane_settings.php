<?php
	require_once('../../Autoloader.php');

	$Browser=new Browser();$db=new Database();$Select=new Select();$Data=new Data($db);$Theme=new Theme($db);$Messenger=new Messenger($Browser);$Style=new Style($db,$Theme);$Tpl=new Template($Data,$Messenger,$Select,$Style,$Theme);$Setting=new Setting($Data,$db,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
#			die();
		}
	}

	list($RowID,$DESC,$VALUE,$SELECTOR) = explode("~",$_POST['id']);

	echo '<form class="edit_setting">';
		#$Tpl->input_group('RowID','',$RowID,'readonly','<i class="fa fa-info-circle"></i>','');
		echo '<input class="form-control" id="RowID" name="RowID" type="hidden" value="'.$RowID.'"/>';

		$Tpl->input_group('DESC','',$DESC,'readonly','<i class="fa fa-info-circle"></i>','');
		$Tpl->input_group('VALUE','',$VALUE,'','<i class="fa fa-info-circle"></i>','');
		$Tpl->input_select($Select->$SELECTOR());

		echo '<button type="button" class="btn btn-primary text-center tac" id="edit_setting"><i class="fa fa-check-circle"></i> Update Setting</button>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#edit_setting").click(function(){
			$.ajax({
				type: "POST",
				url:"<?php echo $Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_settings_submit.php",
				data: $("form.edit_setting").serialize(),
				success: function(message){
					$("#pane_modal #dynamic-content").html(message);
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>