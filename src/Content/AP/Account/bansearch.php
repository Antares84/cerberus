<?php
	$Length	=	array(
						4=>"5 Days",
						13=>"2 Weeks",
						0=>"Permanent"
	);
#	$this->LogSys->createLog('Viewed Banned Users');

	$this->Tpl->TitleBar("Banned Accounts List");
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div id="sb_content">';
			$sql	=	("
							SELECT *,DATEADD(d,Duration,BanDate) AS 'ReleaseDate'
							FROM ".$this->db->get_TABLE("SH_BANNED_PLAYERS")."
							ORDER BY BanDate DESC
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);
			

			if($prep){
				if(!odbc_num_rows($stmt)){
					echo '<div class="tac">';
						echo 'No banned users found. This is a good thing..I think.';
					echo '</div>';
				}
				else{
					echo '<div class="table-responsive">';
						echo '<table class="table table-sm table-bordered table-striped acp_table tac">';
							echo '<thead>';
								echo '<tr>';
									echo '<th>CharName</th>';
									echo '<th>Reason</th>';
									echo '<th>Length</th>';
									echo '<th>Banned By</th>';
									echo '<th>Date</th>';
									echo '<th>Release Date</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
							while($row = odbc_fetch_array($stmt)){
								if($row['Duration'] === 0){$ReleaseDate = "Never";}
								else{$ReleaseDate = date("m/d/Y g:i:s A",strtotime($row["ReleaseDate"]));}
								echo '<tr>';
									echo '<td><a href="?'.$this->Setting->PAGE_PREFIX.'=AccountUnban&CharName='.$row['CharName'].'">'.$row['CharName'].'</a></td>';
									echo '<td>'.htmlspecialchars_decode($row["Reason"]).'</td>';
									echo '<td>'.$row["Duration"].'</td>';
									echo '<td>'.$row["BannedBy"].'</td>';
									echo '<td>'.date("m/d/Y g:i:s A", strtotime($row["BanDate"])).'</td>';
									echo '<td>'.$ReleaseDate.'</td>';
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
			}
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>