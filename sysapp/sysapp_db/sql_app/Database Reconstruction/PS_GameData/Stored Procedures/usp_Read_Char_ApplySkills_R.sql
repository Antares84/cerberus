USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_ApplySkills_R]    Script Date: 8/14/2014 11:48:21 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_Char_ApplySkills_R]

@CharID int

AS

SET NOCOUNT ON

SELECT SkillID,SkillLevel,LeftResetTime FROM CharApplySkills WHERE CharID=@CharID

SET NOCOUNT OFF


GO


