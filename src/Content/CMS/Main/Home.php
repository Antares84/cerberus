<?php
	if(!defined('IN_CMS')){exit;}

	$_SESSION["Action"]	=	'Viewed homepage';

	$Cards	=	new \Classes\Display\Templates\CMS\Cards;
	$data=$this->SQL->_load_hp();
	$Cards->_build('page',$data[0],$data[1],'',$data[2]);
	return $Cards->_output();
?>