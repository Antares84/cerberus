USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_StoredItem_Add_E]    Script Date: 8/15/2014 12:10:26 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


/****** 개체: 저장 프로시저 dbo.usp_Save_User_StoredItem_Add_E    스크립트 날짜: 2006-04-11 오후 10:58:39 ******/


CREATE  Proc [dbo].[usp_Save_User_StoredItem_Add_E]

@ServerID tinyint,
@UserUID int,
@ItemUID bigint,
@Slot tinyint,
@ItemID int,
@Type tinyint,
@TypeID tinyint,
@Quality smallint,
@Gem1 tinyint,
@Gem2 tinyint,
@Gem3 tinyint,
@Gem4 tinyint,
@Gem5 tinyint,
@Gem6 tinyint,
@Craftname varchar(20) = '', 
@Count tinyint,
@Maketime datetime,
@Maketype char(1)

AS

--SET NOCOUNT ON

INSERT INTO UserStoredItems
(ServerID, UserUID, Slot, ItemID, Type, TypeID, ItemUID, quality, gem1, gem2, gem3, gem4, 
gem5, gem6, craftname, [count], maketime, maketype)
VALUES(@ServerID, @UserUID, @Slot, @ItemID, @Type, @TypeID, @ItemUID, @Quality, @Gem1, @Gem2, @Gem3, @Gem4, 
@Gem5, @Gem6, @Craftname, @Count, @Maketime, @Maketype)

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


