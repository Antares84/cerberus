<div class="menu_description">
<pre>
USE [master]
GO
CREATE DATABASE [SDM_GameData]
	CONTAINMENT = NONE
	ON  PRIMARY 
( NAME = N'SDM_GameData', FILENAME = N'C:\ShaiyaServer\DevData\SDM_GameData.mdf' , SIZE = 4096KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
	LOG ON 
( NAME = N'SDM_GameData_log', FILENAME = N'C:\ShaiyaServer\DevData\SDM_GameData_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [SDM_GameData] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
BEGIN
	EXEC [SDM_GameData].[dbo].[sp_fulltext_database] @action = 'enable'
END
GO
ALTER DATABASE [SDM_GameData] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [SDM_GameData] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [SDM_GameData] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [SDM_GameData] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [SDM_GameData] SET ARITHABORT OFF 
GO
ALTER DATABASE [SDM_GameData] SET AUTO_CLOSE ON 
GO
ALTER DATABASE [SDM_GameData] SET AUTO_CREATE_STATISTICS ON 
GO
ALTER DATABASE [SDM_GameData] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [SDM_GameData] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [SDM_GameData] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [SDM_GameData] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [SDM_GameData] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [SDM_GameData] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [SDM_GameData] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [SDM_GameData] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [SDM_GameData] SET  DISABLE_BROKER 
GO
ALTER DATABASE [SDM_GameData] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [SDM_GameData] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [SDM_GameData] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [SDM_GameData] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [SDM_GameData] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [SDM_GameData] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [SDM_GameData] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [SDM_GameData] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [SDM_GameData] SET  MULTI_USER 
GO
ALTER DATABASE [SDM_GameData] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [SDM_GameData] SET DB_CHAINING OFF 
GO
ALTER DATABASE [SDM_GameData] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [SDM_GameData] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [SDM_GameData] SET  READ_WRITE 
GO
/****** Object:  Table [dbo].[BanChars]    Script Date: 2/5/2016 3:34:29 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[BanChars](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[BanID] [int] NOT NULL,
	[BanName] [varchar](30) NOT NULL,
	[Memo] [varchar](50) NULL,
	[BanDate] [datetime] NULL,
 CONSTRAINT [PK_BanChars] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[BanID] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[CharApplySkills]    Script Date: 2/5/2016 3:34:33 PM ******/
USE [SDM_GameData]
GO
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
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CharEvents]    Script Date: 2/5/2016 3:34:52 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CharEvents](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[Event1] [tinyint] NOT NULL,
	[Event2] [tinyint] NOT NULL,
	[Event3] [tinyint] NULL,
	[Event4] [tinyint] NULL,
	[Event5] [tinyint] NULL,
	[Event6] [tinyint] NULL,
	[Event7] [tinyint] NULL,
	[Event8] [tinyint] NULL,
	[Event9] [tinyint] NULL,
	[Event10] [tinyint] NULL,
 CONSTRAINT [PK_CharEvents] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[CharEvents] ADD  CONSTRAINT [DF_CharEvents_Event1]  DEFAULT ((0)) FOR [Event1]
GO
ALTER TABLE [dbo].[CharEvents] ADD  CONSTRAINT [DF_CharEvents_Event2]  DEFAULT ((0)) FOR [Event2]
GO
/****** Object:  Table [dbo].[CharItems]    Script Date: 2/5/2016 3:34:57 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[CharItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Bag] [tinyint] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NULL,
	[Count] [tinyint] NOT NULL,
	[Maketime] [datetime] NOT NULL,
	[Maketype] [varchar](1) NOT NULL,
	[Del] [bit] NOT NULL,
 CONSTRAINT [PK_CharItems] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[ItemUID] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[CharItems] ADD  CONSTRAINT [DF_CharItems_Del]  DEFAULT ((0)) FOR [Del]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'??(2??) + ??ID(3??) = 5?? ????(??? ??)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'ItemID'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'????' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Bag'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'??? ????' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Slot'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'???' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Quality'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'??? ??(??ID? ???)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Gem1'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Craftname'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'????' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Maketime'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'????' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Maketype'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'????' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharItems', @level2type=N'COLUMN',@level2name=N'Del'
GO
/****** Object:  Table [dbo].[CharQuests]    Script Date: 2/5/2016 3:35:03 PM ******/
USE [SDM_GameData]
GO
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
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Count1]  DEFAULT ((0)) FOR [Count1]
GO
ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Count2]  DEFAULT ((0)) FOR [Count2]
GO
ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Count3]  DEFAULT ((0)) FOR [Count3]
GO
ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Success]  DEFAULT ((0)) FOR [Success]
GO
ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Finish]  DEFAULT ((0)) FOR [Finish]
GO
ALTER TABLE [dbo].[CharQuests] ADD  CONSTRAINT [DF_CharQuests_Del]  DEFAULT ((0)) FOR [Del]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'?? ???(ms???)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharQuests', @level2type=N'COLUMN',@level2name=N'Delay'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'???? -1, ?? 0, ?? 1' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'CharQuests', @level2type=N'COLUMN',@level2name=N'Success'
GO
/****** Object:  Table [dbo].[CharQuickSlots]    Script Date: 2/5/2016 3:56:59 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CharQuickSlots](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[QuickBar] [tinyint] NOT NULL,
	[QuickSlot] [tinyint] NOT NULL,
	[Bag] [tinyint] NOT NULL,
	[Number] [smallint] NOT NULL,
 CONSTRAINT [PK_CharQuickSlots] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[QuickBar] ASC,
	[QuickSlot] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CharRenameLog]    Script Date: 2/5/2016 3:57:04 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[CharRenameLog](
	[ServerID] [tinyint] NULL,
	[CharID] [int] NULL,
	[CharName] [varchar](30) NULL,
	[UpdateTime] [datetime] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[CharRenameLog] ADD  CONSTRAINT [DF_CharRenameLog_UpdateTime]  DEFAULT (getdate()) FOR [UpdateTime]
GO
/****** Object:  Table [dbo].[Chars]    Script Date: 2/5/2016 3:57:10 PM ******/
USE [SDM_GameData]
GO
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
	[ADM] [tinyint] NOT NULL,
	[DEV] [tinyint] NOT NULL,
	[GM] [tinyint] NOT NULL,
	[GS] [tinyint] NOT NULL,
	[StaffStatus] [tinyint] NOT NULL,
	[Email] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Chars] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
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
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_RenameCnt]  DEFAULT ((0)) FOR [RenameCnt]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_RemainTime]  DEFAULT ((0)) FOR [RemainTime]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_LoginStatus]  DEFAULT ((0)) FOR [LoginStatus]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF__Chars__Staff__0638D371]  DEFAULT ((0)) FOR [Staff]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_ADM]  DEFAULT ((0)) FOR [ADM]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_DEV]  DEFAULT ((0)) FOR [DEV]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_GM]  DEFAULT ((0)) FOR [GM]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_GS]  DEFAULT ((0)) FOR [GS]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_StaffStatus]  DEFAULT ((0)) FOR [StaffStatus]
GO
ALTER TABLE [dbo].[Chars] ADD  CONSTRAINT [DF_Chars_Email]  DEFAULT ('@email.com') FOR [Email]
GO
/****** Object:  Table [dbo].[CharSavePoint]    Script Date: 2/5/2016 3:57:15 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CharSavePoint](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[MapID] [smallint] NOT NULL,
	[PosX] [real] NOT NULL,
	[PosY] [real] NOT NULL,
	[PosZ] [real] NOT NULL,
 CONSTRAINT [PK_CharSavePoint] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[Slot] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CharSkills]    Script Date: 2/5/2016 3:57:27 PM ******/
