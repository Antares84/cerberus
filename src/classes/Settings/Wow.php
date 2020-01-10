<?php
	namespace classes\settings;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Wow{
		function __construct($db){
			$this->db		=	$db;
		}
		function TOP_NAV(){}
		function C_HEADER(){}
		function CONTENT(){}
		function SIDEBAR(){}
		function FOOTER(){}
	}