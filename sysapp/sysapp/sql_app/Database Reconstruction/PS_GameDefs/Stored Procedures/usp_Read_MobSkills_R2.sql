USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_MobSkills_R2]    Script Date: 8/14/2014 10:47:50 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO






CREATE Proc [dbo].[usp_Read_MobSkills_R2]
@SkillID smallint
AS

SET NOCOUNT ON

SELECT SkillID, SkillLevel, SkillName, Country, Attackfighter, Defensefighter, Patrolrogue, Shootrogue, Attackmage, Defensemage, 
PrevSkillID, ReqLevel, Grow, SkillPoint, TypeShow, TypeAttack, TypeEffect, TypeDetail, 
NeedWeapon1, NeedWeapon2, NeedWeapon3, NeedWeapon4, NeedWeapon5, NeedWeapon6, NeedWeapon7, NeedWeapon8, 
NeedWeapon9, NeedWeapon10, NeedWeapon11, NeedWeapon12, NeedWeapon13, NeedWeapon14, NeedWeapon15, 
Shield, SP, MP, ReadyTime, ResetTime, AttackRange, StateType, AttrType, Disable, 
SuccessType, SuccessValue, TargetType, ApplyRange, MultiAttack, KeepTime, 
Weapon1, Weapon2, Weaponvalue, Bag, Arrow, 
DamageType, DamageHP, DamageSP, DamageMP, TimeDamageType, TimeDamageHP, TimeDamageSP, TimeDamageMP, 
AddDamageHP, AddDamageSP, AddDamageMP, 
AbilityType1, AbilityValue1, AbilityType2, AbilityValue2, AbilityType3, AbilityValue3,
HealHP, HealSP, HealMP, TimeHealHP, TimeHealSP, TimeHealMP, 
DefenceType, DefenceValue, LimitHP, FixRange, ChangeType, ChangeLevel
FROM Skills
WHERE SkillID = @SkillID AND SkillLevel = 100


SET NOCOUNT OFF




GO


