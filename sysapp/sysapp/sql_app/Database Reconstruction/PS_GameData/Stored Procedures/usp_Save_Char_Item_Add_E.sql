USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Item_Add_E]    Script Date: 8/15/2014 12:03:59 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



/****** 개체: 저장 프로시저 dbo.usp_Save_Char_Item_Add_E ******/


CREATE Proc [dbo].[usp_Save_Char_Item_Add_E]

@CharID int,
@ItemUID bigint,
@Bag tinyint,
@Slot tinyint,
@ItemID int,
@Type tinyint,
@TypeID tinyint,
@Quality int,
@Gem1 tinyint,
@Gem2 tinyint,
@Gem3 tinyint,
@Gem4 tinyint,
@Gem5 tinyint,
@Gem6 tinyint,
@Craftname varchar(20) = '',
@Count tinyint,
@MaketimeZ varchar(50),
@Maketype char(1)

AS
DECLARE @Maketime as datetime
SELECT @Maketime = CONVERT(datetime, @MaketimeZ, 120)
--SET NOCOUNT ON

IF(@Quality >= 5000)
BEGIN
SET @Quality=0
END

INSERT INTO CharItems
(CharID, bag, slot, ItemID, Type, TypeID, ItemUID, quality, gem1, gem2, gem3, gem4,
gem5, gem6, craftname, [count], maketime, maketype)
VALUES(@CharID, @Bag, @Slot, @ItemID, @Type, @TypeID, @ItemUID, @Quality, @Gem1, @Gem2, @Gem3, @Gem4,
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


