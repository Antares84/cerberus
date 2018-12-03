<?php
	$sql	=	('
					SELECT *
					FROM '.$this->db->get_TABLE("HOMEPAGE").'
					ORDER BY RowID ASC
	');
	$stmt	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array();
	$prep	=	odbc_execute($stmt,$args);

	# CONTENT
	echo $this->Tpl->Titlebar("Homepage Content Control");
	echo '<div class="ap_content">';
		echo '<div class="row" id="TableLoader">';
			echo '<div class="col-lg-12" id="TabularData">';
				echo $this->Tpl->Separator("10");
				echo '<div class="row">';
					echo '<div class="col-md-10"></div>';
					echo '<div class="col-md-2 tar">';
						echo '<button class="badge badge-info open_hp_editor" data-id="" data-target="#hp_editor_modal" data-toggle="modal"><i class="fa fa-send"></i> Create New Post</button>';
					echo '</div>';
				echo '</div>';
				echo $this->Tpl->Separator("10");

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					echo '<div class="table-responsive">';
						echo '<table class="table table-sm acp_table">';
							echo '<thead>';
								echo '<tr>';
									echo '<th class="col-md-1 debug">Post ID</th>';
									echo '<th>Post Title</th>';
									echo '<th>Post Details</th>';
									echo '<th>Post Date</th>';
									echo '<th>Delete</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
							while($show = odbc_fetch_array($stmt)){
								echo '<tr>';
									echo '<td class="tac">'.$this->Data->escData(htmlentities($show['RowID'])).'</td>';
									echo '<td>'.$this->Data->escData(htmlentities($show['Title'])).'</td>';
									echo '<td>'.$this->Data->escData(html_entity_decode($show['Detail'])).'</td>';
									#echo '<td>'.$this->Data->escData(htmlspecialchars_decode($show['Detail'])).'</td>';
									echo '<td class="col-md-2 tac">'.$this->Data->escData(htmlentities(date("m/d/y h:i A", strtotime($show['Date'])))).'</td>';
									echo '<td class="col-md-1 tac align-middle"><button class="badge badge-danger open_deleter" data-id="'.$show["RowID"].'" data-target="#delete_post_modal" data-toggle="modal"><i class="fa fa-trash"></i> Delete</button></td>';
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
				else{
					echo '<div class="badge-info text-center">';
						echo '<i class="fa fa-info-circle"></i> Nothing to see here. Why not add something?';
					echo '</div>';
				}
			}
			echo '</div>';
		echo '</div>';
	echo '</div>';

	$this->Modal->Display($this->Paging->PAGE_ZONE,'hp_editor_modal','<i class="fa fa-pencil"></i>','0','2','Add New Post');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'delete_post_modal','<i class="fa fa-pencil"></i>','0','2','Delete Post?');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'unlock_modal','<i class="fa fa-pencil"></i>','0','2','Un-lock Setting');
?>
<script>
	$(document).ready(function(){
		$(document).on("click",".open_hp_editor",function(e){
			e.preventDefault();

			var uid = $(this).data("id");

			$("#hp_editor_modal #dynamic-content").html("");
			$("#hp_editor_modal #modal-loader").show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[9];?>AJAX/AP/editor.hp/hp_post_add.php",
				dataType: "html"
			})
			.done(function(data){
//				console.log(data);
				$('#hp_editor_modal #dynamic-content').html('');
				$('#hp_editor_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#hp_editor_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$("#hp_editor_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
				$("#hp_editor_modal #modal-loader").hide();
			});
		});
		$(document).on("click",".open_deleter",function(e){
			e.preventDefault();

			var uid = $(this).data("id");

			$("#delete_post_modal #dynamic-content").html("");
			$("#delete_post_modal #modal-loader").show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[9];?>AJAX/AP/editor.hp/hp_del_post.php",
				type: "POST",
				data: "id="+uid,
				dataType: "html"
			})
			.done(function(data){
//				console.log(data);
				$('#delete_post_modal #dynamic-content').html('');
				$('#delete_post_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#delete_post_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#delete_post_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#delete_post_modal #modal-loader').hide();
			});
		});
		$(document).on("click",".open_unlock_modal",function(e){
			e.preventDefault();

			var uid = $(this).data("id");

			$("#unlock_modal #dynamic-content").html("");
			$("#unlock_modal #modal-loader").show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[9];?>AJAX/Settings/settings_access_unlock.php",
				type: "POST",
				data: "id="+uid,
				dataType: "html"
			})
			.done(function(data){
//				console.log(data);
				$('#unlock_modal #dynamic-content').html('');
				$('#unlock_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#unlock_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$("#unlock_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
				$("#unlock_modal #modal-loader").hide();
			});
		});
	});
</script>