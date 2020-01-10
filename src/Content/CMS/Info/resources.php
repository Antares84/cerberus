<?php
	$this->User->Auth();

	$ResourceID = isset($_GET['res_id']) ? trim($this->Data->_do('escData',$_GET["res_id"])) : false;

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
		$res	=	$this->SQL->_get_res_show_post($ResourceID);
		list($CARD_TITLE,$CARD_BODY) = explode("~",$res);

		echo $this->Cards->_do_build_card('page',$CARD_TITLE,$CARD_BODY);
	}
	else{
		$CARD_BODY		=	$this->SQL->_get_res($max,$this->PAGE_INDEX);
		$CARD_FOOTER	=	$this->SQL->_get_res_cnt($persite,$page,$this->PAGE_INDEX);

		echo $this->Cards->_do_build_card('resources','Resources',$CARD_BODY,'',$CARD_FOOTER,1);
	}
?>