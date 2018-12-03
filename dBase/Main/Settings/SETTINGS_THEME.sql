IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_THEME]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[SETTINGS_THEME]
GO

CREATE TABLE [Cerberus].[dbo].[SETTINGS_THEME](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[SECTION]	[varchar](20)					NOT NULL,
	[DESC]		[varchar](100)					NOT NULL,
	[SETTING]	[varchar](50)					NOT NULL,
	[VALUE]		[varchar](max)					NULL,
	[SHOW]		[bit]							NOT NULL	DEFAULT(0)
)ON [PRIMARY]
GO

-- BACKGROUNDS
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'BG',N'CMS Background',N'CMS_BG',N'http://cdn.ndf-innovations.net/images/wallpapers/wall_1.png',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'BG',N'ACP Background',N'ACP_BG',N'abstract-background-002.jpg',1);
-- BACKGROUND COLORS
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'BG_COLOR',N'Nav Background Color',N'NAV_BG_COLOR','bg-black',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'BG_COLOR',N'Card Background Color',N'CARD_BG_COLOR',NULL,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'BG_COLOR',N'Titlebar Background Color',N'TITLE_BG_COLOR','bg-dark',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'BG_COLOR',N'Breadcrumb Background Color',N'BREAD_BG_COLOR','bg-dark',1);

-- PANE SETTINGS
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'PANE',N'Panes Background Color',N'PANE_BG_COLOR',NULL,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'PANE',N'Panes Background Transparency',N'PANE_BG_TRANS',NULL,1);

-- THEME NAMES
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'THEME',N'CMS Style Name',N'CMS_STYLE_NAME',N'Standard',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'THEME',N'CMS Theme Name',N'CMS_THEME_NAME',N'Surface',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'THEME',N'ACP Style Name',N'ACP_STYLE_NAME',N'Admin',1);

-- NAV
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'NAV',N'Enable/Disable Left Navigation',N'SHOW_SIDE_NAV',N'0',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'NAV',N'Enable/Disable Shaiya Server Status',N'NAV_SERVER_STATUS',N'0',1);

-- FOOTER
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'FOOTER',N'Footer Text',N'FOOTER',N'&copy;2010-2018 <span>Nexus Development Foundation</span>. All Rights Reserved.',1);

-- OTHER
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'MISC',N'Enable/Disable Site Plugins',N'USE_PLUGINS',N'1',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'MISC',N'Set Columns',N'COLUMNS',N'2',0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'MISC',N'Set Sidebar Position',N'SIDEBAR_POS',N'2',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'MISC',N'Header/Logo Image',N'LOGO_IMG','logo_1.png',1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_THEME]
VALUES (N'MISC',N'FavIcon',N'FAVICON_IMAGE',N'favicon.ico',1);

GO