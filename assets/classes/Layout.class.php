<?php
	class Layout{
		function __construct($DatabaseObj){
			$this->db	=	$DatabaseObj;
		}
		# LAYOUT
		function SHOW_SIDE_NAV(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","SHOW_SIDE_NAV");
		}
		function COLUMNS(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","COLUMNS");
		}
		function SIDEBAR_POS(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","SIDEBAR_POS");
		}
		function NAV_SERVER_STATUS(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","NAV_SERVER_STATUS");
		}
		# STYLE
		function CMS_STYLE_NAME(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","CMS_STYLE_NAME")."/";
		}
		function CMS_THEME_NAME(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","CMS_THEME_NAME")."/";
		}
		function ACP_STYLE_NAME(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","ACP_STYLE_NAME")."/";
		}
		function ACP_THEME_NAME(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","ACP_THEME_NAME")."/";
		}
		function LOGO_IMG(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","LOGO_IMG");
		}
		function CMS_BG(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","CMS_BG");
		}
		function ACP_BG(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","ACP_BG");
		}
		# PLUGINS
		function USE_PLUGINS(){
			return $this->db->do_QUERY("VALUE","SETTINGS_LAYOUT","SETTING","USE_PLUGINS");
		}
	}
?>