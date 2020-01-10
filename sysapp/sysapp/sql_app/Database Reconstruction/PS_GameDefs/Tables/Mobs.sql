USE [PS_GameDefs]
GO

/****** Object:  Table [dbo].[Mobs]    Script Date: 8/14/2014 10:40:14 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Mobs](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[MobID] [smallint] NOT NULL,
	[MobName] [varchar](40) NOT NULL,
	[Level] [smallint] NOT NULL,
	[Exp] [smallint] NOT NULL,
	[AI] [tinyint] NOT NULL,
	[Money1] [smallint] NOT NULL,
	[Money2] [smallint] NOT NULL,
	[QuestItemID] [int] NOT NULL,
	[HP] [int] NOT NULL,
	[SP] [smallint] NOT NULL,
	[MP] [smallint] NOT NULL,
	[Dex] [smallint] NOT NULL,
	[Wis] [smallint] NOT NULL,
	[Luc] [smallint] NOT NULL,
	[Day] [tinyint] NOT NULL,
	[Size] [tinyint] NOT NULL,
	[Attrib] [tinyint] NOT NULL,
	[Defense] [smallint] NOT NULL,
	[Magic] [smallint] NOT NULL,
	[ResistState1] [tinyint] NOT NULL,
	[ResistState2] [tinyint] NOT NULL,
	[ResistState3] [tinyint] NOT NULL,
	[ResistState4] [tinyint] NOT NULL,
	[ResistState5] [tinyint] NOT NULL,
	[ResistState6] [tinyint] NOT NULL,
	[ResistState7] [tinyint] NOT NULL,
	[ResistState8] [tinyint] NOT NULL,
	[ResistState9] [tinyint] NOT NULL,
	[ResistState10] [tinyint] NOT NULL,
	[ResistState11] [tinyint] NOT NULL,
	[ResistState12] [tinyint] NOT NULL,
	[ResistState13] [tinyint] NOT NULL,
	[ResistState14] [tinyint] NOT NULL,
	[ResistState15] [tinyint] NOT NULL,
	[ResistSkill1] [tinyint] NOT NULL,
	[ResistSkill2] [tinyint] NOT NULL,
	[ResistSkill3] [tinyint] NOT NULL,
	[ResistSkill4] [tinyint] NOT NULL,
	[ResistSkill5] [tinyint] NOT NULL,
	[ResistSkill6] [tinyint] NOT NULL,
	[NormalTime] [int] NOT NULL,
	[NormalStep] [tinyint] NOT NULL,
	[ChaseTime] [int] NOT NULL,
	[ChaseStep] [tinyint] NOT NULL,
	[ChaseRange] [tinyint] NOT NULL,
	[AttackType1] [smallint] NOT NULL,
	[AttackTime1] [int] NOT NULL,
	[Attackrange1] [tinyint] NOT NULL,
	[Attack1] [smallint] NOT NULL,
	[Attackplus1] [smallint] NOT NULL,
	[Attackattrib1] [tinyint] NOT NULL,
	[Attackspecial1] [tinyint] NOT NULL,
	[Attackok1] [tinyint] NOT NULL,
	[Attacktype2] [smallint] NOT NULL,
	[Attacktime2] [int] NOT NULL,
	[Attackrange2] [tinyint] NOT NULL,
	[Attack2] [smallint] NOT NULL,
	[Attackplus2] [smallint] NOT NULL,
	[Attackattrib2] [tinyint] NOT NULL,
	[Attackspecial2] [tinyint] NOT NULL,
	[Attackok2] [tinyint] NOT NULL,
	[Attacktype3] [smallint] NOT NULL,
	[Attacktime3] [int] NOT NULL,
	[Attackrange3] [tinyint] NOT NULL,
	[Attack3] [smallint] NOT NULL,
	[Attackplus3] [smallint] NOT NULL,
	[Attackattrib3] [tinyint] NOT NULL,
	[Attackspecial3] [tinyint] NOT NULL,
	[Attackok3] [tinyint] NOT NULL,
 CONSTRAINT [PK_Mobs] PRIMARY KEY CLUSTERED 
(
	[MobID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


