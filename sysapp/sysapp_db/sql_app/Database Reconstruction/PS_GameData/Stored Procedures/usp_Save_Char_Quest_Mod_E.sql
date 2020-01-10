USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Quest_Mod_E]    Script Date: 8/15/2014 12:05:36 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_Quest_Mod_E]

@CharID int,
@QuestID smallint,
@Delay smallint = Null,
@Count1 tinyint = Null,
@Count2 tinyint = Null,
@Count3 tinyint = Null

AS

SET NOCOUNT ON

UPDATE CharQuests SET [Delay]=@Delay,Count1=@Count1,Count2=@Count2,Count3=@Count3 WHERE CharID=@CharID AND QuestID=@QuestID

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


