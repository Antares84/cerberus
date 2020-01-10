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
CREATE TABLE [dbo].[Users](<br>
	[UserID] [varchar](20) NOT NULL,<br>
	[CharName] [varchar](25) NULL,<br>
	[Rank] [int] NOT NULL<br>
) ON [PRIMARY]<br>
GO
<br><br>
SET ANSI_PADDING OFF<br>
GO
<br><br>