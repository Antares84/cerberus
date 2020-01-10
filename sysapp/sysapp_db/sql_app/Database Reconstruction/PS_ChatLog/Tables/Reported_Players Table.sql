USE [SDM_Chatlog]
GO

/******
File Label: Table [dbo].[Reported_Players]
Script Date: 8/14/2014 10:22:03 PM
******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Reported_Players](
	[row] [int] IDENTITY(1,1) NOT NULL,
	[UserUID] [int] NOT NULL,
	[UserID] [varchar](30) NOT NULL,
	[CharID] [int] NOT NULL,
	[CharName] [varchar](30) NOT NULL,
	[Map] [smallint] NULL,
	[PosX] [real] NULL,
	[PosZ] [real] NULL,
	[Reported Character] [varchar](30) NOT NULL,
	[Reason] [varchar](110) NOT NULL,
	[Time] [datetime] NOT NULL,
	[Readed] [bit] NULL,
	[GM_notice] [varchar](256) NULL,
 CONSTRAINT [PK_Reports] PRIMARY KEY CLUSTERED 
(
	[row] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO