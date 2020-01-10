<?php
	namespace classes\Display\Templates\CMS;

	class Header{

		private $output;

		public function __construct($Paging,$Tpl){
			$this->Paging	=	$Paging;
			$this->Tpl		=	$Tpl;

			$this->_security();
			$this->html_header();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		private function html_header(){
			if($this->Tpl->_get_header($this->Paging->_arr["PageZone"],"S_LOGO",1)){
				$this->output.=$this->Tpl->_get_header($this->Paging->_arr["PageZone"],"S_LOGO");
			}
			elseif($this->Tpl->_get_header($this->Paging->_arr["PageZone"],"T_LOGO",1)){
				$this->output.=$this->Tpl->_get_header($this->Paging->_arr["PageZone"],"T_LOGO");
			}
			else{
				$this->output.='Unable to load header...';
			}
		}
		public function _output(){
			echo $this->output;
		}
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit;
		}
		public function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

				#	$this->_build();

					echo '<pre>';
						var_dump($this->_arr);
					echo '</pre>';
				echo '</div>';
			}
			else{
				echo '<div class="col-md-12">';
					echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
					echo '<pre>';
					foreach($class_methods as $method_name){
						echo $method_name.'<br>';
					}
					echo '</pre>';
				echo '</div>';
				exit;
			}
		}
	}
?>