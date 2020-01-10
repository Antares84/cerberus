<?php
	namespace classes\display;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title: Cards.class.php																	#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS Cards class, used for building all card resources								#
	#	Last Update Date: 03.22.2019 1100														#
	#																							#
	#	@CARD_TYPE			card name
	#	@CARD_TITLE			card title
	#	@CARD_BODY			card body content
	#	@TEXT_ALIGN			
	#	@CARD_FOOTER
	#	@CARD_FOOTER_TYPE
	#############################################################################################
	class Cards{

		public $data;

		public function __construct($Data,$Setting){
			$this->Data		=	$Data;
			$this->Setting	=	$Setting;
		}
		public function _do_build_card($CARD_TYPE,$CARD_TITLE,$CARD_BODY,$TEXT_ALIGN=false,$CARD_FOOTER=false,$CARD_FOOTER_TYPE=false){
			$method = '_build_card_'.$CARD_TYPE;

			if(method_exists($this,$method)){
				return $this->$method($CARD_TITLE,$CARD_BODY,$TEXT_ALIGN,$CARD_FOOTER,$CARD_FOOTER_TYPE);
			}

			echo '<b>Class ('.get_class($this).'):</b> Defined card type not found!';
		}
		private function _build_card_page($CARD_TITLE,$CARD_BODY,$TEXT_ALIGN=false,$CARD_FOOTER=false,$CARD_FOOTER_TYPE=false){
			echo '<div id="content_card" class="card no_bg wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
			if(!empty($CARD_TITLE)){
				echo '<div class="card-header tac title pTitle show">'.$CARD_TITLE.'</div>';
			}
			if(!empty($CARD_BODY)){
				echo '<div class="card-block content_bg content pContent '.$TEXT_ALIGN.'">';
					echo '<div class="card-text">';
						echo $CARD_BODY;
					echo '</div>';
				echo '</div>';
			}
			if(!empty($CARD_FOOTER)){
				echo '<div class="card-footer content_bg footer pContent">';
					echo '<div class="tac b_i">';
						echo 'Posted on <font class="red">'.Date("m/d/y",strtotime($CARD_FOOTER)).'</font> at <font class="red">'.Date("h:iA ",strtotime($CARD_FOOTER)).'</font>';
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';

		#	return $this->data;
		}
		private function _build_card_members($CARD_TITLE,$CARD_BODY,$TEXT_ALIGN=false,$CARD_FOOTER=false,$CARD_FOOTER_TYPE=false){
			$this->data	.=	'<div class="card no_bg wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
			if(!empty($CARD_TITLE)){
				$this->data	.=	'<div class="card-header tac title pTitle show">'.$CARD_TITLE.'</div>';
			}
			if(!empty($CARD_BODY)){
				$this->data	.=	'<div class="card-block content_bg content pContent '.$TEXT_ALIGN.'">';
					$this->data	.=	'<div class="card-text">';
						$this->data	.=	$CARD_BODY;
					$this->data	.=	'</div>';
				$this->data	.=	'</div>';
			}
			if(!empty($CARD_FOOTER)){
				$this->data	.=	'<div class="card-footer content_bg footer pContent">';
					$this->data	.=	'<div class="tac b_i">';
						$this->data	.=	'<nav>';
							$this->data	.=	'<ul class="pagination justify-content-center">';
								$this->data	.=	$CARD_FOOTER;
							$this->data	.=	'</ul>';
						$this->data	.=	'</nav>';
					$this->data	.=	'</div>';
				$this->data	.=	'</div>';
			}
			$this->data	.=	'</div>';

			return $this->data;
		}
		private function _build_card_resources($CARD_TITLE,$CARD_BODY,$TEXT_ALIGN,$CARD_FOOTER,$CARD_FOOTER_TYPE=false){
			$this->data = false;

			$this->data	.=	'<div id="content_card" class="card no_bg wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
			if(!empty($CARD_TITLE)){
				$this->data	.=	'<div class="card-header tac title pTitle show">'.$CARD_TITLE.'</div>';
			}
			if(!empty($CARD_BODY)){
				$this->data	.=	'<div class="card-block content_bg content pContent';
				if($TEXT_ALIGN){$this->data	.=	' '.$TEXT_ALIGN.'">';}
				else{$this->data.='">';}
					$this->data	.=	'<div class="card-text">';
						$this->data	.=	$CARD_BODY;
					$this->data	.=	'</div>';
				$this->data	.=	'</div>';
			}
			if(!empty($CARD_FOOTER)){
				$this->data	.=	'<div class="card-footer content_bg footer pContent">';
					$this->data	.=	'<div class="tac b_i">';
						$this->data	.=	'<nav>';
							$this->data	.=	'<ul class="pagination justify-content-center">';
								$this->data	.=	$CARD_FOOTER;
							$this->data	.=	'</ul>';
						$this->data	.=	'</nav>';
					$this->data	.=	'</div>';
				$this->data	.=	'</div>';
			}
			$this->data	.=	'</div>';

			return $this->data;
		}
		private function _build_card_module($CARD_TITLE,$CARD_BODY,$TEXT_ALIGN=false,$CARD_FOOTER=false){
			$this->data	.=	'<div id="plugin_card" class="card no_bg no_border no_radius wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
			if(!empty($CARD_TITLE)){
				$this->data	.=	'<div class="card-header card_border tac title pTitle show no_radius">'.$CARD_TITLE.'</div>';
			}
			if(!empty($BODY)){
				if($TEXT_ALIGN){
					$this->data	.=	'<div class="card-block card_border content_bg content no_radius pContent '.$TEXT_ALIGN.'">';
				}
				else{
					$this->data	.=	'<div class="card-block card_border content_bg content no_radius pContent">';
				}
				$this->data	.=	'<div class="card-block card_border content_bg content no_radius pContent '.$TEXT_ALIGN.'">';
					$this->data	.=	'<div class="card-text">';
						$this->data	.=	'<div class="m_tb_10 p_lr_15">';
							$this->data	.=	$CARD_BODY;
						$this->data	.=	'</div>';
					$this->data	.=	'</div>';
				$this->data	.=	'</div>';
			}
			if(!empty($FOOTER)){
				$this->data	.=	'<div class="card-footer card_border content_bg footer no_radius pContent">';
					$this->data	.=	'<div class="tac b_i">';
						$this->data	.=	'Posted on <font class="red">'.Date("m/d/y",strtotime($CARD_FOOTER)).'</font> at <font class="red">'.Date("h:iA ",strtotime($CARD_FOOTER)).'</font>';
					$this->data	.=	'</div>';
				$this->data	.=	'</div>';
			}
			$this->data	.=	'</div>';

			return $this->data;
		}
	}