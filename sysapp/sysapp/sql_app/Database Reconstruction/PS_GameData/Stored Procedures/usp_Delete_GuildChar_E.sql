USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Delete_GuildChar_E]    Script Date: 8/14/2014 11:44:55 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Delete_GuildChar_E]

@GuildID int,
@CharID int

AS

SET NOCOUNT ON

UPDATE GuildChars
SET Del = 1, LeaveDate = GETDATE()
WHERE GuildID = @GuildID AND CharID = @CharID AND Del = 0

IF( @@ERROR = 0 AND @@ROWCOUNT = 1 )
BEGIN
	UPDATE Guilds SET TotalCount=TotalCount-1 WHERE GuildID=@GuildID
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF


GO


