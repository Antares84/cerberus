USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[sp_LoginSuccessCheck]    Script Date: 8/15/2014 12:15:36 AM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER OFF
GO

CREATE PROCEDURE [dbo].[sp_LoginSuccessCheck] 
	@userid varchar(18),
	@checkPassword varchar(32),
	@Rtn_Success int OUTPUT
AS

BEGIN
	SET NOCOUNT ON;
	IF EXISTS(SELECT * FROM Users_Master WITH (nolock) WHERE UserID=@UserID  And PW=@checkPassword)
		BEGIN
			--Login Success
			SET @Rtn_Success = 1
		END
	ELSE
		BEGIN
			--Login Fail
			SET @Rtn_Success =- 1
		END
	RETURN @Rtn_Success

END

GO


