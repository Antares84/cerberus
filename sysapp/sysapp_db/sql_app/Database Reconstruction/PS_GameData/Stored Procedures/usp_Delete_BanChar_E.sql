USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Delete_BanChar_E]    Script Date: 8/14/2014 11:42:59 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Delete_BanChar_E]

@CharID int,
@BanID int

AS

SET NOCOUNT ON

DELETE BanChars WHERE CharID=@CharID AND BanID=@BanID

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


