USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Guild_StoredItem_Add_E]    Script Date: 8/15/2014 12:08:24 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO




CREATE  Proc [dbo].[usp_Save_Guild_StoredItem_Add_E]

@GuildID int,
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

SET NOCOUNT ON

INSERT INTO GuildStoredItems
(GuildID, Slot, ItemID, Type, TypeID, ItemUID, quality, gem1, gem2, gem3, gem4, 
gem5, gem6, craftname, [count], maketime, maketype)
VALUES(@GuildID, @Slot, @ItemID, @Type, @TypeID, @ItemUID, @Quality, @Gem1, @Gem2, @Gem3, @Gem4, 
@Gem5, @Gem6, @Craftname, @Count, @Maketime, @Maketype)

IF(@@ERROR = 0)
BEGIN
	RETURN 1
END
ELSE
BEGIN	
	RETURN -1
END

SET NOCOUNT OFF





GO


