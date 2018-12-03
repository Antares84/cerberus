<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	$Title	.=	'Players Online';
	$Body	.=	'<div class="table-responsive">';
		$Body	.=	'<table class="table table-sm playerOnlineTable border-none">';
			$Body	.=	$this->SQL->playersOnline('4','1','blueGlassBoxShadow blueTextShadow');
		$Body	.=	'</table>';
	$Body	.=	'</div>';

	echo $this->Tpl->PLUGIN_CARD($Title,'',$Body,'');
?>