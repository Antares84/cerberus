<?php
	class Theme{

		private $QUERY;
		public $_theme_array;

		function __construct($db){
			$this->db		=	$db;

			$this->_theme_array();
		}
		function _theme_array(){
			$_array		=	array();
			$_array[]	=	$this->COLUMNS();				#0
			$_array[]	=	$this->SIDEBAR_POS();			#1
			$_array[]	=	$this->NAV_SERVER_STATUS();		#2
			$_array[]	=	$this->CMS_STYLE_NAME();		#3
			$_array[]	=	$this->CMS_THEME_NAME();		#4
			$_array[]	=	$this->ACP_STYLE_NAME();		#5
			$_array[]	=	$this->ACP_THEME_NAME();		#6
			$_array[]	=	$this->LOGO_IMG();				#7
			$_array[]	=	$this->CMS_BG();				#8
			$_array[]	=	$this->ACP_BG();				#9
			$_array[]	=	$this->FAVICON_IMAGE();			#10
			$_array[]	=	$this->NAV_BG();				#11
			$_array[]	=	$this->CARD_BG();				#12
			$_array[]	=	$this->TITLE_BG();				#13
			$_array[]	=	$this->BREAD_BG();				#14
			$_array[]	=	$this->USE_PLUGINS();			#15
			$_array[]	=	$this->FOOTER();				#16
			$_array[]	=	$this->PANE_BG();				#17
			$_array[]	=	$this->PANE_BG_TRANS();			#18
			$_array[]	=	$this->FOOTER_BLOCK_A();		#19
			$_array[]	=	$this->FOOTER_BLOCK_B();		#20
			$_array[]	=	$this->FOOTER_BLOCK_C();		#21

			$this->_theme_array	=	$_array;
		}
		function QUERY($DB,$DATA,$ALERT){
			$this->QUERY = $this->db->do_QUERY("VALUE",$DB,"SETTING",$DATA);

			if($ALERT){
				if(!$this->QUERY){
					throw new SystemException('Unable to load var <b>'.$DATA.'</b> from database!',0,0,__FILE__,__LINE__);
				}
				else{
					return $this->QUERY;
				}
			}
			else{
				return $this->QUERY;
			}
		}
		# LAYOUT
		function COLUMNS(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","COLUMNS",1);
			return $this->QUERY;
		}
		function SIDEBAR_POS(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","SIDEBAR_POS",1);
			return $this->QUERY;
		}
		function NAV_SERVER_STATUS(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","NAV_SERVER_STATUS",0);
			return $this->QUERY;
		}
		# STYLE
		function CMS_STYLE_NAME(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","CMS_STYLE_NAME",1);
			return $this->QUERY."/";
		}
		function CMS_THEME_NAME(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","CMS_THEME_NAME",1);
			return $this->QUERY."/";
		}
		function ACP_STYLE_NAME(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","ACP_STYLE_NAME",1);
			return $this->QUERY."/";
		}
		function ACP_THEME_NAME(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","ACP_THEME_NAME",0);
			return $this->QUERY."/";
		}
		function LOGO_IMG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","LOGO_IMG",1);
			return $this->QUERY;
		}
		function CMS_BG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","CMS_BG",1);
			return $this->QUERY;
		}
		function ACP_BG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","ACP_BG",1);
			return $this->QUERY;
		}
		function FAVICON_IMAGE(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","FAVICON_IMAGE",0);
			return $this->QUERY;
		}
		function NAV_BG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","NAV_BG_COLOR",0);
			return $this->QUERY;
		}
		function CARD_BG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","CARD_BG_COLOR",0);
			return $this->QUERY;
		}
		function TITLE_BG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","TITLE_BG_COLOR",1);
			return $this->QUERY;
		}
		function BREAD_BG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","BREAD_BG_COLOR",1);
			return $this->QUERY;
		}
		function PANE_BG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","PANE_BG_COLOR",0);
			return $this->QUERY;
		}
		function PANE_BG_TRANS(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","PANE_BG_TRANS",0);
			return $this->QUERY;
		}
		# PLUGINS
		function USE_PLUGINS(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","USE_PLUGINS",0);
			return $this->QUERY;
		}
		# FOOTER
		function FOOTER(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","FOOTER",1);
			return $this->QUERY;
		}
		function FOOTER_BLOCK_A(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","FOOTER_BLOCK_A",0);
			return $this->QUERY;
		}
		function FOOTER_BLOCK_B(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","FOOTER_BLOCK_B",0);
			return $this->QUERY;
		}
		function FOOTER_BLOCK_C(){
			$this->QUERY				=	$this->QUERY("SETTINGS_THEME","FOOTER_BLOCK_C",0);
			return $this->QUERY;
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