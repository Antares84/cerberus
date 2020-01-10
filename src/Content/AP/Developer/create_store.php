<?php
	ob_start();
	if(isset($_POST['submit'])){
		$titleAdd=escData(htmlentities($_POST['titleAdd']));
		$detailAdd=escData(htmlentities($_POST['detailAdd']));
		$errors=array();
		if(empty($titleAdd) || empty($detailAdd)){$errors[] = 'Please verify all fields';}
		if (empty($errors)){
			$sql=("INSERT INTO ".StoreList." (StoreOwnerName,StorePlanet,StoreFloorNum,StoreRoomNum,StoreDesc) VALUES (?,?,?,?,?)");
			$stmt=odbc_prepare($cxn1,$sql);
			$args=array($OwnerAdd,$PlanetAdd,$FloorAdd,$StoreAdd,$DescAdd);
			$res=odbc_execute($stmt,$args);
			$postSuccess='<strong>SUCCESS:</strong> Store has been added!';
		}
	}
	if(isset($_POST['deleteBtn'])){
		$deletes=$_POST['deleteCheck'];
		foreach($deletes as $delete){
			$sql=("DELETE FROM ".News." WHERE RowID=?");
			$stmt=odbc_prepare($cxn1,$sql);
			$args=array($delete);
			$res=odbc_execute($stmt,$args);
		}
		$deleteSuccess = '<strong>SUCCESS:</strong> Store has been removed!';
	}
	echo '<div id="page-wrapper">';
		echo '<div id="title">Add A New Store</div>';
		echo '<div id="content">';
			echo '<div id="tabs">';
				echo '<ul>';
					echo '<li><a href="#tabs-1">Add A New Store Location</a></li>';
					echo '<li><a href="#tabs-2">Edit Store</a></li>';
				echo '</ul>';
#	Add Store
				echo '<div id="tabs-1">';
					echo '<form action="" class="acp-form" method="POST">';
						echo '<div id="error">';
							if(count($errors)!=0){echo '<h1>Error!</h1>';foreach($errors as $error){echo '<div id="error-msg" class="red-base">'.$error.'</div>';}}
							else{echo '<div id="error-msg">'.$postSuccess.'</div>';}
						echo '</div>';
						echo '<table class="float-l w-50">';
							echo '<tr class="mb-2">';
								echo '<td id="label1">Owner:</td>';
								echo '<td><input type="text" name="OwnerAdd" /></td';
							echo '</tr><br /><br />';
							echo '<tr class="mb-2">';
								echo '<td id="label1">Planet:</td>';
								echo '<td><input type="text" name="PlanetAdd" /></td';
							echo '</tr><br /><br />';
						echo '</table>';
						echo '<table class="float-r w-50">';
							echo '<tr>';
								echo '<td id="label1">Floor #</td>';
								echo '<td><input type="text" name="FloorAdd" /></td';
							echo '</tr><br /><br />';
							echo '<tr class="mb-2">';
								echo '<td id="label1">Store #</td>';
								echo '<td><input type="text" name="StoreAdd" /></td';
							echo '</tr><br /><br />';
						echo '</table>';
						echo '<div class="clear"></div>';
#						echo '<br />';
#						echo '<div id="label2"><textarea name="DescAdd" placeholder="You have news?"></textarea></div>';
						echo '<br />';
						echo '<div style="text-align: right;">';
							echo '<input type="submit" value="Add It!" name="submit" />';
						echo '</div>';
					echo '</form>';
				echo '</div>';
#	Edit Store
				echo '<div id="tabs-2">';
					echo '<form action="" class = "acp-form" method="POST">';
					echo '<div style="text-align:center;">'.$deleteSuccess.'</div><br />';
						echo '<table cellpadding="0" cellspacing="0" width="100%" class="content-form-table">';
							echo '<tr>';
								echo '<th><input type="checkbox" disabled="disabled" /></th>';
								echo '<th>Post ID</th>';
								echo '<th>Post Title</th>';
								echo '<th>Detail</th>';
								echo '<th>Post Date</th>';
							echo '</tr>';
						$sql=odbc_exec($cxn1,"SELECT * FROM ".News." ORDER BY RowID ASC");
						while($NewsStats=odbc_fetch_array($sql)){
							echo '<tr>';
								echo '<th><input type="checkbox" name="deleteCheck[]" value="'.$NewsStats['RowID'].'"/></th>';
								echo '<td>'.escData(htmlentities($NewsStats['RowID'])).'</td>';
								echo '<td>'.escData(htmlentities($NewsStats['Title'])).'</td>';
								echo '<td>'.escData(htmlspecialchars_decode($NewsStats['Detail'])).'</td>';
								echo '<td>'.escData(htmlentities(date("m/d/y h:i:s A", strtotime($NewsStats['Date'])))).'</td>';
							echo '</tr>';
						}
						echo '</table>';
						echo '<div style="text-align: right;">';
							echo '<br />';
							echo '<input type="submit" value="Delete Selected News" name="deleteBtn" />';
						echo '</div>';
					echo '</form>';
				echo '</div>';
			echo '</div>'; # end of tabs
		echo '</div>'; # end of content
	echo '</div>'; # end of page-wrapper
?>