USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Optisp_Change_ShaiyaPass]    Script Date: 8/15/2014 12:16:21 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Optisp_Change_ShaiyaPass]

@UserID 	varchar(18),
@NewPass 	varchar(18)

AS

SET NOCOUNT ON

SET @UserID		= LTRIM(RTRIM(@UserID))
SET @NewPass		= LTRIM(RTRIM(@NewPass))

IF ( LEN( @NewPass ) < 5 )
BEGIN
	RETURN 0 
END

UPDATE Users_Master SET Enpassword=master.dbo.fn_md5(@NewPass)  WHERE UserID=@UserID

IF( @@ERROR = 0 AND @@ROWCOUNT = 1)
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN 0
END

SET NOCOUNT OFF

GO