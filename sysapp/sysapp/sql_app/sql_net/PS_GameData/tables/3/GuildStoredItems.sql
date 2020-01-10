USE [PS_GameData]
GO

/****** Object:  Table [dbo].[GuildStoredItems]    Script Date: 8/14/2014 11:00:10 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[GuildStoredItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[GuildID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Slot] [int] NOT NULL,
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
	[Maketype] [char](1) NOT NULL,
	[Del] [bit] NOT NULL,
 CONSTRAINT [PK_GuildStoredItems] PRIMARY KEY CLUSTERED 
(
	[ItemUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[GuildStoredItems] ADD  CONSTRAINT [DF_GuildStoredItems_Del]  DEFAULT (0) FOR [Del]
GO


