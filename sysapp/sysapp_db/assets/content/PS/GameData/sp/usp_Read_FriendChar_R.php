USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_FriendChar_R]    Script Date: 8/14/2014 11:52:48 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_FriendChar_R]

@CharID int

AS

SET NOCOUNT ON

SELECT F.FriendID, C.CharName, F.Family, F.Grow, F.Job, F.Memo, F.Refuse FROM FriendChars F
INNER JOIN Chars C ON F.FriendID = C.CharID 

WHERE F.CharID=@CharID

SET NOCOUNT OFF
GO


