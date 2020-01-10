USE [PS_GameData]
GO

/****** Object:  Table [dbo].[GuildDetails]    Script Date: 8/14/2014 10:58:18 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[GuildDetails](
	[GuildID] [int] NOT NULL,
	[UseHouse] [tinyint] NOT NULL,
	[BuyHouse] [tinyint] NOT NULL,
	[Rank] [tinyint] NOT NULL,
	[Etin] [int] NOT NULL,
	[EtinReturnCnt] [int] NOT NULL,
	[KeepEtin] [int] NOT NULL,
	[Remark] [varchar](64) NULL,
 CONSTRAINT [PK_GuildHouses] PRIMARY KEY CLUSTERED 
(
	[GuildID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildHouses_UseHouse]  DEFAULT (0) FOR [UseHouse]
GO

ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildDetails_BuyHouse]  DEFAULT (0) FOR [BuyHouse]
GO

ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildHouses_Rank]  DEFAULT (31) FOR [Rank]
GO

ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildHouses_Etine]  DEFAULT (0) FOR [Etin]
GO

ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildDetails_EtinReturnCnt]  DEFAULT (0) FOR [EtinReturnCnt]
GO

ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildDetails_KeepEtin]  DEFAULT (2000) FOR [KeepEtin]
GO


