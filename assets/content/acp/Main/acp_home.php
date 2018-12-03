<?php
	$this->User->Auth();
	$this->LogSys->createLog('accessed Page('.$this->Paging->PAGE_TITLE.')');
	$Tasks			=	1;
	$Transactions	=	1;

	# CONTENT
	$this->Tpl->TitleBar("Welcome To Your Administration Panel");
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div class="ap_content">';
				echo '<p>';
					echo 'Welcome to your site Content Management System.<br>';
					echo 'Website Management tools can be found here.<br>';
					echo 'If you find something that isn\'t working, feel free to send an e-mail <a href="mailto:admin@ndf-innovations.net">here</a> detailing what the specific issue is, and where you encountered it.';
				echo '</p>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	$this->Tpl->TitleBar("Notices & Updates");
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div id="sb_content">';
				echo $this->Notices->get_SQL_UPDATES($this->Dirs->DIR_ASSETS);
			echo '</div>';
		echo '</div>';
	echo '</div>';

	# CMS INFO
	$this->Tpl->TitleBar("CMS Statistical Information");
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div class="table-responsive">';
				echo '<table class="table table-sm table-bordered table-striped acp_table tac">';
					echo '<tr>';
						echo '<th class="col-md-4">Version Type</th>';
						echo '<th class="col-md-4">Current Version</th>';
						echo '<th class="col-md-4">Update Status</th>';
						echo '<th></th>';
					echo '</tr>';
					echo '<tr>';
						echo '<td>CMS Version</td>';
						echo '<td><div class="badge-info">'.$this->Setting->VERSION.'</div></td>';
						echo '<td>'.$this->Version->ValidateVersion().'</td>';
						echo '<td><button class="badge badge-info align-middle open_updater_modal" data-target="#updater_modal" data-toggle="modal"><i class="fa fa-gear"></i> Update Info</button></td>';
					echo '</tr>';
				echo '</table>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	if(isset($_SESSION["AdminLevel"]) && $_SESSION["AdminLevel"] > 0){
