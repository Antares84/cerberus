USE [PS_GameData]
GO

/****** Object:  Table [dbo].[Keeps]    Script Date: 8/14/2014 11:00:20 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Keeps](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[KeepID] [int] NOT NULL,
	[OwnCountry] [tinyint] NOT NULL,
	[ResetTime] [int] NOT NULL
) ON [PRIMARY]

GO


