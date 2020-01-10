USE [PS_GameData]
GO

/****** Object:  Table [dbo].[EventLog_CharStat]    Script Date: 8/14/2014 10:57:28 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[EventLog_CharStat](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[UseCount] [tinyint] NOT NULL,
	[GetPoint] [smallint] NOT NULL,
	[StatPoint] [smallint] NOT NULL,
	[Str] [smallint] NOT NULL,
	[Dex] [smallint] NOT NULL,
	[Rec] [smallint] NOT NULL,
	[Int] [smallint] NOT NULL,
	[Luc] [smallint] NOT NULL,
	[Wis] [smallint] NOT NULL,
	[UseDate] [datetime] NOT NULL,
 CONSTRAINT [PK_EventLog_CharStat] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[UseCount] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO


