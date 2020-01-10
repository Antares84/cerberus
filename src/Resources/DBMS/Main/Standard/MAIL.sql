IF OBJECT_ID('[Cerberus].[dbo].[MAIL]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[MAIL]
GO

CREATE TABLE [Cerberus].[dbo].[MAIL](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[Subject]	[varchar](max)					NOT NULL,
	[Body]		[varchar](max)					NOT NULL,
	[Status]	[tinyint]						NOT NULL	DEFAULT(0),
	[Date]		[datetime]						NOT NULL	DEFAULT (getdate())
)ON [PRIMARY]
GO