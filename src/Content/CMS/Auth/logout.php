<?php
	if($this->User->_is_staff()){
		$this->Setting->_do_set_defaults();
	}

	$this->Session->_do_logout($_SESSION["CMS"]["sid"]);
?>