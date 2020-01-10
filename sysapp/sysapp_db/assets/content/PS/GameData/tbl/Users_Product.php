<div class="menu_description">
<pre>

USE [PS_GameData]
GO

/****** Object:  Table [dbo].[Users_Product]    Script Date: 8/14/2014 11:03:14 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Users_Product](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[UserUID] [int] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemCount] [tinyint] NOT NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[OrderNumber] [int] NOT NULL,
	[VerifyCode] [bigint] NULL,
	[BuyDate] [datetime] NULL,
 CONSTRAINT [PK_Users_Product] PRIMARY KEY CLUSTERED 
(
	[UserUID] ASC,
	[Slot] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

</pre>
</div>