USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_CharResultItem_ADD]    Script Date: 8/14/2014 11:45:56 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO





CREATE  Proc [dbo].[usp_Market_CharResultItem_ADD]


@CharID 	int,
@MarketID	int,
@Result	tinyint,
@EndDate	datetime,

@ItemID 	int,
@ItemUID 	bigint,

@Type 		tinyint,
@TypeID 	tinyint,
@Quality 	int,
@Gem1 	tinyint,
@Gem2 	tinyint,
@Gem3 	tinyint,
@Gem4 	tinyint,
@Gem5 	tinyint,
@Gem6 	tinyint,
@Craftname 	varchar(20) = '', 
@Count 	tinyint,
@Maketime 	datetime,
@Maketype 	char(1)

AS

SET NOCOUNT ON



IF NOT EXISTS( SELECT MarketID FROM MarketItems WHERE MarketID = @MarketID )
BEGIN
	BEGIN TRAN

	INSERT INTO [MarketItems]([MarketID], [ItemID], [ItemUID], [Type], [TypeID], [Quality], [Gem1], [Gem2], [Gem3], [Gem4], [Gem5], [Gem6], [Craftname], [Count], [Maketime], [Maketype])
	VALUES( @MarketID, @ItemID, @ItemUID, @Type, @TypeID, @Quality, @Gem1, @Gem2, @Gem3, @Gem4, @Gem5, @Gem6, @Craftname, @Count, @Maketime,  @Maketype     )

	IF( @@ERROR <> 0 )
	BEGIN
		ROLLBACK TRAN
		RETURN 0
	END

	INSERT INTO [MarketCharResultItems]([CharID], [MarketID], [Result], [EndDate])
	VALUES( @CharID, @MarketID, @Result, @EndDate )
	IF( @@ERROR <> 0 )
	BEGIN
		ROLLBACK TRAN
		RETURN 0
	END

	COMMIT TRAN

END

ELSE

BEGIN
	INSERT INTO [MarketCharResultItems]([CharID], [MarketID], [Result], [EndDate])
	VALUES( @CharID, @MarketID, @Result, @EndDate )
	IF( @@ERROR <> 0 )
	BEGIN
		RETURN 0
	END

END

RETURN 1

SET NOCOUNT OFF

GO


