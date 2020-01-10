USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Maxgrow_E]    Script Date: 8/15/2014 12:04:42 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_Maxgrow_E]

@ServerID tinyint,
@UserUID int,
@MaxGrow tinyint

AS

SET NOCOUNT ON

UPDATE UserMaxGrow SET MaxGrow=@MaxGrow WHERE ServerID=@ServerID AND UserUID=@UserUID

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


