<?php
	echo '<div class="container">';
		echo '<div class="row">';
			$this->Tpl->TitleBar("ERROR 404","w_100_p");
			echo '<div class="col-md-3"></div>';
			echo '<div class="col-md-6">';
				echo '<img src="'.$this->Style->_uni_images($this->PAGE_ZONE,"S_MISC").'error404.png" class="img-fluid mx-auto ap-error">';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>