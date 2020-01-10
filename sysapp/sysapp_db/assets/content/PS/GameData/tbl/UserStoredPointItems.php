<div class="menu_description">
<pre>
USE [PS_GameData]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[UserStoredPointItems](
	[UserUID] [int] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemCount] [tinyint] NOT NULL,
	[BuyDate] [datetime] NULL,
 CONSTRAINT [PK_UserProductItems] PRIMARY KEY CLUSTERED 
(
	[UserUID] ASC,
	[Slot] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[UserStoredPointItems] ADD  CONSTRAINT [DF_UserProductItems_BuyDate]  DEFAULT (getdate()) FOR [BuyDate]
GO

</pre>
</div>