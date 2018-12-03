IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_STYLE]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[SETTINGS_STYLE]
GO

CREATE TABLE [Cerberus].[dbo].[SETTINGS_STYLE](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[DESC]		[varchar](50)					NOT NULL,
	[STYLE]		[varchar](50)					NOT NULL,
	[TYPE]		[varchar](3)					NOT NULL,
	[VALUE]		[varchar](max)					NOT NULL,
	[EDIT]		[bit]							NOT NULL	DEFAULT(0)
)ON [PRIMARY]
GO

-- JQUERY CORE
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Directory',								N'JQUERY_HOME_DIR',				N'DIR',		N'assets/jquery/',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Version',									N'JQUERY_VERSION',				N'VER',		N'v1.12.3',							0);
-- JQUERYUI CORE
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Directory',								N'JQUERYUI_HOME_DIR',			N'DIR',		N'UI/',								0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Version',								N'JQUERYUI_VERSION',			N'VER',		N'v1.12.1',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Theme/Directory Name',					N'JQUERYUI_THEME_NAME',			N'TXT',		N'Dot Luv',							0);
-- JQUERY EXTRAS
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Addons Directory',							N'JQUERY_ADDONS_DIR',			N'DIR',		N'Addons/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Custom Scripts Directory',					N'JQUERY_CUSTOM_DIR',			N'DIR',		N'Custom/',							0);
-- JQUERY ADDONS : BOOTSTRAP
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Bootstrap Directory',						N'JQUERY_BS_DIR',				N'DIR',		N'Bootstrap/',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Bootstrap Version',						N'JQUERY_BS_VERSION',			N'VER',		N'v4.0.0',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Bootstrap Stylesheet',						N'JQUERY_BS_CSS',				N'SS',		N'bootstrap.css',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Bootstrap JScript',						N'JQUERY_BS_JS',				N'JS',		N'bootstrap.min.js',				0);
-- JQUERY ADDONS : BROWSERPLUGIN
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Browser Plugin Directory',					N'JQUERY_BP_DIR',				N'DIR',		N'BrowserPlugin/',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Browser Plugin Extension Directory',		N'JQUERY_BP_EXT_DIR',			N'DIR',		N'extensions/',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Browser Plugin JScript',					N'JQUERY_BP_CORE_JS',			N'JS',		N'jquery.browser.js',				0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Browser Plugin JScript (Minified)',		N'JQUERY_BP_CORE_MIN_JS',		N'JS',		N'jquery.browser.min.js',			0);
-- JQUERY ADDONS : BROWSERPLUGIN || PHONE NUMBER FORMATTER
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
	VALUES (N'Jquery Browser Plugin Phone Formatter JScript',	N'JQUERY_BP_EXT_PHONE',			N'JS',		N'phone_number_formatter.js',		0);
