USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_GuildRemark_E]    Script Date: 8/15/2014 12:09:08 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO






CREATE Proc [dbo].[usp_Save_GuildRemark_E]

@GuildID 	int,
@Remark	varchar(64)

AS

SET NOCOUNT ON

IF EXISTS ( SELECT GuildID FROM GuildHouses WHERE GuildID = @GuildID )
BEGIN
	UPDATE GuildDetails SET Remark=@Remark WHERE GuildID=@GuildID
END
ELSE
BEGIN
	INSERT INTO GuildDetails(GuildID, Remark) VALUES(@GuildID, @Remark )
END

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


