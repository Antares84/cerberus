<?php
	$e	=	isset($_POST["e"])	?	$Data->escData(trim($_POST["e"]))	:	false;

	echo '<div class="border border_concave content_bg" id="auth">';
		echo '<form class="login_form">';
			echo '<input type="hidden" name="Err_Chk" value="'.$e.'" />';

			echo '<h5 class="tac b_i">'.$this->Setting->SITE_TITLE.' - Login</h5>';
			echo '<div class="separator_10"></div>';
			echo '<div class="form-group">';
				echo '<input type="text" name="UserID" autocomplete="off" class="form-control tac" placeholder="Account Username" />';
			echo '</div>';
			echo '<div class="form-group">';
				echo '<input type="password" name="Pw" autocomplete="off" class="form-control tac" placeholder="Account Password" />';
			echo '</div>';
			echo '<div class="form-group tac">';
				echo '<button class="badge badge-pill badge-info f16 open_login_modal" data-target="#login_modal" data-toggle="modal">Authenticate</button>';
			echo '</div>';
		echo '</form>';
	echo '</div>';
?>