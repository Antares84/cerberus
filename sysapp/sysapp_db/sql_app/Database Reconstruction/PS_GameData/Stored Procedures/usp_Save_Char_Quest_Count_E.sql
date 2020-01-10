USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Quest_Count_E]    Script Date: 8/15/2014 12:05:14 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_Quest_Count_E]

@CharID int,
@QuestID int,
@Count1 int,
@Count2 int,
@Count3 int

AS

SET NOCOUNT ON

UPDATE CharQuests SET Count1=@Count1, Count2=@Count2, Count3=@Count3 WHERE CharID=@CharID AND QuestID=@QuestID

SET NOCOUNT OFF


GO


