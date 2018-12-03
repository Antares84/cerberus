<?php
	# Vars
	$errors			=	array();
	$postSuccess	=	false;
	$deleteSuccess	=	false;

#	Tab 1 Post Response
	if(isset($_POST['DonateAdd'])){
		$rewardAdd	=	$_POST['rewardAdd'];
		$priceAdd	=	$_POST['priceAdd'];

		if(empty($rewardAdd) || empty($priceAdd)){
			$errors[]='Please verify all fields';
		}

		if(empty($errors)){
			$sql	=	("
							INSERT INTO ".$this->db->get_TABLE("DONATE_OPTIONS")."
								(Reward, Price)
							VALUES
								(?,?)
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($rewardAdd,$priceAdd);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				$postSuccess='<strong>SUCCESS:</strong> Donation Option has been posted!';
			}
			else{
				echo 'Script failed(rewardAdd)';
			}
		}
	}
#	Tab 2 Post Response
	if(isset($_POST['DonateDel'])){
		$deletes	=	$_POST['deleteCheck'];

		foreach($deletes as $delete){
			$sql	=	("
							DELETE FROM ".$this->db->get_TABLE("DONATE_OPTIONS")."
							WHERE RowID=?
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($delete);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				$deleteSuccess = '<strong>SUCCESS:</strong> Donation Option Has Been Removed!';
			}
			else{
				echo 'Script failed.';
			}
		}
	}

	# Tab 3 Response | Payments
	if(isset($_POST['ClearPmts'])){
		$sql	=	odbc_exec($this->db->conn,"TRUNCATE TABLE ".$this->db->get_TABLE("ACP_PAYMENTS")."");
		if($sql){
			$deleteSuccess = '<strong>SUCCESS:</strong> Payments have been cleared';
		}
		else{
			echo 'Script failed.';
		}
	}

	$this->Tpl->Titlebar('Payment Office');
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
				echo '<div id="tabs">';
					echo '<ul>';
						echo '<li><a href="#tabs-1">Post Donation Options</a></li>';
						echo '<li><a href="#tabs-2">Delete Donation Options</a></li>';
						echo '<li><a href="#tabs-3">Payments</a></li>';
					echo '</ul>';
					echo '<div id="tabs-1">';
					if(count($errors) != 0){
						foreach($errors as $error){
							echo '<div class="tac">';
								echo $error;
							echo '</div>';
						}
					}
					else{
						echo '<div class="tac">';
							echo $postSuccess;
						echo '</div>';
					}
						echo '<form action="" method="POST">';
							echo '<div class="table-responsive">';
								echo '<table class="table table-sm acp_table tac">';
									echo '<thead>';
										echo '<tr>';
											echo '<th class="tac">Reward</th>';
											echo '<th class="tac">Price</th>';
											echo '<th></th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
										echo '<tr>';
											echo '<td>';
												$this->Tpl->input_group("rewardAdd","1000","","","","points");
											echo '</td>';
											echo '<td>';
												$this->Tpl->input_group("priceAdd","1.00","","","$","USD");
											echo '</td>';
											echo '<td class="tac text-center f22"><button class="badge badge-primary" name="DonateAdd" type="submit">Add</button></td>';
										echo '</tr>';
									echo '</tbody>';
								echo '</table>';
							echo '</div>';
						echo '</form>';
					echo '</div>';# <!-- end of tab 1 -->

					echo '<div id="tabs-2">';
					if(count($errors) != 0){
						foreach($errors as $error){
							echo '<div class="tac">';
								echo $error;
							echo '</div>';
						}
					}
					else{
						echo '<div class="tac">';
							echo $deleteSuccess;
						echo '</div>';
					}
						echo '<form action="" class="acp-form" method="POST">';
							echo '<div class="table-responsive">';
								echo '<table class="table table-sm acp_table tac sTable withCheck" id="checkAll">';
									echo '<tr>';
										echo '<th width="5%">';
											echo '<div class="form-check">';
												echo '<input type="checkbox" class="form-check-input" id="exampleCheck1" disabled>';
											echo '</div>';
										echo '</th>';
										echo '<th width="7%">Reward ID</th>';
										echo '<th>Reward</th>';
										echo '<th>Price</th>';
										echo '<th>Date Added</th>';
									echo '</tr>';
								$sql	=	odbc_exec($this->db->conn,"SELECT * FROM ".$this->db->get_TABLE("DONATE_OPTIONS")." ORDER BY RowID ASC");
								while($show = odbc_fetch_array($sql)){
									echo '<tr>';
										echo '<td>';
											echo '<div class="form-check">';
												echo '<input type="checkbox" class="form-check-input" name="deleteCheck[]" value="'.$show['RowID'].'"/>';
											echo '</div>';
										echo '</td>';
										echo '<td>'.htmlentities($show['RowID']).'</td>';
										echo '<td>'.htmlentities($show['Reward']).' points</td>';
										echo '<td>$'.htmlentities($show['Price']).'</td>';
										echo '<td>'.htmlentities(date("m/d/y h:i:s A", strtotime($show['Date']))).'</td>';
									echo '</tr>';
								}
								echo '</table>';
							echo '</div>';
							echo '<div class="text-center tac f20">';
								echo '<button class="badge badge-primary" type="submit" name="DonateDel">Delete Donation Option(s)</button>';
							echo '</div>';
						echo '</form>';
					echo '</div>';# <!-- end of tab 2 -->

					echo '<div id="tabs-3">';
						echo '<div style="text-align:center;">'.$deleteSuccess.'</div>';
						$sql	=	odbc_exec($this->db->conn,"SELECT * FROM ".$this->db->get_TABLE("LOG_PAYMENTS")."");
						if(odbc_num_rows($sql) > 0){
							$sql	=	odbc_exec($this->db->conn,"SELECT * FROM ".$this->db->get_TABLE("LOG_PAYMENTS")." ORDER BY PaymentDate ASC");
							echo '<form action="" class="content-form" method="POST">';
								echo '<div class="table-responsive">';
									echo '<table class="table table-bordered table-hover table-striped acp_table tac">';
										echo '<thead>';
											echo '<tr>';
												echo '<th>UserID</th>';
												echo '<th>Amount Paid</th>';
												echo '<th>DP Given</th>';
												echo '<th>Email</th>';
												echo '<th>Status</th>';
												echo '<th>Trans ID</th>';
												echo '<th>Payment Type</th>';
												echo '<th>Date</th>';
											echo '</tr>';
										echo '</thead>';
										echo '<tbody>';
										while($TransInfo	=	odbc_fetch_array($sql)){
											echo '<tr>';
												echo '<td>'.$TransInfo['UserID'].'</td>';
												echo '<td>$'.$TransInfo['Paid'].'</td>';
												echo '<td>'.$TransInfo['Reward'].'</td>';
												echo '<td>'.$TransInfo['DonatorEmail'].'</td>';
												echo '<td>'.$TransInfo['PaymentStatus'].'</td>';
												echo '<td>'.$TransInfo['TransID'].'</td>';
												echo '<td>'.$TransInfo['PaymentType'].'</td>';
												echo '<td>'.date("m/d/y", strtotime($TransInfo['PaymentDate'])).'</td>';
											echo '</tr>';
										}
										echo '</tbody>';
									echo '</table>';
								echo '</div>';
								echo '<br>';
								echo '<div class="tac">';
#									echo '<input type="submit" value="Clear Logs" name="ClearPmts" />';
#									echo '<button class="badge badge-pill badge-warning f16" ></button>';
									echo '<button class="btn btn-sm btn-warning badge-pill b_i f_20" type="submit" name="ClearPmts">Clear Logs</button>';
								echo '</div>';
							echo '</form>';
						}else{
							echo 'No transactions found.';
						}
					echo '</div>';#<!-- end of tab 3 -->
				echo '</div>';# <!-- end of tabs -->
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>