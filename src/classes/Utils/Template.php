<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Template{
		public function __construct($Colors,$Messenger,$Select,$Style,$Theme,$Tooltips){
			if(isset($Colors) && !empty($Colors)){$this->Colors=$Colors;}
			if(isset($Messenger) && !empty($Messenger)){$this->Messenger=$Messenger;}
			if(isset($Select) && !empty($Select)){$this->Select=$Select;}
			if(isset($Style) && !empty($Style)){$this->Style=$Style;}
			if(isset($Theme) && !empty($Theme)){$this->Theme=$Theme;}
			if(isset($Tooltips) && !empty($Tooltips)){$this->Tooltips=$Tooltips;}
		}
		public function _do_alert($Color,$Body,$Error=false,$Dismiss=null){
			echo '<div class="container no_padding wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						echo '<div class="alert';
						if($Color){echo ' '.$this->_alert_color($Color);}
						if($Dismiss){echo ' '.$Dismiss;}
						echo '" role="alert">';

						if($Dismiss){
							echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								echo '<span aria-hidden="true">&times;</span>';
							echo '</button>';
						}
						if($Body){
							if($Error){
								echo '<h4 class="alert-heading">';
									echo '<i class="fa fa-info-circle"></i> ';
									echo '<strong>'.$Body.'</strong>';
								echo '</h4>';
							}
							else{
								$text=$this->Messenger->_msg_array($Body);
								echo $text;
							}
						}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		public function _do_alert_text($Color,$Body){
			$text=$this->Messenger->MessagesArr($Body);
			return '<div class="badge badge-pill f_14 '.$this->_alert_color($Color).'">'.$text.'</div>';
		}
		public function _alert_color($data){
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
		public function _badge($BadgeColor,$BadgeText){
			echo '<span class="badge '.$this->_alert_color($BadgeColor).'">'.$BadgeText.'</span>';
		}
		public function BADGE_AJAX($BadgeColor,$BadgeText){
			echo '<div class="badge '.$BadgeColor.' text-center f_18 w_100_p">'.$BadgeText.'</div>';
		}
		public function badge_pill($PillColor,$PillText){
			return '<div class="badge badge-pill f_14 '.$this->_alert_color($PillColor).'">'.$PillText.'</div>';
		}
		# Misc Display Functions
		public function TitleBar($data,$width=false,$s_class=false){
			echo '<div class="badge '.$this->Theme->_arr["TITLE_BG_COLOR"];
			if($width){echo ' '.$width.' ';}
			echo 'b_i f_20 tac';
			if($s_class){echo ' '.$s_class;}
			echo '">'.$data.'</div>';
		}
		public function mail_diag(){
			echo 'Debug : '.$this->PayPal->PAYPAL_DEBUG.'<br>';
			echo 'Receiver : '.$this->PayPal->PAYPAL_RECEIVER.'<br>';
			echo 'SB URI : '.$this->PayPal->PAYPAL_SANDBOX_URI.'<br>';
			echo 'SD URI : '.$this->PayPal->PAYPAL_STANDARD_URI.'<br>';
			echo 'USE SB : '.$this->PayPal->PAYPAL_SANDBOX.'<br>';
			echo 'Send Conf Email : '.$this->PayPal->PAYPAL_CONF_EMAIL.'<br>';
			echo 'Member Email : '.$_SESSION["Email"].'<br>';
		}
		public function Separator($Height){
			switch($Height){
				case '5':return '<div class="separator_5"></div>';break;
				case '10':return '<div class="separator_10"></div>';break;
				case '15':return '<div class="separator_15"></div>';break;
				case '20':return '<div class="separator_20"></div>';break;
				case '30':return '<div class="separator_30"></div>';break;
				case '40':return '<div class="separator_40"></div>';break;
				case '50':return '<div class="separator_50"></div>';break;
				case '60':return '<div class="separator_60"></div>';break;
				case '70':return '<div class="separator_70"></div>';break;
				case '80':return '<div class="separator_80"></div>';break;
				case '90':return '<div class="separator_90"></div>';break;
				case '100':return '<div class="separator_100"></div>';break;
			}
		}
		# Content Builders
		public function _get_bg($Zone){
			$CMS_WP		=	$this->Style->_uni_images($Zone,"S_WP").$this->Theme->_arr["CMS_BG"];
			$CMS_C_WP	=	$this->Style->_uni_images($Zone,"T_WP").$this->Theme->_arr["CMS_BG"];

			$ACP_WP		=	$this->Style->_uni_images($Zone,"S_WP").$this->Theme->_arr["ACP_BG"];
			$ACP_C_WP	=	$this->Style->_uni_images($Zone,"T_WP").$this->Theme->_arr["ACP_BG"];

			if($Zone == "CMS"){
				if($this->Theme->_arr["CMS_BG"] !== NULL || !empty($this->Theme->_arr["CMS_BG"])){
					if(is_file($CMS_WP)){
						# local image file
						return '<body class="ndf" style="background:#000 url("'.$CMS_WP.'") no-repeat center fixed;background-size:100% 100%;">';
					}
					elseif(is_file($CMS_C_WP)){
						# local image file
						return '<body class="ndf" style="background:#000 url('.$CMS_C_WP.') no-repeat center fixed;background-size:100% 100%;">';
					}
					elseif(!is_file($CMS_WP) && !is_file($CMS_C_WP)){
						# remote image file
						return '<body class="ndf" style="background:#000 url('.$this->Theme->_arr["CMS_BG"].') no-repeat center fixed;background-size:100% 100%;">';
					}
					else{
						return '<body class="ndf" style="background:#000;">';
					}
				}
				else{
					return '<body class="ndf" style="background:#000;">';
				}
			}
			elseif($Zone == "ACP"){
				if($this->Theme->_arr["ACP_BG"] !== NULL || !empty($this->Theme->_arr["ACP_BG"])){
					if(is_file($ACP_WP)){
						# local image file
						return '<body style="background:#000 url('.$ACP_WP.') no-repeat center fixed;background-size:100% 100%;">';
					}
					elseif(is_file($ACP_C_WP)){
						# local image file
						return '<body style="background:#000 url('.$ACP_C_WP.') no-repeat center fixed;background-size:100% 100%;">';
					}
					elseif(!is_file($ACP_WP) && !is_file($ACP_C_WP)){
						# remote image file
						return '<body style="background:#000 url('.$this->Theme->_arr["ACP_BG"].') no-repeat center fixed;background-size:100% 100%;">';
					}
					else{
						return '<body style="background:#000;">';
					}
				}
				else{
					return '<body style="background:#000;">';
				}
			}
		#	echo '<div id="loader-wrapper">';
		#		echo '<div id="loader"></div>';
		#		echo '<div class="loader-section section-left"></div>';
		#		echo '<div class="loader-section section-right"></div>';
		#	echo '</div>';
		}
		public function _get_header($Zone,$img_type,$check=false){
			$img_path		=	$this->Style->_uni_images($Zone,$img_type);
			$img			=	$this->Theme->_arr["LOGO_IMG"];
			$img_attr		=	'';
			$img_src		=	$img_path.$img;

			$img_err_src	=	$this->Style->_uni_images($Zone,'S_MISC').'Cross_2.png';
			$img_err_attr	=	'height="64" width="64"';

			if($check == true){
				if(file_exists($img_src)){
			#		return true;
					return $img_src.'<br>';
				}

			#	return false;
				return $img_path.'<br>';

			}
			else{
				# Make sure $IMG is not empty
				if($img){
					echo '<header id="logo" class="container"';
					# Check if pane color && transparency are set, else just add closing tag
					if($this->Theme->_arr["PANE_BG_COLOR"] && $this->Theme->_arr["PANE_BG_TRANS"]){
						echo 'style="background-color:rgba('.$this->Theme->_arr["PANE_BG_COLOR"].','.$this->Theme->_arr["PANE_BG_TRANS"].');"';
					}
					else{
						echo '>';
					}

					if(!file_exists($img_src)){
						$img_attr=$img_err_attr;
						$img_src=$img_err_src;
					}
					echo '<img src="'.$img_src.'" class="img-fluid" '.$img_attr.'>';
					echo '</header>';
				}
			}
		}
		public function _do_build_card($t1,$t2,$t3,$t4,$t5){
			echo '<div class="col-xl-3 col-lg-6">';
				echo '<div class="card card-inverse" style="background-color: #333; border-color: #333;">';
					echo '<div class="card-header label-default">'.$t1.'</div>';
					echo '<div class="card-block">';
						echo '<p class="card-text">'.$t2.'</p>';
						echo '<a class="btn btn-warning" href="?'.$this->Setting->_stng_array[0].'='.$t3.'">'.$t4.' '.$t5.'</a>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		# Form Builders
		public function input_group($ID,$PLACEHOLDER,$VALUE,$ATTRIB=false,$PREPEND=false,$APPEND=false,$STYLE=false){
			echo '<div class="input-group input-group-sm '.$STYLE.'">';
				if($PREPEND){
					echo '<div class="input-group-prepend">';
						echo '<span class="input-group-text" id="basic-addon">'.$PREPEND.'</span>';
					echo '</div>';
				}

				echo '<input class="form-control" id="'.$ID.'" name="VALUE" type="text" placeholder="'.$PLACEHOLDER.'" value="'.htmlspecialchars($VALUE).'" '.$ATTRIB.'>';

				if($APPEND){
					echo '<div class="input-group-append">';
						echo '<span class="input-group-text">'.$APPEND.'</span>';
					echo '</div>';
				}
			echo '</div>';
		}
		public function input_group_reg($STYLE='',$PREPEND='',$LABEL='',$LABEL_TEXT='',$ID,$INPUT_TYPE='',$PLACEHOLDER='',$VALUE='',$ATTRIB='',$SMALL='',$SMALL_TEXT='',$APPEND='',$APPEND_TEXT_1='',$APPEND_TEXT_2=''){
			echo '<div class="form-group row">';
				echo '<div class="input-group input-group-sm';
					if(!empty($STYLE)){echo ' '.$STYLE;}
				echo '">';
				if($PREPEND){
					echo '<div class="input-group-prepend">';
						echo '<span class="input-group-text" id="basic-addon">'.$PREPEND.'</span>';
					echo '</div>';
				}

				if(!empty($LABEL)){
					echo '<label for="input-'.$ID.'">';
					if(!empty($LABEL_TEXT)){echo $LABEL_TEXT;}
					else{echo 'Label text is null!';}
					echo '</label>';
				}
					echo '<input class="form-control" id="input-'.$ID.'" name="VALUE" type="text" ';
					if(!empty($PLACEHOLDER)){echo 'placeholder="'.$PLACEHOLDER.'" ';}
					if(!empty($VALUE)){echo 'value="'.htmlspecialchars($VALUE).'" ';}
					if(!empty($ATTRIB)){echo $ATTRIB;}
					echo '>';

				if(!empty($APPEND)){
					switch($APPEND){
						case	0	:
							echo '<div class="input-group-append">';
								echo '<button class="btn badge badge-warning open_'.$APPEND_TEXT_1.'" data-id="" data-target="#'.$APPEND_TEXT_1.'" data-toggle="modal">'.$APPEND_TEXT_2.'</button>';
							echo '</div>';
						break;
						case	1	:
							echo '<div class="input-group-append">';
								echo '<span class="input-group-text">'.$APPEND_TEXT_1.'</span>';
							echo '</div>';
						break;
					}
				}
				echo '</div>';
			echo '</div>';
		}
		public function input_label_group(){
			echo '<div class="form-label-group">';
				echo '<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">';
				echo '<label for="inputEmail">Email address</label>';
			echo '</div>';
		}
		public function input_select($SELECT){
			echo '<div class="input-group input-group-sm mb-3">';
				echo $SELECT;
			echo '</div>';
		}
		public function _do_table_options($RowID,$Edit,$DB,$target,$Desc,$Value,$Setting,$Special=false){
			switch($Edit){
				case	0	:
					echo '<td class="col-1 tac badge-danger">';
						echo '<i class="fa fa-lock"></i> ';
						echo 'Locked';
					echo '</td>';
					echo '<td class="col-1 tac badge-warning">';
						echo '<button class="badge badge-warning open_unlock_modal" data-id="'.$RowID.'~'.$Edit.'~'.$DB.'" data-target="#unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button>';
					echo '</td>';
					echo '<td class="col-1 tac badge-info">'; # tooltip
						echo $this->Tooltips->_do_tooltip('build','button',$Setting,'fa fa-info-circle',1,6,'','pill');
					echo '</td>';
				break;
				case	1	:
					echo '<td class="col-1 tac badge-success">';
						echo '<button 
							class="badge badge-warning open_'.$target.'" 
							data-id="'.$RowID.'~'.$Desc.'~'.$Value.'~'.$Setting.'~'.$DB.'" 
							data-target="#'.$target.'" 
							data-toggle="modal">
							<i class="fa fa-eye">
							</i> Modify</button>';
					echo '</td>';
					echo '<td class="col-1 tac badge-success">';
						echo '<button class="badge badge-warning open_lock_modal" data-id="'.$RowID.'~'.$Edit.'~'.$DB.'" data-target="#lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button>';
					echo '</td>';
					echo '<td class="col-1 tac badge-info">'; # tooltip
						echo $this->Tooltips->_do_tooltip('build','button',$Setting,'fa fa-info-circle',1,6,'','pill');
					echo '</td>';
				break;
				case	2	:
					echo '<td class="col-1 tac badge-secondary">';
						echo '<i class="fa fa-times"></i> ';
						echo 'Disabled';
					echo '</td>';
					echo '<td class="col-1 tac badge-secondary">';
						echo '<i class="fa fa-times"></i> ';
						echo 'Disabled';
					echo '</td>';
					echo '<td class="col-1 tac badge-info">'; # tooltip
						echo $this->Tooltips->_do_tooltip('build','button',$Setting,'fa fa-info-circle',1,6,'','pill');
					echo '</td>';
				break;
				default		:
					echo $Edit;
			}
		}
		public function _do_pre($notice,$data=false,$debug=false){
			echo '<pre>';
				echo '<div class="b_i f_20">'.$notice.'</div>';
				if($data){
					var_dump($data);
				}
				if($debug){
					exit();
				}
			echo '</pre>';
		}
		public function _status_2_text_admin($data){
			# _do_ColorBuilder($Type,$Color='',$Alpha='',$Text='')
			switch($data){
				case 0	:	return $this->Colors->_do_ColorBuilder('span','DarkGray','','Player');	break;
				case 16	:	return $this->Colors->_do_ColorBuilder('span','DarkGoldenrod','','Administrator');	break;
				case 32	:	return $this->Colors->_do_ColorBuilder('span','MediumBlue','','Game Master');	break;
				case 64	:	return $this->Colors->_do_ColorBuilder('span','DodgerBlue2','','Game Master Assistant');	break;
				case 80	:	return $this->Colors->_do_ColorBuilder('span','Green','','Game Sage');	break;
				default	:	return $this->Colors->_do_ColorBuilder('span','Red','','Unknown');	break;
			}
		}
		# MISC
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		public function _Mthds(){
			$class_methods	=	get_class_methods($this);
			echo '<div class="col-md-12">';
				echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
				echo '<pre>';
				foreach($class_methods as $method_name){
					echo $method_name.'<br>';
				}
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>