USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_ApplySkill_Del_E]    Script Date: 8/15/2014 12:01:24 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_ApplySkill_Del_E]

@CharID int,
@SkillID smallint,
@SkillLevel tinyint,
@DeleteAll bit = 0

AS

SET NOCOUNT ON

IF(@DeleteAll = 0)
BEGIN
	DELETE CharApplySkills WHERE CharID=@CharID AND SKillID=@SkillID AND SkillLevel=@SkillLevel
END
ELSE
BEGIN
	DELETE CharApplySkills WHERE CharID=@CharID
END

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


