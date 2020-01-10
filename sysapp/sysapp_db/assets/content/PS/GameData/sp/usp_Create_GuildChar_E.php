USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Create_GuildChar_E]    Script Date: 8/14/2014 11:42:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Create_GuildChar_E]

@GuildID int,
@CharID int,
@GuildLevel tinyint

AS

SET NOCOUNT ON

DECLARE @NameCnt int

SET @NameCnt = ( SELECT ISNULL(COUNT(*),0) FROM GuildChars WHERE CharID = @CharID AND Del = 0 )

IF( @NameCnt <> 0 )
BEGIN
	RETURN -1
END
ELSE
BEGIN
	INSERT INTO GuildChars(GuildID, CharID, GuildLevel, JoinDate)
	VALUES(@GuildID, @CharID, @GuildLevel, GETDATE())

	UPDATE Guilds SET TotalCount=TotalCount+1 WHERE GuildID=@GuildID

	RETURN 0
END

SET NOCOUNT OFF


GO


