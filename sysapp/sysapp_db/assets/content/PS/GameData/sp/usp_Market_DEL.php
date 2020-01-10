USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_DEL]    Script Date: 8/14/2014 11:46:56 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO










CREATE  Proc [dbo].[usp_Market_DEL]

@IDList 		varchar(4096) = ''

AS

SET NOCOUNT ON

DECLARE
@TmpQuery	varchar(8000)

SET @TmpQuery = 'INSERT INTO #TmpDel(MarketID) VALUES('
SET @TmpQuery = @TmpQuery + REPLACE( @IDList, ',', ') INSERT INTO #TmpDel(MarketID) VALUES(' )
SET @TmpQuery = @TmpQuery + ')'

CREATE TABLE #TmpDel( MarketID int  NULL )

--PRINT @TmpQuery

EXEC (@TmpQuery)

UPDATE [Market] SET Del = 1
WHERE MarketID IN (SELECT MarketID FROM #TmpDel)

-- Fail
IF @@ERROR <> 0
BEGIN
	DROP TABLE #TmpDel
	RETURN 0
END
ELSE
BEGIN
	DROP TABLE #TmpDel
	RETURN 1
END

SET NOCOUNT OFF

GO


