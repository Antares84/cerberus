USE [PS_GameData]
GO

/****** Object:  Table [dbo].[EventLog_CharSkill2]    Script Date: 8/14/2014 10:57:19 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[EventLog_CharSkill2](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[UseCount] [tinyint] NOT NULL,
	[SkillID] [smallint] NOT NULL,
	[SkillLevel] [tinyint] NOT NULL,
	[Number] [tinyint] NOT NULL,
	[CreateTime] [datetime] NOT NULL,
 CONSTRAINT [PK_EventLog_CharSkill2] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[UseCount] ASC,
	[SkillID] ASC,
	[SkillLevel] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO


