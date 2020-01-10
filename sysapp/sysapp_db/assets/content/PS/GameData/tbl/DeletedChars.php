<div class="menu_description">
<pre>
USE [PS_GameData]
GO

/****** Object:  Table [dbo].[DeletedChars]    Script Date: 8/14/2014 10:57:02 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[DeletedChars](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[CharID] [int] NOT NULL,
	[DeleteDate] [datetime] NOT NULL,
 CONSTRAINT [PK_DeleteChars] PRIMARY KEY CLUSTERED 
(
	[RowID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

</pre>
</div>