<?php
	# Script Security && Session Update
	if(!defined('IN_CMS')){
		$action	=	'Outside access detected';
	#	$this->Session->_action($action);
		exit;
	}
	else{
		$action	=	'Viewed login';
	#	$this->Session->_action($action);
	}

	# Page Content
	echo '<div class="container">';
		echo '<div class="row">';
			echo '<div class="col-md-3"></div>';
			echo '<div class="col-md-6">';
				echo '<div id="auth" class="cms_login">';
					echo '<form class="login_form">';
						echo '<h5 class="tac b_i">'.$this->Setting->_arr["SITE_TITLE"].' - Login</h5>';
						echo $this->Tpl->Separator('20');

						echo '<input type="hidden" name="SID" value="'.session_id().'">';

						echo '<div class="form-group">';
							echo '<input type="text" name="UserID" autocomplete="off" class="form-control tac" placeholder="Account Username">';
						echo '</div>';
						echo '<div class="form-group">';
							echo '<input type="password" name="Pw" autocomplete="off" class="form-control tac" placeholder="Account Password">';
						echo '</div>';
						echo '<div class="form-group tac">';
							echo '<button class="badge badge-pill badge-info f_16 open_login_modal" data-target="#login_modal" data-toggle="modal">Authenticate</button>';
						echo '</div>';
					echo '</form>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>