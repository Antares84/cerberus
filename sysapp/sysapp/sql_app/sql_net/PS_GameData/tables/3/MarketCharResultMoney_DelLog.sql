USE [PS_GameData]
GO

/****** Object:  Table [dbo].[MarketCharResultMoney_DelLog]    Script Date: 8/14/2014 11:01:56 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[MarketCharResultMoney_DelLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[MoneyID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[MarketID] [int] NOT NULL,
	[Result] [tinyint] NOT NULL,
	[Money] [int] NOT NULL,
	[GuaranteeMoney] [int] NOT NULL,
	[ReturnMoney] [int] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NOT NULL,
	[Count] [tinyint] NOT NULL,
	[DelDate] [datetime] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


