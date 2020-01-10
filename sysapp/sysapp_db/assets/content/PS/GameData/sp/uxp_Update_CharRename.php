USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[uxp_Update_CharRename]    Script Date: 8/15/2014 12:13:14 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



--정기점검시 실행(SQLAgent)
--케릭터 이름 바꾼거 웹에도 적용.
CREATE Proc [dbo].[uxp_Update_CharRename]

AS

DECLARE
@ServerID	tinyint,
@CharID		int,
@CharName	varchar(30)

SET NOCOUNT ON
--------------------------------------------

DECLARE Cur_Char CURSOR 
FOR

-------------------------------------------------------------
SELECT ServerID, CharID, CharName FROM CharRenameLog ORDER BY UpdateTime
-----------------------------------------------------------
OPEN Cur_Char

FETCH NEXT FROM Cur_Char INTO @ServerID, @CharID, @CharName

WHILE @@FETCH_STATUS = 0
BEGIN

	UPDATE PS_USERDB01.PS_UserData.dbo.CreatedChars 
	SET CharName=@CharName WHERE ServerID=@ServerID AND CharID=@CharID
	IF @@ERROR <> 0
	BEGIN
		GOTO ERROR_RETURN
	END
	

FETCH NEXT FROM Cur_Char INTO  @ServerID, @CharID, @CharName
END

DELETE FROM CharRenameLog

ERROR_RETURN:

CLOSE Cur_Char
DEALLOCATE Cur_Char

--------------------------------------------
SET NOCOUNT OFF

GO


