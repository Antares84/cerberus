<?php
	#createLog("Viewed Staff List");
	# Content
	echo '<div id="page-wrapper">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div class="col-lg-12">';
					echo '<h1 class="page-header">'.$this->PageTitle;if(!empty($this->PageSub)){echo '<small> - '.$this->PageSub.'</small>';}echo '</h1>';
						echo '<ol class="breadcrumb">';
							echo '<li><i class="fa fa-dashboard"></i> <a href="?id=Dashboard">Dashboard</a></li>';
							echo '<li class="active"><i class="fa fa-dashboard"></i> <a href="#">'.$this->PageTitle.'</a></li>';
						echo '</ol>';
					echo '<div id="title" class="tac">Registered Accounts</div>';
				echo '</div>';
			echo '</div>';

			echo '<div class="row">';
				echo '<div class="col-lg-12">';
					echo "<div id=\"sb_content\">";
						echo $this->User->get_staff_members();
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
?>