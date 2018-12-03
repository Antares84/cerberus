<?php
	class Donate{
		function __construct($db){
			$this->db	=	$db;
		}
		function DonateOptions(){
			$ret	=	false;

			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE("DONATE_OPTIONS").'
							ORDER BY Reward ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$ret	.=	'<form action="" method="POST">';
						$ret	.=	'<div class="table-responsive">';
							$ret	.=	'<table class="table table-bordered table-hover table-striped acp_table tac">';
								$ret	.=	'<thead>';
									$ret	.=	'<tr>';
										$ret	.=	'<th><input type="radio" name="RewardID" disabled="disabled" /></th>';
										$ret	.=	'<th>Reward</th>';
										$ret	.=	'<th>Price</th>';
									$ret	.=	'</tr>';
								$ret	.=	'</thead>';
								$ret	.=	'<tbody>';
								while($show = odbc_fetch_array($stmt)){
									$ret	.=	'<tr>';
										$ret	.=	'<td><input type="radio" name="RewardID" value="'.$show['RowID'].'"></td>';
										$ret	.=	'<td>'.$show['Reward'].' points</td>';
										$ret	.=	'<td>$'.$show['Price'].' USD</td>';
									$ret	.=	'<tr>';
								}
								$ret	.=	'</tbody>';
							$ret	.=	'</table>';
						$ret	.=	'</div>';
						$ret	.=	'<div class="separator_30"></div>';

						$ret	.=	'<div class="col-md-12 tac">';
							$ret	.=	'<button type="submit" name="PayPalBtn" class="badge badge-pill badge-primary" value="submit">Proceed To PayPal</button>';
						$ret	.=	'</div>';
					$ret	.=	'</form>';
				}
				else{
					$ret	.=	'<div class="tac b_i">Someone forgot to add donation options, what a pity...</div>';
				}
			}
			else{
				$ret	.=	'An error has occured';
			}

			return $ret;
		}
	}
?>