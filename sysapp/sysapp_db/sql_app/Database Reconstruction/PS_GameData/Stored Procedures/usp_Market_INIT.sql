USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_INIT]    Script Date: 8/14/2014 11:47:03 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO







CREATE  Proc [dbo].[usp_Market_INIT]

AS

SET NOCOUNT ON

DECLARE
@CurDate	datetime,
@MaxMarketID	int


SET @CurDate = GETDATE()

SELECT @MaxMarketID = ISNULL(MAX( MarketID ),0) FROM Market

INSERT INTO [MarketCharResultItems_DelLog]([CharID], [MarketID], [Result], [EndDate], [DelDate])
SELECT [CharID], [MarketID], [Result], [EndDate], @CurDate FROM [MarketCharResultItems] WHERE EndDate <= @CurDate

INSERT INTO [MarketItems_DelLog]([MarketID], [ItemID], [ItemUID], [Type], [TypeID], [Quality], [Gem1], [Gem2], [Gem3], [Gem4], [Gem5], [Gem6], [Craftname], [Count], [Maketime], [Maketype])
SELECT [MarketID], [ItemID], [ItemUID], [Type], [TypeID], [Quality], [Gem1], [Gem2], [Gem3], [Gem4], [Gem5], [Gem6], [Craftname], [Count], [Maketime], [Maketype] FROM [MarketItems]
WHERE MarketID IN ( SELECT [MarketID] FROM [MarketCharResultItems] WHERE EndDate <= @CurDate )

DELETE FROM [MarketItems]
WHERE MarketID IN ( SELECT [MarketID] FROM [MarketCharResultItems] WHERE EndDate <= @CurDate )

DELETE FROM [MarketCharResultItems]
WHERE EndDate <= @CurDate


INSERT INTO [MarketCharResultMoney_DelLog]( [MoneyID], [CharID], [MarketID], [Result], [Money], [GuaranteeMoney], [ReturnMoney], [EndDate], [Type], [TypeID], [Quality], [Gem1], [Gem2], [Gem3], [Gem4], [Gem5], [Gem6], [Craftname], [Count], [DelDate])
SELECT [MoneyID], [CharID], [MarketID], [Result], [Money], [GuaranteeMoney], [ReturnMoney], [EndDate], [Type], [TypeID], [Quality], [Gem1], [Gem2], [Gem3], [Gem4], [Gem5], [Gem6], [Craftname], [Count], @CurDate FROM [MarketCharResultMoney] WHERE EndDate <= @CurDate

DELETE FROM [MarketCharResultMoney]
WHERE EndDate <= @CurDate



DELETE FROM [Market]
WHERE Del = 1 AND EndDate < DATEADD(day, -16, @CurDate )


RETURN @MaxMarketID

SET NOCOUNT OFF


GO


