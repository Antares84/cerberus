<?php
	echo '<div class="card no_bg no_border no_radius">';
		echo '<div class="card-header card_border tac title pTitle show no_radius">Welcome To Your Profile, <span class="b_i">'.$this->User->UserID.'</div>';
		echo '<div class="card-body card_border content_bg content no_radius pContent no_padding">';
			echo '<div class="card-text">';
				echo '<div id="tabs_profile">';
					echo '<ul>';
						echo '<li><a href="#tabs-1">Account Details</a></li>';
						echo '<li><a href="#tabs-2">Characters</a></li>';
#						echo '<li><a href="#tabs-1">Change Password</a></li>';
					if($this->User->isAdmin()){
						echo '<li><a href="#tabs-4">Session</a></li>';
					}
					echo '</ul>';

					echo '<div id="tabs-1">';
						echo '<form action="" method="post">';
							echo '<div class="separator_10"></div>';

							echo '<div class="form-group row">';
								echo '<label for="input-UserID" class="control-label col-sm-4 tar">My UserID</label>';
								echo '<div class="col-sm-4 tac">';
									echo '<input type="text" class="form-control tac" id="input-UserID" name="UserID" value="'.$this->User->UserID.'" disabled>';
								echo '</div>';
							echo '</div>';
/*
							echo '<div class="form-group row">';
								echo '<label for="input-MemberID" class="control-label col-sm-4 tar">My MemberID</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="text" class="form-control tac" id="input-MemberID" name="MemberID" value="'.$this->User->MemberID.'" readonly>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<label for="input-DisplayName" class="control-label col-sm-4 tar">My Display Name</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="text" class="form-control tac" id="input-DisplayName" name="DisplayName" value="'.$this->User->DisplayName.'" readonly>';
								echo '</div>';
								echo '<div class="col-sm-2 tac">';
									echo '<button class="btn btn-warning open_settings_modal" data-id="DisplayName~'.$this->User->MemberID.'~'.$this->User->DisplayName.'" data-target="#settings_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button>';
								echo '</div>';
							echo '</div>';
*/
							echo '<div class="form-group row">';
								echo '<label for="input-Email" class="control-label col-sm-4 tar">E-Mail Address</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="text" class="form-control tac" id="input-Email" name="Email" value="'.$this->User->Email.'" readonly>';
								echo '</div>';
								echo '<div class="col-sm-2 tac">';
									echo '<button class="btn btn-warning open_settings_modal" data-id="Email~'.$this->User->UserUID.'~'.$this->User->Email.'" data-target="#settings_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<label for="input-RegDate" class="control-label col-sm-4 tar">Registration Date</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="text" class="form-control tac" id="input-RegDate" name="RegDate" value="'.Date("m/d/Y", strtotime($this->User->RegDate)).'" disabled>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<label for="input-L_Online" class="control-label col-sm-4 tar">Last Online</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="text" class="form-control tac" id="input-L_Online" name="L_Online" value="'.$this->Data->getDateDiff($this->User->LeaveDate).'" disabled>';
								echo '</div>';
							echo '</div>';
/*
							echo '<div class="form-group row">';
								echo '<label for="input-Country" class="control-label col-sm-4 tar">Country</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="text" class="form-control tac" id="input-Country" name="Country" value="'.$this->User->Country.'" disabled>';
								echo '</div>';
							echo '</div>';

							echo '<div class="form-group row">';
								echo '<label for="input-Reg_IP" class="control-label col-sm-4 tar">Registered IP</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="text" class="form-control tac" id="input-Reg_IP" name="Reg_IP" value="'.$this->User->RegIP.'" disabled>';
								echo '</div>';
							echo '</div>';
*/
							echo '<div class="form-group row">';
								echo '<label for="input-Curr_IP" class="control-label col-sm-4 tar">Current IP</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="text" class="form-control tac" id="input-Curr_IP" name="Curr_IP" value="'.$this->User->UserIP.'" disabled>';
								echo '</div>';
							echo '</div>';

						echo '</form>';
					echo '</div>'; // end tab 1

					# Tab 2 - Character Profiles
					echo '<div id="tabs-2">';
						
					echo '</div>';

					#	Password Update Tab - #3
