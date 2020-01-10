USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_ConcernMarket_R]    Script Date: 8/14/2014 11:49:22 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO






CREATE Proc [dbo].[usp_Read_Char_ConcernMarket_R]

@CharID int

AS

SET NOCOUNT ON

SELECT TOP 10 MarketID FROM MarketCharConcern WHERE CharID=@CharID
ORDER BY RowID

SET NOCOUNT OFF





GO


