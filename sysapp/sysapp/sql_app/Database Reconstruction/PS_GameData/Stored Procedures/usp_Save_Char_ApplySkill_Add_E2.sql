USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_ApplySkill_Add_E2]    Script Date: 8/15/2014 12:01:11 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO






CREATE Proc [dbo].[usp_Save_Char_ApplySkill_Add_E2]

@CharID int,
@SkillID smallint,
@SkillLevel tinyint,
@LeftResetTime int

AS

SET NOCOUNT ON

INSERT INTO CharApplySkills(CharID,Skillid,SkillLevel,LeftResetTime) VALUES(@CharID,@Skillid,@SkillLevel,@LeftResetTime)

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


