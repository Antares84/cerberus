USE [PS_Chatlog]<br>
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
CREATE TABLE [dbo].[ChatLog](<br>
	[row] [int] IDENTITY(1,1) NOT NULL,<br>
	[UserUID] [char](10) NULL,<br>
	[CharID] [char](10) NULL,<br>
	[ChatType] [char](10) NULL,<br>
	[TargetName] [char](10) NULL,<br>
	[ChatData] [char](100) NULL,<br>
	[MapID] [char](10) NULL,<br>
	[ChatTime] [varchar](20) NOT NULL,<br>
 CONSTRAINT [PK_ChatLog] PRIMARY KEY CLUSTERED([row] ASC)<br>
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)<br>
ON [PRIMARY]) ON [PRIMARY]<br>
GO
<br><br>
SET ANSI_PADDING OFF<br>
GO
<br><br>