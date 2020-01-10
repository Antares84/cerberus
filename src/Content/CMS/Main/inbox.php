<?php
	if( $_SESSION["settings"]["fieldsets"] == 1 ){
		echo '<div class="row hide">';
			echo '<fieldset>';
				echo '<legend>Your Mail, <font class="orange">'.$_SESSION["uid"].'</font></legend>';
				getInbox();
			echo '<div class="separator"></div>';
			echo '</fieldset>';
		echo '</div>';
		echo '<div class="separator"></div>';
	}else{
		echo '<div class="row hide">';
			echo '<div class="title tac">Your Mail, <font class="orange">'.$_SESSION["uid"].'</font></div>';
			echo '<div class="inner">';
				getInbox();
			echo '</div>';
		echo '</div>';
		echo '<div class="separator"></div>';
	}
?>