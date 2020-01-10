USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Skill_Mod_E]    Script Date: 8/15/2014 12:06:34 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_Skill_Mod_E]

@CharID int,
@SkillID smallint,
@SkillLevel tinyint,
@Delay smallint

AS

SET NOCOUNT ON

UPDATE CharSkills SET SkillLevel=@SkillLevel,[Delay]=@Delay WHERE CharID=@CharID AND SkillID=@SkillID

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


