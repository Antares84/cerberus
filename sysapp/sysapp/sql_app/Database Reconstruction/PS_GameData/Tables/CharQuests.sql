USE [PS_GameData]
GO

/****** Object:  Table [dbo].[CharQuests]    Script Date: 8/14/2014 10:55:45 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[CharQuests](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[QuestID] [smallint] NOT NULL,
	[Delay] [smallint] NOT NULL,
	[Count1] [tinyint] NOT NULL,
	[Count2] [tinyint] NOT NULL,
	[Count3] [tinyint] NOT NULL,
	[Success] [tinyint] NOT NULL,
	[Finish] [tinyint] NOT NULL,
	[Del] [bit] NOT NULL,
 CONSTRAINT [PK_CharQuests] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[QuestID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Count1]  DEFAULT (0) FOR [Count1]
GO

ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Count2]  DEFAULT (0) FOR [Count2]
GO

ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Count3]  DEFAULT (0) FOR [Count3]
GO

ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Success]  DEFAULT (0) FOR [Success]
GO

ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Finish]  DEFAULT (0) FOR [Finish]
GO

ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Del]  DEFAULT (0) FOR [Del]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'스킬 딜레이(ms던가?)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharQuests', @level2type=N'COLUMN',@level2name=N'Delay'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'수행안함 -1, 실패 0, 성공 1' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharQuests', @level2type=N'COLUMN',@level2name=N'Success'
GO


