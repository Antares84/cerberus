<div class="menu_description">
<pre>
USE [PS_GameData]
GO

/****** Object:  Table [dbo].[CharQuickSlots]    Script Date: 8/14/2014 10:55:55 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[CharQuickSlots](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[QuickBar] [tinyint] NOT NULL,
	[QuickSlot] [tinyint] NOT NULL,
	[Bag] [tinyint] NOT NULL,
	[Number] [smallint] NOT NULL,
 CONSTRAINT [PK_CharQuickSlots] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[QuickBar] ASC,
	[QuickSlot] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

</pre>
</div>