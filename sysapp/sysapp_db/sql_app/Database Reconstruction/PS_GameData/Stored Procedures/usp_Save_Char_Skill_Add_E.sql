USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Skill_Add_E]    Script Date: 8/15/2014 12:06:14 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_Skill_Add_E]

@CharID int,
@SkillID smallint,
@SkillLevel tinyint,
@Number tinyint,
@Delay smallint

AS

SET NOCOUNT ON

INSERT INTO CharSkills(CharID,SkillID,SkillLevel,Number,[Delay]) VALUES(@CharID,@SkillID,@SkillLevel,@Number,@Delay)

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


