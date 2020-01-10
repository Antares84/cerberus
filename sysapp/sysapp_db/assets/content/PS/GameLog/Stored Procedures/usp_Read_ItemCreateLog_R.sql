USE [PS_GameLog]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_ItemCreateLog_R]    Script Date: 8/16/2014 12:09:11 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE  Proc [dbo].[usp_Read_ItemCreateLog_R]

@ItemID varchar(70) = '',
--@ItemName varchar(30) = '',
@MakeType char(1) = '',
@StDate datetime = null,
@EnDate datetime = null,
@Cond varchar(300) = '',
@Sql varchar(1000) = ''

AS

SET @Sql = 'SELECT MakeTime, MakeType, MobID, MapID, 
PosX, PosY, PosZ, FirstOwnerableID, ShopID, ItemID, ItemUID, ItemName 
FROM PS_GameLog.dbo.ItemMakeLog'

IF(@ItemID <> '')
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( ItemID IN (''' + @ItemID + ''') ) '
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( ItemID IN (''' + @ItemID + ''') ) '
	END
END

IF(@MakeType <> '')
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( MakeType = ''' + @MakeType + ''' ) '
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( MakeType = ''' + @MakeType + ''' ) '
	END
END

IF( (@StDate IS NOT NULL) AND (@EnDate IS NOT NULL) )
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( MakeTime >= ''' + CONVERT(varchar(40), @StDate, 120) + ''' AND MakeTime <= '''  + CONVERT(varchar(40), @EnDate, 120) + ''' ) ' 
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( MakeTime >= ''' + CONVERT(varchar(40), @StDate, 120) + ''' AND MakeTime <= '''  + CONVERT(varchar(40), @EnDate, 120) + ''' ) ' 
	END
END

IF(@Cond <> '')
BEGIN

	SET @Sql = @Sql + @Cond
	EXEC(@Sql)
END
ELSE
BEGIN
	RETURN -1
END

GO