<?php
	session_destroy();
	if($this->Setting->SITE_TYPE === "Standard"){
		header('Location: ?'.$this->Setting->PAGE_PREFIX.'=PMI_Login');
		exit();
	}
	elseif($this->Setting->SITE_TYPE === "Gaming"){
		header('Location: ?'.$this->Setting->PAGE_PREFIX.'=Login');
		exit();
	}
?>