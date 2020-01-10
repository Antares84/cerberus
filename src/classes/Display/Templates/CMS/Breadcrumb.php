<?php
	namespace classes\Display\Templates\CMS;

	class Breadcrumb{
		private $output;

		public function __construct($Paging,$Setting,$Theme){
			$this->Paging	=	$Paging;
			$this->Setting	=	$Setting;
			$this->Theme	=	$Theme;

			$this->_security();
			$this->_run();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		private function _run(){
			if($this->Theme->_arr["PANE_BG_COLOR"] && $this->Theme->_arr["PANE_BG_TRANS"]){
				$this->output.='<div id="bread" class="container" style="background-color:rgba('.$this->Theme->_arr["PANE_BG_COLOR"].','.$this->Theme->_arr["PANE_BG_TRANS"].');"';
			}
			else{
				$this->output.='<div id="bread" class="container">';
			}
				$this->output.='<div class="col-md-12 no_padding">';
					$this->output.='<nav>';
						$this->output.='<ol class="breadcrumb';
						if($this->Theme->_arr["BREAD_BG_COLOR"]){
							$this->output.=' '.$this->Theme->_arr["BREAD_BG_COLOR"].'">';
						}
						else{
							$this->output.=' no_bg">';
						}
						if($this->Paging->_arr["PageIndex"] != "HOME"){
							$this->output.='<li class="breadcrumb-item">';
								$this->output.='<a href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=HOME">Home</a>';
							$this->output.='</li>';
							if($this->Paging->_arr["PageSub"]){
								$this->output.='<li class="breadcrumb-item" aria-current="PAGE">'.$this->Paging->_arr["PageSub"].'</li>';
							}
							$this->output.='<li class="breadcrumb-item active" aria-current="PAGE">';
								$this->output.='<a href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$this->Paging->_arr["PageIndex"].'">'.$this->Paging->_arr["PageTitle"].'</a>';
							$this->output.='</li>';
						}else{
							$this->output.='<li class="breadcrumb-item active" aria-current="PAGE">Home</li>';
						}
						$this->output.='</ol>';
					$this->output.='</nav>';
				$this->output.='</div>';
			$this->output.='</div>';
		}
		public function bc_output(){
			echo $this->output;
		}
	}