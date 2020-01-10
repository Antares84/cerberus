USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Guild_StoredItem_Del_E]    Script Date: 8/15/2014 12:08:32 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE  Proc [dbo].[usp_Save_Guild_StoredItem_Del_E]


@GuildID int,
@IDList varchar(7000) = '', -- 삭제시(리스트값)
@ChkID int = 1,
@Qry varchar(8000) = ''

AS

--------------------------------------------------------------------------------------------------------------------------------
SET NOCOUNT ON

DECLARE
@TmpQuery	varchar(7000)

SET @TmpQuery = 'INSERT INTO #TmpTb7(ItemUID) VALUES('
SET @TmpQuery = @TmpQuery + REPLACE( @IDList, ',', ') INSERT INTO #TmpTb7(ItemUID) VALUES(' )
SET @TmpQuery = @TmpQuery + ')'


CREATE TABLE #TmpTb7( ItemUID bigint  NULL )

EXEC (@TmpQuery)

IF( @ChkID = 1 )
BEGIN
	DELETE GuildStoredItems WHERE ItemUID IN (SELECT ItemUID FROM #TmpTb7) AND GuildID=@GuildID 
END
ELSE
BEGIN
	DELETE GuildStoredItems WHERE ItemUID IN (SELECT ItemUID FROM #TmpTb7)
END

IF(@@ERROR = 0)
BEGIN
	DROP TABLE #TmpTb7
	RETURN 1
END
ELSE
BEGIN
	DROP TABLE #TmpTb7
	RETURN -1
END

SET NOCOUNT OFF

--------------------------------------------------------------------------------------------------------------------------------

GO


