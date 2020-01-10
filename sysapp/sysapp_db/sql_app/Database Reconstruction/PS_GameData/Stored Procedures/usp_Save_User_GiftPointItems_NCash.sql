USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_GiftPointItems_NCash]    Script Date: 8/15/2014 12:09:58 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO





/*==================================================
@author	lenasoft
@date	2006-09-22
@return	@Ret

	  0 = 성공
	  1 = 해당서버에 케릭터명이 존재하지 않음.
	  2 = 같은 개정임
	  3 = 아이템 보유수량 초과(포인트개정슬롯 꽉참)
	  4 = 슬롯부족(아이템을 추가할수 없음)
	  5 = 인서트 오류
	  6 = 상품테이블 데이타오류(해당 상품코드 존재하지 않음)
	  7 = 포인트 차감 실패.
	  8 = 로그기록 실패.
	 10= 포인트부족

@brief	유저에게 포인트아이템을 선물한다.
==================================================*/

CREATE Proc [dbo].[usp_Save_User_GiftPointItems_NCash]
@TargetUserID		int output,
@TargetCharName 	varchar(30),
@ProductCode 		varchar(20),

@BuyUserUID		int,
@BuyCharID		int,
@UsePoint 		int,
@UseDate 		datetime,
@BuyUserID		varchar(30)

AS

SET NOCOUNT ON
--SET XACT_ABORT ON

DECLARE @SlotCnt		int
DECLARE @SlotMax		int
DECLARE @SlotUse		int
DECLARE @I			int
DECLARE @J			int
DECLARE @StrItemID		varchar(20)
DECLARE @StrItemCount	varchar(20)
DECLARE @Query		nvarchar(1000)
DECLARE @ItemID		int
DECLARE @ItemCount		tinyint
DECLARE @Ret		int

-----------------------------------------------
--DECLARE @UserUID	int
DECLARE @UseType	int
--DECLARE @OrderNumber  	int
--DECLARE @RemainPoint  	int

SET @UseType = 2 --선물
SET @TargetUserID = 0
-----------------------------------------------

SET @Ret = 0
SET @SlotMax = 240


SELECT @TargetUserID = UserUID FROM Chars WHERE CharName = @TargetCharName AND Del = 0
IF( @TargetUserID = 0 OR @TargetUserID IS NULL )
BEGIN
	-- 해당서버에 케릭터명이 존재하지 않음.
	SET @Ret = 1
	RETURN @Ret
END

IF( @TargetUserID = @BuyUserUID )
BEGIN
	-- 같은 개정임
	SET @Ret = 2
	RETURN @Ret
END


BEGIN TRANSACTION


CREATE TABLE #SlotList( SlotNum int NOT NULL )
CREATE TABLE #InsertSlotList( SlotNum tinyint NOT NULL, ItemID int NOT NULL, ItemCount tinyint NOT NULL)

INSERT INTO #SlotList SELECT Slot FROM UserStoredPointItems WHERE UserUID=@TargetUserID ORDER BY Slot

SET @SlotCnt = ( SELECT ISNULL(COUNT(*),0) FROM #SlotList )

IF( @SlotCnt >= @SlotMax )
BEGIN
	-- 아이템 보유수량 초과(포인트개정슬롯 꽉참)
	SET @Ret = 3
	GOTO ERROR_RETURN
END

SET @I = 1

WHILE( @I <= 24 )
BEGIN
	SET @StrItemID = 'ItemID' + CAST( @I AS varchar(5) )
	SET @StrItemCount = 'ItemCount' + CAST( @I AS varchar(5) )

	SET @Query = 'SELECT @ItemID='+@StrItemID+', @ItemCount='+@StrItemCount+' FROM PS_DEFINEDB.PS_GameDefs.dbo.ProductList WHERE ProductCode=''' +@ProductCode+''''
	EXEC sp_executesql @Query, N'@ItemID int OUTPUT, @ItemCount tinyint OUTPUT', @ItemID OUTPUT, @ItemCount OUTPUT

	IF( (@ItemID IS NOT NULL) AND (@ItemCount IS NOT NULL) AND (@ItemID <> 0) ) 
	BEGIN
		SET @J = 0

		WHILE( @J < @SlotMax )
		BEGIN
			SET @SlotUse = ( SELECT ISNULL(COUNT(*),0) FROM #SlotList WHERE SlotNum=@J )
			IF( @SlotUse = 0 )
			BEGIN
				INSERT INTO UserStoredPointItems(UserUID,Slot,ItemID,ItemCount) VALUES(@TargetUserID,@J,@ItemID,@ItemCount)
				IF( @@ERROR = 0 )
				BEGIN
					INSERT INTO #SlotList(SlotNum) VALUES(@J)
					INSERT INTO #InsertSlotList(SlotNum, ItemID, ItemCount ) VALUES(@J, @ItemID, @ItemCount)
					BREAK
				END
				ELSE
				BEGIN
					-- 인서트 오류
					SET @Ret = 5
					GOTO ERROR_RETURN
				END
			END
			
			SET @J = @J + 1
		END

		IF( @J >= @SlotMax )
		BEGIN
			-- 슬롯부족(아이템을 추가할수 없음)
			SET @Ret = 4
			GOTO ERROR_RETURN
		END
	END
	ELSE IF( @I = 1 )
	BEGIN
		-- 상품테이블 데이타오류(해당 상품코드 존재하지 않음)
		SET @Ret = 6
		GOTO ERROR_RETURN
	END

	SET @I = @I + 1
END
		
-- Insert Log
INSERT INTO PointLog(UseType,UserUID,CharID,UsePoint,ProductCode,UseDate,TargetName)
VALUES(@UseType,@BuyUserUID,@BuyCharID,@UsePoint,@ProductCode,@UseDate,@TargetCharName)
IF( @@ERROR<>0 )
BEGIN
	SET @Ret = 8
	GOTO ERROR_RETURN
END

-- Select
SELECT SlotNum, ItemID, ItemCount FROM #InsertSlotList

ERROR_RETURN:

DROP TABLE #SlotList
DROP TABLE #InsertSlotList

IF( @@ERROR = 0 AND @Ret = 0 )
BEGIN
	COMMIT TRAN 
	RETURN 0
END
ELSE
BEGIN
	ROLLBACK TRAN
	RETURN @Ret
END

SET NOCOUNT OFF
--SET XACT_ABORT OFF
GO


