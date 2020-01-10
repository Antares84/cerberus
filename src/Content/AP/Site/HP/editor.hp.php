<?php
	$sql	=	('
					SELECT *
					FROM '.$this->db->_table_list("HOMEPAGE").'
					ORDER BY RowID ASC
	');
	$stmt	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array();
	$prep	=	odbc_execute($stmt,$args);

	# CONTENT
	echo $this->Tpl->Titlebar('Homepage Content Control','w_100_p');
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
						echo '<table class="table table-sm acp_table text-white">';
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
									echo '<td class="tac">'.$this->Data->_do('escData',htmlentities($show['RowID'])).'</td>';
									echo '<td>'.$this->Data->_do('escData',htmlentities($show['Title'])).'</td>';
									echo '<td>'.$this->Data->_do('escData',html_entity_decode($show['Detail'])).'</td>';
									#echo '<td>'.$this->Data->_do('escData',htmlspecialchars_decode($show['Detail'])).'</td>';
									echo '<td class="col-md-2 tac">'.$this->Data->_do('escData',htmlentities(date("m/d/y h:i A", strtotime($show['Date'])))).'</td>';
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
?>