<?php
	namespace classes\Display\Templates\CMS;

	class Columns{
		public function __construct(){}
		public function _get_col($size,$width,$data){
			$method	=	'_col_'.$size.'_'.$width;
			$err='Fatal error in <b>'.get_class($this).'<br>';
			$err.='Action: Method '.$method.' was called.';
			$err.='Result: Method doesn\'t exist!';

			try{
				if(method_exists($this,$method)){
					return $this->$method($data);
				}
			}
			catch(exception $e){throw new SystemException($err,0,0,__FILE__,__LINE__);}
		}
		public function _col($size,$width,$data){
			return '<div class="col-'.$size.'-'.$width.'">'.$data.'</div>';
		}
		# Small
		public function _col_sm_1($data){
			return '<div class="col-sm-1">'.$data.'</div>';
		}
		public function _col_sm_2($data){
			return '<div class="col-sm-2">'.$data.'</div>';
		}
		public function _col_sm_3($data){
			return '<div class="col-sm-3">'.$data.'</div>';
		}
		public function _col_sm_4($data){
			return '<div class="col-sm-4">'.$data.'</div>';
		}
		public function _col_sm_5($data){
			return '<div class="col-sm-5">'.$data.'</div>';
		}
		public function _col_sm_6($data){
			return '<div class="col-sm-6">'.$data.'</div>';
		}
		public function _col_sm_7($data){
			return '<div class="col-sm-7">'.$data.'</div>';
		}
		public function _col_sm_8($data){
			return '<div class="col-sm-8">'.$data.'</div>';
		}
		public function _col_sm_9($data){
			return '<div class="col-sm-9">'.$data.'</div>';
		}
		public function _col_sm_10($data){
			return '<div class="col-sm-10">'.$data.'</div>';
		}
		public function _col_sm_11($data){
			return '<div class="col-sm-11">'.$data.'</div>';
		}
		public function _col_sm_12($data){
			return '<div class="col-sm-12">'.$data.'</div>';
		}
		# Medium
		public function _col_md_1($data){
			return '<div class="col-md-1">'.$data.'</div>';
		}
		public function _col_md_2($data){
			return '<div class="col-md-2">'.$data.'</div>';
		}
		public function _col_md_3($data){
			return '<div class="col-md-3">'.$data.'</div>';
		}
		public function _col_md_4($data){
			return '<div class="col-md-4">'.$data.'</div>';
		}
		public function _col_md_5($data){
			return '<div class="col-md-5">'.$data.'</div>';
		}
		public function _col_md_6($data){
			return '<div class="col-md-6">'.$data.'</div>';
		}
		public function _col_md_7($data){
			return '<div class="col-md-7">'.$data.'</div>';
		}
		public function _col_md_8($data){
			return '<div class="col-md-8">'.$data.'</div>';
		}
		public function _col_md_9($data){
			return '<div class="col-md-9">'.$data.'</div>';
		}
		public function _col_md_10($data){
			return '<div class="col-md-10">'.$data.'</div>';
		}
		public function _col_md_11($data){
			return '<div class="col-md-11">'.$data.'</div>';
		}
		public function _col_md_12($data){
			return '<div class="col-md-12">'.$data.'</div>';
		}
		# Large
		public function _col_lg_1($data){}
		public function _col_lg_2($data){}
		public function _col_lg_3($data){}
		public function _col_lg_4($data){}
		public function _col_lg_5($data){}
		public function _col_lg_6($data){}
		public function _col_lg_7($data){}
		public function _col_lg_8($data){}
		public function _col_lg_9($data){}
		public function _col_lg_10($data){}
		public function _col_lg_11($data){}
		public function _col_lg_12($data){}
	}