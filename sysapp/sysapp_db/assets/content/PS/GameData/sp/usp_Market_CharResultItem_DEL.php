USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_CharResultItem_DEL]    Script Date: 8/14/2014 11:46:07 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO





CREATE  Proc [dbo].[usp_Market_CharResultItem_DEL]


@CharID 	int,
@MarketID	int

AS

SET NOCOUNT ON


BEGIN TRAN

DELETE FROM [MarketItems]
WHERE MarketID = @MarketID

IF( @@ERROR <> 0 )
BEGIN
	ROLLBACK TRAN
	RETURN 0
END

DELETE FROM [MarketCharResultItems]
WHERE CharID = @CharID AND MarketID = @MarketID

IF( @@ERROR <> 0 )
BEGIN
	ROLLBACK TRAN
	RETURN 0
END

COMMIT TRAN

RETURN 1

SET NOCOUNT OFF

GO


