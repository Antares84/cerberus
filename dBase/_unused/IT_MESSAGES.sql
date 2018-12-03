IF OBJECT_ID('[Cerberus].[dbo].[IT_MESSAGES]','U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[IT_MESSAGES]
GO

CREATE TABLE [Cerberus].[dbo].[IT_MESSAGES](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[TICKET_ID] [int]							NOT NULL,
	[NAME]		[varchar](255)					NOT NULL,
	[EMAIL]		[varchar](255)					NOT NULL,
	[PHONE]		[varchar](15)					NOT NULL,
	[PRIORITY]	[tinyint]						NOT NULL,
	[DIVISION]	[tinyint]						NOT NULL,
	[SUBJECT]	[varchar](255)					NOT NULL,
	[CONTENT]	[varchar](MAX)					NOT NULL,
	[PRODUCT]	[tinyint]						NOT NULL,
	[STATUS]	[tinyint]						NOT NULL,
	[SPAM]		[int]							NOT NULL,
	[DATE]		[datetime]						NOT NULL	DEFAULT(getdate())
)ON [PRIMARY]
GO