USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Create_Guild_E]    Script Date: 8/14/2014 11:41:45 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Create_Guild_E]

@GuildID int,
@GuildName varchar(30),
@MasterUserID varchar(12),
@MasterCharID int,
@MasterName varchar(30),
@Country tinyint

AS

SET NOCOUNT ON

DECLARE @NameCnt int

SET @GuildName = LTRIM ( RTRIM ( @GuildName ) )
SET @MasterName = LTRIM ( RTRIM ( @MasterName ) )
SET @NameCnt = ( SELECT ISNULL(COUNT(*),0) FROM Guilds WHERE GuildName=@GuildName AND Del = 0 )

IF( @NameCnt <> 0 )
BEGIN
	RETURN -1
END
ELSE
BEGIN
	INSERT INTO Guilds(GuildID,GuildName,MasterUserID,MasterCharID,MasterName,Country,TotalCount,GuildPoint,CreateDate)
	VALUES(@GuildID,@GuildName,@MasterUserID,@MasterCharID,@MasterName,@Country,0,0,GETDATE())
	RETURN 0
END

SET NOCOUNT OFF


GO


