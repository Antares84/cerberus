<?php
	$this->User->Auth();

	$eid	=	isset($_GET['EntryID'])	?	trim($this->Data->_exec_data_mthd('escData',$_GET['EntryID']))	:	false;

	$this->Journal->_do_journal($eid);
?>