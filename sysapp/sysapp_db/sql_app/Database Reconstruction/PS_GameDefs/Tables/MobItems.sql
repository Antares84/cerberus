USE [PS_GameDefs]
GO

/****** Object:  Table [dbo].[MobItems]    Script Date: 8/14/2014 10:40:00 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[MobItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[MobID] [smallint] NOT NULL,
	[ItemOrder] [tinyint] NOT NULL,
	[Grade] [smallint] NOT NULL,
	[DropRate] [int] NOT NULL
) ON [PRIMARY]

GO


