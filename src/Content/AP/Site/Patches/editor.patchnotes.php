<?php
	# Vars
	$errors=array();
	$postSuccess = false;
	$deleteSuccess = false;

	if(isset($_POST['submit'])){
		$titleAdd=escData(htmlentities($_POST['titleAdd']));
		$detailAdd=escData(htmlentities($_POST['detailAdd']));
		$errors=array();
		if(empty($titleAdd) || empty($detailAdd)){$errors[] = 'Please verify all fields';}
		if (empty($errors)){
			$sql	=	("INSERT INTO ".$this->db->get_TABLE("WS_PATCHNOTES")." (Title,Detail) VALUES (?,?)");
			$stmt	=	odbc_prepare($this->db-conn,$sql);
			$args	=	array($titleAdd,$detailAdd);
			$res	=	odbc_exec($stmt,$args);
			$postSuccess='<strong>SUCCESS:</strong> Your new patch data has been posted!';
		}
	}
	if(isset($_POST['deleteBtn'])){
		$deletes = $_POST['deleteCheck'];
		foreach($deletes as $delete){
			$sql	=	("DELETE FROM ".$this->db->get_TABLE("WS_PATCHNOTES")." WHERE RowID=?");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($delete);
			$res	=	odbc_execute($stmt,$args);
		}
		$deleteSuccess = '<strong>SUCCESS:</strong> The selected patch(es) has/have Been removed!';
	}

	# Content
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo $this->Tpl->Titlebar("Payment Office");
			echo '<div id="tabs">';
				echo '<ul>';
					echo '<li><a href="#tabs-1">Post Patch Notes</a></li>';
					echo '<li><a href="#tabs-2">Delete Patch Notes</a></li>';
				echo '</ul>';
				# Post News Tab
				echo '<div id="tabs-1">';
					echo '<div id="error">';
					if(count($errors)!=0){
						echo '<h1>Error!</h1>';
						foreach($errors as $error){
							echo '<div id="error-msg" class="red-base">'.$error.'</div>';
						}
					}else{
						echo '<div id="error-msg">'.$postSuccess.'</div>';
					}
					echo '</div>';
					echo '<form action="" class="acp-form" method="POST">';
						echo '<div id="label1">Title: <input type="text" name="titleAdd" /></div>';
						echo '<br />';
						echo '<div id="label2"><textarea name="detailAdd" placeholder="You have news?"></textarea></div>';
						echo '<br />';
						echo '<div style="text-align: right;">';
							echo '<input type="submit" value="Post New News" name="submit" />';
						echo '</div>';
					echo '</form>';
				echo '</div>';
				# Delete News Tab
				echo '<div id="tabs-2">';
					$sql	=	("SELECT * FROM ".$this->db->get_TABLE("PATCH_NOTES")." ORDER BY RowID ASC");
					$stmt	=	odbc_prepare($this->db->conn,$sql);
					$args	=	array();
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
					echo '<form action="" class = "acp-form" method="POST">';
						echo '<div style="text-align:center;">'.$deleteSuccess.'</div><br />';
						echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
							echo '<thead>';
								echo '<tr>';
									echo '<th class="align-middle"><input type="checkbox" disabled="disabled" /></th>';
									echo '<th>ID</th>';
									echo '<th>Title</th>';
									echo '<th>Details</th>';
									echo '<th>Date</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								echo '<tr class="db_data">';
									echo '<td class="col-md-1 tac align-middle"><input type="checkbox" name="deleteCheck[]" value="'.$data['RowID'].'"/></td>';
									echo '<td class="col-md-1 tac">'.$this->Data->escData(html_entity_decode($data['RowID'])).'</td>';
									echo '<td class="col-md-3">'.$this->Data->escData(html_entity_decode($data['Title'])).'</td>';
									echo '<td class="col-md-5">'.$this->Data->escData(html_entity_decode($data['Detail'])).'</td>';
									echo '<td class="col-md-2 tac">'.$this->Data->escData(html_entity_decode(date("m/d/y h:i:s A", strtotime($data['Date'])))).'</td>';
								echo '</tr>';
							}
							echo '</tbody>';
						}
						
						echo '</table>';
						echo '<button class="btn btn-sm btn-primary center-block" name="deleteBtn"><i class="fa fa-pencil"></i> Delete Selected News</button>';
					echo '</form>';
				echo '</div>';
			echo '</div>'; # end of tabs
		echo '</div>';
	echo '</div>';
?>