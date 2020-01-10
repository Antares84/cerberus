IF OBJECT_ID('[Cerberus].[dbo].[LOG_SESSION]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[LOG_SESSION]

CREATE TABLE [Cerberus].[dbo].[LOG_SESSION](
	[RowID]			[int]			IDENTITY(1,1)	NOT NULL,
	[LogType]		varchar(7)						NOT NULL,
	[UserUID]		[int]								NULL,
	[UserID]		[varchar](max)						NULL,
	[AcctStatus]	[int]								NULL,
	[Action]		[varchar](max)						NULL,
	[OS]			[varchar](max)						NULL,
	[Browser]		[varchar](max)						NULL,
	[UserAgent]		[varchar](max)						NULL,
	[UserIP]		[varchar](15)						NULL,
	[SID]			varchar(50)						NOT NULL,
	[SessionData]	[text]								NULL,
	[RequestURI]	varchar(50)							NULL,
	[LoginDate]		[datetime]						NOT NULL 	DEFAULT getdate(),
	[LogoutDate]	[datetime]							NULL,
	[Timestamp]		[datetime]						NOT NULL	DEFAULT (getdate()),
	[ModID]			[int]								NULL,
	[Active]		[tinyint]						NOT NULL 	DEFAULT (0)
)ON [PRIMARY]
GO