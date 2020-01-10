<?php
	if(!defined('IN_CMS')){exit;}

	echo '<div class="card no_bg no_border no_radius">';
		echo '<div class="card-header card_border tac title pTitle show no_radius">Welcome To Your Profile, <span class="b_i">'.$this->User->_get_UserInfo('DisplayName').'</div>';
		echo '<div class="card-body card_border content_bg content no_radius pContent no_padding">';
			echo '<div class="card-text">';
				echo '<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">';
					echo '<li class="nav-item">';
						echo '<a class="nav-link active" id="details" data-toggle="pill" href="#acct-details" role="tab">Account Details</a>';
					echo '</li>';
				if($this->User->ADM===true){
					echo '<li class="nav-item">';
						echo '<a class="nav-link" id="sess-info" data-toggle="pill" href="#session" role="tab" aria-controls="pills-contact" aria-selected="false">Session</a>';
					echo '</li>';
				}
				echo '</ul>';

				echo '<div class="tab-content" id="pills-tabContent">';
					echo '<div class="tab-pane fade show active" id="acct-details" role="tabpanel">';
						echo '<div class="container-fluid">';
							echo '<div class="row">';
								echo '<div class="col-md-12 tac bg-dark">';
									echo $this->Tpl->Titlebar('Account Information','w_100_p');
								echo '</div>';
						#		echo '<div class="col-md-3 tac bg-dark">';
						#			echo $this->Tpl->Titlebar('Profile Image','w_25_p');
						#		echo '</div>';
							echo '</div>';
						echo '</div>';

						echo '<div class="row">';
							echo '<div class="col-md-12">';
								echo '<div class="table-responsive" style="border:1px solid lime;">';
									echo '<table class="table table-sm">';
										echo '<tr>';
											echo '<td>Display Name:</td>';
											echo '<td><span class="member-span">'.$this->User->_get_UserInfo('DisplayName').'</span></td>';
											echo '<td>Account E-Mail:</td>';
											echo '<td>'.$this->User->_get_UserInfo('Email').'</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td>Registration Date:</td>';
											echo '<td>'.$this->User->_get_UserInfo('JoinDate').'</td>';
											echo '<td>Last Online:</td>';
											echo '<td>'.$this->User->_get_UserInfo('LeaveDate').'</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td>Fleet Join Date:</td>';
											echo '<td></td>';
											echo '<td>Country:</td>';
											echo '<td>'.$this->User->_get_UserInfo('Country').'</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td>Registered IP:</td>';
											echo '<td></td>';
											echo '<td>Current IP:</td>';
											echo '<td>'.$this->User->_get_UserInfo('UserIP').'</td>';
										echo '</tr>';
									echo '</table>';
								echo '</div>';
							echo '</div>';
						#	echo '<div class="col-md-3 p_lr_0" style="border:1px solid red;">';
						#		echo '<img src="http://sto-dec.ndf-innovations.net/assets/skins/STO/images/image_placeholder.png" class="img-responsive">';
						#	echo '</div>';
						echo '</div>';
					echo '</div>';

					echo '<div class="tab-pane fade" id="pills-profile" role="tabpanel">';
						
					echo '</div>';

					echo '<div class="tab-pane fade" id="session" role="tabpanel">';
						echo '<div class="container-fluid">';
						if($this->User->ADM===true){
							echo '<div class="row">';
								echo '<div class="col-md-12 tac bg-dark">';
									echo $this->Tpl->Titlebar('Account Information','w_100_p');
								echo '</div>';
							echo '</div>';

							echo '<div class="row">';
								echo '<div class="col-md-12">';
									echo 'Session UID: '.$_SESSION['UserID'].'<br>';
									echo 'Session UUID: '.$_SESSION['UserUID'].'<br>';
									echo 'SessionID: '.session_id().'<br>';
									echo 'User IP: '.$this->User->_get_UserInfo('UserIP').'<br>';
								echo '</div>';
							echo '</div>';
						}
						echo '</div>';
					echo '</div>';

					# Account Settings Tab
					echo '<div class="tab-pane fade" id="acct-settings" role="tabpanel">';
						
					echo '</div>'; # end tab-panes
				echo '</div>'; # end tab-content
			echo '</div>'; # end card-text
		echo '</div>'; # end card-body
	echo '</div>'; # end card
?>