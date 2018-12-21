<?php
	if($this->User->_is_ADM()){
		$this->Setting->SET_DEFAULTS();
	}

	$this->Session->CLOSE_SESSION($this->User->UserUID);

	die(
		header("Location: ?".$this->Setting->PAGE_PREFIX."=HOME")
	);
?>