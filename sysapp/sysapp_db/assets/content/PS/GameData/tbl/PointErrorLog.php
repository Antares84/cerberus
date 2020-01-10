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

CREATE TABLE [dbo].[PointErrorLog](
	[UserUID] [int] NOT NULL,
	[CharID] [int] NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[Ret] [int] NOT NULL,
	[ErrDate] [datetime] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[PointErrorLog] ADD  CONSTRAINT [DF_PointErrorLog_ErrDate]  DEFAULT (getdate()) FOR [ErrDate]
GO

</pre>
</div>