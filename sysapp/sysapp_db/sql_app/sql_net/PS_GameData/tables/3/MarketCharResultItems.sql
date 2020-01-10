USE [PS_GameData]
GO

/****** Object:  Table [dbo].[MarketCharResultItems]    Script Date: 8/14/2014 11:01:28 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[MarketCharResultItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[MarketID] [int] NOT NULL,
	[Result] [tinyint] NOT NULL,
	[EndDate] [datetime] NOT NULL,
 CONSTRAINT [PK_MarketCharResultItems] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[MarketID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO


