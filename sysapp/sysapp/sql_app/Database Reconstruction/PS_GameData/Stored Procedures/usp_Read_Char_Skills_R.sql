USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_Skills_R]    Script Date: 8/14/2014 11:51:47 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE  Proc [dbo].[usp_Read_Char_Skills_R]

@CharID int

AS

SET NOCOUNT ON

SELECT SkillID,SkillLevel,Number,[Delay] FROM CharSkills WHERE CharID=@CharID AND Del=0 ORDER BY Number ASC

SET NOCOUNT OFF


GO


