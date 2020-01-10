USE [PS_GameDefs]
GO

/****** Object:  Table [dbo].[StatusDefs]    Script Date: 8/14/2014 10:40:53 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[StatusDefs](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[Level] [smallint] NOT NULL,
	[Job] [tinyint] NOT NULL,
	[HP] [smallint] NOT NULL,
	[SP] [smallint] NOT NULL,
	[MP] [smallint] NOT NULL
) ON [PRIMARY]

GO