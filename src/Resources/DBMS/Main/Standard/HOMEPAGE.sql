IF OBJECT_ID('[Cerberus].[dbo].[HOMEPAGE]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[HOMEPAGE]
GO

CREATE TABLE [Cerberus].[dbo].[HOMEPAGE](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[Title]		[varchar](max)					NOT NULL,
	[Detail]	[varchar](max)					NOT NULL,
	[Date]		[datetime]						NOT NULL	DEFAULT (getdate())
)ON [PRIMARY]
GO