USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_CharResultMoney_READ]    Script Date: 8/14/2014 11:46:45 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO








CREATE Proc [dbo].[usp_Market_CharResultMoney_READ]

AS

SET NOCOUNT ON

DECLARE
@MoneyMaxID	int

SELECT @MoneyMaxID = ISNULL(MAX( MoneyID ),0) FROM MarketCharResultMoney

SELECT [MoneyID], [CharID], [MarketID], [Result], [Money], [GuaranteeMoney], [ReturnMoney], [EndDate], [Type], [TypeID], [Quality], [Gem1], [Gem2], [Gem3], [Gem4], [Gem5], [Gem6], [Craftname], [Count] FROM [MarketCharResultMoney]
ORDER BY CharID

RETURN @MoneyMaxID

SET NOCOUNT OFF

GO


