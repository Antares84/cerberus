<?php
	namespace Classes\Base;

	#############################################################################################
	#	Title: Arrays.php																		#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS arrays class, used for loading all array resources								#
	#	Last Update Date: 09.29.2019	2133													#
	#############################################################################################

	class Arrays{

		# Class Specific Arrays
		public $no_index;
		public $dirs_index;
		public $pp_index;
		public $stng_index;
		public $style_index;
		public $theme_index;

		# Misc Arrays
		private $filetypes;
		private $bg_color;
		private $bit;
		private $btn;
		private $dir_lister_cfg;
		private $enabled;
		private $levels;
		private $no_msg;
		private $pane;
		private $select;
		private $sidebar;
		private $standalone;
		private $textual;
		private $y_n;

		# Public Methods
		public function __construct(){
			$this->_security();
			$this->_class_info();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _class_info($level=false){
			if($level){
			#	echo '<b>ClassInfo Level: '.$level.'<br>';
			}
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
				default	:	return $this->_build(true);		break;
			#	default	:	return $this->_build_array();	break;
			}
		}

		# Private Methods
		private function _Props(){
			echo '<td>';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</td>';
			exit();
		}
		private function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				$this->_build();

				echo '<td>';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';
				echo '</td>';
				if(!empty($this->_array)){
					echo '<td>';
						echo '<pre>';
							echo 'Pre Node (_array)<br>';
							var_dump($this->_array);
						echo '</pre>';
					echo '</td>';
				}

				if(!empty($this->_a)){
					echo '<td>';
						echo '<pre>';
							echo 'Pre Node (_a)<br>';
							var_dump($this->_a);
						echo '</pre>';
					echo '</td>';
				}
			}
			else{
				echo '<td>';
					echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
					echo '<pre>';
					foreach($class_methods as $method_name){
						echo $method_name.'<br>';
					}
					echo '</pre>';
				echo '<td>';
			}
			exit;
		}

		public function _array_depth(array $array){
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
		public function _get_array($data){
			try{
				if($this->$data){
					return $this->$data;
				}
			}
			catch(exception $e){
				throw new SystemException('<b>Class ('.get_class($this).'):</b><br>The requested array, <b>'.$data.'</b>, couldn\'t be found.',0,0,__FILE__,__LINE__);
			}
		#	exit;
		}
		public function _get_index_data($data,$index=false,$debug=false){
			if($this->$data){
				$array	=	$this->$data;

				if($debug){
					foreach($array as $key=>$value){
						echo '<pre>';
							echo $key.' => '.$value.'<br>';
						echo '</pre>';

						if($index){
							if($key==$index){
								return $value;
							}
						}
					}
				}

				if($index){
					foreach($array as $key=>$value){
						if($key==$index){
							return $value;
						}
					}
				}

				return $array;
			}

			return 'Array doesn\'t exist';
		}
		# Private Methods
		private function _build($init=false){
			if($init){
				$this->_no_index();
				$this->_build();
			}
			$class_methods	=	get_class_methods($this);

			foreach($class_methods as $method_name){
			#	echo '<pre>';
			#		var_dump($this->no_index);
			#	echo '</pre>';
			#	exit;

				if(!in_array($method_name,$this->no_index)){
					try{
						$this->$method_name();
					#	echo $method_name.'<br>';
					}
					catch(exception $e){
						throw new SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
					}
				}
			}
		}
		private function _build_array($array){
			$method = '_'.$array;

			if(method_exists($this,$method)){
				try{
					#	echo $method.'<br>';
						return $this->$method();
				}
				catch(exception $e){
					throw new SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
				}
			}

			return 'Defined method not found';
		}
		private function _levels(){
			$this->levels		=	array(
				'./',
				'./../',
				'./../../',
				'./../../../',
				'./../../../../',
				'./../../../../../',
				'./../../../../../../',
				'./../../../../../../../',
				'./../../../../../../../../',
				'./../../../../../../../../../',
				'./../../../../../../../../../../'
			);
		}
		private function _no_index(){
			$this->no_index		=	array(
				# Universal
				'__construct',
				'_build',
				'_class_info',
				'_do_build_array',
				'_do_close',
				'_do_query',
				'_do_set_defaults',
				'_Mthds',
				'_Props',
				'_set_defaults',
				# Arrays
				'_no_index',
				'_array_depth',
				'_build_array',
				'_get_array',
				'_get_index_data',
				# Main Settings
				'_do_load_xml_settings',
				'_do_maint_chk',
				# Style
				'_uni_css_dir',
				'_uni_css',
				'_uni_images',
				'_uni_images_dir',
				# Dirs
				'_is_Writable_Path',
				# Paging
				'_page_stats',
				'_update_page_show',
				'_update_page_standalone',
				'_update_page_columns'
			);
		}
		private function _pp_index(){
			$this->pp_index		=	array(
				'_pp_donate',
				'_pp_debug',
				'_pp_receiver',
				'_pp_sandbox',
				'_pp_send_conf_email',
				'_pp_sandbox_uri',
				'_pp_standard_uri',
				'_pp_uri',
				'_pp_valid',
				'_pp_invalid'
			);
		}
		private function _style_index(){
			$this->style_index	=	array(
				# jQuery
				'_jquery_js',				# 0
				'_jquery_ui_js',			# 1
				'_jquery_ui_style_css',		# 2
				'_jquery_ui_theme_css',		# 3
				# Bootstrap
				'_bs_css',					# 4
				'_bs_js',					# 5
				# GA
				'_google_analytics_js',		# 6
				# MDB
				'_mdb_css',					# 7
				'_mdb_js',					# 8
				# TinyMCE
				'_tinymce_js',				# 9
				'_tinymce_init',			# 10
				# WoW
				'_wow_css',					# 11
				'_wow_js',					# 12
				# FontAwesome
				'_fa_css',					# 13
				'_fa_js',					# 14
				# FontIcons
				'_fi_css',					# 15
				# Misc
				'_preloader_css'			# 16
			);
		}
		private function _dirs_index(){
			$this->dirs_index	=	array(
				'_assets',
				'_content',
				'_content_ap',
				'_content_ap_account',
				'_content_ap_developer',
				'_content_ap_jts3servermod',
				'_content_ap_main',
				'_content_ap_paging',
				'_content_ap_player',
				'_content_ap_pmt_office'
			);
		}
		private function _filetypes(){
			$this->filetypes	=	array(
											// Archives
											'7z'    => 'fa-file-archive-o',
											'bz'    => 'fa-file-archive-o',
											'gz'    => 'fa-file-archive-o',
											'rar'   => 'fa-file-archive-o',
											'tar'   => 'fa-file-archive-o',
											'zip'   => 'fa-file-archive-o',
											// Audio
											'aac'   => 'fa-music',
											'flac'  => 'fa-music',
											'mid'   => 'fa-music',
											'midi'  => 'fa-music',
											'mp3'   => 'fa-music',
											'ogg'   => 'fa-music',
											'wma'   => 'fa-music',
											'wav'   => 'fa-music',
											// Code
											'c'     => 'fa-code',
											'class' => 'fa-code',
											'cpp'   => 'fa-code',
											'css'   => 'fa-code',
											'erb'   => 'fa-code',
											'htm'   => 'fa-code',
											'html'  => 'fa-code',
											'java'  => 'fa-code',
											'js'    => 'fa-code',
											'php'   => 'fa-code',
											'pl'    => 'fa-code',
											'py'    => 'fa-code',
											'rb'    => 'fa-code',
											'xhtml' => 'fa-code',
											'xml'   => 'fa-code',
											// Databases
											'accdb' => 'fa-hdd-o',
											'db'    => 'fa-hdd-o',
											'dbf'   => 'fa-hdd-o',
											'mdb'   => 'fa-hdd-o',
											'pdb'   => 'fa-hdd-o',
											'sql'   => 'fa-hdd-o',
											// Documents
											'csv'   => 'fa-file-text',
											'doc'   => 'fa-file-text',
											'docx'  => 'fa-file-text',
											'odt'   => 'fa-file-text',
											'pdf'   => 'fa-file-text',
											'xls'   => 'fa-file-text',
											'xlsx'  => 'fa-file-text',
											// Executables
											'app'   => 'fa-list-alt',
											'bat'   => 'fa-list-alt',
											'com'   => 'fa-list-alt',
											'exe'   => 'fa-list-alt',
											'jar'   => 'fa-list-alt',
											'msi'   => 'fa-list-alt',
											'vb'    => 'fa-list-alt',
											// Fonts
											'eot'   => 'fa-font',
											'otf'   => 'fa-font',
											'ttf'   => 'fa-font',
											'woff'  => 'fa-font',
											// Game Files
											'gam'   => 'fa-gamepad',
											'nes'   => 'fa-gamepad',
											'rom'   => 'fa-gamepad',
											'sav'   => 'fa-floppy-o',
											// Images
											'bmp'   => 'fa-picture-o',
											'gif'   => 'fa-picture-o',
											'jpg'   => 'fa-picture-o',
											'jpeg'  => 'fa-picture-o',
											'png'   => 'fa-picture-o',
											'psd'   => 'fa-picture-o',
											'tga'   => 'fa-picture-o',
											'tif'   => 'fa-picture-o',
											// Package Files
											'box'   => 'fa-archive',
											'deb'   => 'fa-archive',
											'rpm'   => 'fa-archive',
											// Scripts
											'bat'   => 'fa-terminal',
											'cmd'   => 'fa-terminal',
											'sh'    => 'fa-terminal',
											// Text
											'cfg'   => 'fa-file-text',
											'ini'   => 'fa-file-text',
											'log'   => 'fa-file-text',
											'md'    => 'fa-file-text',
											'rtf'   => 'fa-file-text',
											'txt'   => 'fa-file-text',
											// Vector Images
											'ai'    => 'fa-picture-o',
											'drw'   => 'fa-picture-o',
											'eps'   => 'fa-picture-o',
											'ps'    => 'fa-picture-o',
											'svg'   => 'fa-picture-o',
											// Video
											'avi'   => 'fa-youtube-play',
											'flv'   => 'fa-youtube-play',
											'mkv'   => 'fa-youtube-play',
											'mov'   => 'fa-youtube-play',
											'mp4'   => 'fa-youtube-play',
											'mpg'   => 'fa-youtube-play',
											'ogv'   => 'fa-youtube-play',
											'webm'  => 'fa-youtube-play',
											'wmv'   => 'fa-youtube-play',
											'swf'   => 'fa-youtube-play',
											// Other
											'bak'   => 'fa-floppy',
											'msg'   => 'fa-envelope',
											// Blank
											'blank' => 'fa-file'
			);
		}
		private function _no_msg(){
			$this->no_msg 		= 	array(
											'REGISTRATION_COMPLETE',
											'ERROR'
			);
		}
		private function _bg_color(){
			$this->bg_color		=	array(
											'NAV_BG_COLOR',
											'CARD_BG_COLOR',
											'TITLE_BG_COLOR',
											'BREAD_BG_COLOR',
											'PANE_BG_COLOR',
											'PANE_BG_TRANS'
			);
		}
		private function _dir_lister_cfg(){
			$this->dir_lister_cfg	=	array(
				// Basic settings
				'home_label'			=>	'Home',
				'hide_dot_files'		=>	true,
				'list_folders_first'	=>	true,
				'list_sort_order'		=>	'natcasesort',
				'theme_name'			=>	'bootstrap',
				'date_format'			=>	'm-d-Y H:i:s',
				// Hidden files
				'hidden_files'	=>	array(
					'.ht*',
					'*/.ht*',
					'assets',
					'dBase',
					'cms',
					'resources',
					'resources/*',
					'Shaiya',
					'analytics.inc',
					'BS_Core',
					'*/assets',
					'*/code',
					'*/images',
					'*.php',
					'*.txt'
				),
				// If set to 'true' an directory with an index file (as defined below) will
				// become a direct link to the index page instead of a browsable directory
				'links_dirs_with_index' => true,
				// Make linked directories open in a new (_blank) tab
				'external_links_new_window' => true,
				// Files that, if present in a directory, make the directory
				// a direct link rather than a browse link.
				'index_files' => array(
					'index.htm',
					'index.html',
					'index.php'
				),
				// File hashing threshold
				'hash_size_limit' => 268435456, // 256 MB
				// Custom sort order
				'reverse_sort' => array(
					// 'path/to/folder'
				),
				// Allow to download directories as zip files
				'zip_dirs' => false,
				// Stream zip file content directly to the client,
				// without any temporary file
				'zip_stream' => true,
				'zip_compression_level' => 0,
				// Disable zip downloads for particular directories
				'zip_disable' => array(
					// 'path/to/folder'
				),
			);
		}
		private function _enabled(){
			$this->enabled=array(
				'DEBUG',
				'FOOTER_BLOCK_A',
				'FOOTER_BLOCK_B',
				'FOOTER_BLOCK_C',
				'HTTPS_SSL',
				'LOGGING',
				'MAINTENANCE',
				'NAV_SERVER_STATUS',
				'SHOW_SIDE_NAV',
				'USE_PLUGINS'
			);
		}
		private function _select(){
			$this->select=array(
				# MAIN
				'SETUP',
				'SITE_TYPE',
				'HTTPS_SSL',
				'LOGGING',
				'DEBUG',
				'MAINTENANCE',
				'MAILSYS_ENABLE',
				'PAYPAL_DONATE',
				'PAYPAL_DEBUG',
				'PAYPAL_SANDBOX',
				'PAYPAL_CONF_EMAIL',
				'PAYPAL_LOG_TO_FILE',
				'PAYPAL_LOG_TO_DB'
			);
		}
		private function _pane(){
			$this->pane=array(
				'PANE_BG_COLOR',
				'PANE_BG_TRANS'
			);
		}
		private function _sidebar(){
			$this->sidebar=array(
				'SIDEBAR_POS'
			);
		}
		private function _textual(){
			$this->textual 		= 	array(
				# MAIN
				'AUTHOR',
				'SITE_TITLE',
				'ACP_SITE_TITLE',
				'WEBMASTER',
				'PAGE_PREFIX',
				'SITE_DOMAIN',
				'PHONE_PRIMARY',
				'PHONE_SECONDARY',
				'ADDRESS_1',
				'ADDRESS_2',
				'ADDRESS_3',
				'EMAIL_SALES',
				'EMAIL_SUPPORT',
				'PHPMAILER_ACCOUNT_ID',
				'PHPMMAILER_ACCOUNT_PW',
				'PHPMAILER_REPLY_NAME',
				'PHPMAILER_REPLY_EMAIL',
				'PHPMAILER_HOST',
				'PAYPAL_RECEIVER',
				'PAYPAL_SANDBOX_URI',
				'PAYPAL_STANDARD_URI',
				'PAYPAL_EMAIL_1',
				'PAYPAL_EMAIL_2',
				'PAYPAL_EMAIL_3',
				'PAYPAL_LOG_DIR',
				'RECAPTCHA_SITE_KEY',
				'RECAPTCHA_SEC_KEY',
				'VERSION',
				'VERSION_ID',
				'UPDATER_KEY',
				# THEME
				'CMS_BG',
				'ACP_BG',
				'LOGO_IMG',
				'FAVICON_IMAGE',
				'FOOTER',
				'ACP_THEME_NAME',
				# STYLE
				'JQUERY_VERSION'
			);
		}
		private function _theme(){
			$this->theme 	= 	array(
				'CMS_THEME_NAME'
			);
		}
		private function _btn(){
			$this->btn 		= 	array(
				# Textual Modal
				'PAGE_PREFIX'			=>	'textual_modal',
				'SITE_DOMAIN'			=>	'textual_modal',
				'SITE_DOMAIN'			=>	'textual_modal',
				'SITE_TITLE'			=>	'textual_modal',
				'ACP_SITE_TITLE'		=>	'textual_modal',
				'AUTHOR'				=>	'textual_modal',
				'WEBMASTER'				=>	'textual_modal',
				'JQUERY_VERSION'		=>	'textual_modal',
				'JQUERYUI_VERSION'		=>	'textual_modal',
				'JQUERYUI_THEME_NAME'	=>	'textual_modal',
				'BS_VERSION'			=>	'textual_modal',
				'BS_CSS'				=>	'textual_modal',
				'BS_JS'					=>	'textual_modal',
				'GA_JS'					=>	'textual_modal',
				'MDB_VERSION'			=>	'textual_modal',
				'MDB_CSS'				=>	'textual_modal',
				'MDB_JS'				=>	'textual_modal',
				'POPPERJS_VERSION'		=>	'textual_modal',
				'POPPERJS_JS'			=>	'textual_modal',
				'TINYMCE_VERSION'		=>	'textual_modal',
				'TINYMCE_JS'			=>	'textual_modal',
				'TINYMCE_INIT'			=>	'textual_modal',
				'WOW_VERSION'			=>	'textual_modal',
				'WOW_JS'				=>	'textual_modal',
				'WOW_CSS'				=>	'textual_modal',
				'CMS_STYLE_NAME'		=>	'textual_modal',
				'CMS_THEME_CSS'			=>	'textual_modal',
				'ACP_STYLE_NAME'		=>	'textual_modal',
				'ACP_THEME_CSS'			=>	'textual_modal',
				'CMS_LANDING_CSS'		=>	'textual_modal',
				'CMS_MASTER_CSS'		=>	'textual_modal',
				'ACP_MASTER_CSS'		=>	'textual_modal',
				'CMS_CUSTOM_CSS'		=>	'textual_modal',
				'ACP_CUSTOM_CSS'		=>	'textual_modal',
				'FONTAWESOME_VERSION'	=>	'textual_modal',
				'FONTAWESOME_CSS'		=>	'textual_modal',
				'FONTAWESOME_JS'		=>	'textual_modal',
				'FONTICONS_CSS'			=>	'textual_modal',
				'JQUERYUI_STYLE_CSS'	=>	'textual_modal',
				'JQUERYUI_THEME_CSS'	=>	'textual_modal',
				'LOADER_CSS'			=>	'textual_modal',
				# Pages Modal
				'ACCT_BAN'				=>	'pages_modal',
				'ACCT_BAN_SEARCH'		=>	'pages_modal',
				'ACCT_SEARCH'			=>	'pages_modal',
				'ACCT_UNBAN'			=>	'pages_modal',
				'ACP_ISSUE_TRACKER'		=>	'pages_modal',
				'ACP_VALIDATE'			=>	'pages_modal',
				'AP_TOOLS'				=>	'pages_modal',
				'AUTH'					=>	'pages_modal',
				'BLOG_EDITOR'			=>	'pages_modal',
				'BOSS_RECORD'			=>	'pages_modal',
				'COMPLETE_DONATION'		=>	'pages_modal',
				'CREATE_NEW_PAGE'		=>	'pages_modal',
				'CREATE_NEW_STORE'		=>	'pages_modal',
				'CRYPTO'				=>	'pages_modal',
				'DASHBOARD'				=>	'pages_modal',
				'DONATE'				=>	'pages_modal',
				'DOWNLOADS'				=>	'pages_modal',
				'ERROR'					=>	'pages_modal',
				'FORTE_COMPLETED'		=>	'pages_modal',
				'FORTE_POST_LEAD'		=>	'pages_modal',
				'FORTE_REQUESTS'		=>	'pages_modal',
				'FORTE_VALIDATE'		=>	'pages_modal',
				'HOME'					=>	'pages_modal',
				'HP_EDITOR'				=>	'pages_modal',
				'INBOX'					=>	'pages_modal',
				'INDEX'					=>	'pages_modal',
				'INT_VAL'				=>	'pages_modal',
				'ISSUE_TRKR'			=>	'pages_modal',
				'JOURNAL'				=>	'pages_modal',
				'LANDING'				=>	'pages_modal',
				'LOGIN'					=>	'pages_modal',
				'LOGOUT'				=>	'pages_modal',
				'LOGOUT'				=>	'pages_modal',
				'MAIL_TEST'				=>	'pages_modal',
				'MAINT'					=>	'pages_modal',
				'MEMBERLIST'			=>	'pages_modal',
				'MESSAGE_BOT_CREATOR'	=>	'pages_modal',
				'MESSAGES'				=>	'pages_modal',
				'NEWS'					=>	'pages_modal',
				'NEWS'					=>	'pages_modal',
				'NEWS_EDITOR'			=>	'pages_modal',
				'PATCH_NOTES'			=>	'pages_modal',
				'PATCH_NOTES_EDITOR'	=>	'pages_modal',
				'PAYMENTS_CENTER'		=>	'pages_modal',
				'PLR_BUFF_VIEW'			=>	'pages_modal',
				'PLR_FC'				=>	'pages_modal',
				'PLR_GUILD_SEARCH'		=>	'pages_modal',
				'PLR_ITEM_VIEW'			=>	'pages_modal',
				'PLR_RES'				=>	'pages_modal',
				'PLR_SEARCH'			=>	'pages_modal',
				'PLR_STATS_EDITOR'		=>	'pages_modal',
				'PROCESS_DONATION'		=>	'pages_modal',
				'PVP_RANKING'			=>	'pages_modal',
				'PW_CHANGE'				=>	'pages_modal',
				'PW_RESET'				=>	'pages_modal',
				'RECAPTCHA_V2'			=>	'pages_modal',
				'RECOVERY'				=>	'pages_modal',
				'REGISTER'				=>	'pages_modal',
				'REGISTRATION_COMPLETE'	=>	'pages_modal',
				'RESEND_REGISTRATION'	=>	'pages_modal',
				'RESOURCE_EDITOR'		=>	'pages_modal',
				'RESOURCES'				=>	'pages_modal',
				'SCRIPTS'				=>	'pages_modal',
				'SESSION_CLOSE'			=>	'pages_modal',
				'SESSION_END'			=>	'pages_modal',
				'SHOPS'					=>	'pages_modal',
				'STF_GLOBAL_CHAT'		=>	'pages_modal',
				'STF_GM_CMDS_LOG'		=>	'pages_modal',
				'STF_GUILD_LDR_CHG'		=>	'pages_modal',
				'STF_ITEM_LIST'			=>	'pages_modal',
				'STF_JAIL'				=>	'pages_modal',
				'STF_ONLINE_PLRS'		=>	'pages_modal',
				'STF_PNL_LOG'			=>	'pages_modal',
				'STF_STAFF_LIST'		=>	'pages_modal',
				'STNG_COLORS'			=>	'pages_modal',
				'STNG_CONTACT'			=>	'pages_modal',
				'STNG_CORE'				=>	'pages_modal',
				'STNG_MAIL'				=>	'pages_modal',
				'STNG_PAGES'			=>	'pages_modal',
				'STNG_PAYPAL'			=>	'pages_modal',
				'STNG_PLUGINS'			=>	'pages_modal',
				'STNG_RECAPTCHA'		=>	'pages_modal',
				'STNG_STYLE'			=>	'pages_modal',
				'STNG_THEME'			=>	'pages_modal',
				'STNG_WARNING'			=>	'pages_modal',
				'STORYTIME'				=>	'pages_modal',
				'TOOLS'					=>	'pages_modal',
				'TOS'					=>	'pages_modal',
				'UPDATE_EMAIL'			=>	'pages_modal',
				'USER_PROFILE'			=>	'pages_modal',
				'VALIDATE'				=>	'pages_modal',
				'VERIFY'				=>	'pages_modal',
				'WELCOME'				=>	'pages_modal',
				'WELCOME_BOT_CREATOR'	=>	'pages_modal',
				# Select Modal
				'SETUP'					=>	'select_modal',
				'SITE_TYPE'				=>	'select_modal',
				'LOGGING'				=>	'select_modal',
				'DEBUG'					=>	'select_modal',
				'HTTPS_SSL'				=>	'select_modal',
				'MAINTENANCE'			=>	'select_modal',
				# Theme Modal
				'ACP_BG'				=>	'textual_modal',
				'ACP_STYLE_NAME'		=>	'select_modal',
				'ACP_THEME_NAME'		=>	'select_modal',
				'BREAD_BG_COLOR'		=>	'select_modal',
				'CARD_BG_COLOR'			=>	'select_modal',
				'CMS_BG'				=>	'textual_modal',
				'CMS_STYLE_NAME'		=>	'select_modal',
				'CMS_THEME_NAME'		=>	'select_modal',
				'COLUMNS'				=>	'textual_modal',
				'FAVICON_IMAGE'			=>	'textual_modal',
				'FOOTER'				=>	'textual_modal',
				'FOOTER_BLOCK_A'		=>	'select_modal',
				'FOOTER_BLOCK_B'		=>	'select_modal',
				'FOOTER_BLOCK_C'		=>	'select_modal',
				'LOGO_IMG'				=>	'textual_modal',
				'MODULES'				=>	'textual_modal',
				'NAV_BG_COLOR'			=>	'select_modal',
				'NAV_SERVER_STATUS'		=>	'textual_modal',
				'PANE_BG_COLOR'			=>	'select_modal',
				'PANE_BG_TRANS'			=>	'select_modal',
				'SIDEBAR_POS'			=>	'textual_modal',
				'TITLE_BG_COLOR'		=>	'select_modal'
			);
		}
		private function _standalone(){
			$this->standalone 	= 	array(
				'USER_PROFILE',
				'REGISTER',
				'VALIDATE',
				'ISSUE_TRKR',
				'TOOLS',
				'LANDING',
				'MEMBERLIST',
				'RESOURCES',
				'JOURNAL',
				'ERROR'
			);
		}
		
	}
?>