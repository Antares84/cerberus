USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_SkillMaxID_R]    Script Date: 8/14/2014 10:48:22 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO


CREATE Proc [dbo].[usp_Read_SkillMaxID_R]
AS

WAITFOR DELAY '00:01';

SELECT MAX(SkillID)
FROM Skills
WHERE SkillLevel < 100
GO


