IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_MODULES]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[SETTINGS_MODULES]
GO

CREATE TABLE [Cerberus].[dbo].[SETTINGS_MODULES](
	[RowID]				[int]			IDENTITY(1,1)	NOT NULL,
	[MODULE_NAME]		[varchar](50)					NOT NULL,
	[MODULE_MASTERFILE] [varchar](50)					NOT NULL,
	[MODULE_AJAX]	 	[varchar](max)					NULL,
	[MODULE_JS]		 	[varchar](max)					NULL,
	[MODULE_PHP]	 	[varchar](max)					NULL,
	[MODULE_OPT_0]	 	[varchar](max)					NULL,
	[MODULE_OPT_1]	 	[varchar](max)					NULL,
	[MODULE_OPT_2]	 	[varchar](max)					NULL,
	[MODULE_OPT_3]	 	[varchar](max)					NULL,
	[MODULE_OPT_4]	 	[varchar](max)					NULL,
	[MODULE_OPT_5]	 	[varchar](max)					NULL,
	[MODULE_OPT_6]	 	[varchar](max)					NULL,
	[MODULE_OPT_7]	 	[varchar](max)					NULL,
	[MODULE_OPT_8]	 	[varchar](max)					NULL,
	[MODULE_OPT_9]	 	[varchar](max)					NULL,
	[MODULE_VERSION]	[varchar](10)					NOT NULL,
	[MODULE_DATE]		[varchar](10)					NULL,
	[MODULE_ORDER]		[varchar](2)					NOT NULL	DEFAULT (0),
	[MODULE_ENABLED]	[bit]							NULL		DEFAULT (0),
	[EDIT]				[bit]							NULL		DEFAULT (0),
)ON [PRIMARY]
GO