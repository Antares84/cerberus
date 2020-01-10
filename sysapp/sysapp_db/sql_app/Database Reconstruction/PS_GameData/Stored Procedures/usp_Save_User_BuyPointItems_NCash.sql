USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_BuyPointItems_NCash]    Script Date: 8/15/2014 12:09:27 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



/****** Shoping Mall	Fixed by sandolkakos	Website: www.universalgamesonline.com.br ******/



CREATE Proc [dbo].[usp_Save_User_BuyPointItems_NCash]

@UserUID int,
@CharID int,
@UsePoint int,
@ProductCode varchar(20),
@UseDate datetime

AS

SET NOCOUNT ON
SET XACT_ABORT ON

DECLARE @UseType int
DECLARE @ReturnValue int

SET @UseType = 1 -- 掘衙

BEGIN DISTRIBUTED TRANSACTION

EXEC @ReturnValue = PS_UserData.dbo.usp_Update_UserPoint @UserUID, @UsePoint
IF ( @ReturnValue < 0 )
BEGIN
	GOTO ERROR
END

INSERT INTO PointLog(UseType,UserUID,CharID,UsePoint,ProductCode,UseDate)
VALUES(@UseType,@UserUID,@CharID,@UsePoint,@ProductCode,@UseDate)
IF( @@ERROR<>0)
BEGIN
	GOTO ERROR
END

COMMIT TRAN
RETURN 1

ERROR:
ROLLBACK TRAN
RETURN -1

SET XACT_ABORT OFF
SET NOCOUNT OFF


GO


