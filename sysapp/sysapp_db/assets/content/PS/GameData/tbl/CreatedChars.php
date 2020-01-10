<div class="menu_description">
<pre>
USE [PS_GameData]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[CreatedChars](
	[RowID] [int] NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[UserID] [varchar](12) NOT NULL,
	[CharID] [int] NOT NULL,
	[CharName] [varchar](50) NOT NULL,
	[Family] [tinyint] NOT NULL,
	[CreateDate] [datetime] NOT NULL,
	[UserUID] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[RowID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

</pre>
</div>