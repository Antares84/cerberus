USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_Quest_R]    Script Date: 8/14/2014 11:51:21 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_Char_Quest_R]

@CharID int

AS

SET NOCOUNT ON

SELECT QuestID, [Delay], Count1, Count2, Count3 FROM CharQuests WHERE CharID=@CharID AND Finish=0 AND Del=0

SET NOCOUNT OFF


GO


