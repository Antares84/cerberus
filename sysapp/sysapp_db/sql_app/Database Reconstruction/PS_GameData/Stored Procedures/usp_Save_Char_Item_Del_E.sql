USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Item_Del_E]    Script Date: 8/15/2014 12:04:10 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



/****** 개체: 저장 프로시저 dbo.usp_Save_Char_Item_Del_E    스크립트 날짜: 2006-04-11 오후 10:57:52 ******/


CREATE   Proc [dbo].[usp_Save_Char_Item_Del_E]

@CharID int,
@IDList varchar(7000) = '', -- 삭제시(리스트값)
@ChkID int = 1,
@Qry varchar(8000) = ''

AS

--------------------------------------------------------------------------------------------------------------------------------
SET NOCOUNT ON

DECLARE
@TmpQuery	varchar(7000)

SET @TmpQuery = 'INSERT INTO #TmpTb(ItemUID) VALUES('
SET @TmpQuery = @TmpQuery + REPLACE( @IDList, ',', ') INSERT INTO #TmpTb(ItemUID) VALUES(' )
SET @TmpQuery = @TmpQuery + ')'


CREATE TABLE #TmpTb( ItemUID bigint  NULL )

EXEC (@TmpQuery)


IF( @ChkID = 1 )
BEGIN
	DELETE CharItems WHERE CharID = @CharID AND ItemUID IN (SELECT ItemUID FROM #TmpTb)
END
ELSE
BEGIN
	DELETE CharItems WHERE ItemUID IN (SELECT ItemUID FROM #TmpTb)
END

IF(@@ERROR = 0)
BEGIN
	DROP TABLE #TmpTb
	RETURN 1
END
ELSE
BEGIN
	DROP TABLE #TmpTb
	RETURN -1
END

SET NOCOUNT OFF

--------------------------------------------------------------------------------------------------------------------------------

GO


