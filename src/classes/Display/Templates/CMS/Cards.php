<?php
	namespace classes\Display\Templates\CMS;

	class Cards{

		public $output;

		public function __construct(){
			$this->_security();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _build($type,$title,$body,$text_align=false,$footer=false,$footer_type=false){
			$method = '_'.$type;

			if(method_exists($this,$method)){
				$this->$method($title,$body,$text_align,$footer,$footer_type);
			}
			else{
				return '<b>Class ('.get_class($this).'):</b><br>Defined card type('.$type.') not found!';
			}
		}
		private function _page($title,$body,$footer=false,$text_align=false,$footer_type=false){
			$this->output.='<div id="content_card" class="card no_bg wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
			if(!empty($title)){
				$this->output.='<div class="card-header tac title pTitle show">'.$title.'</div>';
			}
			if(!empty($body)){
				$this->output.='<div class="card-block content_bg content pContent '.$text_align.'">';
					$this->output.='<div class="card-text">';
						$this->output.=$body;
					$this->output.='</div>';
				$this->output.='</div>';
			}
			if(!empty($footer)){
				$this->output.='<div class="card-footer content_bg footer pContent">';
					$this->output.='<div class="tac b_i">';
						$this->output.='Posted on <font class="red">'.Date("m/d/y",strtotime($footer)).'</font> at <font class="red">'.Date("h:iA ",strtotime($footer)).'</font>';
					$this->output.='</div>';
				$this->output.='</div>';
			}
			$this->output.='</div>';
		}
		private function _module($title,$body,$footer=false,$text_align=false,$footer_type=false){
			$this->output	.=	'<div id="module_card" class="card no_bg no_border no_radius wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
			if(!empty($title)){
				$this->output	.=	'<div class="card-header card_border tac title pTitle show no_radius">'.$title.'</div>';
			}
			if(!empty($body)){
				if($text_align){
					$this->output	.=	'<div class="card-block card_border content_bg content no_radius pContent '.$text_align.'">';
				}
				else{
					$this->output	.=	'<div class="card-block card_border content_bg content no_radius pContent">';
				}
				$this->output	.=	'<div class="card-block card_border content_bg content no_radius pContent '.$text_align.'">';
					$this->output	.=	'<div class="card-text">';
						$this->output	.=	'<div class="m_tb_10 p_lr_15">';
							$this->output	.=	$body;
						$this->output	.=	'</div>';
					$this->output	.=	'</div>';
				$this->output	.=	'</div>';
			}
			if(!empty($footer)){
				$this->output	.=	'<div class="card-footer card_border content_bg footer no_radius pContent">';
					$this->output	.=	'<div class="tac b_i">';
						$this->output	.=	'Posted on <font class="red">'.Date("m/d/y",strtotime($footer)).'</font> at <font class="red">'.Date("h:iA ",strtotime($footer)).'</font>';
					$this->output	.=	'</div>';
				$this->output	.=	'</div>';
			}
			$this->output	.=	'</div>';

			return $this->_output();
		}
		public function _output(){
			return $this->output;
		}
	}
?>