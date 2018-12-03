IF OBJECT_ID('[Cerberus].[dbo].[IT_ANSWERS]','U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[IT_ANSWERS]
GO

CREATE TABLE [Cerberus].[dbo].[IT_ANSWERS](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[TICKET_ID] [int]							NOT NULL,
	[MSG_ID] 	[int]							NOT NULL,
	[EMAIL]		[varchar](255)					NOT NULL,
	[CONTENT]	[varchar](MAX)					NOT NULL,
	[ACCOUNT]	[int]							NOT NULL,
	[DATE]		[datetime]						NOT NULL	DEFAULT(getdate())
)ON [PRIMARY]
GO