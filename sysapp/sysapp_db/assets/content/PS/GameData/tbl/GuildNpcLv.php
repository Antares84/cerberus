<div class="menu_description">
<pre>
USE [PS_GameData]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[GuildNpcLv](
	[GuildID] [int] NOT NULL,
	[GNpcType] [smallint] NOT NULL,
	[NpcLevel] [tinyint] NOT NULL,
	[Number] [tinyint] NOT NULL,
	[CreateTime] [datetime] NOT NULL,
	[Del] [tinyint] NOT NULL,
 CONSTRAINT [PK_GuildNpcLv] PRIMARY KEY CLUSTERED 
(
	[GuildID] ASC,
	[GNpcType] ASC,
	[NpcLevel] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[GuildNpcLv] ADD  CONSTRAINT [DF_GuildNpcLv_CreateTime]  DEFAULT (getdate()) FOR [CreateTime]
GO

ALTER TABLE [dbo].[GuildNpcLv] ADD  CONSTRAINT [DF_GuildNpcLv_Del]  DEFAULT (0) FOR [Del]
GO

</pre>
</div>