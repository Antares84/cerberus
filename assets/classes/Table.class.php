<?php
	/*
		Description:	Table Builder API
		Build Date:		11.21.2018
	*/
	class Table{
		# Head
		protected $head=array();
		protected $h_level;

		# Body
		protected $body=array();
		protected $b_level;
		# Misc
		protected $debug=0;
		protected $h_pre=1;
		protected $b_pre=1;
		protected $zone;

		public	$align_arr=array();

		function array_depth(array $array){
			$max_depth = 1;

			foreach($array as $value){
				if(is_array($value)){
					$depth=$this->array_depth($value)+1;

					if($depth>$max_depth){
						$max_depth = $depth;
					}
				}
			}

			return $max_depth;
		}
		function align_arr(){
			$this->align_arr	=	array(
											'1',
											'2',
											'4',
											'5',
											'Page Zone'
			);
		}
		function _build($data){
			if($data["head"]){
				$this->h_level	=	$this->array_depth($data["head"]);
				if($this->h_level == 1){
					if($this->h_pre){$this->_pre('Table Builder: Head L1');}
					$this->_builder_L1($data["head"],'th');
				}
				elseif($this->h_level == 2){
					if($this->h_pre){$this->_pre('Table Builder: Head L2');}
					$this->_builder_L2($data["head"],'th');
				}
				elseif($this->h_level == 3){
					if($this->h_pre){$this->_pre('Table Builder: Head L3');}
					$this->_builder_L3($data["head"],'th');
				}
			}

			if($data["body"]){
				$this->b_level	=	$this->array_depth($data["body"]);
				if($this->b_level == 1){
					if($this->b_pre){$this->_pre('Table Builder: Body L1');}
					$this->_builder_L1($data["body"],'td');
				}
				elseif($this->b_level == 2){
					if($this->b_pre){$this->_pre('Table Builder: Body L2');}
					$this->_builder_L2($data["body"],'td');
				}
				elseif($this->b_level == 3){
					if($this->b_pre){$this->_pre('Table Builder: Body L3');}
					$this->_builder_L3($data["body"],'td');
				}
			}

			$this->_ds_table($this->head,$this->body);
		}
		function _builder_L1($data,$zone){
			$h_array	=	array();
			$b_array	=	array();

			if($zone == 'th'){
				$h_array[]	=	'<thead>';
					$h_array[]	=	'<tr>';
					foreach($data as $value){
						$h_array[]	=	'<th>'.$value.'</th>';
					}
					$h_array[]	=	'</tr';
				$h_array[]	=	'</thead>';

				$this->head	=	$h_array;
			}

			if($zone == 'td'){
				foreach($data as $key=>$value){
					echo $value;
					#array_push($this->body,$value);
				}
			}
		}
		function _builder_L2($data,$zone){
			$h_array	=	array();
			$b_array	=	array();

			if($zone == 'td'){
				#if($this->b_pre){$this->_pre(__FUNCTION__ .': Body (data)',$data,1);}
				foreach($data as $key=>$value){
					$b_array[]	.=	'<tbody>';
						$b_array[]	.=	'<tr>';
							foreach($value as $v){
								$b_array[]	.=	'<td>'.$v.'</td>';
							}
						$b_array[]	.=	'</tr>';
					$b_array[]	.=	'</tbody>';
				}
				$this->body	=	$b_array;
			}
		}
		function _ds_table($head=false,$body=false){
			if($this->debug){
				if($head){$this->_debug('head',$head);}
				if($body){$this->_debug('body',$body);}
			}
			echo '<div class="row" id="TableLoader">';
				echo '<div class="col-lg-12" id="TabularData">';
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
						if($head){
							foreach($head as $key=>$value){
								echo $value;
							}
						}
						if($body){
							foreach($body as $key=>$value){
								echo $value;
							}
						}
						echo '</table>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		function _debug($zone,$data){
			if($zone == 'head'){
				if($data){
					$this->_pre('Head data IS populated!');
				}
				else{
					$this->_pre('Head data IS NOT populated!');
				}
			}

			if($zone == 'body'){
				if($data){
					$this->_pre('Body data IS populated!');
				}
				else{
					$this->_pre('Body data IS NOT populated!');
				}
			}
		}
		function _pre($notice,$data=false,$debug=false){
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

	/*
			foreach($products as $key=>$value){
				foreach($value as $k => $v){
					
				}
			}
*/
?>