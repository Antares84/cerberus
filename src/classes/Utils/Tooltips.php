<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title: Tooltips.class.php																#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS tooltips class, used for loading all tooltip resources							#
	#	Last Update Date: 02.02.2019	1045													#
	#																							#
	#	USAGE																					#
	#	@method_name	(string)	name of the method to call (_do_tooltip)					#
	#	@color			(string)	color for tooltip button									#
	#	@data			(string)	data that you want displayed in the tooltip					#
	#	@Icon			(string)	data that you want displayed for the icon	 				#
	#								(available icon libraries are Fontawesome && FontIcons)		#
	#	@pos			(int)		tooltip location/position									#
	#	@style			(string)	tooltip button style (block/rounded)						#
	#############################################################################################

	class Tooltips{

		# Required
		protected $type;protected $title;protected $icon;protected $pos;protected $color;protected $color_type;protected $style;
		# Markup
		protected $color1;protected $color2;protected $color3;protected $color_marker;
		# Storage && Output
		protected $tooltip;protected $output;
		# Debugging
		protected $debug=0; # 0/1/2

		public function __construct($Colors){
			$this->Colors	=	$Colors;
		}
		public function _do_tooltip($method_name,$type=false,$title=false,$icon=false,$pos=false,$color=false,$color_type=false,$style=false){
			$method = '_tooltip_'.$method_name;

			if(method_exists($this,$method)){
				return $this->$method($type,$title,$icon,$pos,$color,$color_type,$style);
			}

			return '<b>Class ('.get_class($this).'):</b> Defined method not found';
		}
		private function _tooltip_build($type,$title,$icon,$pos,$color,$color_type,$style){
			if($title){
				$this->type			=	$type;
				$this->title		=	$this->_do_tooltip('array',$title);
				$this->title		=	'data-toggle="tooltip" data-html="true" title="'.$this->title.'"';
				$this->icon			=	$icon;
				$this->pos			=	$pos;
				$this->color		=	$color;
				$this->color_type	=	$color_type;
				$this->style		=	$style;

				if($this->debug == 1){
					$this->output	.=	'<div class="table-responsive">';
						$this->output	.=	'<table class="table table-sm auto-table acp_table">';
							$this->output	.=	'<thead>';
								$this->output	.=	'<tr>';
									$this->output	.=	'<th>Label</th>';
									$this->output	.=	'<th>Details</th>';
								$this->output	.=	'</tr>';
							$this->output	.=	'</thead>';
							$this->output	.=	'<tbody>';
								$this->output	.=	'<tr>';
									$this->output	.=	'<td>Type</td>';
									$this->output	.=	'<td>'.$this->type.'</td>';
								$this->output	.=	'</tr>';
								$this->output	.=	'<tr>';
									$this->output	.=	'<td>Title</td>';
									$this->output	.=	'<td>'.$this->title.'</td>';
								$this->output	.=	'</tr>';
								$this->output	.=	'<tr>';
									$this->output	.=	'<td>Icon</td>';
									$this->output	.=	'<td>'.$this->icon.'</td>';
								$this->output	.=	'</tr>';
								$this->output	.=	'<tr>';
									$this->output	.=	'<td>Pos</td>';
									$this->output	.=	'<td>'.$this->pos.'</td>';
								$this->output	.=	'</tr>';
								$this->output	.=	'<tr>';
									$this->output	.=	'<td>Color</td>';
									$this->output	.=	'<td>'.$this->color.'</td>';
								$this->output	.=	'</tr>';
								$this->output	.=	'<tr>';
									$this->output	.=	'<td>Color Type</td>';
									$this->output	.=	'<td>'.$this->color_type.'</td>';
								$this->output	.=	'</tr>';
								$this->output	.=	'<tr>';
									$this->output	.=	'<td>Style</td>';
									$this->output	.=	'<td>'.$this->style.'</td>';
								$this->output	.=	'</tr>';
							$this->output	.=	'</tbody>';
						$this->output	.=	'</table>';
					$this->output	.=	'</div>';

					return $this->output;
				}

				if($this->pos){
					$this->pos		=	$this->_do_tooltip('pos');
				}
				if($this->color){
					$this->color	=	$this->_do_tooltip('color');
				}
				if($this->style){
					$this->style	=	$this->_do_tooltip('style');
				}
				if($this->type){
					$this->type		=	$this->_do_tooltip('type');
				}
				$this->tooltip		=	$this->type;

				if($this->debug == 2){
					$this->output	.=	'Type: '.$this->type.'<br>';
					$this->output	.=	'Title:	'.$this->title.'<br>';
					$this->output	.=	'Icon: '.$this->icon.'<br>';
					$this->output	.=	'Pos: '.$this->pos.'<br>';
					$this->output	.=	'Color: '.$this->color.'<br>';
					$this->output	.=	'Color1: '.$this->color1.'<br>';
					$this->output	.=	'Color2: '.$this->color2.'<br>';
					$this->output	.=	'Color3: '.$this->color3.'<br>';
					$this->output	.=	'Color Marker: '.$this->color_marker.'<br>';
					$this->output	.=	'Color Type: '.$this->color_type.'<br>';
					$this->output	.=	'Style: '.$this->style.'<br>';
					$this->output	.=	'Tooltip: '.$this->tooltip.'<br><br>';

					return $this->output;
				}

				$this->output=$this->tooltip;
				return $this->output;
			}
			else{
				throw new SystemException('[Title] must be defined! Check your code and try again.',0,0,__FILE__,__LINE__);
			}
		}
		private function _tooltip_type(){
			$return='';

			switch($this->type){
				case 'button' :
					$return	.=	'<button '.$this->style.' '.$this->title.'>';
						$return	.=	'<i class="'.$this->icon.'"></i> Tooltip';
					$return	.=	'</button>';
				break;
				case 'icon' :
					$return	.=	'<i class="'.$this->icon.'" '.$this->style.' '.$this->title.'></i>';
				break;
				default :
					$return	.=	'<i class="'.$this->icon.'" '.$this->style.' '.$this->title.'></i>';
				break;
			}

			return $return;
		}
		private function _tooltip_pos(){
			switch($this->pos){
				case	0	:	return ' data-placement="auto"';	break;
				case	1	:	return ' data-placement="top"';		break;
				case	2	:	return ' data-placement="bottom"';	break;
				case	3	:	return ' data-placement="left"';	break;
				case	4	:	return ' data-placement="right"';	break;
			}
		}
		private function _tooltip_style(){
			$this->color1	=	substr($this->color,0,2);	# bg
			$this->color2	=	substr($this->color,0,5);	# badge
			$this->color3	=	substr($this->color,0,10);	# background

			if($this->color1 == 'bg'){
				$this->color_marker=0;
			}elseif($this->color2 == 'badge'){
				$this->color_marker=1;
			}elseif($this->color3 == 'background'){
				$this->color_marker=2;
			}

			if($this->color_marker == 0 || $this->color_marker == 1){
				switch($this->style){
					case	'block'	:	return ' class="badge text-white '.$this->color.'"';						break;
					case	'pill'	:	return ' class="badge badge-pill text-white '.$this->color.'"';				break;
					default			:	return ' class="badge text-white '.$this->color.'"';						break;
				}
			}elseif($this->color_marker == 2){
				switch($this->style){
					case	'block'	:	return ' class="badge text-white" style="'.$this->color.'"';				break;
					case	'pill'	:	return ' class="badge badge-pill text-white" style="'.$this->color.'"';		break;
					default			:	return ' class="badge text-white" style="'.$this->color.'"';				break;
				}
			}
		}
		private function _tooltip_color(){
			return $this->Colors->_colors_default($this->color_type,$this->color);
		}
		private function _tooltip_array($data){
			$return='';

			switch($data){
				case	'PAGE_PREFIX'	:
					$return	.=	'<b><i>Page Prefix</i></b><br>The prefix that is shown in the address bar for all pages.';
				break;
				case	'SETUP'			:
					$return	.=	'<b><i>Initial Setup</i></b><br>Whether initial setup has been completed or not.';
				break;
				case	'SITE_DOMAIN'	:
					$return	.=	'<b><i>Site Domain</i></b><br>Your site domain url. Don\'t add http/https as these are automatically added per your settings.';
				break;
				case	'SITE_TYPE'		:
					$return	.=	'<b><i>Site Type</i></b><br>Available site templates';
				break;
				case	'LOGGING'		:
					$return	.=	'<b><i>Logging</i></b><br>Enable/Disable access logging';
				break;
				case	'DEBUG'		:
					$return	.=	'<b><i>Debugging</i></b><br>Enable/Disable debugging, used for error checking & submission pages';
				break;
				case	'HTTPS_SSL'		:
					$return	.=	'<b><i>HTTPS/SSL</i></b><br>Enable/Disable https site-wide, used if you have an SSL certificate for your website';
				break;
				case	'MAINTENANCE'		:
					$return	.=	'<b><i>Maintenance</i></b><br>Enable/Disable maintenance mode for the CMS';
				break;
				default					:
					$return	.=	'No description available';
				break;
			}

			return $return;
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
		public function _class_methods(){
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