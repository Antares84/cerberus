<?php
	$sql	=	("SELECT c.CharName,c.UserID,c.UserUID,c.Family,u.Status
				  FROM ".$this->db->get_TABLE("SH_CHARDATA")." c
				  INNER JOIN ".$this->db->get_TABLE("SH_USERDATA")." u ON u.UserUID = c.UserUID
				  WHERE c.CharName LIKE '![%' ESCAPE'!' AND c.Del=?");
	$stmt	=	odbc_prepare($this->db->conn,$sql);
	$args	=	array(0);
	$prep	=	odbc_execute($stmt,$args);
	if($prep){
		echo '<div class="card no_bg no_border no_radius">';
			echo '<div class="card-header card_border tac title pTitle show no_radius">Staff List</div>';
			echo '<div class="card-block card_border content_bg content no_radius pContent">';
				echo '<div class="row">';
					echo '<div class="col-lg-4 col-sm-4 col-xs-4 tac">';
						echo '<font class="orange">Character Name</font>';
					echo '</div>';
					echo '<div class="col-lg-4 col-sm-4 col-xs-4 tac">';
						echo '<font class="orange">Position</font>';
					echo '</div>';
					echo '<div class="col-lg-4 col-sm-4 col-xs-4 tac">';
						echo '<font class="orange">Faction</font>';
					echo '</div>';
				echo '</div>';
			while($staff = odbc_fetch_array($stmt)){
				echo '<div class="row tac">';
					echo '<div class="col-lg-4 col-sm-4 col-xs-4 tac">';
						echo '<font class="white">'.$staff['CharName'].'</font>';
					echo '</div>';
					echo '<div class="col-lg-4 col-sm-4 col-xs-4 tac">';
						echo '<font class="white">'.$this->User->get_Status($staff["Status"]).'</font>';
					echo '</div>';
					echo '<div class="col-lg-4 col-sm-4 col-xs-4 tac">';
					if($staff["Family"] == 0 || $staff["Family"] == 1){
						echo '<font class="skyblue">Alliance of Light</font>';
					}else if($staff["Family"] == 2 || $staff["Family"] == 3){
						echo '<font class="red">Union of Fury</font>';
					}
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';
	}else{
		$this->ds_page_card('Staff List','Staff list is currently unavailable. Please check back later.','');
	}
?>