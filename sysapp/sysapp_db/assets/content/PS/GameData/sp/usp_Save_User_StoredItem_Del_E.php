USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_StoredItem_Del_E]    Script Date: 8/15/2014 12:10:36 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO


/****** 개체: 저장 프로시저 dbo.usp_Save_User_StoredItem_Del_E    스크립트 날짜: 2006-04-11 오후 10:59:04 ******/


CREATE  Proc [dbo].[usp_Save_User_StoredItem_Del_E]

@ServerID tinyint,
@UserUID int,
@IDList varchar(7000) = '', -- 삭제시(리스트값)
@ChkID int = 1,
@Qry varchar(8000) = ''

AS

--------------------------------------------------------------------------------------------------------------------------------
SET NOCOUNT ON

DECLARE
@TmpQuery	varchar(7000)

SET @TmpQuery = 'INSERT INTO #TmpTb1(ItemUID) VALUES('
SET @TmpQuery = @TmpQuery + REPLACE( @IDList, ',', ') INSERT INTO #TmpTb1(ItemUID) VALUES(' )
SET @TmpQuery = @TmpQuery + ')'


CREATE TABLE #TmpTb1( ItemUID bigint  NULL )

EXEC (@TmpQuery)

IF( @ChkID = 1 )
BEGIN
	DELETE UserStoredItems WHERE ItemUID IN (SELECT ItemUID FROM #TmpTb1) AND UserUID=@UserUID AND ServerID=@ServerID
END
ELSE
BEGIN
	DELETE UserStoredItems WHERE ItemUID IN (SELECT ItemUID FROM #TmpTb1)
END

IF(@@ERROR = 0)
BEGIN
	DROP TABLE #TmpTb1
	RETURN 1
END
ELSE
BEGIN
	DROP TABLE #TmpTb1
	RETURN -1
END

SET NOCOUNT OFF

--------------------------------------------------------------------------------------------------------------------------------
GO


