USE [PS_GameDefs]
GO

/****** Object:  Table [dbo].[Skills]    Script Date: 8/14/2014 10:40:38 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Skills](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[SkillID] [smallint] NOT NULL,
	[SkillLevel] [tinyint] NOT NULL,
	[SkillName] [varchar](30) NOT NULL,
	[Country] [tinyint] NOT NULL,
	[Attackfighter] [tinyint] NOT NULL,
	[Defensefighter] [tinyint] NOT NULL,
	[Patrolrogue] [tinyint] NOT NULL,
	[Shootrogue] [tinyint] NOT NULL,
	[Attackmage] [tinyint] NOT NULL,
	[Defensemage] [tinyint] NOT NULL,
	[PrevSkillID] [smallint] NOT NULL,
	[ReqLevel] [smallint] NOT NULL,
	[Grow] [tinyint] NOT NULL,
	[SkillPoint] [tinyint] NOT NULL,
	[TypeShow] [tinyint] NOT NULL,
	[TypeAttack] [tinyint] NOT NULL,
	[TypeEffect] [tinyint] NOT NULL,
	[TypeDetail] [smallint] NOT NULL,
	[NeedWeapon1] [tinyint] NOT NULL,
	[NeedWeapon2] [tinyint] NOT NULL,
	[NeedWeapon3] [tinyint] NOT NULL,
	[NeedWeapon4] [tinyint] NOT NULL,
	[NeedWeapon5] [tinyint] NOT NULL,
	[NeedWeapon6] [tinyint] NOT NULL,
	[NeedWeapon7] [tinyint] NOT NULL,
	[NeedWeapon8] [tinyint] NOT NULL,
	[NeedWeapon9] [tinyint] NOT NULL,
	[NeedWeapon10] [tinyint] NOT NULL,
	[NeedWeapon11] [tinyint] NOT NULL,
	[NeedWeapon12] [tinyint] NOT NULL,
	[NeedWeapon13] [tinyint] NOT NULL,
	[NeedWeapon14] [tinyint] NOT NULL,
	[NeedWeapon15] [tinyint] NOT NULL,
	[Shield] [tinyint] NOT NULL,
	[SP] [smallint] NOT NULL,
	[MP] [smallint] NOT NULL,
	[ReadyTime] [tinyint] NOT NULL,
	[ResetTime] [smallint] NOT NULL,
	[AttackRange] [tinyint] NOT NULL,
	[StateType] [tinyint] NOT NULL,
	[AttrType] [tinyint] NOT NULL,
	[Disable] [smallint] NOT NULL,
	[SuccessType] [tinyint] NOT NULL,
	[SuccessValue] [tinyint] NOT NULL,
	[TargetType] [tinyint] NOT NULL,
	[ApplyRange] [tinyint] NOT NULL,
	[MultiAttack] [tinyint] NOT NULL,
	[KeepTime] [smallint] NOT NULL,
	[Weapon1] [tinyint] NOT NULL,
	[Weapon2] [tinyint] NOT NULL,
	[Weaponvalue] [tinyint] NOT NULL,
	[Bag] [tinyint] NOT NULL,
	[Arrow] [smallint] NOT NULL,
	[DamageType] [tinyint] NOT NULL,
	[DamageHP] [smallint] NOT NULL,
	[DamageSP] [smallint] NOT NULL,
	[DamageMP] [smallint] NOT NULL,
	[TimeDamageType] [tinyint] NOT NULL,
	[TimeDamageHP] [smallint] NOT NULL,
	[TimeDamageSP] [smallint] NOT NULL,
	[TimeDamageMP] [smallint] NOT NULL,
	[AddDamageHP] [smallint] NOT NULL,
	[AddDamageSP] [smallint] NOT NULL,
	[AddDamageMP] [smallint] NOT NULL,
	[AbilityType1] [tinyint] NULL,
	[AbilityValue1] [smallint] NULL,
	[AbilityType2] [tinyint] NULL,
	[AbilityValue2] [smallint] NULL,
	[AbilityType3] [tinyint] NULL,
	[AbilityValue3] [smallint] NULL,
	[HealHP] [smallint] NOT NULL,
	[HealSP] [smallint] NOT NULL,
	[HealMP] [smallint] NOT NULL,
	[TimeHealHP] [smallint] NOT NULL,
	[TimeHealSP] [smallint] NOT NULL,
	[TimeHealMP] [smallint] NOT NULL,
	[DefenceType] [tinyint] NOT NULL,
	[DefenceValue] [tinyint] NOT NULL,
	[LimitHP] [tinyint] NOT NULL,
	[FixRange] [tinyint] NOT NULL,
	[ChangeType] [smallint] NOT NULL,
	[ChangeLevel] [smallint] NOT NULL,
	[UpdateDate] [datetime] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[Skills] ADD  CONSTRAINT [DF_Skills_UpdateDate]  DEFAULT (getdate()) FOR [UpdateDate]
GO


