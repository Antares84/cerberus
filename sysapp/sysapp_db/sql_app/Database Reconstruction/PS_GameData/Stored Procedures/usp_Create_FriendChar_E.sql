USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Create_FriendChar_E]    Script Date: 8/14/2014 11:39:46 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Create_FriendChar_E]

@CharID int,
@FriendID int,
@FriendName varchar(30),
@Family tinyint,
@Grow tinyint,
@Job tinyint

AS

SET NOCOUNT ON

SET @FriendName = LTRIM( RTRIM(@FriendName) )

INSERT INTO FriendChars(CharID, FriendID, FriendName, Family, Grow, Job, CreateDate)
VALUES(@CharID, @FriendID, @FriendName, @Family, @Grow, @Job, GETDATE())

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


