<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	$Title	.=	'Account Information';

	$Body	.=	'<div class="table-responsive">';
		$Body	.=	'<table class="table table-bordered table-hover table-striped acp_table tac no_margin">';
			$Body	.=	'<tbody>';
				$Body	.=	'<tr>';
					$Body	.=	'<td class="b_i">Current DP</td>';
					$Body	.=	'<td>'.$this->User->Point.'</td>';
				$Body	.=	'</tr>';
				$Body	.=	'<tr>';
					$Body	.=	'<td class="b_i"></td>';
					$Body	.=	'<td></td>';
				$Body	.=	'</tr>';
				$Body	.=	'<tr>';
					$Body	.=	'<td class="b_i"></td>';
					$Body	.=	'<td></td>';
				$Body	.=	'</tr>';
			$Body	.=	'</tbody>';
		$Body	.=	'</table>';
	$Body	.=	'</div>';

	echo $this->Tpl->PAGE_CARD($Title,'tac',$Body,'');
	echo $this->Tpl->Separator('15');
?>