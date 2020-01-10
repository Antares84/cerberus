USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_BodyChg_E]    Script Date: 8/15/2014 12:02:04 AM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER OFF
GO

CREATE Proc [dbo].[usp_Save_Char_BodyChg_E]

@CharID int,
@Hair      tinyint,
@Face    tinyint,
@Size     tinyint,
@Sex      tinyint

AS

SET NOCOUNT ON

UPDATE Chars
SET Hair=@Hair, Face=@Face, [Size]=@Size,  Sex=@Sex
WHERE CharID = @CharID


IF(@@ERROR = 0 AND @@ROWCOUNT = 1)
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF
GO


