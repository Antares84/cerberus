<?php
	# SQL - Site Pages
	$sql1	=	('
					SELECT *
					FROM '.$DB->get_table('FTW_SITE_PAGES').'
					WHERE PageShow IN (?,?)'
	);
	$stmt1	=	odbc_prepare($DB->conn,$sql1);
	$args1	=	array(0,1);
	$prep1	=	odbc_execute($stmt1,$args1);

	# SQL - Admin Panel Pages
	$sql2	=	('
					SELECT *
					FROM '.$DB->get_table('FTW_ACP_PAGES').'
					WHERE PageShow IN (?,?)'
	);
	$stmt2	=	odbc_prepare($DB->conn,$sql2);
	$args2	=	array(0,1);
	$prep2	=	odbc_execute($stmt2,$args2);

	if(isset($_POST['Add_Page_Sub'])){

		$addPageIndex	=	$_POST['PageIndex'];
		$addPageURI		=	$_POST['PageURI'];
		$addPageTitle	=	$_POST['PageTitle'];
		$addPageShow	=	$_POST['PageShow'];

		if(empty($addPageTitle) || empty($addPageIndex) || empty($addPageShow)){
			$errors[]	=	'Please fill in all required fields!';
		}
		if(empty($errors)){
			$sql	=	("INSERT INTO ".$DB->get_table('FTW_SITE_PAGES')."
							(PageIndex,PageURI,PageTitle,PageShow)
						VALUES
							(?,?,?,?)"
			);
			$stmt	=	odbc_prepare($DB->conn,$sql);
			$args	=	array($addPageIndex,$addPageURI,$addPageTitle,$addPageShow);
			$res	=	odbc_execute($stmt,$args);

			$postSuccess='<strong>SUCCESS:</strong> Your blog content has been posted!';
		}
	}

	# Content
	echo '<div id="page-wrapper">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div class="col-lg-12">';
					echo '<h1 class="page-header">'.$Settings->PageTitle;if(!empty($Settings->PageSub)){echo '<small> - '.$Settings->PageSub.'</small>';}echo '</h1>';
					echo '<div id="content-wrapper">';
						echo '<ol class="breadcrumb">';
							echo '<li><a href="?id=Dashboard">Dashboard</a></li>';
							echo '<li class="active"><i class="fa fa-dashboard"></i> <a href="#">'.$Data->PageTitle.'</a></li>';
						echo '</ol>';
					echo '<div id="title" class="tac">Menu Editor</div>';
					echo '<div id="content-wrapper">';
						echo '<div id="tabs">';
							echo '<ul>';
								echo '<li><a href="#tabs-1">Site Pages</a></li>';
								echo '<li><a href="#tabs-2">Admin Panel Pages</a></li>';
							echo '</ul>';
							echo '<div id="tabs-1">';
								echo '<form action="" class="blue_base" method="POST">';
									echo '<div class="form-group">';
										echo '<label for="PageTitle">Page Title*</label>';
										echo '<input type="text" class="form-control" name="PageTitle" id="PageTitle" placeholder="Add A Page Title">';
									echo '</div>';

									echo '<div class="form-group ">';
										echo '<label for="PageURI">Page Location</label>';
										echo '<input type="text" class="form-control col-6" name="PageURI" id="PageURI" value="assets/content/">';
									echo '</div>';

									echo '<div class="form-group">';
										echo '<label for="PageIndex">Page Index (No spaces between words)</label>';
										echo '<input type="text" class="form-control" name="PageIndex" id="PageIndex" placeholder="Page Index">';
									echo '</div>';
										
									echo '<div class="form-group-inline">';
										echo '<label class="form-check-label">Show Page?</label><br>';
										echo '<input class="form-check-input" type="radio" name="PageShow" id="inlineRadio1" value="1"> Yes';
										echo '<input class="form-check-input ml_10" type="radio" name="PageShow" id="inlineRadio2" value="0"> No';
									echo '</div>';

									echo '<button type="submit" name="Add_Page_Sub" class="btn btn-primary btn_center">Add Page</button>';
								echo '</form>';
								echo '<div class="separator_30"></div>';

								echo '<table class="acp-table tac">';
									echo '<tr>';
										echo '<th>RowID</th>';
										echo '<th>Page Name</th>';
										echo '<th>Category</th>';
										echo '<th>Sub-Category</th>';
										echo '<th>Visible</th>';
										echo '<th>Edit Link</th>';
									echo '</tr>';
								while($data1 = odbc_fetch_array($stmt1)){
									echo '<tr>';
										echo '<td>'.$data1['RowID'].'</td>';
										echo '<td>'.$data1['PageIndex'].'</td>';
										echo '<td>'.$data1['Cat'].'</td>';
										echo '<td>'.$data1['PageSub'].'</td>';
										echo '<td>'.$Data->pageShow($data1['PageShow']).'</td>';
										echo '<td><a href="?pid=PlayerStatsEditor&CharName='.$data1['RowID'].'" />Edit</a></td>';
									echo '</tr>';
								}
								echo '</table>';
							echo '</div>'; # end of tabs-1

							echo '<div id="tabs-2">';
								echo '<table class="acp-table tac">';
									echo '<tr>';
										echo '<th>Page Name</th>';
										echo '<th>Category</th>';
										echo '<th>Sub-Category</th>';
										echo '<th>Visible</th>';
										echo '<th>Edit Link</th>';
									echo '</tr>';
								while($data2 = odbc_fetch_array($stmt2)){
									echo '<tr>';
										echo '<td>'.$data2['PageIndex'].'</td>';
										echo '<td>'.$data2['Cat'].'</td>';
										echo '<td>'.$data2['PageSub'].'</td>';
										echo '<td>'.$Data->pageShow($data2['PageShow']).'</td>';
										echo '<td><a href="?pid=PlayerStatsEditor&CharName=?" />Edit</a></td>';
									echo '</tr>';
								}
								echo '</table>';
							echo '</div>'; # end of tabs-2
						echo '</div>'; # end of tabs
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>