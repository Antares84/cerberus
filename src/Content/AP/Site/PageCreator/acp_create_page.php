<?php
	# Vars
	$errors=array();
	$postSuccess = false;
	$deleteSuccess = false;

	# Post Errors To Array
	$errors=array();
	if(isset($_POST['submit'])){
		$titleAdd=$_POST['titleAdd'];
		$detailAdd=$_POST['detailAdd'];
		if(empty($titleAdd) || empty($detailAdd)){
			$errors[]='Please verify all fields';}
		if(empty($errors)){
			$sql=("INSERT INTO ".$cfg["HomePage"]."(title,detail) VALUES(?,?)");
			$stmt=odbc_prepare($cxn,$sql);
			$args=array($titleAdd,$detailAdd);
			$res=odbc_execute($stmt,$args);
			$postSuccess='<strong>SUCCESS:</strong> News has been posted!';
		}
	}
	if(isset($_POST['deleteBtn'])){
		$deletes=$_POST['deleteCheck'];
		foreach($deletes as $delete){
			$sql=("DELETE FROM ".$cfg["HomePage"]." WHERE RowID=?");
			$stmt=odbc_prepare($cxn,$sql);
			$args=array($delete);
			$res=odbc_execute($stmt,$args);
		}
			$deleteSuccess = '<strong>SUCCESS:</strong> News Has Been Removed!';
	}

	# Content
	echo '<div id="wrapper">';
		echo '<div id="page-wrapper">';
			echo '<div class="container-fluid">';
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						echo '<h1 class="page-header">';
							echo ''.$cfg["PageTitle"].'';
							if(!empty($cfg["PageSub"])) {echo '<small> - '.$cfg["PageSub"].'</small>';}
						echo '</h1>';
						echo '<div id="title" class="tac">Create New Page</div>';
						echo '<div id="content-wrapper">';
							echo '<div id="tabs">';
								echo '<ul>';
									echo '<li><a href="#tabs-1">Post Content</a></li>';
									echo '<li><a href="#tabs-2">Delete Content</a></li>';
								echo '</ul>';
								echo '<div id="tabs-1">';
									if(count($errors)!= 0){
									echo '<div id="error" class="red-base">';
										echo '<h1>Error!</h1>';
										echo '<div id="error-msg">';
											foreach($errors as $error){echo $error;}
										echo '</div>';
									echo '</div>';
									}else{echo '<div id="error-msg">'.$postSuccess.'</div>';}
									echo '<form action="" class="acp-form" method="POST">';
										echo '<div id="label1">Title: <input type="text" name="titleAdd" maxlength="50" /></div>';
										echo '<br />';
										echo '<div id="label2"><textarea name="detailAdd"></textarea></div>';
										echo '<div style="text-align: right;">';
											echo '<br />';
											echo '<input type="submit" value="Post New Content" name="submit" />';
										echo '</div>';
									echo '</form>';
								echo '</div>';
								echo '<div id="tabs-2">';
									echo '<div id="error">'.$deleteSuccess.'</div><br />';
									echo '<form action="" class="acp-form" method="POST">';
										echo '<table class="acp-table tac">';
											echo '<tr>';
												echo '<th><input type="checkbox" disabled="disabled" /></th>';
												echo '<th>Post ID</th>';
												echo '<th>Post Title</th>';
												echo '<th>Post Details</th>';
												echo '<th>Post Date</th>';
											echo '</tr>';
											$sql=odbc_exec($cxn1,"SELECT * FROM ".$cfg["HomePage"]." ORDER BY RowID ASC");
										while ($show = odbc_fetch_array($sql)){
											echo '<tr>';
												echo '<td><input type="checkbox" name="deleteCheck[]" value="'.$show['RowID'].'"/></td>';
												echo '<td>'.escData(htmlentities($show['RowID'])).'</td>';
												echo '<td>'.escData(htmlentities($show['Title'])).'</td>';
												echo '<td>'.escData(htmlspecialchars_decode(htmlentities($show['Detail']))).'</td>';
												echo '<td>'.escData(htmlentities(date("m/d/y h:i A", strtotime($show['Date'])))).'</td>';
											echo '</tr>';
										}
										echo '</table>';
										echo '<br />';
										echo '<div style="text-align: right;">';
											echo '<input type="submit" value="Delete Selected News" name="deleteBtn" />';
										echo '</div>';
									echo '</form>';
								echo '</div>';
							echo '</div>'; # end of tabs
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>