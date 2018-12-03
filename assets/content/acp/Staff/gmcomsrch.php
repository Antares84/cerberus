<?php
	$this->User->Auth();
	$this->LogSys->createLog("Viewed GM Command Log");

	$this->Tpl->Titlebar('GM Commands Log ~ Last 50 Commands');
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			$sql	=	("SELECT TOP 50 * FROM ".$this->db->get_TABLE("LOG_GM_COMMANDS")." ORDER BY ActionTime DESC");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(!odbc_num_rows($stmt)){
					echo '<div id="sb_content" class="tac">';
						echo 'No Commands Currently Listed.';
					echo '</div>';
				}else{
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
							echo '<thead>';
								echo '<tr class="tac">';
									echo '<th>CharName</th>';
									echo '<th>Map</th>';
									echo '<th>PosX</th>';
									echo '<th>PosY</th>';
									echo '<th>Command</th>';
									echo '<th>Player Affected</th>';
									echo '<th>Command Result</th>';
									echo '<th>Usage Date</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
							while($data=odbc_fetch_array($stmt)){
								echo '<tr>';
									echo '<td class="tac">'.$data["CharName"].'</td>';
									echo '<td class="tac">'.$data["MapID"].'</td>';
									echo '<td class="tac">'.$data["PosX"].'</td>';
									echo '<td class="tac">'.$data["PosY"].'</td>';
									echo '<td class="tac">'.$data["Command"].'</td>';
									echo '<td class="tac">'.$data["PlayerAffected"].'</td>';
									echo '<td>'.$data["CommandResult"].'</td>';
									echo '<td class="tac">'.date("m/d/y H:i A", strtotime($data["ActionTime"])).'</td>';
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
			}
		echo '</div>';
	echo '</div>';
?>