<div class="menu_description">
<pre>
USE [PS_GameData]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[MarketItems_DelLog](
	[MarketID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NULL,
	[Count] [tinyint] NOT NULL,
	[Maketime] [datetime] NOT NULL,
	[Maketype] [varchar](1) NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

</pre>
</div>