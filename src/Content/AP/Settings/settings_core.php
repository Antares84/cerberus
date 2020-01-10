<?php
#	$this->User->Auth();
#	$this->LogSys->createLog("Accessed Main ACP Settings");

	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			$this->SQL->_get_Options('SETTINGS_MAIN','Core Settings','CORE',1);
		#	$this->SQL->_get_Options('SETTINGS_MAIN','Mode Settings','MODE',0);
		#	$this->SQL->_get_Options('SETTINGS_MAIN','Metadata Settings','META',0);
		#	$this->SQL->_get_Options('SETTINGS_MAIN','Version Settings','VERSIONING',0);
		echo '</div>';
	echo '</div>';
?>