<?php
	$this->User->Auth();
	$this->LogSys->createLog("Searched ...");
	$count	=	1;
	$rank	=	0;
	$cimg	=	0;
	$kdr	=	0;
	$char	=	'???';

	$sql	=	("SELECT * FROM ".$this->db->get_TABLE("SH_ITEMS")." WHERE ItemName NOT LIKE %?% ORDER BY ItemID");
	$stmt	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array($char);
	$prep	=	odbc_execute($stmt,$args);
	
	echo 'Country (6=AOL/UOF,2=AOL,5=UOF) IF A 1 apears in row signifying a class that is class that wears or uses item. /getitem useing Type space TypeID space Count you want.';
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<h1 class="page-header">'.$this->PageTitle;if(!empty($this->PageSub)){echo '<small> - '.$this->PageSub.'</small>';}echo '</h1>';
			echo '<div id="title" class="tac">Item Search</div>';
		echo '</div>';
	echo '</div>';
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<table class="table table-bordered table-inverse">';
				echo '<thead>';
						echo '<tr>';
							echo '<th>ItemName</th>';
							echo '<th>Type</th>';
							echo '<th>TypeID</th>';
							echo '<th>Required Level</th>';
							echo '<th>Country</th>';
							echo '<th>Fight/War</th>';
							echo '<th>Def/Guard</th>';
							echo '<th>Ranger/Sin</th>';
							echo '<th>Archer/Hunter</th>';
							echo '<th>Mage/Pagan</th>';
							echo '<th>Priest/Orc</th>';
							echo '<th>Max O.J.Stats</th>';
							echo '<th>Stack Count</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					while($row = odbc_fetch_array($stmt)){
						echo '<tr>';
							echo '<th scope="row">'.$row[1].'</th>';
							echo '<td>'.$row[2].'</td>';
							echo '<td>'.$row[3].'</td>';
							echo '<td>'.$row[4].'</td>';
							echo '<td>'.$row[5].'</td>';
							echo '<td>'.$row[6].'</td>';
							echo '<td>'.$row[7].'</td>';
							echo '<td>'.$row[8].'</td>';
							echo '<td>'.$row[9].'</td>';
							echo '<td>'.$row[10].'</td>';
							echo '<td>'.$row[11].'</td>';
							echo '<td>'.$row[17].'</td>';
							echo '<td>'.$row[48].'</td>';
						echo '</tr>';
						$count++;
					}
					echo '</table>';
				echo '</center>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?> 