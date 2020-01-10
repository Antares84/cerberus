USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Quest_Add_E]    Script Date: 8/15/2014 12:05:04 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_Quest_Add_E]

@CharID int,
@QuestID smallint,
@Delay smallint = Null,
@Count1 tinyint = Null,
@Count2 tinyint = Null,
@Count3 tinyint = Null

AS

SET NOCOUNT ON

INSERT INTO CharQuests(CharID,QuestID,[Delay],Count1,Count2,Count3) VALUES(@CharID,@QuestID,@Delay,@Count1,@Count2,@Count3)

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


