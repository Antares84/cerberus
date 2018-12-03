<?php
	/*
		Description:	Table Builder API
		Build Date:		11.21.2018
	*/
	class Table{
		# Head
		public $head=array();
		private $h_level;

		# Body
		public $body=array();
		private $b_level;
		# Misc
		private $debug=0;
		private $h_pre=1;
		private $b_pre=1;
		private $zone;
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
		function test($data){
			$this->_pre('Debug level: '.$this->debug);

			if($data["head"]){
				$this->h_level	=	$this->array_depth($data["head"]);
				if($this->h_pre){$this->_pre('Head level: '.$this->h_level);}
				if($this->h_level == 1){
					if($this->h_pre){$this->_pre('Test: Head L1');}
					$this->_self_align($data["head"],'th');
					$this->_ds_level_1($this->head,'th');
				}
				elseif($this->h_level == 2){
					if($this->h_pre){$this->_pre('Test: Head L2');}
					$this->_self_align($data["head"],'th');
					$this->_ds_level_2($this->head);
				}
				elseif($this->h_level == 3){
					if($this->h_pre){$this->_pre('Test: Head L3');}
					$this->_self_align($data["head"],'th');
					$this->_ds_level_3($this->head);
				}
			}

			if($data["body"]){
				$this->b_level	=	$this->array_depth($data["body"]);
				if($this->b_pre){$this->_pre('Body level: '.$this->b_level);}
				if($this->b_level == 1){
					if($this->b_pre){$this->_pre('Test: Body L1');}
					$this->_self_align($data["body"],'td');
					$this->_ds_level_1($this->body,'body');
				}
				elseif($this->b_level == 2){
					if($this->b_pre){$this->_pre('Test: Body L2');}
					$this->_ds_level_2($data["body"],'td');
					$this->_self_align($this->body,'td');
				#	$this->_self_align($data["body"],'td');
				#	$this->_ds_level_2($this->body,'td');
				}
				elseif($this->b_level == 3){
					if($this->b_pre){$this->_pre('Test: Body L3');}
					$this->_self_align($data["body"],'td');
					$this->_ds_level_3($this->body);
				}
			}

			#$this->_pre('Test Results',$this->head);
			$this->_ds_table($this->head,$this->body);
		}
		function test_v2($data){
			if($data["head"]){
				$this->h_level	=	$this->array_depth($data["head"]);
				if($this->h_pre){$this->_pre('Head level: '.$this->h_level);}

				if($this->h_level == 1){
					if($this->h_pre){$this->_pre('Test v2: Head L1');}
					$this->_self_align($data["head"],'th');
					$this->_ds_level_1($this->head,'th');
				}
				elseif($this->h_level == 2){
					if($this->h_pre){$this->_pre('Test v2: Head L2');}
					$this->_ds_level_2($this->head,'th');
				}
				elseif($this->h_level == 3){
					if($this->h_pre){$this->_pre('Test v2: Head L3');}
					$this->_ds_level_3($this->head);
				}
				else{}
			}

			if($data["body"]){
				$this->b_level	=	$this->array_depth($data["body"]);
				if($this->b_pre){$this->_pre('Body level: '.$this->b_level);}

				if($this->b_level == 1){
					if($this->b_pre){$this->_pre('Test v2: Body L1');}
					$this->_self_align($data["body"],'td');
					$this->_ds_level_1($this->body,'body');
				}
				elseif($this->b_level == 2){
					if($this->b_pre){$this->_pre('Test v2: Body L2');}
#					$this->_pre('Test v2: Body L2 data["body"]',$data["body"],1);
#					$this->_ds_level_2($data["body"],'td');
				#	$this->_self_align($this->body,'td');
					$this->_self_align($data["body"],'td');
				#	$this->_ds_level_2($this->body,'td');
				}
				elseif($this->b_level == 3){
					if($this->b_pre){$this->_pre('Test v2: Body L3');}
					$this->_self_align($data["body"],'td');
					$this->_ds_level_3($this->body);
				}
			}

			$this->_ds_table($this->head,$this->body);
		}
		function _self_align($data,$zone){
			$h_array	=	array();
			$b_array	=	array();

			if($zone == 'th'){
				if(in_array($data,$this->align_arr)){
					if($this->h_pre){$this->_pre('Self-align : Head Phase 1');}
					foreach($data as $key=>$value){
						$h_array[]	=	'<th class="tac">'.$value.'</th>';
					}
				}
				else{
					if($this->h_pre){$this->_pre('Self-align : Head Phase 2');}
					foreach($data as $key=>$value){
						$h_array[]	=	'<th>'.$value.'</th>';
					}
				}
				#if($this->h_pre){$this->_pre('_self_align th',$data);}
				#if($this->h_pre){$this->_pre('Head array data (_self_align):',$h_array);}
				$this->head	=	$h_array;
			}

			if($zone == 'td'){
				#if($this->b_pre){$this->_pre('_self_align td',$data,1);}
			#	foreach($data as $k => &$key){
			#		$this->_pre('td Stage 1 Results:',$key,1);
			#	}
				if($this->b_pre){$this->_pre('_self_align : Body Phase 2');}
				#if($this->b_pre){$this->_pre('_self_align td',$data,1);}

				foreach($data as $key=>$value){
					#$this->_pre('_self_align : Body - Stage 1 (data) :',$data,1);
					$b_array[]	.=	'<tbody>';
						$b_array[]	.=	'<tr class="'.$key.'">';
						#$this->_pre('_self_align : Body - Stage 1 (data) :',$key,1);
						if(in_array($key,$this->align_arr)){
							#$this->_pre('_self_align : Body - Stage 1 (data) :',$key,1);
							#$this->_pre('_self_align : Body - (align_arr) :',$this->align_arr,1);
							if($this->b_pre){$this->_pre('Self-align : Body Phase 1');}
							foreach($value as $v){
								$b_array[]	.=	'<td class="tac">'.$v.'</td>';
							}
						}
						else{
							foreach($value as $key){
								#$this->_pre('td Stage 1 Results:',$key,1);
								$b_array[]	.=	'<td>'.$key.'</td>';
							}
						}
						$b_array[]	.=	'</tr>';
					$b_array[]	.=	'</tbody>';
				}
				$this->body	=	$b_array;
			}
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