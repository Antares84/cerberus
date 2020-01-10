<div class="menu_description">
<pre>

USE [PS_GameData]
GO

/****** Object:  Table [dbo].[PointGiftNotify]    Script Date: 8/14/2014 11:02:43 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[PointGiftNotify](
	[UserUID] [int] NOT NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[SendCharName] [varchar](30) NOT NULL,
	[RecvDate] [datetime] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[PointGiftNotify] ADD  CONSTRAINT [DF_PointGiftNotify_UseDate]  DEFAULT (getdate()) FOR [RecvDate]
GO

</pre>
</div>