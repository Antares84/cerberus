USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_ConcernMarket_Add_E]    Script Date: 8/15/2014 12:02:32 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO






CREATE Proc [dbo].[usp_Save_Char_ConcernMarket_Add_E]

@CharID 	int,
@MarketID	int

AS

SET NOCOUNT ON

INSERT INTO MarketCharConcern(CharID, MarketID)
VALUES(@CharID, @MarketID  )


SET NOCOUNT OFF


GO


