<?php
	echo $this->Tpl->TitleBar('Pages Settings');
	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			echo '<div class="table-responsive">';
				$sql	=	("
								SELECT *
								FROM ".$this->db->get_TABLE("SETTINGS_PAGES")."
								ORDER BY ZONE DESC
				");
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array();
				$prep	=	odbc_execute($stmt,$args);
				if($prep){
					echo '<table id="mytable" class="table table-sm acp_table">';
						echo '<thead>';
							echo '<tr>';
								echo '<th>Page Zone</th>';
								echo '<th>Page Index</th>';
								echo '<th>Page URI</th>';
								echo '<th>Show Page</th>';
								echo '<th>Edit</th>';
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
						while($data = odbc_fetch_array($stmt)){
							echo '<tr>';
								echo '<td class="tac">'.$data["ZONE"].'</td>';
								echo '<td class="tac">'.$data["PAGE_INDEX"].'</td>';
								echo '<td>'.$data["PAGE_URI"].'</td>';
								echo '<td class="tac">'.$this->Data->bit_2_text($data["PAGE_SHOW"]).'</td>';
								echo '<td class="tac"><button class="badge badge-primary open_editor_modal" data-id="'.$data["RowID"].'~'.$data["PAGE_INDEX"].'~'.$data["PAGE_URI"].'~'.$data["PAGE_SHOW"].'~'.$data["METATAG_TITLE"].'~'.$data["METATAG_DESC"].'~'.$data["METATAG_KEYWORDS"].'" data-target="#pages_modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</button></td>';
							echo '</tr>';
						}
						echo '</tbody>';
					echo '</table>';
				}
			echo '</div>';
		echo '</div>';
	echo '</div>';

	$this->Modal->Display($this->Paging->PAGE_ZONE,'pages_modal','<i class="fa fa-pencil"></i>','0','2','Edit Page');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_editor_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#pages_modal #dynamic-content').html('');
			$('#pages_modal #modal-loader').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Paging/edit_pages.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
				$('#pages_modal #dynamic-content').html('');
				$('#pages_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#pages_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#pages_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#pages_modal #modal-loader').hide();
			});
		});
	});
</script>