-- JQUERY ADDONS : EASING
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Easing Directory',							N'JQUERY_EASING_DIR',			N'DIR',		N'Easing/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Easing Version',							N'JQUERY_EASING_VERSION',		N'VER',		N'v1.3',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Easing JScript',							N'JQUERY_EASING_JS',			N'JS',		N'jquery.easing.1.3.js',			0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Easing Compat JScript',					N'JQUERY_EASING_COMPAT_JS',		N'JS',		N'jquery.easing.compatibility.js',	0);
-- JQUERY ADDONS : GOOGLE ANALYTICS
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Google Directory',							N'JQUERY_GA_DIR',				N'DIR',		N'Google/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Google Analytics JScript',					N'JQUERY_GA_JS',				N'JS',		N'analytics.js',					0);
-- JQUERY ADDONS : MASKPLUGIN
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Mask Plugin Directory',					N'JQUERY_MP_DIR',				N'DIR',		N'MaskPlugin/',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Mask Plugin JScript',						N'JQUERY_MP_CORE_JS',			N'JS',		N'jquery.mask.js',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Mask Plugin JScript (Minified)',			N'JQUERY_MP_CORE_MIN_JS',		N'JS',		N'jquery.mask.min.js',				0);
-- JQUERY ADDONS : MODERNIZR
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Modernizr Directory',						N'JQUERY_MODERNIZR_DIR',		N'DIR',		N'modernizr/',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Modernizr Version',						N'JQUERY_MODERNIZR_VERSION',	N'VER',		N'v2.8.3',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Modernizr JScript',						N'JQUERY_MODERNIZR_JS',			N'JS',		N'modernizr.custom.js',				0);
-- JQUERY ADDONS : TINYMCE
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery TinyMCE Directory',						N'JQUERY_TINYMCE_DIR',			N'DIR',		N'TinyMCE/',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery TinyMCE Version',							N'JQUERY_TINYMCE_VERSION',		N'VER',		N'v4.9.0',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery TinyMCE JScript',							N'JQUERY_TINYMCE_JS',			N'JS',		N'tinymce.min.js',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery TinyMCE Init',								N'JQUERY_TINYMCE_INIT',			N'JS',		N'init.tinymce.js',					0);
-- JQUERY ADDONS : TETHER
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Tether Directory',							N'JQUERY_TETHER_DIR',			N'DIR',		N'Tether/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Tether Version',							N'JQUERY_TETHER_VERSION',		N'DIR',		N'v1.3.3',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Tether JScript',							N'JQUERY_TETHER_JS',			N'DIR',		N'tether.js',						0);
-- JQUERY ADDONS : WOW
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Wow Directory',							N'JQUERY_WOW_DIR',				N'DIR',		N'Wow/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Wow Version',								N'JQUERY_WOW_VERSION',			N'VER',		N'v1.1.2',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Wow JScript',								N'JQUERY_WOW_JS',				N'DIR',		N'wow.min.js',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Wow Stylesheet',							N'JQUERY_WOW_CSS',				N'TXT',		N'animate.css',						0);
-- STYLE : STYLES
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Styles Directory',								N'STYLES_DIR',					N'DIR',		N'Assets/Styles/',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Themes Directory',								N'THEMES_DIR',					N'DIR',		N'Assets/Themes/',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Core CSS Directory',								N'CORE_CSS_DIR',				N'DIR',		N'Core/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'CMS Style Name',									N'CMS_STYLE_NAME',				N'TXT',		N'Standard',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'CMS Theme Stylesheet',							N'CMS_THEME_CSS',				N'TXT',		N'theme.css',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'ACP Style Name',									N'ACP_STYLE_NAME',				N'TXT',		N'Admin',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'ACP Theme Stylesheet',							N'ACP_THEME_CSS',				N'TXT',		N'theme.css',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Landing Stylesheet',								N'CMS_LANDING_CSS',				N'TXT',		N'landing.css',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Style FileStore Directory',						N'FILESTORE_DIR',				N'DIR',		N'Filestore/',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Style Stylesheet Directory',						N'CSS_DIR',						N'DIR',		N'CSS/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Events Images Directory',							N'EVENTS_DIR',					N'DIR',		N'Events/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Fonts Directory',									N'FONTS_DIR',					N'DIR',		N'Fonts/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Main Images Directory',							N'IMAGES_DIR',					N'DIR',		N'Images/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Media Images Directory',							N'MEDIA_DIR',					N'DIR',		N'Media/',							0);
-- STYLE : CSS
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'CMS Master Stylesheet',							N'CMS_MASTER_CSS',				N'SS',		N'master.css',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'ACP Master Stylesheet',							N'ACP_MASTER_CSS',				N'SS',		N'master.css',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'CMS Custom Stylesheet',							N'CMS_CUSTOM_CSS',				N'SS',		N'custom.css',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'ACP Custom Stylesheet',							N'ACP_CUSTOM_CSS',				N'SS',		N'custom.css',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'FontAwesome Directory',							N'FONTAWESOME_DIR',				N'DIR',		N'font-awesome/',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'FontAwesome Stylesheet',							N'FONTAWESOME_CSS',				N'SS',		N'font-awesome.css',				0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'FontIcons Directory',								N'FONTICONS_DIR',				N'DIR',		N'fonticons/',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'FontIcons Stylesheet',							N'FONTICONS_CSS',				N'SS',		N'fonts.css',						0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Main Stylesheet',						N'JQUERYUI_STYLE_CSS',			N'SS',		N'jquery-ui-style.css',				0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Theme Stylesheet',						N'JQUERYUI_THEME_CSS',			N'SS',		N'jquery-ui-theme.css',				0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Custom Stylesheet Directory',						N'CUSTOM_DIR',					N'DIR',		N'Custom/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Icons Directory',									N'ICONS_DIR',					N'DIR',		N'Icons/',							0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'LoadLab Directory',								N'LOADLAB_DIR',					N'DIR',		N'LoadLab/',					0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Preloader Stylesheet',							N'LOADER_CSS',					N'SS',		N'Preloader.css',					0);
GO