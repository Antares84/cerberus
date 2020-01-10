IF OBJECT_ID('[Cerberus].[dbo].[LOG_GM_COMMANDS]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[LOG_GM_COMMANDS]
GO

CREATE TABLE [Cerberus].[dbo].[LOG_GM_COMMANDS](
	[RowID]				[int]			IDENTITY(1,1)	NOT NULL,
	[CharName]			[varchar](20)					NULL,
	[MapID]				[smallint]						NULL,
	[PosX]				[real]							NULL,
	[PosY]				[real]							NULL,
	[ActionTime]		[datetime]						NULL,
	[Command]			[varchar](max)					NULL,
	[PlayerAffected]	[varchar](max)					NULL,
	[CommandResult]		[varchar](max)					NULL
)ON [PRIMARY]
GO