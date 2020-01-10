USE [PS_GameData]
GO

/****** Object:  Table [dbo].[Chars]    Script Date: 8/14/2014 10:56:18 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Chars](
	[ServerID] [tinyint] NOT NULL,
	[UserID] [varchar](12) NOT NULL,
	[UserUID] [int] NOT NULL,
	[CharID] [int] IDENTITY(1,1) NOT NULL,
	[CharName] [varchar](50) NOT NULL,
	[New] [tinyint] NOT NULL,
	[Del] [tinyint] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[Family] [tinyint] NOT NULL,
	[Grow] [tinyint] NOT NULL,
	[Hair] [tinyint] NOT NULL,
	[Face] [tinyint] NOT NULL,
	[Size] [tinyint] NOT NULL,
	[Job] [tinyint] NOT NULL,
	[Sex] [tinyint] NOT NULL,
	[Level] [smallint] NOT NULL,
	[StatPoint] [smallint] NOT NULL,
	[SkillPoint] [smallint] NOT NULL,
	[Str] [smallint] NOT NULL,
	[Dex] [smallint] NOT NULL,
	[Rec] [smallint] NOT NULL,
	[Int] [smallint] NOT NULL,
	[Luc] [smallint] NOT NULL,
	[Wis] [smallint] NOT NULL,
	[HP] [smallint] NOT NULL,
	[MP] [smallint] NOT NULL,
	[SP] [smallint] NOT NULL,
	[Map] [smallint] NOT NULL,
	[Dir] [smallint] NOT NULL,
	[Exp] [int] NOT NULL,
	[Money] [int] NOT NULL,
	[PosX] [real] NOT NULL,
	[PosY] [real] NOT NULL,
	[Posz] [real] NOT NULL,
	[Hg] [smallint] NOT NULL,
	[Vg] [smallint] NOT NULL,
	[Cg] [tinyint] NOT NULL,
	[Og] [tinyint] NOT NULL,
	[Ig] [tinyint] NOT NULL,
	[K1] [int] NOT NULL,
	[K2] [int] NOT NULL,
	[K3] [int] NOT NULL,
	[K4] [int] NOT NULL,
	[KillLevel] [tinyint] NOT NULL,
	[DeadLevel] [tinyint] NOT NULL,
	[RegDate] [datetime] NOT NULL,
	[DeleteDate] [datetime] NULL,
	[JoinDate] [datetime] NULL,
	[LeaveDate] [datetime] NULL,
	[RenameCnt] [tinyint] NOT NULL,
	[OldCharName] [varchar](30) NULL,
	[RemainTime] [int] NOT NULL,
	[LoginStatus] [tinyint] NOT NULL,
	[Staff] [tinyint] NOT NULL,
	[GS] [tinyint] NOT NULL,
	[GM] [tinyint] NOT NULL,
	[StaffStatus] [tinyint] NOT NULL,
	[Email] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Chars] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_New]  DEFAULT ((1)) FOR [New]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_Del]  DEFAULT ((0)) FOR [Del]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_level]  DEFAULT ((0)) FOR [Level]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_StatPoint]  DEFAULT ((0)) FOR [StatPoint]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_SkillPoint]  DEFAULT ((0)) FOR [SkillPoint]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_map]  DEFAULT ((0)) FOR [Map]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_dir]  DEFAULT ((0)) FOR [Dir]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_exp]  DEFAULT ((0)) FOR [Exp]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_money]  DEFAULT ((0)) FOR [Money]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_posx]  DEFAULT ((674.442)) FOR [PosX]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_posy]  DEFAULT ((3.640)) FOR [PosY]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_posz]  DEFAULT ((1000.924)) FOR [Posz]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_K1]  DEFAULT ((0)) FOR [K1]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_K2]  DEFAULT ((0)) FOR [K2]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_K3]  DEFAULT ((0)) FOR [K3]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_K4]  DEFAULT ((0)) FOR [K4]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_KillLevel]  DEFAULT ((0)) FOR [KillLevel]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_DeadLevel]  DEFAULT ((0)) FOR [DeadLevel]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_RegDate]  DEFAULT (getdate()) FOR [RegDate]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_RemainTime]  DEFAULT ((0)) FOR [RemainTime]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_LoginStatus]  DEFAULT ((0)) FOR [LoginStatus]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF__Chars__Staff__0638D371]  DEFAULT ((0)) FOR [Staff]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_GS]  DEFAULT ((0)) FOR [GS]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_GM]  DEFAULT ((0)) FOR [GM]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_StaffStatus]  DEFAULT ((0)) FOR [StaffStatus]
GO

ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_Email]  DEFAULT ('@email.com') FOR [Email]
GO


