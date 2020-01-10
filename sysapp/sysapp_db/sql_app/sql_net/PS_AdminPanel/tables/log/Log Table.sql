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
CREATE TABLE [dbo].[Log](<br>
	[UserID] [varchar](max) NOT NULL,<br>
	[UserIP] [varchar](15) NOT NULL,<br>
	[Action] [varchar](max) NOT NULL,<br>
	[ActionTime] [datetime] NOT NULL<br>
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]<br>
GO
<br><br>
SET ANSI_PADDING OFF<br>
GO
<br><br>
ALTER TABLE [dbo].[Log] ADD  CONSTRAINT [DF_Log_ActionTime]  DEFAULT (getdate()) FOR [ActionTime]<br>
GO
<br><br>