USE [PS_GameLog]
GO

/****** Object:  StoredProcedure [dbo].[usp_Insert_ItemMake_Log_E]    Script Date: 8/15/2014 11:55:48 PM ******/

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Insert_ItemMake_Log_E]

@MakeTime datetime,
@MakeType char(1) = '',
@MobID smallint = null,
@MapID smallint,
@PosX real = null,
@PosY real = null,
@PosZ real = null, 
@FOID int = null,
@ShopID int = null,
@ItemID int = null,
@ItemUID bigint = null,
@ItemName varchar(30) = ''

AS

IF(@ItemName = '')
BEGIN
	SET @ItemName = (SELECT ItemName FROM PS_GameDefs.dbo.Items WHERE ItemID = @ItemID)
END

INSERT INTO PS_GameLog.dbo.ItemMakeLog(MakeTime, MakeType, MapID,  MobID, PosX, PosY, PosZ, 
FirstOwnerableID, ShopID, ItemID, ItemUID, ItemName)
VALUES(@MakeTime, @MakeType, @MapID, @MobID, @PosX, @PosY, @PosZ, @FOID, @ShopID, @ItemID, @ItemUID, @ItemName)

GO