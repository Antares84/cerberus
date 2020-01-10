USE [PS_GameData]
GO

/****** Object:  Table [dbo].[UserStoredItems]    Script Date: 8/14/2014 11:03:24 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[UserStoredItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[UserUID] [int] NOT NULL,
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
 CONSTRAINT [IX_UserStoredItems_1] UNIQUE NONCLUSTERED 
(
	[ItemUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[UserStoredItems] ADD  CONSTRAINT [DF_UserStoredItems_Del]  DEFAULT (0) FOR [Del]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'창고 아이템 테이블로써 구조는 CharItems 테이블과 동일' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'UserStoredItems', @level2type=N'COLUMN',@level2name=N'RowID'
GO


