USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_NCash]    Script Date: 8/15/2014 12:10:10 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO





CREATE  Proc [dbo].[usp_Save_User_NCash]
@BuyUserUID		int,
@TargetUserID		int,
@ProductCode 		varchar(20)

AS

SET NOCOUNT ON

DECLARE @Ret		int
DECLARE @OrderNumber  	int
DECLARE @RemainPoint  	int

SET @Ret = 0

EXEC dbo.procRequestOrderProductByGame @BuyUserUID,@TargetUserID,@ProductCode,@Ret OUTPUT, @RemainPoint OUTPUT, @OrderNumber OUTPUT
IF( @@ERROR <> 0 )
BEGIN
	INSERT INTO PointErrorLog( UserUID, CharID, ProductCode, Ret) 	VALUES( @BuyUserUID, NULL, @ProductCode, 100 )
	SET @Ret = 7
	RETURN @Ret
END

IF ( @Ret <> 0 )
BEGIN
	INSERT INTO PointErrorLog( UserUID, CharID, ProductCode, Ret) 	VALUES( @BuyUserUID, NULL, @ProductCode, @Ret )
END

SET @Ret = CASE @Ret
		WHEN 0 THEN 0 
		WHEN 1 THEN 10 
		WHEN 2 THEN 1
		WHEN 3 THEN 6
		ELSE 7
END


RETURN @Ret

SET NOCOUNT OFF
--SET XACT_ABORT OFF
GO


