USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_READ]    Script Date: 8/14/2014 11:47:32 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO





CREATE  Proc [dbo].[usp_Market_READ]

AS

SET NOCOUNT ON

SELECT M.[MarketID], M.[CharID], M.[MinMoney], M.[DirectMoney], M.[MarketType], 
	M.[GuaranteeMoney], M.[TenderCharID], M.[TenderMoney], M.[EndDate], C.[CharName], ISNULL( M.[TenderCharName], '') TenderCharName, 
	I.[ItemID], I.[ItemUID], I.[Type], I.[TypeID], I.[Quality], I.[Gem1], I.[Gem2], I.[Gem3], I.[Gem4], I.[Gem5], I.[Gem6], I.[Craftname], I.[Count], I.[Maketime], I.[Maketype]
FROM Market M
INNER JOIN MarketItems I ON M.MarketID = I.MarketID 
INNER JOIN Chars C ON M.CharID = C.CharID

WHERE M.Del = 0
ORDER BY M.[MarketID]


RETURN 1

SET NOCOUNT OFF

GO


