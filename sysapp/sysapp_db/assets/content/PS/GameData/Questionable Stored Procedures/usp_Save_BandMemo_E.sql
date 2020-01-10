USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_BandMemo_E]    Script Date: 8/15/2014 12:00:00 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Save_BandMemo_E]

@CharID int,
@BanID int,
@Memo varchar(50) = NULL

AS

SET NOCOUNT ON

SET @Memo = LTRIM( RTRIM(@Memo) )

UPDATE BanChars SET Memo=@Memo WHERE CharID=@CharID AND BanID=@BanID

IF( @@ERROR = 0 )
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF


GO


