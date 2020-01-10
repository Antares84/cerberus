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
CREATE TABLE [dbo].[Banned](<br>
	[CharName] [varchar](25) NOT NULL,<br>
	[Reason] [varchar](max) NULL,<br>
	[BannedBy] [varchar](30) NULL,<br>
	[Duration] [int] NULL,<br>
	[BanDate] [datetime] NOT NULL,<br>
	[UserUID] [int] NULL<br>
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]<br>
GO
<br><br>
SET ANSI_PADDING OFF<br>
GO
<br><br>
ALTER TABLE [dbo].[Banned] ADD  CONSTRAINT [DF_Banned_BanDate]  DEFAULT (getdate()) FOR [BanDate]<br>
GO
<br><br>