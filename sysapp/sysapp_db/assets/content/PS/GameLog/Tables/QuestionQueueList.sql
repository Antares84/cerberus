USE [PS_GameLog]
GO

/****** Object:  Table [dbo].[QuestionQueueList]    Script Date: 8/16/2014 12:23:15 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[QuestionQueueList](
	[QueueID] [int] NULL,
	[OwnerAdminID] [varchar](30) NULL,
	[Type] [tinyint] NULL,
	[CharID] [int] NULL,
	[Charname] [varchar](50) NULL,
	[Question] [varchar](2000) NULL,
	[QuestionDate] [datetime] NULL,
	[Answer] [varchar](50) NULL,
	[AnswerDate] [datetime] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


