<?php
	namespace classes\settings;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Theme{

		public $_arr;

		# Public Methods
		public function __construct($Arrays,$db,$Dirs){
			$this->Arrays	=	$Arrays;
			$this->db		=	$db;
			$this->Dirs		=	$Dirs;

			$this->_class_info();
		}
		public function _class_info($level=false){
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
				default	:	return $this->_build();	break;
			}
		}
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		public function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

					$this->_build();

					echo '<pre>';
						echo 'Pre Node<br>';
						var_dump($this->_arr);
					echo '</pre>';
				echo '</div>';
			}
			else{
				echo '<div class="col-md-12">';
					echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
					echo '<pre>';
					foreach($class_methods as $method_name){
						echo $method_name.'<br>';
					}
					echo '</pre>';
				echo '</div>';
				exit;
			}
		}

		# Private Methods
		private function _build(){
			if($this->_arr){$this->_arr=null;}
			$this->_a=array();

			$class_methods	=	get_class_methods($this);

			foreach($class_methods as $method_name){
				if(!in_array($method_name,$this->Arrays->no_index)){
					try{
						$this->$method_name();
					#	echo $method_name.'<br>';
					}
					catch(\Exception $e){
						echo $method_name;
					#	exit;
						throw new \classes\Exception\SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
					}
				}
			}

			$this->_do_close(true);
		}
		private function _do_close($push=false){
			$this->_arr=$this->_a;

			if($push){unset($this->_a);}
		}
		private function _do_query($database,$data,$alert){
			$res	=	$this->db->_do_query($database,0,$data);

			if($alert){
				if(!$res){
					throw new \classes\Exception\SystemException('Unable to load var <b>'.$data.'</b> from database!',0,0,__FILE__,__LINE__);
				}
				else{
					return $res;
				}
			}
			else{
				return $res;
			}
		}
		# LAYOUT
		private function _columns(){
			$this->_a["COLUMNS"]	=	$this->_do_query("SETTINGS_THEME","COLUMNS",1);
		}
		private function _sidebar_position(){
			$this->_a["SIDEBAR_POS"]	=	$this->_do_query("SETTINGS_THEME","SIDEBAR_POS",1);
		}
		private function _nav_server_status(){
			$this->_a["NAV_SERVER_STATUS"]	=	$this->_do_query("SETTINGS_THEME","NAV_SERVER_STATUS",0);
		}
		# STYLE
		private function _cms_style(){
			$this->_a["CMS_STYLE_NAME"]	=	$this->_do_query("SETTINGS_THEME","CMS_STYLE_NAME",1).'/';
		}
		private function _cms_theme(){
			$this->_a["CMS_THEME_NAME"]	=	$this->_do_query("SETTINGS_THEME","CMS_THEME_NAME",1).'/';
		}
		private function _acp_style(){
			$this->_a["ACP_STYLE_NAME"]	=	$this->_do_query("SETTINGS_THEME","ACP_STYLE_NAME",1).'/';
		}
		private function _acp_theme(){
			$this->_a["ACP_THEME_NAME"]	=	$this->_do_query("SETTINGS_THEME","ACP_THEME_NAME",0).'/';
		}
		private function _logo_img(){
			$this->_a["LOGO_IMG"]	=	$this->_do_query("SETTINGS_THEME","LOGO_IMG",1);
		}
		private function _cms_background(){
			$this->_a["CMS_BG"]	=	$this->_do_query("SETTINGS_THEME","CMS_BG",1);
		}
		private function _ap_background(){
			$this->_a["ACP_BG"]	=	$this->_do_query("SETTINGS_THEME","ACP_BG",1);
		}
		private function _favicon(){
			$this->_a["FAVICON_IMAGE"]	=	$this->Dirs->_arr["ICO"].$this->_do_query("SETTINGS_THEME","FAVICON_IMAGE",0);
		}
		private function _nav_background(){
			$this->_a["NAV_BG_COLOR"]	=	$this->_do_query("SETTINGS_THEME","NAV_BG_COLOR",0);
		}
		private function _card_background(){
			$this->_a["CARD_BG_COLOR"]	=	$this->_do_query("SETTINGS_THEME","CARD_BG_COLOR",0);
		}
		private function _title_background(){
			$this->_a["TITLE_BG_COLOR"]	=	$this->_do_query("SETTINGS_THEME","TITLE_BG_COLOR",1);
		}
		private function _breadcrumb_background(){
			$this->_a["BREAD_BG_COLOR"]	=	$this->_do_query("SETTINGS_THEME","BREAD_BG_COLOR",1);
		}
		private function _pane_background(){
			$this->_a["PANE_BG_COLOR"]	=	$this->_do_query("SETTINGS_THEME","PANE_BG_COLOR",0);
		}
		private function _pane_background_transparency(){
			$this->_a["PANE_BG_TRANS"]	=	$this->_do_query("SETTINGS_THEME","PANE_BG_TRANS",0);
		}
		# PLUGINS
		private function _module_status(){
			$this->_a["MODULES_STATUS"]	=	$this->_do_query("SETTINGS_THEME","MODULES_STATUS",1);
		}
		# FOOTER
		private function _footer_status(){
			$this->_a["FOOTER_STATUS"]	=	$this->_do_query("SETTINGS_THEME","FOOTER_STATUS",1);
		}
		private function _footer_copyright(){
			$this->_a["FOOTER_COPYRIGHT"]	=	$this->_do_query("SETTINGS_THEME","FOOTER_COPYRIGHT",1);
		}
		private function _footer_block_0(){
			$this->_a["FOOTER_BLOCK_0"]	=	$this->_do_query("SETTINGS_THEME","FOOTER_BLOCK_0",0);
		}
		private function _footer_block_1(){
			$this->_a["FOOTER_BLOCK_1"]	=	$this->_do_query("SETTINGS_THEME","FOOTER_BLOCK_1",0);
		}
		private function _footer_block_2(){
			$this->_a["FOOTER_BLOCK_2"]	=	$this->_do_query("SETTINGS_THEME","FOOTER_BLOCK_2",0);
		}
	}
?>