<?php
	echo '<h1 class="page-header">'.$this->PAGE_TITLE;if(!empty($this->PAGE_SUB)){echo '<small> - '.$this->PAGE_SUB.'</small>';}echo '</h1>';
	echo '<ol class="breadcrumb">';
		echo '<li><i class="fa fa-dashboard"></i>  <a href="?id=Dashboard">Dashboard</a></li>';
		echo '<li class="active"><i class="fa fa-dashboard"></i> <a href="#">Error 404</a></li>';
	echo '</ol>';
	echo '<div id="content-wrapper">';
		echo '<div id="title" class="tac">Error!</div>';
			echo '<center><img src="'.$this->Styles->get_IMAGES_DIR().'error404.png"/></center>';
		echo '</div>';
		echo '<div class="label label-danger p_all_5 b_i w_100_p f16">';
			echo 'The page you requested does not exist or has been moved.<br />';
			#echo 'Page URI: '.$this->PAGE_INDEX;
		echo '</div>';
	echo '</div>';
?>