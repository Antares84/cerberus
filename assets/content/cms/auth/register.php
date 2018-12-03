<?php
#	echo '<pre>';
#		var_dump($_GET);
#	echo '</pre>';
#	exit();
	$Valid = isset($_GET["Valid"]) ? $this->Data->escData(trim($_GET["Valid"])) : false;

	# CONTENT
	if(!empty($Valid)){
		if($Valid == true){
			echo '<div class="row tac">';
				echo '<div class="col-md-12">';
					echo '<a class="badge badge-pill badge-info f_16" href="?'.$this->Setting->PAGE_PREFIX.'=AUTH">Log In</a>';
				echo '</div>';
			echo '</div>';
			unset($Valid);
		}
		
	}
	else{
		echo '<div class="card no_bg no_border no_radius">';
			echo '<div class="card-header card_border tac title pTitle show no_radius">'.$this->Setting->SITE_TITLE.' Registration</div>';
			echo '<div class="card-block card_border content_bg content no_radius pContent">';
				echo '<div class="card-text">';
					echo '<div class="container">';
						echo '<form action="?'.$this->Setting->PAGE_PREFIX.'=VALIDATE" method="post" id="register">';
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

							# PERSONAL
							echo '<div class="form-group row">';
								echo '<div class="col-sm-12 tac">';
									echo '<div class="badge badge-pill badge-dark tac w_100_p f_16">Personal</div>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-DOB" name="DOB" placeholder="Date of Birth" type="text"/>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo $this->Select->gender();
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo $this->Select->sec_question();
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-SecAnswer" name="SecAnswer" placeholder="Security Answer" type="text"/>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<input autocomplete="off" class="form-control tac" id="Input-EMail" name="EMail" placeholder="E-Mail" type="email" />';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-4 hidden-sm-down"></div>';
								echo '<div class="col-md-4 col-sm-12">';
									echo '<center>';
										echo '<input name="Checkbox" type="radio"/> I Agree to the <a href="?'.$this->Setting->PAGE_PREFIX.'=ToS" target="_blank">'.$this->Setting->SITE_TITLE.' Terms Of Use</a>';
									echo '</center>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<div class="col-md-12 tac">';
									echo '<button class="badge badge-primary center-block" type="submit" name="sub_reg">Create Account</button>';
								echo '</div>';
							echo '</div>';
						echo '</form>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		$this->Modal->Display($this->Paging->PAGE_ZONE,'verify_userid_modal','<i class="fa fa-pencil"></i>','0','2','Check UserID Availability');
		$this->Modal->Display($this->Paging->PAGE_ZONE,'verify_displayname_modal','<i class="fa fa-pencil"></i>','0','2','Check Display Name Availability');
	}
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_verify_userid_modal',function(e){
			e.preventDefault();

			$('#verify_userid_modal #dynamic-content').html('');
			$('#verify_userid_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[1];?>ajax/Site/Registration/verify_userid.php",
				type: 'POST',
				data: $('form#register').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
					console.log(data);
				<?php } ?>
				$('#verify_userid_modal #dynamic-content').html('');
				$('#verify_userid_modal #dynamic-content').html(data);
				$('#verify_userid_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#verify_userid_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#verify_userid_modal #modal-loader').hide();
			});
		});
		$(document).on('click','.open_verify_displayname_modal',function(e){
			e.preventDefault();

			$('#verify_displayname_modal #dynamic-content').html('');
			$('#verify_displayname_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[1];?>ajax/Site/Registration/verify_displayname.php",
				type: 'POST',
				data: $('form').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
					console.log(data);
				<?php } ?>
				$('#verify_displayname_modal #dynamic-content').html('');
				$('#verify_displayname_modal #dynamic-content').html(data);
				$('#verify_displayname_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#verify_displayname_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#verify_displayname_modal #modal-loader').hide();
			});
		});
	});
</script>