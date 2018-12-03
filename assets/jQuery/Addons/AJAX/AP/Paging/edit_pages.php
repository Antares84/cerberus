<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Tpl		=	new Template($Data,$Select,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	list($RowID,$PAGE_INDEX,$PAGE_URI,$PAGE_SHOW) = explode("~",$_POST['id']);

	echo '<form class="edit_page">';
		echo '<div class="form-group row">';
			echo '<label for="Input-RowID" class="col-sm-2 col-form-label tar">RowID</label>';
			echo '<div class="col-sm-8">';
				echo '<input class="form-control" id="RowID" name="RowID" type="text" value="'.$RowID.'" readonly/>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_INDEX" class="col-sm-2 col-form-label tar">Page Index</label>';
			echo '<div class="col-sm-8">';
				echo '<input class="form-control" id="PAGE_INDEX" name="PAGE_INDEX" type="text" value="'.$PAGE_INDEX.'"/>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_URI" class="col-sm-2 col-form-label tar">Page URI</label>';
			echo '<div class="col-sm-8">';
					echo '<input class="form-control" id="PAGE_URI" name="PAGE_URI" type="text" value="'.$PAGE_URI.'"/>';
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_SHOW" class="col-sm-2 col-form-label tar">Show Page</label>';
			echo '<div class="col-sm-8">';
				$Select->PageShow();
			echo '</div>';
		echo '</div>';

		echo '<div class="form-group row">';
			echo '<label for="Input-PAGE_SHOW" class="col-sm-2 col-form-label tar">Show Page</label>';
			echo '<div class="col-sm-8">';
				$Select->ReqLogin();
			echo '</div>';
		echo '</div>';

		echo '<div class="row">';
			echo '<button type="button" class="badge badge-warning f_16 m_auto" id="edit_page"><i class="fa fa-check-circle"></i> Update Page</button>';
		echo '</div>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#edit_page").click(function(){
			$.ajax({
				type: "POST",
				url:"<?php echo $Style->_style_array[9];?>AJAX/AP/Paging/edit_pages_submit.php",
				data: $('form.edit_page').serialize(),
				success: function(message){
					$('#pages_modal #dynamic-content').html(message);
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