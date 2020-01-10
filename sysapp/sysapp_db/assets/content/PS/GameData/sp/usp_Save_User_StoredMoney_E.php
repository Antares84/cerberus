USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_StoredMoney_E]    Script Date: 8/15/2014 12:10:56 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_User_StoredMoney_E]

@ServerID tinyint,
@UserUID int,
@Money bigint

AS

SET NOCOUNT ON

DECLARE @Cnt int

SET @Cnt = (SELECT COUNT(*) FROM UserStoredMoney WHERE ServerID=@ServerID AND UserUID=@UserUID)
IF(@Cnt = 0)
BEGIN
	INSERT UserStoredMoney(ServerID,UserUID,[Money]) VALUES(@ServerID,@UserUID,@Money)
END
ELSE
BEGIN
	UPDATE UserStoredMoney SET [Money]=@Money,LastAccessTime=GETDATE() WHERE ServerID=@ServerID AND UserUID=@UserUID
END

SET NOCOUNT OFF


GO


