USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Update_Char_Rename]    Script Date: 8/15/2014 12:11:22 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO




/*==================================================
@author	lenasoft
@date	2006-10-26
@return	@Ret
	 -1 	= 중복케릭명 있음.
	   1 	= 성공
	-2 	= 실패

@brief	GMTool상에서 케릭명 변경.
==================================================*/
CREATE  Proc [dbo].[usp_Update_Char_Rename]

@ServerID tinyint,
@CharID int,
@OldCharName nvarchar(30),
@NewCharName nvarchar(30),
@Ret int OUTPUT
AS

SET NOCOUNT ON
--SET XACT_ABORT ON

--DECLARE @NameCnt int

SET @OldCharName = LTRIM(RTRIM(@OldCharName))
SET @NewCharName = LTRIM(RTRIM(@NewCharName))

SET @Ret = 0

IF EXISTS ( SELECT CharID FROM Chars WHERE CharName=@NewCharName AND Del=0)
BEGIN
	SET @Ret = -1
	RETURN -1
END

BEGIN TRANSACTION

UPDATE Chars SET CharName=@NewCharName,OldCharName=@OldCharName WHERE CharID=@CharID-- AND Del=0
IF @@ERROR <> 0
BEGIN
	GOTO ERROR_ROLLBACK
END
UPDATE Guilds SET MasterName=@NewCharName WHERE MasterCharID=@CharID
IF @@ERROR <> 0
BEGIN
	GOTO ERROR_ROLLBACK
END
UPDATE FriendChars SET FriendName=@NewCharName WHERE FriendID=@CharID
IF @@ERROR <> 0
BEGIN
	GOTO ERROR_ROLLBACK
END
UPDATE BanChars SET BanName=@NewCharName WHERE BanID=@CharID
IF @@ERROR <> 0
BEGIN
	GOTO ERROR_ROLLBACK
END

INSERT INTO CharRenameLog( ServerID, CharID, CharName) VALUES(@ServerID, @CharID, @NewCharName )
IF @@ERROR <> 0
BEGIN
	GOTO ERROR_ROLLBACK
END

COMMIT TRANSACTION
SET @Ret = 1
RETURN 1


ERROR_ROLLBACK:
ROLLBACK TRANSACTION
SET @Ret = -2
RETURN -2


--SET XACT_ABORT OFF
SET NOCOUNT OFF


GO


