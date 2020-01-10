USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_MobSkillMaxID_R]    Script Date: 8/14/2014 10:47:26 PM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER OFF
GO


CREATE Proc [dbo].[usp_Read_MobSkillMaxID_R]
AS
SELECT MAX(SkillID)
FROM Skills
WHERE SkillLevel = 100


GO


