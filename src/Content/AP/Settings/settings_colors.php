<?php
	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
//			echo '<div id="title" class="tac">'.$this->PageTitle.'</div>';
			echo '<div class="table-responsive">';

			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list("SETTINGS_COLORS")
			);
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				echo '<table class="table table-sm acp_table text-white">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>#</th>';
							echo '<th>Color</th>';
							echo '<th>Hex</th>';
							echo '<th>RGB</th>';
							echo '<th>Visual</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					while($data = odbc_fetch_array($stmt)){
						echo '<tr>';
							echo '<td class="tac">'.$data["RowID"].'</td>';
							echo '<td>'.$data["COLOR"].'</td>';
							echo '<td class="tac">'.$data["HEX"].'</td>';
							echo '<td class="tac">'.$data["RGB"].'</td>';
							echo '<td style="background-color:'.$data["HEX"].';"></td>';
						echo '</tr>';
					}
					echo '</tbody>';
				echo '</table>';
			}
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>