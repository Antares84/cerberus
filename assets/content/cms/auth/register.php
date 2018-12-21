<?php
	echo '<div class="card no_bg no_border no_radius">';
		echo '<div class="card-header card_border tac title pTitle show no_radius">'.$this->Setting->SITE_TITLE.' Registration</div>';
		echo '<div class="card-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
				echo '<div class="container">';
					echo '<form class="register_Form" id="register">';
					# MAILSYS NOTICE
					if($this->MailSys->ENABLED){
						echo '<div class="form-group row">';
							echo '<div class="col-sm-12 tac">';
								echo '<div class="badge badge-pill badge-dark tac w_100_p f16">Notice</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="separator_10"></div>';

						echo '<div class="form-group row">';
							echo '<div class="col-sm-12 tac">';
								echo 'Usage of your <b>REAL</b> e-mail address is required for e-mail verification.<br>';
								echo 'Please check your <b>Spam</b> folder if you can\'t find the e-mail in your inbox.<br>';
								echo 'Please use a <b>REAL</b> security question and answer as this will be used to recover<br>';
								echo 'your account should anything ever happen to it.<br><br>';
								echo 'All fields are required.';
							echo '</div>';
						echo '</div>';
						echo '<div class="separator_10"></div>';
					}
						# ACCOUNT
						echo '<div class="form-group row">';
							echo '<div class="col-sm-12 tac">';
								echo '<div class="badge badge-pill badge-dark tac w_100_p f_16">Account</div>';
							echo '</div>';
						echo '</div>';

						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="input-group col-md-4 col-sm-12">';
								echo '<input autocomplete="off" class="form-control tac" id="Input-UserID" name="UserID" placeholder="Desired UserID" type="text" />';
								echo '<div class="input-group-append">';
									echo '<button class="btn badge badge-warning open_verify_userid_modal" data-id="" data-target="#verify_userid_modal" data-toggle="modal">Check</button>';
								echo '</div>';
							echo '</div>';
						echo '</div>';

						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="input-group col-md-4 col-sm-12">';
								echo '<input autocomplete="off" class="form-control tac" id="Input-DisplayName" name="DisplayName" placeholder="Desired Display Name" type="text"/>';
								echo '<div class="input-group-append">';
									echo '<button class="btn badge badge-warning open_verify_displayname_modal" data-id="" data-target="#verify_displayname_modal" data-toggle="modal">Check</button>';
								echo '</div>';
							echo '</div>';
						echo '</div>';

						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo '<input autocomplete="off" class="form-control tac" id="Input-Password" name="Password" placeholder="Password" type="password" />';
							echo '</div>';
						echo '</div>';

						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo '<input autocomplete="off" class="form-control tac" id="Input-Password2" name="c_Password" placeholder="Confirm Password" type="password" />';
							echo '</div>';
						echo '</div>';

						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo '<input autocomplete="off" class="form-control tac" id="Input-Referer" name="Referer" placeholder="Referer" type="text"/>';
							echo '</div>';
						echo '</div>';
						echo '<div class="separator_10"></div>';

						# PERSONAL - HEADER
						echo '<div class="form-group row">';
							echo '<div class="col-sm-12 tac">';
								echo '<div class="badge badge-pill badge-dark tac w_100_p f_16">Personal</div>';
							echo '</div>';
						echo '</div>';

						# PERSONAL - DOB
						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo '<input class="form-control tac jQuery-Date" id="Input-DOB" name="DOB" placeholder="Date of Birth" type="text"/>';
							echo '</div>';
						echo '</div>';

						# PERSONAL - GENDER
						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo $this->Select->gender();
							echo '</div>';
						echo '</div>';

						# PERSONAL - SEC QUESTION
						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo $this->Select->sec_question();
							echo '</div>';
						echo '</div>';

						# PERSONAL - SEC ANSWER
						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo '<input autocomplete="off" class="form-control tac" id="Input-SecAnswer" name="SecAnswer" placeholder="Security Answer" type="text"/>';
							echo '</div>';
						echo '</div>';

						# PERSONAL - EMAIL
						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo '<input autocomplete="off" class="form-control tac" id="Input-EMail" name="EMail" placeholder="E-Mail" type="email" />';
							echo '</div>';
						echo '</div>';

						# PERSONAL - TOS AGREEMENT
						echo '<div class="form-group row">';
							echo '<div class="col-md-4 hidden-sm-down"></div>';
							echo '<div class="col-md-4 col-sm-12">';
								echo '<center>';
									echo '<input name="Checkbox" type="radio"/> I Agree to the <a href="?'.$this->Setting->PAGE_PREFIX.'=ToS" target="_blank">'.$this->Setting->SITE_TITLE.' Terms Of Use</a>';
								echo '</center>';
							echo '</div>';
						echo '</div>';

						# SUBMISSION
						echo '<div class="form-group row">';
							echo '<div class="col-md-12 tac f_20">';
								echo '<button class="badge badge-primary open_register_modal" data-id="register_submit" data-target="#register_modal" data-toggle="modal">Create Account</button>';
							echo '</div>';
						echo '</div>';
					echo '</form>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>