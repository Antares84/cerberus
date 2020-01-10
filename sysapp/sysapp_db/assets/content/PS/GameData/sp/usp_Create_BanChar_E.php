USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Create_BanChar_E]    Script Date: 8/14/2014 11:37:19 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Create_BanChar_E]

@CharID int,
@BanID int,
@BanName varchar(30)

AS

SET NOCOUNT ON

SET @BanName = LTRIM( RTRIM(@BanName) )

INSERT INTO BanChars(CharID,BanID,BanName,BanDate) VALUES(@CharID,@BanID,@BanName,GETDATE())

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


