USE [PS_GameData]
GO

/****** Object:  Table [dbo].[WorldInfo]    Script Date: 8/14/2014 11:04:38 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[WorldInfo](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[LastWorldTime] [int] NOT NULL,
	[GodBless_Light] [int] NOT NULL,
	[GodBless_Dark] [int] NOT NULL
) ON [PRIMARY]

GO


