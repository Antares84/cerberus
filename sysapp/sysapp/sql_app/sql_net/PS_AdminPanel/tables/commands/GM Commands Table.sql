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
CREATE TABLE [dbo].[GMCommands](<br>
	[CharName] [varchar](20) NOT NULL,<br>
	[Command] [varchar](max) NULL,<br>
	[PlayerAffected] [varchar](max) NULL,<br>
	[CommandEffect] [varchar](max) NULL,<br>
	[DateUsed] [datetime] NOT NULL<br>
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]<br>
GO
<br><br>
SET ANSI_PADDING OFF<br>
GO
<br><br>
ALTER TABLE [dbo].[GMCommands] ADD  CONSTRAINT [DF_GMCommands_DateUsed]  DEFAULT (getdate()) FOR [DateUsed]<br>
GO
<br><br>