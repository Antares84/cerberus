USE [PS_AdminPanel]<br>
GO
<br><br>
SET ANSI_NULLS ON<br>
GO
<br><br>
SET QUOTED_IDENTIFIER ON<br>
GO
<br><br>
SET ANSI_PADDING ON<br>
GO
<br><br>
CREATE TABLE [dbo].[donate_items](<br>
	[id] [int] NOT NULL,<br>
	[item_name] [varchar](255) NULL,<br>
	[item_price] [int] NULL,<br>
	[item_count] [varchar](255) NULL,<br>
	[item_id] [varchar](255) NULL,<br>
	[item_ali] [varchar](255) NULL,<br>
	[item_cat] [varchar](11) NULL,<br>
	[item_pack] [varchar](11) NULL,<br>
	[item_image] [varchar](255) NULL<br>
) ON [PRIMARY]<br>
GO
<br><br>
SET ANSI_PADDING OFF<br>
GO
<br><br>