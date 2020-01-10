USE [PS_GameData]
GO

/****** Object:  Table [dbo].[CharItems]    Script Date: 8/14/2014 10:55:34 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[CharItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Bag] [tinyint] NOT NULL,
	[Slot] [tinyint] NOT NULL,
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
	[Maketype] [varchar](1) NOT NULL,
	[Del] [bit] NOT NULL,
 CONSTRAINT [PK_CharItems] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[ItemUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[CharItems] ADD  CONSTRAINT [DF_CharItems_Del]  DEFAULT (0) FOR [Del]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'타입(2자리) + 타입ID(3자리) = 5자리 일련번호(겹치지 않음)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'ItemID'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'가방번호' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Bag'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'가방에 슬롯번호' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Slot'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'내구도' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Quality'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'라피스 번호(타입ID만 들어감)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Gem1'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Craftname'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'생성시간' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Maketime'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'생성방법' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Maketype'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'삭제여부' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Del'
GO


