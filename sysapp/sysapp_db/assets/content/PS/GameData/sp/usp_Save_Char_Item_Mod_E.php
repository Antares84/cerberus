USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Item_Mod_E]    Script Date: 8/15/2014 12:04:20 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



/****** 개체: 저장 프로시저 dbo.usp_Save_Char_Item_Mod_E    스크립트 날짜: 2006-04-11 오후 10:58:15 ******/


CREATE   Proc [dbo].[usp_Save_Char_Item_Mod_E]

@CharID int,
@ItemUID bigint = Null, -- 일반 작업시

-- 삭제만 필요한 경우 여기까지만 사용
-- 나머지는 기본값 Null 적용
@Bag tinyint = Null, 
@Slot tinyint = Null, 
@Quality smallint = Null, 
@Gem1 tinyint = Null, 
@Gem2 tinyint = Null, 
@Gem3 tinyint = Null, 
@Gem4 tinyint = Null,  
@Gem5 tinyint = Null, 
@Gem6 tinyint = Null, 
@Craftname varchar(20) = '',
@Count tinyint = Null,
@Qry varchar(8000) = ''

AS

--SET NOCOUNT ON

UPDATE CharItems
SET Bag=@Bag, Slot=@Slot, Quality=@Quality, Gem1=@Gem1, Gem2=@Gem2, Gem3=@Gem3, Gem4=@Gem4, Gem5=@Gem5, Gem6=@Gem6, 
[Count]=@Count, Craftname=@Craftname
WHERE CharID=@CharID AND ItemUID = @ItemUID

IF(@@ERROR = 0)
BEGIN
	RETURN 1
END
ELSE
BEGIN	
	RETURN -1
END

--SET NOCOUNT OFF




GO


