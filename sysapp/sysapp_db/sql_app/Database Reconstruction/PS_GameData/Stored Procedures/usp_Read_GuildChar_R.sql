USE [SDM_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_GuildChar_R]    Script Date: 8/14/2014 11:54:04 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_GuildChar_R]

@GuildID int=0

AS

SET NOCOUNT ON

IF( @GuildID = 0 )
BEGIN
	SELECT B.CharID, B.CharName, B.[Level], B.Job, A.GuildID, A.GuildLevel
	FROM GuildChars A INNER JOIN Chars B ON A.CharID = B.CharID
	WHERE A.Del = 0
END
ELSE
BEGIN
	SELECT B.CharID, B.CharName, B.[Level], B.Job, A.GuildID, A.GuildLevel
	FROM GuildChars A INNER JOIN Chars B ON A.CharID = B.CharID
	WHERE A.GuildID = @GuildID AND A.Del = 0
END

SET NOCOUNT OFF


GO


