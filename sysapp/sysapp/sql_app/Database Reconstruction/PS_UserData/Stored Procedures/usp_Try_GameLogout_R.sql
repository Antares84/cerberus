USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Try_GameLogout_R]    Script Date: 8/15/2014 12:17:36 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Try_GameLogout_R]

@UserUID int,
@SessionID bigint,
@LogoutType smallint = 0,
@ErrType int = 0

AS

SET NOCOUNT ON

DECLARE @LogTime datetime
DECLARE @Sql nvarchar(4000)
DECLARE @yyyy varchar(4)
DECLARE @mm varchar(2)
DECLARE @dd varchar(2)
DECLARE @LogType bit	-- Login:0, Logout:1

SET @LogType = 1
SET @LogTime = GETDATE()
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
(SessionID, UserUID, LogType, LogTime, LogoutType, ErrType)
VALUES(@SessionID, @UserUID, @LogType, @LogTime, @LogoutType, @ErrType)'

EXEC sp_executesql @Sql, 
N'@SessionID bigint, @UserUID int, @LogType bit, @LogTime datetime, @LogoutType smallint, @ErrType int',
@SessionID, @UserUID, @LogType, @LogTime, @LogoutType, @ErrType

SET NOCOUNT OFF

GO