USE [PS_GameLog]
GO

/****** Object:  Table [dbo].[ItemMakeLog]    Script Date: 8/16/2014 12:16:12 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[ItemMakeLog](
	[RowID] [int] NOT NULL,
	[MakeTime] [datetime] NOT NULL,
	[MakeType] [char](1) NOT NULL,
	[MapID] [smallint] NOT NULL,
	[MobID] [smallint] NOT NULL,
	[PosX] [real] NOT NULL,
	[PosY] [real] NOT NULL,
	[PosZ] [real] NOT NULL,
	[FirstOwnerableID] [int] NOT NULL,
	[ShopID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[ItemName] [varchar](30) NOT NULL,
 CONSTRAINT [PK_ItemMakeLog] PRIMARY KEY CLUSTERED 
(
	[RowID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


