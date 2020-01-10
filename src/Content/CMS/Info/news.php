<?php
	$sql	=	("SELECT TOP 25 Title,Detail,PostDate,PosterID FROM ".$this->db->get_TABLE("NEWS")." ORDER BY PostDate DESC");
	$stmt	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array();
	$prep	=	odbc_execute($stmt,$args);
	
	if(odbc_num_rows($stmt) > 0){
		if($prep){
			while($row = odbc_fetch_array($stmt)){
				echo '<div class="card no_bg no_border no_radius">';
					echo '<div class="card-header card_border tac title pTitle show no_radius">'.$row['Title'].'</div>';

					echo '<div class="card-block card_border content_bg content no_radius pContent">';
						echo '<div class="card-text">';
							echo html_entity_decode($row['Detail']);
						echo '</div>';
					echo '</div>';

					echo '<div class="card-footer card_border content_bg footer no_radius pContent2">';
						echo '<div class="tac">';
							echo 'Posted by <font class="red"><strong>'.$row["PosterID"].'</strong></font> on <font class="red"><strong>'.Date("h:i A m/d/y", strtotime($row['PostDate'])).'</strong></font>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}
	}
	else{
		echo '<div class="card no_bg no_border no_radius">';
			echo '<div class="card-header card_border tac title pTitle show no_radius">News & Updates</div>';

			echo '<div class="card-block card_border content_bg content no_radius pContent">';
				echo '<div class="card-text tac">';
					echo 'There is currently no News to show.';
				echo '</div>';
			echo '</div>';

		echo '</div>';
	}
?>