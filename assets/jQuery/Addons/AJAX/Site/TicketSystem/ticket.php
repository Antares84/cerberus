<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Tpl		=	new Template($Data,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);

#	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

#		if($Setting->DEBUG === "2"){
			exit();
#		}
#	}

	list($RowID,$PAGE_INDEX,$PAGE_URI,$PAGE_SHOW,$METATAG_TITLE,$METATAG_DESC,$METATAG_KEYWORDS) = explode("~",$_POST['id']);

	echo '<form class="edit_page">';
		echo '<div class="form-group row">';
			echo '<label for="Input-RowID" class="col-sm-4 col-form-label tar">RowID</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="RowID" name="RowID" type="text" value="'.$RowID.'" readonly/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_INDEX" class="col-sm-4 col-form-label tar">Page Index</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="PAGE_INDEX" name="PAGE_INDEX" type="text" value="'.$PAGE_INDEX.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_URI" class="col-sm-4 col-form-label tar">Page URI</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="PAGE_URI" name="PAGE_URI" type="text" value="'.$PAGE_URI.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-METATAG_TITLE" class="col-sm-4 col-form-label tar">Meta: Title</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="METATAG_TITLE" name="METATAG_TITLE" type="text" value="'.$METATAG_TITLE.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-METATAG_DESC" class="col-sm-4 col-form-label tar">Meta: Description</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="METATAG_DESC" name="METATAG_DESC" type="text" value="'.$METATAG_DESC.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-METATAG_KEYWORDS" class="col-sm-4 col-form-label tar">Meta: Keywords</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
					echo '<input class="form-control" id="METATAG_KEYWORDS" name="METATAG_KEYWORDS" type="text" value="'.$METATAG_KEYWORDS.'"/>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_SHOW" class="col-sm-4 col-form-label tar">Show Page</label>';
			echo '<div class="col-sm-8">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon"><i class="fa fa-eye"></i></div>';
					echo $Select->ds_selector_page_show();
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<button type="button" class="btn btn-warning center-block" id="edit_page"><i class="fa fa-check-circle"></i> Update Page</button>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#edit_page").click(function(){
			$.ajax({
				type: "POST",
				url: "ajax/settings/ws_edit_pages_submit.php",
				data: $('form.edit_page').serialize(),
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