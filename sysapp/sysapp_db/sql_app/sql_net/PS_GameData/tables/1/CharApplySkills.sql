USE [PS_GameData]
GO

/****** Object:  Table [dbo].[CharApplySkills]    Script Date: 8/14/2014 10:55:17 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[CharApplySkills](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[SkillID] [smallint] NOT NULL,
	[SkillLevel] [tinyint] NOT NULL,
	[LeftResetTime] [int] NOT NULL,
 CONSTRAINT [PK_CharApplySkills] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[SkillID] ASC,
	[SkillLevel] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO


