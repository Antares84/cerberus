<?php
	class LogSys{
		function __construct($Data,$db,$Setting){
			$this->Data		=	$Data;
			$this->db		=	$db;
			$this->Setting	=	$Setting;
		}
		function _get_logs($data,$logtype){
			$method = '_get_logs_'.$logtype;

			if(method_exists($this,$method)){
				return $this->$method($data);
			}

			return $data;
		}
		function createLog($Action){
			$sql	=	("INSERT INTO ".$this->db->get_TABLE("LOG_ACCESS")."
							(UserID,UserIP,Action)
						VALUES
							(?,?,?)
						");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($_SESSION["UserID"],$_SERVER['REMOTE_ADDR'],$Action);
			odbc_execute($stmt,$args);

		}
		function do_PAYPAL($t1,$t2){
			$sql	=	("INSERT INTO ".$this->db->get_TABLE("LOG_DONATE")."
							(CODE,MSG)
						VALUES
							(?,?)
						");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($t1,$t2);
			odbc_execute($stmt,$args);

			odbc_free_result($stmt);
			odbc_close($this->conn);
		}
		function _get_logs_actions($Size){
			$Top	=	'8';

			$sql	=	('
							SELECT TOP 8 *
							FROM '.$this->db->get_TABLE("LOG_ACCESS").'
							ORDER BY ActionTime DESC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				echo '<div class="col-md-'.$Size.' m_t_10">';
					echo '<div class="card text-white bg-dark">';
						echo '<div class="card-header">';
							echo '<div class="tac m_b_10">';
								echo '<i class="fa fa-clock-o fa-fw"></i> Admin Panel Action Log';
							echo '</div>';
							echo '<div class="tac">';
								echo '<h6 class="card-subtitle mb-2 text-muted tac">Showing Top '.$Top.' Records</h6>';
							echo '</div>';
						echo '</div>';
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
									while($data = odbc_fetch_array($stmt)){
										$UserID		=	$data["UserID"];
										$Action		=	$data["Action"];
										$ActionTime	=	$this->Data->getDateDiff($data['ActionTime']);
										echo '<tr>';
											echo '<td><a href="javascript:;">'.$UserID.' '.$Action.'</td>';
											echo '<td><span class="badge badge-pill badge-secondary">'.$ActionTime.'</span></td>';
										echo '<tr>';
									}
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
		}
		function _get_logs_transactions($Size){
			$Top	=	'8';
			$sql	=	('
							SELECT TOP 8 *
							FROM '.$this->db->get_TABLE("LOG_PAYMENTS").'
							ORDER BY PaymentDate DESC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					echo '<div class="col-md-'.$Size.' m_t_10 no_padding">';
						echo '<div class="card text-white bg-dark">';
							echo '<div class="card-header">';
								echo '<div class="tac m_b_10">';
									echo '<i class="fa fa-money fa-fw"></i> Transactions';
								echo '</div>';
								echo '<div class="tac">';
									echo '<h6 class="card-subtitle mb-2 text-muted tac">Showing Top '.$Top.' Records</h6>';
								echo '</div>';
							echo '</div>';
							echo '<h6 class="card-subtitle mb-2 text-muted">Showing Top '.$Top.' Records</h6>';
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
										while($data = odbc_fetch_array($stmt)){
											echo '<tr>';
												echo '<td>000'.$data["RowID"].'</td>';
												echo '<td>'.date("m/d/y",strtotime($data["PaymentDate"])).'</td>';
												echo '<td>'.date("h:i:s A",strtotime($data["PaymentDate"])).'</td>';
												echo '<td>$'.$data["Paid"].'</td>';
												echo '<td>'.$data["TransID"].'</td>';
												echo '<td>'.$data["PaymentStatus"].'</td>';
											echo '<tr>';
										}
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
				else{
					$this->_do_no_data($Size);
				}
			}
		}
		function _do_no_data($Size){
			echo '<div class="col-md-'.$Size.' m_t_10 no_padding">';
				echo '<div class="card text-white bg-dark">';
					echo '<div class="card-header card-primary text-center"><i class="fa fa-money fa-fw"></i> Transactions</div>';
					echo '<div class="card-body">';
						echo '<div class="card-text text-center">';
							echo 'No data to display';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		# MISC
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>