USE [SDM_GameData]
GO
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
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[CharSkills] ADD  CONSTRAINT [DF_CharSkills_RegDate]  DEFAULT (getdate()) FOR [CreateTime]
GO
ALTER TABLE [dbo].[CharSkills] ADD  CONSTRAINT [DF_CharSkills_Del]  DEFAULT ((0)) FOR [Del]
GO
/****** Object:  Table [dbo].[CreatedChars]    Script Date: 2/5/2016 4:05:30 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[CreatedChars](
	[RowID] [int] NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[UserID] [varchar](12) NOT NULL,
	[CharID] [int] NOT NULL,
	[CharName] [varchar](50) NOT NULL,
	[Family] [tinyint] NOT NULL,
	[CreateDate] [datetime] NOT NULL,
	[UserUID] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[RowID] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[DeletedChars]    Script Date: 2/5/2016 4:05:34 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[DeletedChars](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[CharID] [int] NOT NULL,
	[DeleteDate] [datetime] NOT NULL,
 CONSTRAINT [PK_DeleteChars] PRIMARY KEY CLUSTERED 
(
	[RowID] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[EventLog_CharSkill1]    Script Date: 2/5/2016 4:05:38 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[EventLog_CharSkill1](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[UseCount] [tinyint] NOT NULL,
	[GetPoint] [smallint] NOT NULL,
	[SkillPoint] [smallint] NOT NULL,
	[UseDate] [datetime] NOT NULL,
 CONSTRAINT [PK_EventLog_CharSkill1] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[UseCount] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[EventLog_CharSkill2]    Script Date: 2/5/2016 4:05:42 PM ******/
