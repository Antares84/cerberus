<?php
	$this->User->Auth();
	$this->LogSys->createLog("Accessed Plugin Settings");

	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			$this->SQL->_get_Options('SETTINGS_PLUGINS','Plugin Settings','',1);
		echo '</div>';
	echo '</div>';
?>