USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Delete_FriendChar_E]    Script Date: 8/14/2014 11:43:52 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Delete_FriendChar_E]

@CharID int,
@FriendID int

AS

SET NOCOUNT ON

DELETE FriendChars WHERE CharID=@CharID AND FriendID=@FriendID

UPDATE FriendChars SET Refuse = 1, RefuseDate=GETDATE()  WHERE CharID=@FriendID AND FriendID=@CharID

IF( @@ERROR = 0 )
BEGIN
	RETURN 0
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF


GO


