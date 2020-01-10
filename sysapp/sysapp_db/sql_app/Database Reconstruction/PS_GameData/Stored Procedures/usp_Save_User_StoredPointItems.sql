USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_StoredPointItems]    Script Date: 8/15/2014 12:11:03 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



/*==================================================
@author	lenasoft
@date	2006-09-25
@return	

@brief	유저의 포인트아이템을 저장한다..
==================================================*/
CREATE    Proc [dbo].[usp_Save_User_StoredPointItems]

@UserUID int,
@BankSlot tinyint,

@CharID int,
@ItemUID bigint,
@Bag tinyint,
@Slot tinyint,
@ItemID int,
@Type tinyint,
@TypeID tinyint,
@Quality smallint,	--int
@Gem1 tinyint,
@Gem2 tinyint,
@Gem3 tinyint,
@Gem4 tinyint,
@Gem5 tinyint,
@Gem6 tinyint,
@Craftname varchar(20) = '', 
@Count tinyint,
@Maketime datetime,
@Maketype varchar(1)	--char(1)

AS

SET NOCOUNT ON
SET XACT_ABORT ON

DECLARE @ProductCode varchar(20)
DECLARE @OrderNumber int
DECLARE @VerifyCode bigint
DECLARE @BuyDate datetime

IF(@Quality >= 5000)
BEGIN
	SET @Quality=0
END

BEGIN DISTRIBUTED TRANSACTION

-- 인벤토리 추가
INSERT INTO CharItems(CharID,Bag,Slot,ItemID,Type,TypeID,ItemUID,Quality,Gem1,Gem2,Gem3,Gem4, 
Gem5,Gem6,CraftName,[Count],Maketime,Maketype)
VALUES(@CharID,@Bag,@Slot,@ItemID,@Type,@TypeID,@ItemUID,@Quality,@Gem1,@Gem2,@Gem3,@Gem4, 
@Gem5,@Gem6,@Craftname,@Count,@Maketime,@Maketype)

-- 상품수령로그 기록
-- None

-- 저장된포인트아이템 삭제
DELETE FROM UserStoredPointItems WHERE UserUID=@UserUID AND Slot=@BankSlot

IF( @@ERROR=0 AND @@ROWCOUNT=1)
BEGIN
	COMMIT TRAN
	RETURN 1
END
ELSE
BEGIN
	ROLLBACK TRAN
	RETURN -1
END

SET XACT_ABORT OFF
SET NOCOUNT OFF
GO


