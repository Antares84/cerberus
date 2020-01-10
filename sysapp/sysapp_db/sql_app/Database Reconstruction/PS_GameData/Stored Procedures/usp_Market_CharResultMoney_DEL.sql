USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_CharResultMoney_DEL]    Script Date: 8/14/2014 11:46:35 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO





CREATE  Proc [dbo].[usp_Market_CharResultMoney_DEL]

@MoneyID	int

AS

SET NOCOUNT ON

DELETE FROM [MarketCharResultMoney] WHERE MoneyID = @MoneyID

IF( @@ERROR <> 0 )
BEGIN

	RETURN 0
END


RETURN 1

SET NOCOUNT OFF

GO


