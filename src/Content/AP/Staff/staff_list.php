<?php
	$this->User->Auth();
	$this->LogSys->createLog("Viewed Staff List");

	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<h1 class="page-header">'.$this->PageTitle;if(!empty($this->PageSub)){echo '<small> - '.$this->PageSub.'</small>';}echo '</h1>';
			echo '<ol class="breadcrumb">';
				echo '<li><a href="?'.$this->Setting->PAGE_PREFIX.'=Dashboard">Dashboard</a></li>';
				echo '<li><a href="?'.$this->Setting->PAGE_PREFIX.'=Settings_Warning">Settings</a></li>';
				echo '<li class="active"><i class="fa fa-dashboard"></i> <a href="#">'.$this->PageTitle.'</a></li>';
			echo '</ol>';
		echo '</div>';
	echo '</div>';

	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div id="title" class="tac">Registered Accounts</div>';
			echo '<div id="sb_content">';
				echo $this->User->get_staff_members();
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>