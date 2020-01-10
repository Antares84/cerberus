<?php
	namespace classes\Display\Templates\CMS;

	class Container{

		private $addon;
		private $data;
		private $id;
		private $sb_pos;
		private $style;

		public function __construct(){
			$this->_security();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _set($var,$value){
			if(isset($var) && !empty($var)){
				$this->$var=$value;
			}
			else{
				echo 'Unable to set var!';
				exit;
			}
		}
		public function _get_method($method){
			$method	=	'_'.$method;
			$err='Fatal error in <b>'.get_class($this).'<br>';
			$err.='Action: Method '.$method.' was called.';
			$err.='Result: Method doesn\'t exist!';

			try{
				if(method_exists($this,$method)){return $this->$method();}
			}
			catch(exception $e){throw new SystemException($err,0,0,__FILE__,__LINE__);}
		}

		# Core Methods
		private function _c(){
			if(isset($this->style) && !empty($this->style)){
				return '<div class="container" style='.$this->style.'">'.$this->data.'</div>';
			}
			elseif(isset($this->addon) && !empty($this->addon)){
				return '<div class="container'.$this->addon.'">'.$this->data.'</div>';
			}
			elseif(isset($this->id) && !empty($this->id)){
				return '<div id="'.$this->id.'" class="container" style="border:1px solid red;">'.$this->data.'</div>';
			}
			else{
				return '<div class="container">'.$this->data.'</div>';
			}
		}
		private function _c_w_sb(){
			if($this->sb_pos==="1"){
				return $this->data;
			}
			if($this->sb_pos==="2"){
				return $this->data;
			}
		}
		private function _c_wo_sb(){}
		private function _row(){
			if(isset($this->addon) && !empty($this->addon)){
				return '<div class="row '.$this->addon.'">'.$this->data.'</div>';
			}
			if(isset($this->style) && !empty($this->style)){
				return '<div class="row" style="'.$this->style.'">'.$this->data.'</div>';
			}
			return '<div class="row">'.$this->data.'</div>';
		}
		private function _pre(){
			return $this->data;
		}
		private function _pre_dump($data){
			echo '<pre>';
				var_dump($data);
			echo '</pre>';
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