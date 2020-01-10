IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_STYLE]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[SETTINGS_STYLE]
GO

CREATE TABLE [Cerberus].[dbo].[SETTINGS_STYLE](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[DESC]		[varchar](50)					NOT NULL,
	[STYLE]		[varchar](50)					NOT NULL,
	[TYPE]		[varchar](3)					NOT NULL,
	[VALUE]		[varchar](max)					NOT NULL,
	[MODAL]		[varchar](15)					NULL,
	[EDIT]		[bit]							NOT NULL	DEFAULT(0),
	[SHOW]		[bit]							NOT NULL	DEFAULT(0)
)ON [PRIMARY]
GO

-- JQUERY CORE
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Version',N'JQUERY_VERSION',N'VER',N'v1.12.3',NULL,0,1);
-- JQUERYUI CORE
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Version',N'JQUERYUI_VERSION',N'VER',N'v1.12.1',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Theme/Directory Name',N'JQUERYUI_THEME_NAME',N'TXT',N'Dot Luv',NULL,0,1);
-- JQUERY ADDONS : BOOTSTRAP
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Bootstrap Version',N'BS_VERSION',N'VER',N'v4.3.1',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Bootstrap Stylesheet',N'BS_CSS',N'SS',N'bootstrap.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Bootstrap JScript',N'BS_JS',N'JS',N'bootstrap.min.js',NULL,0,1);
-- JQUERY ADDONS : GOOGLE ANALYTICS
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery Google Analytics JScript',N'GA_JS',N'JS',N'analytics.js',NULL,0,1);
-- JQUERY ADDONS : MDB
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery MDB Version',N'MDB_VERSION',N'VER',N'v4.5.16',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery MDB CSS Stylesheet',N'MDB_CSS',N'DIR',N'mdb.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery MDB JScript (Minified)',N'MDB_JS',N'JS',N'mdb.min.js',NULL,0,1);
-- JQUERY ADDONS : POPPERJS
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery PopperJS Version',N'POPPERJS_VERSION',N'VER',N'v1.14.6',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery PopperJS JScript',N'POPPERJS_JS',N'JS',N'popper.min.js',NULL,0,1);
-- JQUERY ADDONS : TINYMCE
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery TinyMCE Version',N'TINYMCE_VERSION',N'VER',N'v4.9.0',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery TinyMCE JScript',N'TINYMCE_JS',N'JS',N'tinymce.min.js',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Jquery TinyMCE Init',N'TINYMCE_INIT',N'JS',N'init.tinymce.js',NULL,0,1);
-- JQUERY ADDONS : WOW
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Wow Version',N'WOW_VERSION',N'VER',N'v1.1.2',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Wow JScript',N'WOW_JS',N'DIR',N'wow.min.js',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'jQuery Wow Stylesheet',N'WOW_CSS',N'TXT',N'animate.css',NULL,0,1);
-- STYLE : STYLES - CMS
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'CMS Style Name',N'CMS_STYLE_NAME',N'TXT',N'Standard',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'CMS Master Stylesheet',N'CMS_MASTER_CSS',N'SS',N'master.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'CMS Theme Stylesheet',N'CMS_THEME_CSS',N'SS',N'theme.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'CMS Custom Stylesheet',N'CMS_CUSTOM_CSS',N'SS',N'custom.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Landing Stylesheet',N'CMS_LANDING_CSS',N'SS',N'landing.css',NULL,0,1);

-- STYLE : STYLES - AP
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'AP Style Name',N'AP_STYLE_NAME',N'TXT',N'AP',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'AP Master Stylesheet',N'AP_MASTER_CSS',N'SS',N'sb-admin.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'AP Theme Stylesheet',N'AP_THEME_CSS',N'SS',N'theme.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'AP Custom Stylesheet',N'AP_CUSTOM_CSS',N'SS',N'custom.css',NULL,0,1);

-- STYLE : FONTAWESOME
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'FontAwesome Version',N'FONTAWESOME_VERSION',N'VER',N'v5.6.3',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'FontAwesome Stylesheet',N'FONTAWESOME_CSS',N'SS',N'all.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'FontAwesome JScript',N'FONTAWESOME_JS',N'JS',N'all.js',NULL,0,1);

-- STYLE : FONTICONS
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'FontIcons Stylesheet',N'FONTICONS_CSS',N'SS',N'fonts.css',NULL,0,1);

-- STYLE : JQUERYUI
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Main Stylesheet',N'JQUERYUI_STYLE_CSS',N'SS',N'jquery-ui-style.css',NULL,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'JqueryUI Theme Stylesheet',N'JQUERYUI_THEME_CSS',N'SS',N'jquery-ui-theme.css',NULL,0,1);

-- STYLE : PRELOADER
INSERT INTO [Cerberus].[dbo].[SETTINGS_STYLE]
VALUES (N'Preloader Stylesheet',N'LOADER_CSS',N'SS',N'Preloader.css',NULL,0,1);
GO