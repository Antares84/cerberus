USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Delete_Guild_E]    Script Date: 8/14/2014 11:44:00 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Delete_Guild_E]

@GuildID int

AS

SET NOCOUNT ON

UPDATE Guilds SET Del=1,DeleteDate=GETDATE() WHERE GuildID=@GuildID AND Del=0

IF( @@ERROR=0 AND @@ROWCOUNT=1 )
BEGIN
	UPDATE GuildChars SET Del=1,LeaveDate=GETDATE()	WHERE GuildID=@GuildID AND Del=0
	UPDATE Guilds SET TotalCount=0 WHERE GuildID=@GuildID
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF


GO


