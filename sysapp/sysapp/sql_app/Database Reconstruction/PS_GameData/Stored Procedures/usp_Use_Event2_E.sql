USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Use_Event2_E]    Script Date: 8/15/2014 12:11:42 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Use_Event2_E]

@CharID int,
@GetPoint int

AS

SET NOCOUNT ON

DECLARE @Cnt int
DECLARE @UseCount int
DECLARE @SkillPoint smallint

SELECT @SkillPoint=SkillPoint FROM Chars WHERE CharID=@CharID

SELECT @UseCount=Event2 FROM CharEvents WHERE CharID=@CharID

IF( @UseCount IS NULL )
BEGIN
	SET @UseCount = 1
	INSERT CharEvents(CharID, Event2) VALUES (@CharID, @UseCount)
END
ELSE
BEGIN
	SET @UseCount = @UseCount + 1
	UPDATE CharEvents SET Event2=@UseCount WHERE CharID=@CharID
END

INSERT EventLog_CharSkill1(CharID, UseCount, GetPoint, SkillPoint, UseDate) 
VALUES (@CharID, @UseCount, @GetPoint, @SkillPoint, GETDATE())

INSERT INTO EventLog_CharSkill2(CharID, UseCount, SkillID, SkillLevel, Number, CreateTime)
SELECT CharID, @UseCount, SkillID, SkillLevel, Number, CreateTime FROM CharSkills WHERE CharID=@CharID AND Del=0

IF( @@ERROR = 0 )
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF


GO


