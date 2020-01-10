<div class="menu_description">
<pre>
USE [PS_GameData]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[GuildRankLog2](
	[GuildID] [int] NOT NULL,
	[GuildValue] [int] NOT NULL,
	[Rank] [int] NOT NULL,
	[TotalRank] [int] NOT NULL,
	[Change] [int] NULL,
	[TotalChange] [int] NULL,
	[RankTime] [datetime] NOT NULL
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[GuildRankLog2] ADD  CONSTRAINT [DF_GuildRankLog2_TotalRank]  DEFAULT (0) FOR [TotalRank]
GO

ALTER TABLE [dbo].[GuildRankLog2] ADD  CONSTRAINT [DF_GuildRankLog2_RankTime]  DEFAULT (getdate()) FOR [RankTime]
GO

</pre>
</div>