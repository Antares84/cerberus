<?php
	$this->User->Auth();
	$this->LogSys->createLog("Viewed Online Users");
	$count=1;

	$sql	=	("
					SELECT [C].[CharName],[C].[Level],[C].[Map],[C].[PosX],[C].[PosY],[U].[Country],[M].[MapName]
					FROM ".$this->db->get_TABLE("SH_CHARDATA")." AS [C]
					INNER JOIN ".$this->db->get_TABLE("SH_UMG")." AS [U] ON [U].[UserUID] = [C].[UserUID]
					INNER JOIN ".$this->db->get_TABLE("SH_MAPS")." AS [M] ON [M].[MapID] = [C].[Map]
					WHERE [C].[LoginStatus]=?
	");
	$stmt1	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array(1);
	odbc_execute($stmt1,$args);

	$this->Tpl->Titlebar('Online Players List');
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
		if(!odbc_num_rows($stmt1)){
			echo '<div id="sb_content" class="tac">';
				echo 'There are currently no members online...how disappointing.';
			echo '</div>';
		}else{
			$sql	=	("
							SELECT (SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE Family IN (0,1) AND LoginStatus = ?) AS \"Light\",
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE Family IN (2,3) AND LoginStatus = ?) AS \"Fury\"
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array(1,1);
			$res	=	odbc_execute($stmt,$args);

			$online = odbc_fetch_array($stmt);
			echo '<div id="sb_content" class="tac">';
					echo ''.$online['Light'].' Light Players Online || '.$online['Fury'].' Fury Players Online';
			echo '</div>';

			echo '<div class="table-responsive">';
				echo '<table id="mytable" class="table table-sm acp_table tac">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>Count</th>';
							echo '<th>Character</th>';
							echo '<th>Level</th>';
							echo '<th>Location</th>';
							echo '<th>Coords X</th>';
							echo '<th>Coords Y</th>';
							echo '<th>Faction</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					while($row=odbc_fetch_array($stmt1)){
						echo '<tr>';
							echo '<td>'.$count.'</td>';
							echo '<td>'.$row["CharName"].'</td>';
							echo '<td>'.$row["Level"].'</td>';
							echo '<td>'.$row["MapName"].'</td>';
							echo '<td>'.$row["PosX"].'</td>';
							echo '<td>'.$row["PosY"].'</td>';
							echo '<td>'.($row["Country"] == 0 ? "Light" : "Fury").'</td>';
						echo '</tr>';
						$count++;
					}
					echo '</tbody>';
				echo '</table>';
			echo '</div>';
		}
		echo '</div>';
	echo '</div>';
?>