<?php
	require_once('../../Autoloader.php');

	$Browser=new Browser();
	$db=new Database();
	$Select=new Select();
	$Data=new Data($db);
	$Theme=new Theme($db);
	$Messenger=new Messenger($Browser);
	$Style=new Style($db,$Theme);
	$Tpl=new Template($Data,$Messenger,$Select,$Style,$Theme);
	$Setting=new Setting($Data,$db,$Tpl);
	$SQL=new SQL($Data,$db,$Setting,$Tpl);

#	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
#	}

	@list($RowID,$DESC,$VALUE,$SETTING,$DB) = explode("~",$_POST['id']);

	echo '<form class="ajax">';
		echo '<div class="row">';
			echo '<input id="RowID" name="RowID" type="hidden" value="'.$RowID.'"/>';
			echo '<input id="DB" name="DB" type="hidden" value="'.$DB.'"/>';

			$Tpl->input_group('DESC','',$DESC,'readonly','<i class="fa fa-info-circle"></i>','','mb-3');
			if(in_array($SETTING,$SQL->ENABLED_ARRAY)){
				$Select->_get_select('enable');
			}
			elseif(in_array($SETTING,$SQL->SB_ARRAY)){
				$Select->_get_select('sidebar_pos');
			}
			elseif(in_array($SETTING,$SQL->BG_COLOR_ARRAY)){
				$Select->_get_select('background_color');
			}
			elseif(in_array($SETTING,$SQL->TXT_ARRAY)){
				#	input_group($ID,$PLACEHOLDER,$VALUE,$ATTRIB,$PREPEND,$APPEND,$STYLE=false)
				$Tpl->input_group('VALUE','',$VALUE,'','http(s)://');
				echo '<small class="form-text text-muted">';
					echo 'Can be a http(s) link, or just the image filename itself';
				echo '</small>';
			}
			elseif(in_array($SETTING,$SQL->THEME_ARRAY)){
				$Select->_get_select('cms_theme');
			}
			else{
				echo 'Undefined';
			}
		echo '</div>';

		echo '<div class="text-center f_20 mt-3">';
			echo '<button type="button" class="badge badge-primary" id="stng_submit"><i class="fa fa-check-circle"></i> Update Setting</button>';
		echo '</div>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#stng_submit").click(function(){
			$.ajax({
				type: "POST",
				url:"<?php echo $Style->_style_array[9];?>AJAX/AP/Settings/edit_settings_submit.php",
				data: $('form.ajax').serialize(),
				success: function(message){
					$('#settings_modal #dynamic-content').html(message);
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>