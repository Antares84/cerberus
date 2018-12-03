<?php
	echo '<div class="title tac">'.$this->Setting->SITE_TITLE.' Downloads</div>';
	if(!empty($cfg["DL_1_FILENAME"]) || !empty($cfg["DL_2_FILENAME"]) || !empty($cfg["DL_3_FILENAME"])){
		echo '<div class="inner">';
			echo '<div class="row b tac">';
				echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
					echo '<font class="orange">Filename</font>';
				echo '</div>';
				echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
					echo '<font class="orange">Mirror</font>';
				echo '</div>';
				echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
					echo '<font class="orange">Link</font>';
				echo '</div>';
				echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
					echo '<font class="orange">Size</font>';
				echo '</div>';
			echo '</div>';
			if(!empty($cfg["DL_1_FILENAME"])){
				echo '<div class="row b tac">';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_1_FILENAME"];
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_1_TYPE"];
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo '<a href="'.$cfg["DL_1_URL"].'" target="_blank"><img src="'.$cfg["CMS_IMAGES"].'download-2.png" width="128" height="20"></a>';
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_1_SIZE"];
					echo '</div>';
				echo '</div>';
			}
			if(!empty($cfg["DL_2_FILENAME"])){
				echo '<div class="row b tac">';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_2_FILENAME"];
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_2_TYPE"];
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo '<a href="'.$cfg["DL_2_URL"].'" target="_blank"><img src="'.$cfg["CMS_IMAGES"].'download-2.png" width="128" height="20"></a>';
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_2_SIZE"];
					echo '</div>';
				echo '</div>';
			}
			if(!empty($cfg["DL_3_FILENAME"])){
				echo '<div class="row b tac">';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_3_FILENAME"];
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_3_TYPE"];
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo '<a href="'.$cfg["DL_3_URL"].'" target="_blank"><img src="'.$cfg["CMS_IMAGES"].'download-2.png" width="128" height="20"></a>';
					echo '</div>';
					echo '<div class="col-lg-3 col-sm-4 col-xs-4">';
						echo $cfg["DL_3_SIZE"];
					echo '</div>';
				echo '</div>';
			}
		echo '</div>';
	}
?>