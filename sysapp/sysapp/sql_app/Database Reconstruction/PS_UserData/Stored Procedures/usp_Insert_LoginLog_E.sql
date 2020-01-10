USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Insert_LoginLog_E]    Script Date: 8/15/2014 12:15:47 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE PROC [dbo].[usp_Insert_LoginLog_E]

@SessionID bigint,
@UserUID int,
@UserIP varchar(15),
@LogType bit = 0,	-- Login:0, Logout:1
@LogTime datetime,
@LoginType smallint = 1

AS

SET NOCOUNT ON

DECLARE @Sql nvarchar(4000)
DECLARE @yyyy varchar(4)
DECLARE @mm varchar(2)
DECLARE @dd varchar(2)

SET @yyyy = DATEPART(yyyy, @LogTime)
SET @mm = DATEPART(mm, @LogTime)
SET @dd = DATEPART(dd, @LogTime)

IF( LEN(@mm) = 1 )
BEGIN
	SET @mm = '0' + @mm
END

IF( LEN(@dd) = 1 )
BEGIN
	SET @dd = '0' + @dd
END

SET @Sql = N'
INSERT INTO PS_GameLog.dbo.UserLog
(SessionID, UserUID, UserIP, LogType, LogTime, LoginType)
VALUES(@SessionID, @UserUID, @UserIP, @LogType, @LogTime, @LoginType)'

EXEC sp_executesql @Sql, 
N'@SessionID bigint, @UserUID int, @UserIP varchar(15), @LogType bit, @LogTime datetime, @LoginType smallint',
@SessionID, @UserUID, @UserIP, @LogType, @LogTime, @LoginType

SET NOCOUNT OFF

GO