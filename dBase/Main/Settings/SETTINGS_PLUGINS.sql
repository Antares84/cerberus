IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_PLUGINS]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[SETTINGS_PLUGINS]
GO

CREATE TABLE [Cerberus].[dbo].[SETTINGS_PLUGINS](
	[RowID]				[int]			IDENTITY(1,1)	NOT NULL,
	[PLUGIN_NAME]		[varchar](50)					NOT NULL,
	[PLUGIN_MASTERFILE] [varchar](50)					NOT NULL,
	[PLUGIN_AJAX]	 	[varchar](max)					NULL,
	[PLUGIN_JS]		 	[varchar](max)					NULL,
	[PLUGIN_PHP]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_0]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_1]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_2]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_3]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_4]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_5]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_6]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_7]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_8]	 	[varchar](max)					NULL,
	[PLUGIN_OPT_9]	 	[varchar](max)					NULL,
	[PLUGIN_VERSION]	[varchar](10)					NOT NULL,
	[PLUGIN_DATE]		[varchar](10)					NULL,
	[PLUGIN_ORDER]		[varchar](2)					NOT NULL	DEFAULT (0),
	[PLUGIN_ENABLED]	[bit]							NULL		DEFAULT (0),
	[EDIT]				[bit]							NULL		DEFAULT (0),
)ON [PRIMARY]
GO