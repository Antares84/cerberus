USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_GuildChar_E]    Script Date: 8/15/2014 12:08:51 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Save_GuildChar_E]

@CharID int,
@GuildLevel tinyint

AS

SET NOCOUNT ON

DECLARE
@MasterUserID varchar(18),
@MasterName	varchar(30),
@GuildID	int

IF ( @GuildLevel = 1 )
BEGIN

	SELECT @MasterUserID=UserID, @MasterName=CharName FROM Chars WHERE CharID = @CharID AND Del = 0
	IF @@ROWCOUNT <> 0
	BEGIN
		SELECT @GuildID=GuildID FROM GuildChars WHERE CharID=@CharID AND Del=0
		IF @@ROWCOUNT <> 0
			UPDATE Guilds SET MasterUserID=@MasterUserID, MasterCharID=@CharID, MasterName=@MasterName WHERE GuildID = @GuildID
	END
END


UPDATE GuildChars SET GuildLevel=@GuildLevel WHERE CharID=@CharID AND Del=0

IF( @@ERROR = 0 AND @@ROWCOUNT = 1 )
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF
GO


