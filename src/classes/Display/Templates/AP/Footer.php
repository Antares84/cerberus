<?php
	namespace classes\Display\Templates\CMS;

	class Footer{
		public function __construct($Paging,$Setting,$Theme,$User){
			$this->Paging	=	$Paging;
			$this->Setting	=	$Setting;
			$this->Theme	=	$Theme;
			$this->User		=	$User;

			$this->_security();

			# Paging
			$this->PAGE			=	$this->Paging->_arr["PAGE"];
			$this->PAGE_INDEX	=	$this->Paging->_arr["PAGE_INDEX"];
			$this->PAGE_SUB		=	$this->Paging->_arr["PAGE_SUB"];
			$this->PAGE_TITLE	=	$this->Paging->_arr["PAGE_TITLE"];
			$this->PAGE_URI		=	$this->Paging->_arr["PAGE_URI"];
			$this->PAGE_ZONE	=	$this->Paging->_arr["PAGE_ZONE"];
			$this->STANDALONE	=	$this->Paging->_arr["STANDALONE"];
			$this->COLUMNS		=	$this->Paging->_arr["COLUMNS"];
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		private function _footer(){
			echo '<div class="row hidden-sm-down acp_footer text-center b_i f_20 bg-dark no_padding">';
				echo '<div class="col-md-2"></div>';
				echo '<div class="col-md-10 tac posh">';
					echo $this->Theme->_array["COPYRIGHT"].' <label class="badge badge-primary b_i f_14">v'.$this->Setting->_arr["VERSION"].'</label>';
				echo '</div>';
			echo '</div>';
		}
		private function _footer_links_1($Zone){
			echo '<div class="row">';
				echo '<div class="col-md-4 col-sm-12 tac"></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="mailto:'.$this->Setting->_arr["EMAIL_SUPPORT"].'">Contact Us</a></div>';
			echo '</div>';
		}
		private function _footer_links_2($Zone){
			echo '<div class="row">';
				echo '<div class="col-md-4 col-sm-12 tac"></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="mailto:'.$this->Setting->_stng_array[7].'">Contact Us</a></div>';
				echo '<div class="col-md-4 col-sm-12 tac"><a href="#">Sponsor 3</a></div>';
			echo '</div>';
		}
		private function _footer_links_3($Zone){}
		private function _footer_links_4($Zone){}
		private function _footer_links_5($Zone){}
		
	}