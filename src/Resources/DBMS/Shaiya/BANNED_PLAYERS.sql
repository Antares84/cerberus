IF OBJECT_ID('[Cerberus].[dbo].[BANNED_PLAYERS]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[BANNED_PLAYERS]
GO

CREATE TABLE [Cerberus].[dbo].[BANNED_PLAYERS](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[CharName]	[varchar](25)					NOT NULL,
	[Reason]	[varchar](max)					NULL,
	[BannedBy]	[varchar](30)					NULL,
	[Duration]	[int]							NULL,
	[BanDate]	[datetime]						NOT NULL	DEFAULT (getdate()),
	[UserUID]	[int]							NULL
)ON [PRIMARY]
GO