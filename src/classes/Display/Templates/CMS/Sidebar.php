<?php
	namespace Classes\Display\Templates\CMS;

	class Sidebar{

		# Placeholders
		private $Modules;

		# Output
		private $output;

		public function __construct($Dirs,$Modules,$MSSQL,$Theme){
			$this->Dirs		=	$Dirs;
			$this->Modules	=	$Modules;
			$this->MSSQL	=	$MSSQL;
			$this->Theme	=	$Theme;

			$this->_security();
			$this->_load_class();
			$this->_run();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		private function _load_class(){
			$this->Modules	=	new \Classes\Modules\Modules($this->Dirs,$this->MSSQL);
		}
		private function _run(){
			if($this->Theme->_arr["COLUMNS"]>"0"){
				$this->Modules->_run('SHA1');
				$this->output.=$this->Modules->_output();
			}
		}
		public function _output(){
			return $this->output;
		}
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
		#	exit;
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