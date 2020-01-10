<?php
	$errors			=	array();
	$postSuccess	=	false;
	$deleteSuccess	=	false;

	if(isset($_POST['submit'])){
		$titleAdd	=	$this->Data->escData(htmlentities($_POST['titleAdd']));
		$detailAdd	=	$this->Data->escData(htmlentities($_POST['detailAdd']));

		if(empty($titleAdd) || empty($detailAdd)){
			$errors[] = 'Please verify all fields';
		}

		if(empty($errors)){
			$sql	=	("
							INSERT INTO ".$this->db->get_TABLE("NEWS")."
								(Title,Detail,PosterID)
							VALUES
								(?,?)
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($titleAdd,$detailAdd,$_SESSION["UserID"]);
			$prep	=	odbc_execute($stmt,$args);

			$postSuccess='<strong>SUCCESS:</strong> News has been posted!';
		}
	}

	if(isset($_POST['deleteBtn'])){
		$deletes	=	$_POST['deleteCheck'];

		foreach($deletes as $delete){
			$sql	=	("
							DELETE FROM ".$this->db->get_TABLE("NEWS")."
							WHERE RowID=?
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($delete);
			$prep	=	odbc_execute($stmt,$args);
		}

		$deleteSuccess = '<strong>SUCCESS:</strong> News Has Been Removed!';
	}

	# Content
	$this->Tpl->Titlebar('News Center');
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div id="tabs">';
				echo '<ul>';
					echo '<li><a href="#tabs-1">Post News</a></li>';
					echo '<li><a href="#tabs-2">Delete News</a></li>';
				echo '</ul>';

				#	Post News Tab
				echo '<div id="tabs-1">';
					echo '<form method="POST">';
						echo '<div id="error">';
						if(count($errors) != 0){
							echo '<h1>Error!</h1>';
							foreach($errors as $error){
								echo '<div id="error-msg" class="red-base">'.$error.'</div>';
							}
						}
						else{
							echo '<div id="error-msg">'.$postSuccess.'</div>';
						}
						echo '</div>';

						echo $this->Tpl->Separator("5");
						echo $this->Tpl->input_group("titleAdd","Title","","","","","col-md-4");

						echo '<div class="col-md-12">';
							echo '<textarea class="mce_standard_textbox" name="detailAdd" placeholder="You have news?"></textarea>';
						echo '</div>';

						echo $this->Tpl->Separator("15");
						echo '<div class="text-center tac f_20">';
							echo '<button class="badge badge-primary" type="submit" name="submit">Post New News</button>';
						echo '</div>';
					echo '</form>';
				echo '</div>';

				# Delete News Tab
				echo '<div id="tabs-2">';
					$sql	=	("
									SELECT *
									FROM ".$this->db->get_TABLE("NEWS")."
									ORDER BY RowID ASC"
					);
					$stmt	=	odbc_prepare($this->db->conn,$sql);
					$args	=	array();
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						if(odbc_num_rows($stmt) < 1){
							echo '<div class="col-md-12 tac b_i">';
								echo 'Oops, there\'s currently no news to delete. Are you sure that you added some?';
							echo '</div>';
						}
						else{
							echo '<form action="" class="acp-form" method="POST">';
								echo '<div style="text-align:center;">'.$deleteSuccess.'</div><br />';
								echo '<div class="table-responsive">';
									echo '<table class="table table-sm table-bordered table-striped acp_table tac">';
										echo '<thead>';
											echo '<tr>';
												echo '<th width="5%"><input type="checkbox" disabled="disabled" /></th>';
												echo '<th width="5%">Post ID</th>';
												echo '<th>Post Title</th>';
												echo '<th>Detail</th>';
												echo '<th width="12%">Post Date</th>';
											echo '</tr>';
										echo '</thead>';
										echo '<tbody>';
										while($NewsStats = odbc_fetch_array($stmt)){
											echo '<tr>';
												echo '<th><input type="checkbox" name="deleteCheck[]" value="'.$NewsStats['RowID'].'"/></th>';
												echo '<td>'.$this->Data->escData(htmlentities($NewsStats['RowID'])).'</td>';
												echo '<td>'.$this->Data->escData(htmlentities($NewsStats['Title'])).'</td>';
												echo '<td>'.$this->Data->escData(htmlspecialchars_decode($NewsStats['Detail'])).'</td>';
												echo '<td>'.$this->Data->escData(htmlentities(date("m/d/y h:i:s A", strtotime($NewsStats['PostDate'])))).'</td>';
											echo '</tr>';
										}
									echo '</table>';

									echo '<div class="text-center tac f20">';
										echo '<button class="badge badge-primary" type="submit" name="deleteBtn">Delete Selected News</button>';
									echo '</div>';
								echo '</div>';
							echo '</form>';
						}
					}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>