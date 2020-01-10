USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_ApplySkill_Mod_E2]    Script Date: 8/15/2014 12:01:41 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO






CREATE Proc [dbo].[usp_Save_Char_ApplySkill_Mod_E2]

@CharID int,
@SkillID smallint,
@SkillLevel tinyint,
@LeftResetTime int

AS

SET NOCOUNT ON

-- 쿨타임만 변경됨..
UPDATE CharApplySkills
SET [LeftResetTime] = @LeftResetTime
WHERE CharID=@CharID AND SkillID=@SkillID AND SkillLevel=@SkillLevel

IF(@@ERROR = 0)
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF





GO


