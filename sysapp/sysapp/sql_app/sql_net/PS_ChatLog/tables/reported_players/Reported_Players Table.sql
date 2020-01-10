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
CREATE TABLE [dbo].[Reported_Players](<br>
	[row] [int] IDENTITY(1,1) NOT NULL,<br>
	[UserUID] [int] NOT NULL,<br>
	[UserID] [varchar](30) NOT NULL,<br>
	[CharID] [int] NOT NULL,<br>
	[CharName] [varchar](30) NOT NULL,<br>
	[Map] [smallint] NULL,<br>
	[PosX] [real] NULL,<br>
	[PosZ] [real] NULL,<br>
	[Reported Character] [varchar](30) NOT NULL,<br>
	[Reason] [varchar](110) NOT NULL,<br>
	[Time] [datetime] NOT NULL,<br>
	[Read] [bit] NULL,<br>
	[GM_Notice] [varchar](256) NULL,<br>
 CONSTRAINT [PK_Reports] PRIMARY KEY CLUSTERED <br>
(<br>
	[row] ASC<br>
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]<br>
) ON [PRIMARY]<br>
GO
<br><br>
SET ANSI_PADDING OFF<br>
GO
<br><br>