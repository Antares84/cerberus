<?php
	$errors=array();
	if(!isset($_SESSION['UUID']) || !$_SESSION['UID']){
#		$errors[]='0x01';
	}
	elseif(!isset($_SESSION['Status'])){
#		$errors[]='0x02';
	}
	if(count($errors)){
		echo '<div id="dialog-confirm" title="ADMIN PANEL: MSG">';
			echo '<br />';
			echo '<div id="error-msg">';
			foreach($errors as $error){
				echo error_msg($error);
			}
			echo '</div>';
		echo '</div>';
	}
?>