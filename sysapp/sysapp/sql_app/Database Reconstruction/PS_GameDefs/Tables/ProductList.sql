USE [PS_GameDefs]
GO

/****** Object:  Table [dbo].[ProductList]    Script Date: 8/14/2014 10:40:24 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[ProductList](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ProductName] [varchar](50) NOT NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[BuyCost] [int] NOT NULL,
	[ItemID1] [int] NOT NULL,
	[ItemCount1] [tinyint] NOT NULL,
	[ItemID2] [int] NULL,
	[ItemCount2] [tinyint] NULL,
	[ItemID3] [int] NULL,
	[ItemCount3] [tinyint] NULL,
	[ItemID4] [int] NULL,
	[ItemCount4] [tinyint] NULL,
	[ItemID5] [int] NULL,
	[ItemCount5] [tinyint] NULL,
	[ItemID6] [int] NULL,
	[ItemCount6] [tinyint] NULL,
	[ItemID7] [int] NULL,
	[ItemCount7] [tinyint] NULL,
	[ItemID8] [int] NULL,
	[ItemCount8] [tinyint] NULL,
	[ItemID9] [int] NULL,
	[ItemCount9] [tinyint] NULL,
	[ItemID10] [int] NULL,
	[ItemCount10] [tinyint] NULL,
	[ItemID11] [int] NULL,
	[ItemCount11] [tinyint] NULL,
	[ItemID12] [int] NULL,
	[ItemCount12] [tinyint] NULL,
	[ItemID13] [int] NULL,
	[ItemCount13] [tinyint] NULL,
	[ItemID14] [int] NULL,
	[ItemCount14] [tinyint] NULL,
	[ItemID15] [int] NULL,
	[ItemCount15] [tinyint] NULL,
	[ItemID16] [int] NULL,
	[ItemCount16] [tinyint] NULL,
	[ItemID17] [int] NULL,
	[ItemCount17] [tinyint] NULL,
	[ItemID18] [int] NULL,
	[ItemCount18] [tinyint] NULL,
	[ItemID19] [int] NULL,
	[ItemCount19] [tinyint] NULL,
	[ItemID20] [int] NULL,
	[ItemCount20] [tinyint] NULL,
	[ItemID21] [int] NULL,
	[ItemCount21] [tinyint] NULL,
	[ItemID22] [int] NULL,
	[ItemCount22] [tinyint] NULL,
	[ItemID23] [int] NULL,
	[ItemCount23] [tinyint] NULL,
	[ItemID24] [int] NULL,
	[ItemCount24] [tinyint] NULL,
 CONSTRAINT [PK_ProductList] PRIMARY KEY CLUSTERED 
(
	[RowID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


