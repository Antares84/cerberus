<?php
	if(empty($_SESSION['UUID']) || empty($_SESSION['UID'])){
		header('Location: ?'.$this->Setting->PAGE_PREFIX.'=EndSession');
	}
	elseif(isset($_SESSION['UUID']) && isset($_SESSION['UID']) && empty($_SESSION['Status'])){
		header('Location: ?'.$this->Setting->PAGE_PREFIX.'=Validate');
	}
?>