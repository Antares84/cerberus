IF OBJECT_ID('[Cerberus].[dbo].[NEWS]','U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[NEWS]
GO

CREATE TABLE [Cerberus].[dbo].[NEWS](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[Title]		[varchar](MAX)					NOT NULL,
	[Detail]	[varchar](MAX)					NOT NULL,
	[PostDate]	[datetime]						NOT NULL	DEFAULT (getdate()),
	[PosterID]	[varchar](50)						NULL 
)ON [PRIMARY]
GO