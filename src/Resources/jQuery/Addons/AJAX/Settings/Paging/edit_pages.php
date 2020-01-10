<?php
	if(!defined('IN_CMS')){exit;}

	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Template	=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Template);
	$db			=	new Database();

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	list($RowID,$PAGE_INDEX,$PAGE_URI,$PAGE_SHOW,$METATAG_TITLE,$METATAG_DESC,$METATAG_KEYWORDS) = explode("~",$_POST['id']);

	echo '<form class="edit_page">';
		$Template->input_group('RowID','',$RowID,'readonly','RowID','');
		$Template->input_group('PAGE_INDEX','',$PAGE_INDEX,'readonly','Page Index','');
		$Template->input_group('PAGE_URI','',$PAGE_URI,'','Page URI','');
		$Template->input_group('METATAG_TITLE','',$METATAG_TITLE,'','Meta Title','');
		$Template->input_group('METATAG_DESC','',$METATAG_DESC,'','Meta Description','');
		$Template->input_group('METATAG_KEYWORDS','',$METATAG_KEYWORDS,'','Meta Keywords','');

		echo '<div class="input-group mb-3">';
			echo $Select->PageShow();
		echo '</div>';

		echo '<div class="text-center f20">';
			echo '<button type="button" class="badge badge-warning" id="edit_page"><i class="fa fa-check-circle"></i> Update Page</button>';
		echo '</div>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#edit_page").click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo $Style->_style_array[1];?>ajax/Settings/Paging/edit_pages_submit.php",
				data: $('form.edit_page').serialize(),
				success: function(message){
					$('#pages_modal #dynamic-content').html(message);
					$("#TableLoader").load(location.href + " #TabularData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>