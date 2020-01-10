<?php
	require_once('../../Autoloader.UNI.php');

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

	list($RowID,$DESC,$VALUE,$SETTING,$DB)=explode("~",$_POST['id']);

	echo '<form class="edit_stng_select">';
		#$Tpl->input_group('RowID','',$RowID,'readonly','<i class="fa fa-info-circle"></i>','');
		echo '<input class="form-control" id="RowID" name="RowID" type="hidden" value="'.$RowID.'"/>';
		echo '<input id="DB" name="DB" type="hidden" value="'.$DB.'">';

		$Tpl->input_group('DESC','',$DESC,'disabled','<i class="fa fa-info-circle"></i>','');
		$Tpl->Separator('10');
		$Tpl->input_group('VALUE','',$Data->_do('bit_2_text_string',$VALUE),'disabled','<i class="fa fa-info-circle"></i>','');
		$Tpl->Separator('10');

		if($SETTING == 'SETUP'){
			$Tpl->input_select($Select->_get_select('y_n'));
		}
		elseif($SETTING == 'CMS_THEME_NAME'){
			$Tpl->input_select($Select->_get_select('cms_theme'));
		}
		elseif($SETTING == 'SITE_TYPE'){
			$Tpl->input_select($Select->_get_select('site_type'));
		}
		elseif($SETTING == 'LOGGING' || $SETTING == 'DEBUG' || $SETTING == 'HTTPS_SSL' || $SETTING == 'MAINTENANCE'){
			$Tpl->input_select($Select->_get_select('enable'));
		}
		elseif(in_array($SETTING,$Arrays->_get_Array('bg_color'))){
			if(
				$SETTING == 'BREAD_BG_COLOR' ||
				$SETTING == 'CARD_BG_COLOR' ||
				$SETTING == 'NAV_BG_COLOR' ||
				$SETTING == 'TITLE_BG_COLOR'
			){
				$Tpl->input_select($Select->_get_select('background_color'));
			}
			if($SETTING == 'PANE_BG_COLOR'){
				$Tpl->input_select($Select->_get_select('pane_bg_color'));
			}
			if($SETTING == 'PANE_BG_TRANS'){
				$Tpl->input_select($Select->_get_select('pane_bg_trans'));
			}
		}
		else{}

		echo '<div class="text-center f_20">';
			echo '<button type="button" class="btn btn-primary text-center tac" id="stng_submit"><i class="fa fa-check-circle"></i> Update Setting</button>';
		echo '</div>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$('button#stng_submit').click(function(){
			$.ajax({
				type	:	'POST',
				url		:	'<?php echo $Dirs->_array[32];?>AP/Universal/edit_stng_submit.php',
				data	:	$('form.edit_stng_select').serialize(),
				success	:	function(message){
					$('#select_modal #dynamic-content').html(message);
					$('#TableLoader').load(location.href + ' #TabularData');
				},
				error	:	function(){
					alert('Error');
				}
			});
		});
	});
</script>