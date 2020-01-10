<?php
	$this->User->Auth();
	$this->LogSys->createLog("accessed JTS3 Welcome Bot Config Creator");

	# CONTENT
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<h1 class="page-header">'.$this->PageTitle;if(!empty($this->PageSub)){echo '<small> - '.$this->PageSub.'</small>';}echo '</h1>';
			echo '<ol class="breadcrumb">';
				echo '<li><i class="fa fa-dashboard"></i> <a href="?'.$this->Setting->PAGE_PREFIX.'=Dashboard">Dashboard</a></li>';
				echo '<li class="active"><i class="fa fa-dashboard"></i> <a href="#">'.$this->PageTitle.'</a></li>';
			echo '</ol>';
		echo '</div>';
	echo '</div>';

	echo '<div class="row">';
		echo '<div class="col-lg-12">';
		echo '</div>';
	echo '</div>';