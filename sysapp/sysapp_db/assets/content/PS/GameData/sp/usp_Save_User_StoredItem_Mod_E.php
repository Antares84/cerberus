USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_StoredItem_Mod_E]    Script Date: 8/15/2014 12:10:46 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


/****** 개체: 저장 프로시저 dbo.usp_Save_User_StoredItem_Mod_E    스크립트 날짜: 2006-04-11 오후 10:59:25 ******/


CREATE   Proc [dbo].[usp_Save_User_StoredItem_Mod_E]

@ServerID tinyint,
@UserUID int,
@ItemUID bigint,
@Slot tinyint,
@Quality smallint,
@Gem1 tinyint,
@Gem2 tinyint,
@Gem3 tinyint,
@Gem4 tinyint,
@Gem5 tinyint,
@Gem6 tinyint,
@Count tinyint,
@Craftname varchar(20)

AS

--SET NOCOUNT ON

UPDATE UserStoredItems
SET Slot=@Slot,Quality=@Quality,Gem1=@Gem1,Gem2=@Gem2,Gem3=@Gem3,Gem4=@Gem4,Gem5=@Gem5,Gem6=@Gem6, 
Craftname=@Craftname,[Count]=@Count
WHERE ServerID=@ServerID AND UserUID=@UserUID AND ItemUID=@ItemUID

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


