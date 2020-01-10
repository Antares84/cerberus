USE [SDM_AdminPanel]
GO

/****** Object:  Table [dbo].[donate_items]    Script Date: 12/4/2013 9:38:24 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[donate_items](
	[id] [int] NOT NULL,
	[item_name] [varchar](255) NULL,
	[item_price] [int] NULL,
	[item_count] [varchar](255) NULL,
	[item_id] [varchar](255) NULL,
	[item_ali] [varchar](255) NULL,
	[item_cat] [varchar](11) NULL,
	[item_pack] [varchar](11) NULL,
	[item_image] [varchar](255) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


