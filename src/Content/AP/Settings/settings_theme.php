<?php
	$this->User->Auth();
	$this->LogSys->createLog("accessed page (Settings: Theme");

	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			$this->SQL->_get_Options("SETTINGS_THEME","Theme Names","THEME",1);
			$this->SQL->_get_Options("SETTINGS_THEME","Backgrounds","BG",1);
			$this->SQL->_get_Options("SETTINGS_THEME","Background Colors","BG_COLOR",1);
			$this->SQL->_get_Options("SETTINGS_THEME","Pane Settings","PANE",1);
			$this->SQL->_get_Options("SETTINGS_THEME","Misc","Misc",1);
			$this->SQL->_get_Options("SETTINGS_THEME","Nav","NAV",1);
			$this->SQL->_get_Options("SETTINGS_THEME","Footer","FOOTER",1);
		echo '</div>';
	echo '</div>';
?>