/*					echo '<div id="tabs-3">';

					if(isset($_POST['submit']) && !empty($_POST['submit'])){
						$oldpw	=	isset($_POST['oldpw']) ? escData(trim($_POST['oldpw'])) : '';
						$newpw	=	isset($_POST['newpw']) ? escData(trim($_POST['newpw'])) : '';
						$UserID	=	$_SESSION["uid"];

						$sql	=	("SELECT UserID, PwPlain FROM SDM_UserData.dbo.Users_Master WHERE UserID=? AND PwPlain=?");
						$stmt	=	odbc_prepare($cxn,$sql);
						$args	=	array($UserID,$opw);
						$prep	=	odbc_execute($stmt,$args);

						if($prep){
							if(odbc_num_rows($stmt) == 0){
								# Error Checking
								die('Error');
							}else{
								$sql = ('UPDATE SDM_UserData.dbo.Users_Master SET Pw=? WHERE UserID=?');
								$stmt = odbc_prepare($cxn,$sql);
								$args = array($npw,$UserID);
								$res = odbc_execute($stmt,$args);

								# Error Checking
								$sql = odbc_prepare($dbConn,"SELECT * FROM SDM_UserData.dbo.Users_Master WHERE UserID='".$UserID."' AND PwPlain='".$npw."'");
								$res = odbc_execute($stmt,$args);
								$data = odbc_num_rows($sql);

								if(odbc_num_rows($sql)==1){
									echo  'Completed';
								}else{
									echo  'Update Failed';
								}
							}
							header('location:?page=user_profile#tabs-3');
						}
					}
					else{
						echo '<form action="" method="post">';
							echo '<div class="separator_10"></div>';
							echo '<div class="form-group row">';
								echo '<label for="input_old_pw" class="control-label col-sm-4 tar">Old Password</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="password" class="form-control" id="input_old_pw" name="oldpw" placeholder="Enter Old Password">';
								echo '</div>';
							echo '</div>';
							echo '<div class="form-group row">';
								echo '<label for="input_new_pw" class="control-label col-sm-4 tar">New Password</label>';
								echo '<div class="col-sm-4">';
									echo '<input type="password" class="form-control" id="input_new_pw" name="newpw" placeholder="Enter New Password">';
								echo '</div>';
							echo '</div>';
				#			echo '<div class="form-group span6 fn">';
				#				echo '<div class="col-sm-offset-2 col-sm-10">';
				#					echo '<button type="submit" name="sub_pw" class="btn btn-primary">Change/Update Passord</button>';
				#				echo '</div>';
				#			echo '</div>';
						echo '</form>';
					}

					echo '</div>'; # end of tab 2
*/
					# Account Settings Tab
					if($this->User->isAdmin() === true){
						echo '<div id="tabs-4">'; # begin tab 5
							echo 'Session UID: '.$_SESSION['UserID'].'<br />';
							echo 'Session UUID: '.$_SESSION['UserUID'].'<br />';
							echo 'SessionID: '.session_id().'<br />';
							echo 'User IP: '.$this->User->UserIP.'<br />';
						echo '</div>';
					}
				echo '</div>'; # end tabs
			echo '</div>';
		echo '</div>';
	echo '</div>';

	$this->Modal->Display($this->Paging->PAGE_ZONE,'settings_modal','<i class="fa fa-pencil"></i>','0','2','Update Profile Information');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'delete_modal','<i class="fa fa-pencil"></i>','0','2','Delete Journal Entry');
?>
<script>
	// Edit Profile Information
	$(document).ready(function(){
		$(document).on('click','.open_settings_modal',function(e){
			e.preventDefault();
			var uid = $(this).data('id');

			$('#settings_modal #dynamic-content').html('');
			$('#settings_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->JQUERY_ADDONS_DIR;?>ajax/site/Profile/update_profile.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
					console.log(data);
				<?php } ?>
				$('#settings_modal #dynamic-content').html('');
				$('#settings_modal #dynamic-content').html(data);
				$('#settings_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#settings_modal #modal-loader').hide();
			});
		});
	});
	// Delete Journal Entry
	$(document).ready(function(){
		$(document).on('click','.open_delete_modal',function(e){
			e.preventDefault();
			var uid = $(this).data('id');

			$('#delete_modal #dynamic-content').html('');
			$('#delete_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->JQUERY_ADDONS_DIR;?>ajax/site/Journal/entry_delete.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
					console.log(data);
				<?php } ?>
				$('#delete_modal #dynamic-content').html('');
				$('#delete_modal #dynamic-content').html(data);
				$('#delete_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#delete_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#delete_modal #modal-loader').hide();
			});
		});
	});
</script>