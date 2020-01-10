<?php
	namespace classes\Display\Templates\CMS;

	class Footer{

		private $output;

		public function __construct($Paging,$Setting,$Theme,$Tpl,$User){
			$this->Paging	=	$Paging;
			$this->Setting	=	$Setting;
			$this->Theme	=	$Theme;
			$this->Tpl		=	$Tpl;
			$this->User		=	$User;

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
			$this->output.='<div class="cms_footer">';
				$this->output.='<div class="container">';

					if(!empty($this->Theme->_arr["FOOTER_STATUS"])){$this->_footer_links_1($this->Paging->_arr["PageZone"]);}
				#	if(!empty($this->Theme->_arr[19])){$this->_footer_links_2($this->Paging->_arr["PageZone"]);}
				#	if(!empty($this->Theme->_arr[19])){$this->_footer_links_3($this->Paging->_arr["PageZone"]);}

					$this->output.='<div class="row">';
						$this->output.='<div class="col-md-12 col-sm-12 tac">';
						if(isset($_SESSION)){
							if($this->User->_is_staff()===true){
								$this->output.=$this->Tpl->Separator("10");
								$this->output.='<a href="?'.$this->Setting->_arr["PAGE_PREFIX"].'=DASHBOARD" target="_blank" class="badge badge-primary b_i f_14">Administration Control Panel</a><br>';
								$this->output.=$this->Tpl->Separator("10");
							}
						}
							$this->output.=$this->Theme->_arr["FOOTER_COPYRIGHT"].'<br>';
							$this->output.='Powered By: <font class="b_i">Cerberus CMS </font><label class="badge badge-primary b_i f14">v'.$this->Setting->_arr["VERSION"].'</label><br>';
						$this->output.='</div>';
					$this->output.='</div>';
				$this->output.='</div>';
			$this->output.='</div>';
		}
		private function _footer_links_1($Zone){
			$this->output.='<div class="row">';
				$this->output.='<div class="col-md-4 col-sm-12 tac"></div>';
				$this->output.='<div class="col-md-4 col-sm-12 tac"><a href="mailto:'.$this->Setting->_arr["EMAIL_SUPPORT"].'">Contact Us</a></div>';
			$this->output.='</div>';
		}
		private function _footer_links_2($Zone){
			$this->output.='<div class="row">';
				$this->output.='<div class="col-md-4 col-sm-12 tac"></div>';
				$this->output.='<div class="col-md-4 col-sm-12 tac"><a href="mailto:'.$this->Setting->_arr["EMAIL_SUPPORT"].'">Contact Us</a></div>';
				$this->output.='<div class="col-md-4 col-sm-12 tac"><a href="#">Sponsor 3</a></div>';
			$this->output.='</div>';
		}
		private function _footer_links_3($Zone){}
		private function _footer_links_4($Zone){}
		private function _footer_links_5($Zone){}
		public function _output(){
			echo $this->output;
		}
	}