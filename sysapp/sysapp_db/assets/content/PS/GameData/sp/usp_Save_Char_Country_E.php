USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Country_E]    Script Date: 8/15/2014 12:02:50 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_Country_E]

@ServerID tinyint,
@UserUID int,
@Country smallint,
@Insert bit = 0

AS

SET NOCOUNT ON

IF(@Insert = 1)
BEGIN
	INSERT UserMaxGrow(ServerID,UserUID,Country,MaxGrow) VALUES(@ServerID,@UserUID,@Country,1)
END
ELSE
BEGIN
	UPDATE UserMaxGrow SET Country=@Country	WHERE ServerID=@ServerID AND UserUID=@UserUID
END

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


