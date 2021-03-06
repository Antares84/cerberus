<?php
	$this->User->Auth();
	$this->LogSys->createLog('accessed Page('.$this->Paging->PAGE_TITLE.')');
	$Tasks			=	1;
	$Transactions	=	1;

	# Welcome
	$this->Tpl->TitleBar('Welcome To Your Administration Panel','w_100_p');
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

	# Notices & Updates
	$this->Tpl->TitleBar('Notices & Updates','w_100_p');
	echo $this->Notices->_sql_updates($this->Dirs->_array[0]);
	$this->Tpl->Separator(20);

	# CMS INFO
	$this->Tpl->TitleBar('CMS Statistical Information','w_100_p');
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
						echo '<td class="text-white">CMS Version</td>';
						echo '<td><div class="badge-info">'.$this->Setting->_arr["VERSION"].'</div></td>';
						echo '<td>'.$this->Version->_do_validate_version().'</td>';
						echo '<td><button class="badge badge-info align-middle open_updater_modal" data-target="#updater_modal" data-toggle="modal"><i class="fa fa-gear"></i> Update Info</button></td>';
					echo '</tr>';
				echo '</table>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	if(
		isset($_SESSION["AdminLevel"]) && $this->User->_is_ADM() || $this->User->_is_GM()){
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

		# Logs
		$this->Tpl->TitleBar('System Logs','w_100_p');
		echo '<div class="row ap_content">';
			# Tasks
			$this->LogSys->_get_logs("6","actions");
			# Transactions
			$this->LogSys->_get_logs("6","transactions");
		echo '</div>';
	}
?>