USE [SDM_GameData]
GO
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
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[EventLog_CharStat]    Script Date: 2/5/2016 4:05:48 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[EventLog_CharStat](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[UseCount] [tinyint] NOT NULL,
	[GetPoint] [smallint] NOT NULL,
	[StatPoint] [smallint] NOT NULL,
	[Str] [smallint] NOT NULL,
	[Dex] [smallint] NOT NULL,
	[Rec] [smallint] NOT NULL,
	[Int] [smallint] NOT NULL,
	[Luc] [smallint] NOT NULL,
	[Wis] [smallint] NOT NULL,
	[UseDate] [datetime] NOT NULL,
 CONSTRAINT [PK_EventLog_CharStat] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[UseCount] ASC
)
WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[FriendChars]    Script Date: 2/5/2016 4:11:22 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[FriendChars](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[FriendID] [int] NOT NULL,
	[FriendName] [varchar](30) NOT NULL,
	[Family] [tinyint] NOT NULL,
	[Grow] [tinyint] NOT NULL,
	[Job] [tinyint] NOT NULL,
	[Memo] [varchar](50) NULL,
	[Refuse] [tinyint] NOT NULL,
	[CreateDate] [datetime] NULL,
	[RefuseDate] [datetime] NULL,
	CONSTRAINT [PK_FriendChars] PRIMARY KEY CLUSTERED 
	(
		[CharID] ASC,
		[FriendID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[FriendChars] ADD  CONSTRAINT [DF_Friends_Ban]  DEFAULT ((0)) FOR [Refuse]
GO
/****** Object:  Table [dbo].[GuildChars]    Script Date: 2/5/2016 4:11:27 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[GuildChars](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[GuildID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[GuildLevel] [tinyint] NOT NULL,
	[Del] [tinyint] NOT NULL,
	[JoinDate] [datetime] NOT NULL,
	[LeaveDate] [datetime] NULL,
	CONSTRAINT [PK_GuildChars] PRIMARY KEY NONCLUSTERED 
	(
		[RowID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
ALTER TABLE [dbo].[GuildChars] ADD  CONSTRAINT [DF_GuildChars_Del]  DEFAULT ((0)) FOR [Del]
GO
/****** Object:  Table [dbo].[GuildDetails]    Script Date: 2/5/2016 4:11:32 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[GuildDetails](
	[GuildID] [int] NOT NULL,
	[UseHouse] [tinyint] NOT NULL,
	[BuyHouse] [tinyint] NOT NULL,
	[Rank] [tinyint] NOT NULL,
	[Etin] [int] NOT NULL,
	[EtinReturnCnt] [int] NOT NULL,
	[KeepEtin] [int] NOT NULL,
	[Remark] [varchar](64) NULL,
	CONSTRAINT [PK_GuildHouses] PRIMARY KEY CLUSTERED 
	(
		[GuildID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildHouses_UseHouse]  DEFAULT ((0)) FOR [UseHouse]
GO
ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildDetails_BuyHouse]  DEFAULT ((0)) FOR [BuyHouse]
GO
ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildHouses_Rank]  DEFAULT ((31)) FOR [Rank]
GO
ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildHouses_Etine]  DEFAULT ((0)) FOR [Etin]
GO
ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildDetails_EtinReturnCnt]  DEFAULT ((0)) FOR [EtinReturnCnt]
GO
ALTER TABLE [dbo].[GuildDetails] ADD  CONSTRAINT [DF_GuildDetails_KeepEtin]  DEFAULT ((2000)) FOR [KeepEtin]
GO
/****** Object:  Table [dbo].[GuildNpcLv]    Script Date: 2/5/2016 4:11:37 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[GuildNpcLv](
	[GuildID] [int] NOT NULL,
	[GNpcType] [smallint] NOT NULL,
	[NpcLevel] [tinyint] NOT NULL,
	[Number] [tinyint] NOT NULL,
	[CreateTime] [datetime] NOT NULL,
	[Del] [tinyint] NOT NULL,
	CONSTRAINT [PK_GuildNpcLv] PRIMARY KEY CLUSTERED 
	(
		[GuildID] ASC,
		[GNpcType] ASC,
		[NpcLevel] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
ALTER TABLE [dbo].[GuildNpcLv] ADD  CONSTRAINT [DF_GuildNpcLv_CreateTime]  DEFAULT (getdate()) FOR [CreateTime]
GO
ALTER TABLE [dbo].[GuildNpcLv] ADD  CONSTRAINT [DF_GuildNpcLv_Del]  DEFAULT ((0)) FOR [Del]
GO
/****** Object:  Table [dbo].[GuildRankLog]    Script Date: 2/5/2016 4:11:42 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[GuildRankLog](
	[GuildID] [int] NOT NULL,
	[GuildValue] [int] NOT NULL,
	[Rank] [int] NOT NULL,
	[TotalRank] [int] NOT NULL,
	[Change] [int] NULL,
	[TotalChange] [int] NULL,
	[RankTime] [datetime] NOT NULL
)
ON [PRIMARY]
GO
ALTER TABLE [dbo].[GuildRankLog] ADD  CONSTRAINT [DF_GuildRankLog_TotalRank]  DEFAULT ((0)) FOR [TotalRank]
GO
ALTER TABLE [dbo].[GuildRankLog] ADD  CONSTRAINT [DF_GuildRankLog_RankTime]  DEFAULT (getdate()) FOR [RankTime]
GO
/****** Object:  Table [dbo].[GuildRankLog2]    Script Date: 2/5/2016 4:14:59 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[GuildRankLog2](
	[GuildID] [int] NOT NULL,
	[GuildValue] [int] NOT NULL,
	[Rank] [int] NOT NULL,
	[TotalRank] [int] NOT NULL,
	[Change] [int] NULL,
	[TotalChange] [int] NULL,
	[RankTime] [datetime] NOT NULL
)
ON [PRIMARY]
GO
ALTER TABLE [dbo].[GuildRankLog2] ADD  CONSTRAINT [DF_GuildRankLog2_TotalRank]  DEFAULT ((0)) FOR [TotalRank]
GO
ALTER TABLE [dbo].[GuildRankLog2] ADD  CONSTRAINT [DF_GuildRankLog2_RankTime]  DEFAULT (getdate()) FOR [RankTime]
GO
/****** Object:  Table [dbo].[Guilds]    Script Date: 2/5/2016 4:15:06 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Guilds](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[GuildID] [int] NOT NULL,
	[GuildName] [varchar](30) NOT NULL,
	[MasterUserID] [varchar](18) NOT NULL,
	[MasterCharID] [int] NOT NULL,
	[MasterName] [varchar](30) NOT NULL,
	[Country] [tinyint] NOT NULL,
	[TotalCount] [smallint] NOT NULL,
	[GuildPoint] [int] NOT NULL,
	[Del] [tinyint] NOT NULL,
	[CreateDate] [datetime] NOT NULL,
	[DeleteDate] [datetime] NULL,
	CONSTRAINT [PK_Guilds] PRIMARY KEY CLUSTERED 
	(
		[GuildID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Guilds] ADD  CONSTRAINT [DF_Guilds_Del]  DEFAULT ((0)) FOR [Del]
GO
/****** Object:  Table [dbo].[GuildStoredItems]    Script Date: 2/5/2016 4:17:36 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[GuildStoredItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[GuildID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Slot] [int] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NULL,
	[Count] [tinyint] NOT NULL,
	[Maketime] [datetime] NOT NULL,
	[Maketype] [char](1) NOT NULL,
	[Del] [bit] NOT NULL,
	CONSTRAINT [PK_GuildStoredItems] PRIMARY KEY CLUSTERED 
	(
		[ItemUID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[GuildStoredItems] ADD  CONSTRAINT [DF_GuildStoredItems_Del]  DEFAULT ((0)) FOR [Del]
GO
/****** Object:  Table [dbo].[Keeps]    Script Date: 2/5/2016 4:17:41 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Keeps](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[KeepID] [int] NOT NULL,
	[OwnCountry] [tinyint] NOT NULL,
	[ResetTime] [int] NOT NULL
)
ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Market]    Script Date: 2/5/2016 4:17:45 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Market](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[MarketID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[MinMoney] [int] NOT NULL,
	[DirectMoney] [int] NOT NULL,
	[MarketType] [tinyint] NOT NULL,
	[GuaranteeMoney] [int] NOT NULL,
	[TenderCharID] [int] NOT NULL,
	[TenderCharName] [varchar](21) NULL,
	[TenderMoney] [int] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	[Del] [int] NOT NULL,
	CONSTRAINT [PK_Market] PRIMARY KEY CLUSTERED 
	(
		[MarketID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[Market] ADD  CONSTRAINT [DF_Market_Del]  DEFAULT ((0)) FOR [Del]
GO
/****** Object:  Table [dbo].[MarketCharConcern]    Script Date: 2/5/2016 4:20:47 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MarketCharConcern](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[MarketID] [int] NOT NULL,
	CONSTRAINT [PK_MarketCharConcern] PRIMARY KEY CLUSTERED 
	(
		[CharID] ASC,
		[MarketID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MarketCharResultItems]    Script Date: 2/5/2016 4:20:51 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MarketCharResultItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[MarketID] [int] NOT NULL,
	[Result] [tinyint] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	CONSTRAINT [PK_MarketCharResultItems] PRIMARY KEY CLUSTERED 
	(
		[CharID] ASC,
		[MarketID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MarketCharResultItems_DelLog]    Script Date: 2/5/2016 4:20:56 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MarketCharResultItems_DelLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[MarketID] [int] NOT NULL,
	[Result] [tinyint] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	[DelDate] [datetime] NOT NULL
)
ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MarketCharResultMoney]    Script Date: 2/5/2016 4:21:00 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MarketCharResultMoney](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[MoneyID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[MarketID] [int] NOT NULL,
	[Result] [tinyint] NOT NULL,
	[Money] [int] NOT NULL,
	[GuaranteeMoney] [int] NOT NULL,
	[ReturnMoney] [int] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NOT NULL,
	[Count] [tinyint] NOT NULL,
	CONSTRAINT [PK_MarketCharResultMoney] PRIMARY KEY CLUSTERED 
	(
		[MoneyID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[MarketCharResultMoney_DelLog]    Script Date: 2/5/2016 4:21:04 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MarketCharResultMoney_DelLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[MoneyID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[MarketID] [int] NOT NULL,
	[Result] [tinyint] NOT NULL,
	[Money] [int] NOT NULL,
	[GuaranteeMoney] [int] NOT NULL,
	[ReturnMoney] [int] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NOT NULL,
	[Count] [tinyint] NOT NULL,
	[DelDate] [datetime] NOT NULL
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[MarketItems]    Script Date: 2/5/2016 4:23:25 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MarketItems](
	[MarketID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NULL,
	[Count] [tinyint] NOT NULL,
	[Maketime] [datetime] NOT NULL,
	[Maketype] [varchar](1) NOT NULL,
	CONSTRAINT [PK_MarketItems] PRIMARY KEY CLUSTERED 
	(
		[MarketID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[MarketItems_DelLog]    Script Date: 2/5/2016 4:23:29 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[MarketItems_DelLog](
	[MarketID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NULL,
	[Count] [tinyint] NOT NULL,
	[Maketime] [datetime] NOT NULL,
	[Maketype] [varchar](1) NOT NULL
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[PointErrorLog]    Script Date: 2/5/2016 4:23:39 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PointErrorLog](
	[UserUID] [int] NOT NULL,
	[CharID] [int] NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[Ret] [int] NOT NULL,
	[ErrDate] [datetime] NULL
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[PointErrorLog] ADD  CONSTRAINT [DF_PointErrorLog_ErrDate]  DEFAULT (getdate()) FOR [ErrDate]
GO
/****** Object:  Table [dbo].[PointGiftNotify]    Script Date: 2/5/2016 4:23:44 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PointGiftNotify](
	[UserUID] [int] NOT NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[SendCharName] [varchar](30) NOT NULL,
	[RecvDate] [datetime] NOT NULL
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[PointGiftNotify] ADD  CONSTRAINT [DF_PointGiftNotify_UseDate]  DEFAULT (getdate()) FOR [RecvDate]
GO
/****** Object:  Table [dbo].[PointLog]    Script Date: 2/5/2016 4:23:48 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[PointLog](
	[UserUID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[UsePoint] [int] NOT NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[TargetName] [varchar](30) NULL,
	[UseDate] [datetime] NOT NULL,
	[UseType] [tinyint] NOT NULL,
	[RemainPoint] [int] NULL,
	[OrderNumber] [int] NULL
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[PointLog] ADD  CONSTRAINT [DF_PointLog_UseDate]  DEFAULT (getdate()) FOR [UseDate]
GO
/****** Object:  Table [dbo].[UserMaxGrow]    Script Date: 2/5/2016 4:26:04 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserMaxGrow](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[UserUID] [int] NOT NULL,
	[Country] [tinyint] NOT NULL,
	[MaxGrow] [tinyint] NOT NULL,
	[Del] [bit] NOT NULL,
	CONSTRAINT [PK_UserMaxGrow] PRIMARY KEY CLUSTERED 
	(
		[ServerID] ASC,
		[UserUID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
ALTER TABLE [dbo].[UserMaxGrow] ADD  CONSTRAINT [DF_UserMaxGrow_Del]  DEFAULT ((0)) FOR [Del]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'??(0:?, 1:??)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'UserMaxGrow', @level2type=N'COLUMN',@level2name=N'Country'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'?? ????(0~3)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'UserMaxGrow', @level2type=N'COLUMN',@level2name=N'MaxGrow'
GO
/****** Object:  Table [dbo].[Users_Product]    Script Date: 2/5/2016 4:26:11 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Users_Product](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[UserUID] [int] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemCount] [tinyint] NOT NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[OrderNumber] [int] NOT NULL,
	[VerifyCode] [bigint] NULL,
	[BuyDate] [datetime] NULL,
	CONSTRAINT [PK_Users_Product] PRIMARY KEY CLUSTERED 
	(
		[UserUID] ASC,
		[Slot] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[UserStoredItems]    Script Date: 2/5/2016 4:26:16 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[UserStoredItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[UserUID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Slot] [int] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NULL,
	[Count] [tinyint] NOT NULL,
	[Maketime] [datetime] NOT NULL,
	[Maketype] [char](1) NOT NULL,
	[Del] [bit] NOT NULL,
	CONSTRAINT [IX_UserStoredItems_1] UNIQUE NONCLUSTERED 
	(
		[ItemUID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
ALTER TABLE [dbo].[UserStoredItems] ADD  CONSTRAINT [DF_UserStoredItems_Del]  DEFAULT ((0)) FOR [Del]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'?? ??? ????? ??? CharItems ???? ??' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'UserStoredItems', @level2type=N'COLUMN',@level2name=N'RowID'
GO
/****** Object:  Table [dbo].[UserStoredMoney]    Script Date: 2/5/2016 4:26:19 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserStoredMoney](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[UserUID] [int] NOT NULL,
	[Money] [bigint] NOT NULL,
	[LastAccessTime] [datetime] NOT NULL,
	[Del] [bit] NOT NULL,
	CONSTRAINT [PK_UserStoredMoney] PRIMARY KEY CLUSTERED 
	(
		[ServerID] ASC,
		[UserUID] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
ALTER TABLE [dbo].[UserStoredMoney] ADD  CONSTRAINT [DF_UserStoredMoney_Money]  DEFAULT ((0)) FOR [Money]
GO
ALTER TABLE [dbo].[UserStoredMoney] ADD  CONSTRAINT [DF_UserStoredMoney_LastAccessTime]  DEFAULT (getdate()) FOR [LastAccessTime]
GO
ALTER TABLE [dbo].[UserStoredMoney] ADD  CONSTRAINT [DF_UserStoredMoney_Del]  DEFAULT ((0)) FOR [Del]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'?? ''??'' ??? ???? ??? Money??? ?? ??' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'UserStoredMoney', @level2type=N'COLUMN',@level2name=N'RowID'
GO
/****** Object:  Table [dbo].[UserStoredPointItems]    Script Date: 2/5/2016 4:26:24 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[UserStoredPointItems](
	[UserUID] [int] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemCount] [tinyint] NOT NULL,
	[BuyDate] [datetime] NULL,
	CONSTRAINT [PK_UserProductItems] PRIMARY KEY CLUSTERED 
	(
		[UserUID] ASC,
		[Slot] ASC
	)
	WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
)
ON [PRIMARY]
GO
ALTER TABLE [dbo].[UserStoredPointItems] ADD  CONSTRAINT [DF_UserProductItems_BuyDate]  DEFAULT (getdate()) FOR [BuyDate]
GO
/****** Object:  Table [dbo].[WorldInfo]    Script Date: 2/5/2016 4:26:29 PM ******/
USE [SDM_GameData]
GO
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[WorldInfo](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[LastWorldTime] [int] NOT NULL,
	[GodBless_Light] [int] NOT NULL,
	[GodBless_Dark] [int] NOT NULL
)
ON [PRIMARY]
GO
</pre>
</div>