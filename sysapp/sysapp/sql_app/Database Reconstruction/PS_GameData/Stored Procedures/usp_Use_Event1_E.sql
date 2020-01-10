USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Use_Event1_E]    Script Date: 8/15/2014 12:11:32 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Use_Event1_E]

@CharID int,
@GetPoint int

AS

SET NOCOUNT ON

DECLARE @Cnt int
DECLARE @UseCount int
DECLARE @StatPoint smallint
DECLARE @Str smallint
DECLARE @Dex smallint
DECLARE @Rec smallint
DECLARE @Int smallint
DECLARE @Luc smallint
DECLARE @Wis smallint

SELECT @StatPoint=StatPoint, @Str=Str, @Dex=Dex, @Rec=Rec, @Int=[Int], @Luc=Luc, @Wis=Wis FROM Chars WHERE CharID=@CharID

SELECT @UseCount=Event1 FROM CharEvents WHERE CharID=@CharID

IF( @UseCount IS NULL )
BEGIN
	SET @UseCount = 1
	INSERT CharEvents(CharID, Event1) VALUES (@CharID, @UseCount)
END
ELSE
BEGIN
	SET @UseCount = @UseCount + 1
	UPDATE CharEvents SET Event1=@UseCount WHERE CharID=@CharID
END

INSERT EventLog_CharStat(CharID, UseCount, GetPoint, StatPoint, Str, Dex, Rec, [Int], Luc, Wis, UseDate) 
VALUES (@CharID, @UseCount, @GetPoint, @StatPoint, @Str, @Dex, @Rec, @Int, @Luc, @Wis, GETDATE())

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


