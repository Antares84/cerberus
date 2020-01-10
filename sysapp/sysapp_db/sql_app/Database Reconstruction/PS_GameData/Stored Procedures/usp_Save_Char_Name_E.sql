USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Name_E]    Script Date: 8/15/2014 12:04:56 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

CREATE   Proc [dbo].[usp_Save_Char_Name_E]

@ServerID tinyint,
@CharID int,
@OldCharName nvarchar(30),
@NewCharName nvarchar(30)

AS

SET NOCOUNT ON

SET @OldCharName = LTRIM(RTRIM(@OldCharName))
SET @NewCharName = LTRIM(RTRIM(@NewCharName))

IF EXISTS ( SELECT CharID FROM Chars WHERE CharName=@NewCharName AND Del=0)
BEGIN
	RETURN -2
END

UPDATE Chars SET CharName=@NewCharName,RenameCnt=RenameCnt-1,OldCharName=@OldCharName WHERE CharID=@CharID AND Del=0
IF @@ERROR <> 0
BEGIN
	GOTO ERROR_ROLLBACK
END

UPDATE Guilds SET MasterName=@NewCharName WHERE MasterCharID=@CharID
UPDATE FriendChars SET FriendName=@NewCharName WHERE FriendID=@CharID
UPDATE BanChars SET BanName=@NewCharName WHERE BanID=@CharID
INSERT INTO CharRenameLog( ServerID, CharID, CharName) VALUES(@ServerID, @CharID, @NewCharName )
RETURN 1
ERROR_ROLLBACK:
RETURN -2
SET NOCOUNT OFF
GO


