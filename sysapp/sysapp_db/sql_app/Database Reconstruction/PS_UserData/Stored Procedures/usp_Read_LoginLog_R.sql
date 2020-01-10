USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_LoginLog_R]    Script Date: 8/15/2014 12:17:15 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

CREATE Proc [dbo].[usp_Read_LoginLog_R]

@UserID varchar(18) = '',
@UserIP varchar(15) = '',
@StDate datetime,
@EnDate datetime,
@UserUID int = -1,
@Flag_ID bit = 0,
@Flag_IP bit = 0,
@Cond varchar(200) = '',
@Sql varchar(1000) = ''

AS

IF(@UserID <> '')
BEGIN
	SET @Flag_ID = 1
END

IF(@UserIP <> '')
BEGIN
	SET @Flag_IP = 1
END

IF( @Flag_ID = 1 AND @Flag_IP = 0)
BEGIN

	SELECT M.UserID, L.SessionID, L.UserIP, L.LoginTime, L.LogoutTime, L.LoginType, E.ErrType, E.ErrMsg

	FROM UserLoginLog L INNER JOIN ErrTypeDefs E
	ON L.ErrType = E.ErrType

	INNER JOIN Users_Master M
	ON M.UserUID = L.UserUID

	WHERE M.UserID = @UserID 
	AND (LoginTime >= @StDate AND LoginTime <= @EnDate)

END

ELSE IF( @Flag_ID = 0 AND @Flag_IP = 1)
BEGIN

	SELECT M.UserID, L.SessionID, L.UserIP, L.LoginTime, L.LogoutTime, L.LoginType, E.ErrType, E.ErrMsg

	FROM UserLoginLog L INNER JOIN ErrTypeDefs E
	ON L.ErrType = E.ErrType

	INNER JOIN Users_Master M
	ON M.UserUID = L.UserUID

	WHERE L.UserIP = @UserIP
	AND (LoginTime >= @StDate AND LoginTime <= @EnDate)

END

ELSE IF( @Flag_ID = 1 AND @Flag_IP = 0)
BEGIN

	SELECT M.UserID, L.SessionID, L.UserIP, L.LoginTime, L.LogoutTime, L.LoginType, E.ErrType, E.ErrMsg

	FROM UserLoginLog L INNER JOIN ErrTypeDefs E
	ON L.ErrType = E.ErrType

	INNER JOIN Users_Master M
	ON M.UserUID = L.UserUID

	WHERE M.UserID = @UserID AND L.UserIP = @UserIP
	AND (LoginTime >= @StDate AND LoginTime <= @EnDate)	

END

GO