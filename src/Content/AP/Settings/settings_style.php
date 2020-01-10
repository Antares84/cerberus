<?php
	$this->User->Auth();
	$this->LogSys->createLog("Accessed Style Settings");

	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			$this->SQL->_get_Options("SETTINGS_STYLE","Style Settings","",1);
		echo '</div>';
	echo '</div>';
?>