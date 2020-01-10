USE [PS_GameData]
GO

/****** Object:  Table [dbo].[GuildRankLog]    Script Date: 8/14/2014 10:58:35 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[GuildRankLog](
	[GuildID] [int] NOT NULL,
	[GuildValue] [int] NOT NULL,
	[Rank] [int] NOT NULL,
	[TotalRank] [int] NOT NULL,
	[Change] [int] NULL,
	[TotalChange] [int] NULL,
	[RankTime] [datetime] NOT NULL
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[GuildRankLog] ADD  CONSTRAINT [DF_GuildRankLog_TotalRank]  DEFAULT (0) FOR [TotalRank]
GO

ALTER TABLE [dbo].[GuildRankLog] ADD  CONSTRAINT [DF_GuildRankLog_RankTime]  DEFAULT (getdate()) FOR [RankTime]
GO


