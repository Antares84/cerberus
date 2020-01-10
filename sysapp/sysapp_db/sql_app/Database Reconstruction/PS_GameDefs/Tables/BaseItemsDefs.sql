USE [PS_GameDefs]
GO

/****** Object:  Table [dbo].[BaseItemsDefs]    Script Date: 8/14/2014 10:38:13 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[BaseItemsDefs](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[Family] [smallint] NOT NULL,
	[Job] [smallint] NOT NULL,
	[ItemID] [int] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Count] [int] NOT NULL,
	[Slot] [smallint] NOT NULL,
	[Quality] [int] NOT NULL
) ON [PRIMARY]

GO