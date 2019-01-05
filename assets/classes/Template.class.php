<?php
	class Template{

		public $NoMsgArr;

		function __construct($Data,$Messenger,$Select,$Style,$Theme){
			$this->Data			=	$Data;
			$this->Messenger	=	$Messenger;
			$this->Select		=	$Select;
			$this->Style		=	$Style;
			$this->Theme		=	$Theme;
		}
		function _do_alert($Color,$Body,$Error=false,$Dismiss=null){
			echo '<div class="container no_padding wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						echo '<div class="alert';
						if($Color){
							echo ' '.$this->_alert_color($Color);
						}
						if($Dismiss){
							echo ' '.$Dismiss;
						}
						echo '" role="alert">';

						if($Dismiss){
							echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								echo '<span aria-hidden="true">&times;</span>';
							echo '</button>';
						}
						if($Body){
							if($Error){
								echo '<h4 class="alert-heading"><i class="fa fa-info-circle"></i> <strong>'.$Body.'</strong></h4>';
							}
							$text=$this->Messenger->MessagesArr($Body);

							if(!$text){
								echo $Body;
							}
							else{
								echo $text;
							}
						}
						#	echo '<h4 class="alert-heading"><i class="fa fa-info-circle"></i> <strong>'.$Body.'</strong></h4>';
						# 	echo 'some text';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		function _alert_color($data){
			switch($data){
				case	'0'	:	return 'badge-primary';		break;
				case	'1'	:	return 'badge-secondary';	break;
				case	'2'	:	return 'badge-success';		break;
				case	'3'	:	return 'badge-danger';		break;
				case	'4'	:	return 'badge-warning';		break;
				case	'5'	:	return 'badge-info';		break;
				case	'6'	:	return 'badge-light';		break;
				case	'7'	:	return 'badge-dark';		break;
			}
		}
		function badge($BadgeColor,$BadgeText){
			echo '<span class="badge '.$BadgeColor.'">'.$BadgeText.'</span>';
		}
		function BADGE_AJAX($BadgeColor,$BadgeText){
			echo '<div class="badge '.$BadgeColor.' text-center f_18 w_100_p">'.$BadgeText.'</div>';
		}
		function badge_pill($PillColor,$PillText){
			echo '<span class="badge badge-pill f_14 '.$PillColor.'">'.$PillText.'</span>';
		}
		function NoMsgArr(){
			$this->NoMsgArr = array("REGISTRATION_COMPLETE","ERROR");
		}
		# Card Loader Functions
		function card($t1,$t2,$t3,$t4,$t5){
			echo '<div class="col-xl-3 col-lg-6">';
				echo '<div class="card card-inverse" style="background-color: #333; border-color: #333;">';
					echo '<div class="card-header label-default">'.$t1.'</div>';
					echo '<div class="card-block">';
						echo '<p class="card-text">'.$t2.'</p>';
						echo '<a class="btn btn-warning" href="?'.$this->Setting->PAGE_PREFIX.'='.$t3.'">'.$t4.' '.$t5.'</a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		function PAGE_CARD($TITLE,$TEXT_ALIGN,$BODY,$FOOTER){
			$ret	=	false;

			$ret	.=	'<div id="content_card" class="card no_bg wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
			if(!empty($TITLE)){
				$ret	.=	'<div class="card-header tac title pTitle show">'.$TITLE.'</div>';
			}
			if(!empty($BODY)){
				$ret	.=	'<div class="card-block content_bg content pContent '.$TEXT_ALIGN.'">';
					$ret	.=	'<div class="card-text">'.$BODY.'</div>';
				$ret	.=	'</div>';
			}
			if(!empty($FOOTER)){
				$ret	.=	'<div class="card-footer content_bg footer pContent">';
					$ret	.=	'<div class="tac b_i">';
						$ret	.=	'Posted on <font class="red">'.Date("m/d/y",strtotime($FOOTER)).'</font> at <font class="red">'.Date("h:iA ",strtotime($FOOTER)).'</font>';
					$ret	.=	'</div>';
				$ret	.=	'</div>';
			}
			$ret	.=	'</div>';

			return $ret;
		}
		function PLUGIN_CARD($TITLE,$TEXT_ALIGN,$BODY,$FOOTER){
			$ret	=	false;

			$ret	.=	'<div id="plugin_card" class="card no_bg no_border no_radius wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
			if(!empty($TITLE)){
				$ret	.=	'<div class="card-header card_border tac title pTitle show no_radius">'.$TITLE.'</div>';
			}
			if(!empty($BODY)){
				$ret	.=	'<div class="card-block card_border content_bg content no_radius pContent '.$TEXT_ALIGN.'">';
					$ret	.=	'<div class="card-text">';
						$ret	.=	'<div class="m_tb_10 p_lr_15">';
							$ret	.=	$BODY;
						$ret	.=	'</div>';
					$ret	.=	'</div>';
				$ret	.=	'</div>';
			}
			if(!empty($FOOTER)){
				$ret	.=	'<div class="card-footer card_border content_bg footer no_radius pContent">';
					$ret	.=	'<div class="tac b_i">';
						$ret	.=	'Posted on <font class="red">'.Date("m/d/y",strtotime($FOOTER)).'</font> at <font class="red">'.Date("h:iA ",strtotime($FOOTER)).'</font>';
					$ret	.=	'</div>';
				$ret	.=	'</div>';
			}
			$ret	.=	'</div>';

			return $ret;
		}
		# Misc Display Functions
		function TitleBar($data){
			echo '<div class="badge '.$this->Theme->_theme_array[13].' w_100_p b_i f_20 tac nTitle">'.$data.'</div>';
		}
		function mail_diag(){
			echo 'Debug : '.$this->PayPal->PAYPAL_DEBUG.'<br>';
			echo 'Receiver : '.$this->PayPal->PAYPAL_RECEIVER.'<br>';
			echo 'SB URI : '.$this->PayPal->PAYPAL_SANDBOX_URI.'<br>';
			echo 'SD URI : '.$this->PayPal->PAYPAL_STANDARD_URI.'<br>';
			echo 'USE SB : '.$this->PayPal->PAYPAL_SANDBOX.'<br>';
			echo 'Send Conf Email : '.$this->PayPal->PAYPAL_CONF_EMAIL.'<br>';
			echo 'Member Email : '.$_SESSION["Email"].'<br>';
		}
		function LOGO_IMG($ZONE,$IMG_TYPE){
			$IMG_PATH	=	$this->Style->UNI_IMAGES($ZONE,$IMG_TYPE);
			$IMG		=	$this->Theme->_theme_array[7];

			if($IMG !== NULL || !empty($IMG)){
				echo $this->Separator("10");
				echo '<header id="logo" class="container" style="background-color:rgba('.$this->Theme->_theme_array[17].','.$this->Theme->_theme_array[18].');">';
				if(is_file($IMG_PATH.$IMG)){
					echo '<img src="'.$IMG_PATH.$IMG.'" class="img-fluid">';
				}
#				else{
#					echo '<img src="'.$this->Style->UNI_IMAGES($ZONE,"MISC").'Cross_2.png" class="img-fluid" style="width:32px;height:32px;">';
#				}
				echo '</header>';
			}
		}
		function Separator($Height){
			switch($Height){
				case '5'	:	return '<div class="separator_5"></div>';	break;
				case '10'	:	return '<div class="separator_10"></div>';	break;
				case '15'	:	return '<div class="separator_15"></div>';	break;
				case '20'	:	return '<div class="separator_20"></div>';	break;
				case '30'	:	return '<div class="separator_30"></div>';	break;
				case '40'	:	return '<div class="separator_40"></div>';	break;
				case '50'	:	return '<div class="separator_50"></div>';	break;
				case '60'	:	return '<div class="separator_60"></div>';	break;
				case '70'	:	return '<div class="separator_70"></div>';	break;
				case '80'	:	return '<div class="separator_80"></div>';	break;
				case '90'	:	return '<div class="separator_90"></div>';	break;
				case '100'	:	return '<div class="separator_100"></div>';	break;
			}
		}
		function BG_IMG($Zone){
			$CMS_WP		=	$this->Style->UNI_IMAGES($Zone,"WP").$this->Theme->_theme_array[8];
			$CMS_C_WP	=	$this->Style->UNI_IMAGES($Zone,"C_WP").$this->Theme->_theme_array[8];

			$ACP_WP		=	$this->Style->UNI_IMAGES($Zone,"WP").$this->Theme->_theme_array[9];
			$ACP_C_WP	=	$this->Style->UNI_IMAGES($Zone,"C_WP").$this->Theme->_theme_array[9];

			if($Zone == "CMS"){
				if($this->Theme->_theme_array[8] !== NULL || !empty($this->Theme->_theme_array[8])){
					if(is_file($CMS_WP)){
						# local image file
						echo '<body class="ndf" style="background:#000 url("'.$CMS_WP.'") no-repeat center fixed;background-size:100% 100%;">';
					}
					elseif(is_file($CMS_C_WP)){
						# local image file
						echo '<body class="ndf" style="background:#000 url('.$CMS_C_WP.') no-repeat center fixed;background-size:100% 100%;">';
					}
					elseif(!is_file($CMS_WP) && !is_file($CMS_C_WP)){
						# remote image file
						echo '<body class="ndf" style="background:#000 url('.$this->Theme->_theme_array[8].') no-repeat center fixed;background-size:100% 100%;">';
					}
					else{
						echo '<body class="ndf" style="background:#000;">';
					}
				}
				else{
					echo '<body class="ndf" style="background:#000;">';
				}
#				echo '<div id="loader-wrapper">';
#					echo '<div id="loader"></div>';
#					echo '<div class="loader-section section-left"></div>';
#					echo '<div class="loader-section section-right"></div>';
#				echo '</div>';
			}
			elseif($Zone == "ACP"){
				if($this->Theme->_theme_array[9] !== NULL || !empty($this->Theme->_theme_array[9])){
					if(is_file($ACP_WP)){
						# local image file
						echo '<body style="background:#000 url('.$ACP_WP.') no-repeat center fixed;background-size:100% 100%;">';
					}
					elseif(is_file($ACP_C_WP)){
						# local image file
						echo '<body style="background:#000 url('.$ACP_C_WP.') no-repeat center fixed;background-size:100% 100%;">';
					}
					elseif(!is_file($ACP_WP) && !is_file($ACP_C_WP)){
						# remote image file
						echo '<body style="background:#000 url('.$this->Theme->_theme_array[9].') no-repeat center fixed;background-size:100% 100%;">';
					}
					else{
						echo '<body style="background:#000;">';
					}
				}
				else{
					echo '<body style="background:#000;">';
				}
			}
		}
		function input_group($ID,$PLACEHOLDER,$VALUE,$ATTRIB,$PREPEND=false,$APPEND=false,$STYLE=false){
			echo '<div class="input-group input-group-sm '.$STYLE.'">';
				if($PREPEND){
					echo '<div class="input-group-prepend">';
						echo '<span class="input-group-text" id="basic-addon">'.$PREPEND.'</span>';
					echo '</div>';
				}

				echo '<input class="form-control" id="'.$ID.'" name="'.$ID.'" type="text" placeholder="'.$PLACEHOLDER.'" value="'.$VALUE.'" '.$ATTRIB.'/>';

				if($APPEND){
					echo '<div class="input-group-append">';
						echo '<span class="input-group-text">'.$APPEND.'</span>';
					echo '</div>';
				}
			echo '</div>';
		}
		function input_label_group(){
			echo '<div class="form-label-group">';
				echo '<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">';
				echo '<label for="inputEmail">Email address</label>';
			echo '</div>';
		}
		function input_select($SELECT){
			echo '<div class="input-group input-group-sm mb-3">';
				echo $SELECT;
			echo '</div>';
		}
		# MISC
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>