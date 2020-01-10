USE [PS_GameDefs]
GO

/****** Object:  Table [dbo].[ExpDefs]    Script Date: 8/14/2014 10:39:25 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[ExpDefs](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[Level] [smallint] NOT NULL,
	[Grow] [tinyint] NOT NULL,
	[Exp] [int] NOT NULL
) ON [PRIMARY]

GO


