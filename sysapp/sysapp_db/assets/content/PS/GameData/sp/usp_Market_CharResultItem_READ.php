USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_CharResultItem_READ]    Script Date: 8/14/2014 11:46:15 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO








CREATE Proc [dbo].[usp_Market_CharResultItem_READ]

AS

SET NOCOUNT ON

SELECT C.[CharID], C.[MarketID], C.[Result], C.[EndDate], 
	I.[ItemID], I.[ItemUID], I.[Type], I.[TypeID], I.[Quality], I.[Gem1], I.[Gem2], I.[Gem3], I.[Gem4], I.[Gem5], I.[Gem6], I.[Craftname], I.[Count], I.[Maketime], I.[Maketype]
FROM MarketCharResultItems C

INNER JOIN MarketItems I ON C.MarketID = I.MarketID

ORDER BY C.[CharID]

RETURN @@ROWCOUNT

SET NOCOUNT OFF

GO


