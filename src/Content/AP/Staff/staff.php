<?php
	# Query
	$res = odbc_exec($this->db->conn,"
										SELECT [C].[CharName],[C].[UserID],[C].[UserUID],[U].[Point]
										FROM ".$this->db->get_TABLE("SH_CHARDATA")." AS [C]
										INNER JOIN ".$this->db->get_TABLE("SH_USERDATA")." AS [U] ON [U].[UserUID] = [C].[UserUID]
										WHERE [C].[CharName] LIKE '![%' ESCAPE'!' AND [C].[Del]=0
	");
	# Content
	echo '<div id="title" class="tac">Registered Staff Members</div>';
		echo '<div id="ap_content">';
			if(!odbc_num_rows($res)){
				die("Staff Users Not Found!");
			}
			echo '<div class="table-responsive">';
				echo '<table class="table table-bordered table-hover table-striped acp_table tac">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>UserID</th>';
							echo '<th>UserUID</th>';
							echo '<th>CharName</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					while($row=odbc_fetch_array($res)){
						echo "<tr>";
							echo "<td width=20%><a href=\"#".$row['UserUID']."&UserID=".$row['CharName']."\">".$row['UserID']."</a></td>";
							echo "<td width=10%>".$row['UserUID']."</td>";
							echo "<td width=70%>".$row['CharName']."</td>";
						echo "</tr>";
					}
					echo '</tbody>';
					$this->LogSys->createLog("Viewed Staff List");
				echo '</table>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>