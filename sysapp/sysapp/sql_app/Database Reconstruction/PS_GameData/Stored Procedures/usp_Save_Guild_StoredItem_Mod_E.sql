USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Guild_StoredItem_Mod_E]    Script Date: 8/15/2014 12:08:40 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO




CREATE   Proc [dbo].[usp_Save_Guild_StoredItem_Mod_E]

@GuildID int,
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

SET NOCOUNT ON

UPDATE GuildStoredItems
SET Slot=@Slot,Quality=@Quality,Gem1=@Gem1,Gem2=@Gem2,Gem3=@Gem3,Gem4=@Gem4,Gem5=@Gem5,Gem6=@Gem6, 
Craftname=@Craftname,[Count]=@Count
WHERE GuildID=@GuildID AND ItemUID=@ItemUID

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


