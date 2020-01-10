<?php
	$this->User->Auth();
	$this->LogSys->createLog("Accessed Paging Settings");

	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			$this->SQL->_get_Options('SETTINGS_PAGES','Standard Paging Settings',0,1);
			$this->SQL->_get_Options('SETTINGS_PAGES','Forte Paging Settings',4,1);
		echo '</div>';
	echo '</div>';
?>