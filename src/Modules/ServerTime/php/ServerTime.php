<?php
	$Body	=	NULL;

	# CONTENT
	$Type	=	'module';
	$Title	=	'Clock';
	$Body	.=	'<div class="tac" id="server_time"></div>';
	$Body	.=	'<div class="tac" id="server_date"></div>';
#	$Body	.=	'<div class="tac" id="serverdate">'.date('m/d/y').'</div>';

	echo $this->Cards->_build($Type,$Title,$Body,false,'tac',false);
?>