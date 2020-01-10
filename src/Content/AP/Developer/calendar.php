<?php
	# Content
		echo '<div id="page-wrapper">';
			echo '<div class="container-fluid">';
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						echo '<h1 class="page-header">'.$Data->PageTitle;if(!empty($Data->PageSub)){echo '<small> - '.$Data->PageSub.'</small>';}echo '</h1>';
						echo '<div id="content-wrapper">';
							echo '<ol class="breadcrumb">';
								echo '<li><i class="fa fa-dashboard"></i> <a href="?id=Dashboard">Dashboard</a></li>';
								echo '<li class="active"><i class="fa fa-dashboard"></i> <a href="#">'.$Data->PageTitle.'</a></li>';
							echo '</ol>';
							echo '<div id="title" class="tac">Blog Content Control</div>';
							echo $Calendar->show();
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>