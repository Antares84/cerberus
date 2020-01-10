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

CREATE TABLE [dbo].[CharRenameLog](
	[ServerID] [tinyint] NULL,
	[CharID] [int] NULL,
	[CharName] [varchar](30) NULL,
	[UpdateTime] [datetime] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[CharRenameLog] ADD  CONSTRAINT [DF_CharRenameLog_UpdateTime]  DEFAULT (getdate()) FOR [UpdateTime]
GO

</pre>
</div>