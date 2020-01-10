USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Quest_Del_E]    Script Date: 8/15/2014 12:05:26 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO






CREATE   Proc [dbo].[usp_Save_Char_Quest_Del_E]

@CharID int,
@QuestID smallint

AS

SET NOCOUNT ON

DELETE CharQuests WHERE CharID=@CharID AND QuestID=@QuestID
--UPDATE CharQuests SET Del=1 WHERE CharID=@CharID AND QuestID=@QuestID

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


