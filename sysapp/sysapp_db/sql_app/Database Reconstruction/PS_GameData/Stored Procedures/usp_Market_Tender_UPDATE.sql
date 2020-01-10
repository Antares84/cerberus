USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_Tender_UPDATE]    Script Date: 8/14/2014 11:48:01 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO








CREATE Proc [dbo].[usp_Market_Tender_UPDATE]

@MarketID 		int,
@TenderCharID		int,
@TenderMoney		int,
@TenderCharName	varchar(21)

AS

SET NOCOUNT ON

UPDATE [Market]
SET [TenderCharID]= @TenderCharID, [TenderMoney]= @TenderMoney, [TenderCharName]=@TenderCharName
WHERE MarketID = @MarketID

IF @@ERROR <> 0
BEGIN
	RETURN 0
END

RETURN 1

SET NOCOUNT OFF

GO


