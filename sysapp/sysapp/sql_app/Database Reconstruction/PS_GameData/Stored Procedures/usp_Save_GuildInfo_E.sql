USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_GuildInfo_E]    Script Date: 8/15/2014 12:08:59 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO







CREATE  Proc [dbo].[usp_Save_GuildInfo_E]

@GuildID 	int,
@GuildPoint	int,
@Etin		int,
@Remark	varchar(64),
@BuyHouse	tinyint,
@EtinReturnCnt int = 0,
@KeepEtin	int = 0

AS

SET NOCOUNT ON

DECLARE
@OldGuildPoint	int

SET @Remark = LTRIM(RTRIM(@Remark))

BEGIN TRAN

SELECT @OldGuildPoint = GuildPoint FROM Guilds WHERE GuildID=@GuildID
IF( @GuildPoint > @OldGuildPoint )
BEGIN
	UPDATE Guilds SET GuildPoint=@GuildPoint WHERE GuildID=@GuildID
	IF( @@ERROR <> 0 )
	BEGIN	
		ROLLBACK TRAN
		RETURN -1
	END
END

IF EXISTS ( SELECT GuildID FROM GuildDetails WHERE GuildID = @GuildID )
BEGIN
	UPDATE GuildDetails SET Etin=@Etin, Remark=@Remark, BuyHouse=@BuyHouse,EtinReturnCnt=@EtinReturnCnt, KeepEtin=@KeepEtin WHERE GuildID=@GuildID
END
ELSE
BEGIN
	INSERT INTO GuildDetails(GuildID, Etin, Remark, BuyHouse, EtinReturnCnt, KeepEtin) VALUES(@GuildID, @Etin, @Remark, @BuyHouse,@EtinReturnCnt, @KeepEtin )
END

IF( @@ERROR = 0 AND @@ROWCOUNT = 1 )
BEGIN
	COMMIT TRAN
	RETURN 1
END
ELSE
BEGIN
	ROLLBACK TRAN
	RETURN -1
END

SET NOCOUNT OFF

GO


