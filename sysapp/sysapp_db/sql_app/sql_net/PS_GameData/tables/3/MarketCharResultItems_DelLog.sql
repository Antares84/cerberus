USE [PS_GameData]
GO

/****** Object:  Table [dbo].[MarketCharResultItems_DelLog]    Script Date: 8/14/2014 11:01:37 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[MarketCharResultItems_DelLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[MarketID] [int] NOT NULL,
	[Result] [tinyint] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	[DelDate] [datetime] NOT NULL
) ON [PRIMARY]

GO


