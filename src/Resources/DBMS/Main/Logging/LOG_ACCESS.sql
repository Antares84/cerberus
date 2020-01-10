IF OBJECT_ID('[Cerberus].[dbo].[LOG_ACCESS]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[LOG_ACCESS]
GO

CREATE TABLE [Cerberus].[dbo].[LOG_ACCESS](
	[RowID]			[int]			IDENTITY(1,1)	NOT NULL,
	[UserID]		[varchar](50)					NOT NULL,
	[UserIP]		[varchar](15)					NOT NULL,
	[Action]		[varchar](max)					NOT NULL,
	[ActionTime]	[datetime]						NOT NULL	DEFAULT (getdate())
)ON [PRIMARY]
GO