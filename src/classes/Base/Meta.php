<?php
	namespace Classes\Base;

	use Classes\DB\MSSQL			as	MSSQL;
	use Classes\Settings\Settings	as	Settings;

	class Meta{

		public function __construct(){
			$this->_security();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		static public function _get_version(){
			return Setting::_arr["Version"];
		}
	}