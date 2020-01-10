USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Delete_Char_E]    Script Date: 8/14/2014 11:43:07 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE  Proc [dbo].[usp_Delete_Char_E]
@ServerID tinyint,
@CharID int
AS
SET NOCOUNT ON
DECLARE @DeleteDate datetime
DECLARE @GuildID int
SET @DeleteDate = GETDATE()
UPDATE Chars SET Del=1, DeleteDate=@DeleteDate WHERE CharID=@CharID
SELECT @GuildID=GuildID FROM GuildChars WHERE CharID=@CharID AND Del=0
IF( @GuildID IS NOT NULL )
BEGIN
	EXEC usp_Delete_GuildChar_E @GuildID, @CharID
END
INSERT DeletedChars(ServerID,CharID,DeleteDate) VALUES(@ServerID,@CharID,@DeleteDate)
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


