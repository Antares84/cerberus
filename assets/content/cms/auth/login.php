<?php
	$Valid = isset($_GET["Valid"]) ? $this->Data->escData(trim($_GET["Valid"])) : false;

	if(!empty($Valid)){
		if($Valid == true){
			header('Refresh:2;url=?'.$this->Setting->PAGE_PREFIX.'=HOME');
		}
	}
	else{
		echo '<form action="?'.$this->Setting->PAGE_PREFIX.'=VALIDATE" method="post" class="login_form border border_concave content_bg" id="auth">';
			echo '<h5 class="tac b_i">'.$this->Setting->SITE_TITLE.' - Login</h5>';
			echo '<div class="separator_10"></div>';
			echo '<div class="form-group">';
				echo '<input type="text" name="UserID" autocomplete="off" class="form-control tac" placeholder="Account Username" />';
			echo '</div>';
			echo '<div class="form-group">';
				echo '<input type="password" name="Pw" autocomplete="off" class="form-control tac" placeholder="Account Password" />';
			echo '</div>';
			echo '<div class="form-group tac">';
				echo '<button type="submit" name="sub_login" class="badge badge-pill badge-info f16">Authenticate</button>';
			echo '</div>';
		echo '</form>';
	}
?>