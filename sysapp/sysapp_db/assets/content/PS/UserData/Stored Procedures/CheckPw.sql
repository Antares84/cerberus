USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[CheckPw]    Script Date: 8/15/2014 12:15:12 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[CheckPw]
	-- Add the parameters for the stored procedure here
	@UserName varchar(16),
	@Password varchar(16)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

	-- Insert statements for procedure here
	SELECT * FROM [PS_UserData].[dbo].[Users_Master] WHERE 
	UserID=@UserName
END

GO


