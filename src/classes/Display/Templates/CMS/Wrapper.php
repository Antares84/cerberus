<?php
	#############################################################################################
	#	Title: Wrapper.php																		#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS wrapper class, used for wrapping all page content								#
	#	Last Update Date: 12.21.2019	0316													#
	#																							#
	#############################################################################################

	namespace Classes\Display\Templates\CMS;

	class Wrapper{

		# Container Vars
		private $addon;
		public $content;
		private $sidebar;
		private $id;
		private $pre;
		private $sb;
		private $style;
		private $standalone;

		# Column Vars
		private $size;
		private $width;

		# Final Result Output
		private $output_int;
		public $output;

		public function __construct(){
			$this->html_reset();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _set($var,$value){
			$err	=	'Fatal error in <b>'.get_class($this).'<br>';
			$err	.=	'Error: Var '.$var.' was called, but it doesn\'t exist!';
			$err2	=	'Var '.$var.' isn\'t empty. Unable to set..';

			$err3	=	'Var doesn\'t exist..';

			try{
			#	echo "Var ($var) has been set to ($value)<br>";
				$this->$var=$value;
			}
			catch(exception $e){
				throw new \Classes\Exception\SystemException($err,0,0,__FILE__,__LINE__);
			}
		}
		public function _get($method,$set=false){
			$method	=	'html_'.$method;
			$err='Fatal error in <b>'.get_class($this).'<br>';
			$err.='Error: Method '.$method.' was called, but it doesn\'t exist!';

			try{
				if(method_exists($this,$method)){
				#	echo "Retrieved ($method)<br>";
					$this->$method($set);
				}
			}
			catch(exception $e){
				throw new \Classes\Exception\SystemException($err,0,0,__FILE__,__LINE__);
				exit;
			}
		}
		private function html_col($set=false){
			if(isset($this->size) && !empty($this->size)){
				if(isset($this->width) && !empty($this->width)){
					if($set==true){
						if($this->sb==true){
							$this->sidebar='<div class="col-'.$this->size.'-'.$this->width.'">'.$this->sidebar.'</div>';
						}
						else{
							$this->content='<div class="col-'.$this->size.'-'.$this->width.'">'.$this->content.'</div>';
						}
					}
					else{
						$this->output_int.='<div class="col-'.$this->size.'-'.$this->width.'">'.$this->content.'</div>';
					}
				}else{die("Column width not set!");}
			}else{die("Column size not set!");}

			$this->html_reset();
		}
		private function html_row($set=false){
			if($set==true){
				$this->content='<div class="row">'.$this->content.'</div>';
			}else{
				$this->output_int.='<div class="row">'.$this->content.'</div>';
			}

			#$this->html_reset();
		}
		private function html_container($set=false){
			if(isset($this->style) && !empty($this->style)){
				if($set==true){
					$this->content='<div class="container" style='.$this->style.'">'.$this->content.'</div>';
					$this->_reset_vars();
				}
				else{
					$this->output_int.='<div class="container" style='.$this->style.'">'.$this->content.'</div>';
					$this->html_reset();
				}
			}
			elseif(isset($this->addon) && !empty($this->addon)){
				if($set==true){
					$this->content='<div class="container'.$this->addon.'">'.$this->content.'</div>';
				}
				else{
					$this->output_int.='<div class="container'.$this->addon.'">'.$this->content.'</div>';
				}
			}
			elseif(isset($this->id) && !empty($this->id)){
				if($set==true){
					$this->content='<div id="'.$this->id.'" class="container" style="border:1px solid red;">'.$this->content.'</div>';
					$this->html_reset("output");
				}
				else{
					$this->output_int.='<div id="'.$this->id.'" class="container" style="border:1px solid red;">'.$this->content.'</div>';
					$this->html_reset("some");
				}
			}
			elseif(isset($this->pre) && !empty($this->pre)){
				if($set==true){
					$this->content='<pre>'.$this->content.'</pre>';
				}
				else{
					$this->output_int.='<pre>'.$this->content.'</pre>';
				}
			}
			else{
				if($set==true){
					$this->content='<div class="container">'.$this->content.'</div>';
				}
				else{
					$this->output_int.='<div class="container">'.$this->content.'</div>';
				}
			}

			
		}
		private function html_wrap($case=false){
			switch($case){
				case	'base'		:	$this->content=$this->content.$this->sidebar;$this->html_reset("sidebar");	break;
				case	'reverse'	:	$this->content=$this->sidebar.$this->content;$this->html_reset("sidebar");	break;
				case	'output'	:	$this->output.=$this->content.$this->sidebar;								break;
			}

		#	echo "Hit wrapper..<br>";
		}
		private function html_reset($case=false){
		#	echo "Hit reset...<br>";
			# Column vars
			switch($case){
				case	"content"	:	$this->output.=$this->content;
				break;
				case	"sidebar"	:	$this->sidebar="";$this->sb="";
				break;
				case	"output"	:	if(isset($this->output_int) && !empty($this->output_int)){
											$this->output.=$this->output_int;$this->output_int="";
										}
										elseif(isset($this->content) && !empty($this->content)){
											$this->output.=$this->content;$this->content="";
										}
				break;
				default				:	$this->size="";$this->width="";
				break;
			}
		}
		private function html_output($set=false){
			if($set==true){
				$this->_reset_vars();
			}
			else{
				echo $this->output;
			}
		}
		private function _reset_vars(){
			# Container vars
		#	$this->addon		=	"";
		#	$this->content		=	"";
		#	$this->sidebar		=	"";
		#	$this->id			=	"";
		#	$this->pre			=	"";
		#	$this->sb_pos		=	"";
		#	$this->style		=	"";
		#	$this->standalone	=	"";
			# Column vars
		#	$this->size			=	"";
		#	$this->width		=	"";
			# Class outputs
			$this->output_int	=	"";
			$this->output		=	"";
		}
		public function _Props(){
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						echo '<b>Properties for class ('.get_class($this).'):</b><br>';
						echo '<pre>';
							echo print_r(get_object_vars($this));
						echo '</pre>';
					echo '</div>';
				echo '</div>';
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