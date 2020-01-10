USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[Usp_Save_Char_EnableRename_E]    Script Date: 8/15/2014 12:03:13 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO






CREATE Proc [dbo].[Usp_Save_Char_EnableRename_E]

@CharID int

AS

SET NOCOUNT ON

UPDATE Chars SET RenameCnt = RenameCnt+1  WHERE CharID = @CharID

IF(@@ERROR = 0)
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF

GO