/*
		# Comments/Chat Messages
		echo '<div class="row">';
			echo '<div class="col-lg-12">';
				echo '<div class="badge badge-secondary b_i f20" style="width:100%;">Forte Statistics</div>';
			echo '<div class="separator_10"></div>';
				# COMMENTS
				echo '<div class="col-xl-3 col-lg-6">';
				echo '<div id="title" class="tac">Forte - New Inquiries</div>';
					echo '<div class="card card-red card-inverse">';
						echo '<div class="card-header card-red">';
							echo '<div class="row">';
								echo '<div class="col-xs-3"><i class="fa fa-comments fa-5x"></i></div>';
								echo '<div class="col-xs-9 text-xs-right">';
									echo '<div class="huge">'.$this->Notices->get_Notices_Comments().'</div>';
									echo '<div>New Inquiries!</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="card-footer card-red">';
							echo '<a class="btn btn-default btn_cards" href="?'.$this->Setting->PAGE_PREFIX.'=Forte_Requests">View Details</a>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				# REQUESTS
				echo '<div class="col-xl-3 col-lg-6">';
					echo '<div id="title" class="tac">Forte - Inquiries Awaiting Validation</div>';
					echo '<div class="card card-yellow card-inverse">';
						echo '<div class="card-header card-yellow">';
							echo '<div class="row">';
								echo '<div class="col-xs-3"><i class="fa fa-tasks fa-5x"></i></div>';
								echo '<div class="col-xs-9 text-xs-right">';
									echo '<div class="huge">'.$this->Notices->get_Notices_Tasks().'</div>';
									echo '<div>Inquiries Needing Validated!</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="card-footer card-yellow">';
							echo '<a class="btn btn-default btn_cards" href="?'.$this->Setting->PAGE_PREFIX.'=Forte_Validate">View Details</a>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

				# TASKS
				echo '<div class="col-xl-3 col-lg-6">';
					echo '<div id="title" class="tac">Forte - Completed Orders</div>';
					echo '<div class="card card-green card-inverse">';
						echo '<div class="card-header card-green">';
							echo '<div class="row">';
								echo '<div class="col-xs-3"><i class="fa fa-shopping-cart fa-5x"></i></div>';
								echo '<div class="col-xs-9 text-xs-right">';
									echo '<div class="huge">'.$this->Notices->get_Notices_Orders().'</div>';
									echo '<div>Completed Orders!</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="card-footer card-green">';
							echo '<a class="btn btn-default btn_cards" href="?'.$this->Setting->PAGE_PREFIX.'=Forte_Completed"">View Details</a>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
/*
				# SUPPORT TICKETS
				echo '<div class="col-xl-3 col-lg-6">';
					echo '<div id="title" class="tac">Un-used</div>';
					echo '<div class="card card-red card-inverse">';
#						echo '<div class="card-header card-red"><i class="fa fa-money fa-fw"></i> Transactions</div>';
						echo '<div class="card-header card-red">';
							echo '<div class="row">';
								echo '<div class="col-xs-3"><i class="fa fa-support fa-5x"></i></div>';
								echo '<div class="col-xs-9 text-xs-right">';
									echo '<div class="huge">0</div>';
									echo '<div>Support Tickets!</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="card-footer card-red">';
							echo '<a class="btn btn-default btn_cards" href="javascript:;">View Details</a>';
						echo '</div>';
					echo '</div>';
				echo '</div>';

			echo '</div>';
		echo '</div>';
*/

		echo '<div class="container-fluid">';
			echo '<div class="row ap_content">';
				$this->Tpl->TitleBar("Administration Panel Access & Sales Logs");
				if($Tasks == 1 || $Transactions == 1){
					# Tasks
					if($Tasks == 1){
						if($Transactions == 1){echo '<div class="col-md-6 m_t_10">';}
						else{echo '<div class="col-md-12 m_t_10">';}
							echo '<div class="card text-white bg-dark">';
								echo '<div class="card-header card-primary text-center"><i class="fa fa-clock-o fa-fw"></i> Admin Panel Action Log</div>';
								echo '<div class="card-body">';
									echo '<div class="table-responsive">';
										echo '<table class="table table-sm table-bordered table-hover table-striped acp_table tac">';
											echo '<thead>';
												echo '<tr>';
													echo '<th>Action</th>';
													echo '<th>Time</th>';
												echo '</tr>';
											echo '</thead>';
											echo '<tbody>';
												$this->SQL->ActionLogs();
											echo '</tbody>';
										echo '</table>';
										echo '<div class="tac">';
											echo '<a class="badge badge-pill badge-primary b_i f14" href="?'.$this->Setting->PAGE_PREFIX.'=STF_PNL_LOG">View All Activity</a>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}

					# Transactions
					if($Transactions == 1){
						if($Tasks == 1){echo '<div class="col-md-6 m_t_10">';}
						else{echo '<div class="col-md-12 m_t_10">';}
							echo '<div class="card text-white bg-dark">';
								echo '<div class="card-header card-primary text-center"><i class="fa fa-money fa-fw"></i> Transactions</div>';
								echo '<div class="card-body">';
									echo '<div class="table-responsive">';
										echo '<table class="table table-sm table-bordered table-striped acp_table tac">';
											echo '<thead>';
												echo '<tr>';
													echo '<th>Order #</th>';
													echo '<th>Order Date</th>';
													echo '<th>Order Time</th>';
													echo '<th>Amount (USD)</th>';
													echo '<th>Transaction ID</th>';
													echo '<th>Status</th>';
												echo '</tr>';
											echo '</thead>';
											echo '<tbody>';
												$this->SQL->TransactionLogs();
											echo '</tbody>';
										echo '</table>';
										echo '<div class="tac">';
											echo '<a class="badge badge-pill badge-primary b_i f14" href="javascript:;">View All Transactions</a>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				}
			echo '</div>';
		echo '</div>';
	}
	$this->Modal->Display($this->Paging->PAGE_ZONE,'updater_modal','<i class="fa fa-pencil"></i>','0','2','Update Information');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_updater_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#updater_modal #dynamic-content').html('');
			$('#updater_modal #modal-loader tac').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Updater/updater.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
				$('#updater_modal #dynamic-content').html('');
				$('#updater_modal #dynamic-content').html(data);
				$('#updater_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#updater_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#updater_modal #modal-loader').hide();
			});
		});
	});
</script>