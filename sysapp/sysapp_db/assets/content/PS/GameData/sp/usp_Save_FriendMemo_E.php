USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_FriendMemo_E]    Script Date: 8/15/2014 12:06:44 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Save_FriendMemo_E]

@CharID int,
@FriendID int,
@Memo varchar(50)=NULL

AS

SET NOCOUNT ON

SET @Memo = LTRIM( RTRIM(@Memo) )

UPDATE FriendChars SET Memo=@Memo WHERE CharID=@CharID AND FriendID=@FriendID

IF(@@ERROR = 0)
BEGIN
	RETURN 0
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF


GO


