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

	if($Setting->_array[12] === "1" || $Setting->_array[12] === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->_array[12] === "2"){
			die();
		}
	}

	list($RowID,$DESC,$VALUE,$SETTING,$DB)=explode("~",$_POST['id']);

	echo '<form class="edit_stng_textual">';
		echo '<input id="RowID" name="RowID" type="hidden" value="'.$RowID.'">';
		echo '<input id="DB" name="DB" type="hidden" value="'.$DB.'">';

		$Tpl->input_group('DESC','',$DESC,'readonly','<i class="fa fa-info-circle"></i>','');
		$Tpl->Separator('10');
		$Tpl->input_group('VALUE','',$VALUE,'','<i class="fa fa-info-circle"></i>','');
		$Tpl->Separator('10');

		echo '<div class="text-center f_20">';
			echo '<button type="button" class="btn btn-primary text-center tac" id="stng_textual_submit"><i class="fa fa-check-circle"></i> Update Setting</button>';
		echo '</div>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$('button#stng_textual_submit').click(function(e){
			$.ajax({
				type	:	'POST',
				url		:	'<?php echo $Dirs->_array[32];?>AP/Universal/Textual/edit_stng_submit.php',
				data	:	$('form.edit_stng_textual').serialize(),
				success	:	function(message){
					$('#textual_modal #dynamic-content').html(message);
					$('#TableLoader').load(location.href + ' #TabularData');
				},
				error	:	function(){
					alert('Error');
				}
			});
		});
	});
</script>