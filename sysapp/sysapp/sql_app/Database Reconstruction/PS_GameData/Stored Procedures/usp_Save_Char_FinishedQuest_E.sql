USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_FinishedQuest_E]    Script Date: 8/15/2014 12:03:30 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_FinishedQuest_E]

@CharID int,
@QuestID smallint,
@Success tinyint,
@Insert bit = 0

AS

SET NOCOUNT ON

IF(@Insert = 0)
BEGIN
	UPDATE CharQuests SET Success=@Success,Finish=1 WHERE CharID=@CharID AND QuestID=@QuestID
END
ELSE
BEGIN
	INSERT INTO CharQuests(CharID,QuestID,[Delay],Success,Finish) VALUES(@CharID,@QuestID,0,@Success,1)
END

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


