USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_FinishedQuest_R]    Script Date: 8/14/2014 11:49:32 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_Char_FinishedQuest_R]

@CharID int

AS

SET NOCOUNT ON

SELECT QuestID,Success FROM CharQuests WHERE CharID=@CharID AND Finish=1

SET NOCOUNT OFF


GO


