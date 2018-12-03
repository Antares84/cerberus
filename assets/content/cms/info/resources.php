<?php
	$this->User->get_Auth();

	$ResourceID = isset($_GET['res_id']) ? $this->Data->escData(trim($_GET['res_id'])) : false;
	$page		=	1;
	$persite	=	25;
	$addlink	=	"";
	$scripturl	=	$_SERVER['PHP_SELF'];

	# Get Current Page
	if(isset($_GET['page']) && !empty($_GET['page']) && preg_match('#^[0-9]*$#',$_GET['page'])){
		$page		= $_GET['page'];
		$addlink	= '&amp;page='.$page;
	}

	$begin	=	($page - 1)	*	$persite;
	$max	=	$page		*	$persite;

#	if(!$ResourceID){
#		echo 'Something happened...';
#		echo '<pre>';
#			var_dump($_GET);
#		echo '</pre>';
#		die();
#	}
	if($ResourceID){
		echo $this->SQL->get_sql_resources_show_post($ResourceID);
	}
	else{
		echo '<div class="card no_bg no_border no_radius">';
			echo '<div class="card-header card_border tac title no_radius">Resources</div>';

			echo '<div class="card-block card_border content_bg content no_radius pContent">';
				echo '<div class="card-text">';
					echo $this->SQL->get_sql_resources($max,$this->PageIndex);
				echo '</div>';
			echo '</div>';

			# Pagination
			echo $this->SQL->get_sql_resources_cnt($persite,$page,$this->PageIndex);
		echo '</div>';
	}
?>