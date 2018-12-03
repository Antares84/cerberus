IF OBJECT_ID('[Cerberus].[dbo].[LOG_SESSION]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[LOG_SESSION]
GO

CREATE TABLE [Cerberus].[dbo].[LOG_SESSION](
	[RowID]			[int]			IDENTITY(1,1)	NOT NULL,
	[UserUID]		[int]							NOT NULL,
	[UserID]		[varchar](max)					NOT NULL,
	[AcctStatus]	[int]							NOT NULL,
	[Action]		[varchar](max)					NOT NULL,
	[OS]			[varchar](max)					NOT NULL,
	[Browser]		[varchar](max)					NOT NULL,
	[BrowserVer]	[varchar](max)					NOT NULL,
	[UserIP]		[varchar](15)					NOT NULL,
	[SessionID]		[varchar](max)					NOT NULL,
	[LoginDate]		[datetime]						NOT NULL DEFAULT getdate(),
	[LogoutDate]	[datetime]						NULL
)ON [PRIMARY]
GO