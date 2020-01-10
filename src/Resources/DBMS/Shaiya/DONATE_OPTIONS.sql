IF OBJECT_ID('[Cerberus].[dbo].[DONATE_OPTIONS]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[DONATE_OPTIONS]
GO

CREATE TABLE [Cerberus].[dbo].[DONATE_OPTIONS](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[Reward]	[int]							NULL,
	[Price]		[varchar](50)					NULL,
	[Date]		[datetime]						NULL	DEFAULT (getdate())
)ON [PRIMARY]
GO