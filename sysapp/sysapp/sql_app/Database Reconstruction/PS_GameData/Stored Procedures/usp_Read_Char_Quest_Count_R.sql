USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_Quest_Count_R]    Script Date: 8/14/2014 11:51:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_Char_Quest_Count_R]

@CharID int,
@QuestID int

AS

SET NOCOUNT ON

SELECT Count1,Count2,Count3 FROM CharQuests WHERE CharID=@CharID AND QuestID=@QuestID

SET NOCOUNT OFF


GO


