USE [PS_GameData]
GO

/****** Object:  Table [dbo].[CharSkills]    Script Date: 8/14/2014 10:56:36 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[CharSkills](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[SkillID] [smallint] NOT NULL,
	[SkillLevel] [tinyint] NOT NULL,
	[Number] [tinyint] NOT NULL,
	[Delay] [smallint] NOT NULL,
	[CreateTime] [smalldatetime] NOT NULL,
	[Del] [bit] NOT NULL,
 CONSTRAINT [PK_CharSkills] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[SkillID] ASC,
	[SkillLevel] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[CharSkills] ADD  CONSTRAINT [DF_CharSkills_RegDate]  DEFAULT (getdate()) FOR [CreateTime]
GO

ALTER TABLE [dbo].[CharSkills] ADD  CONSTRAINT [DF_CharSkills_Del]  DEFAULT (0) FOR [Del]
GO


