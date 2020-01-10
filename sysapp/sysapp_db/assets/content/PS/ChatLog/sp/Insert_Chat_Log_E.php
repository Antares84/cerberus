<div class="menu_description">
<pre>
USE [PS_ChatLog]
GO

SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROC [dbo].[usp_Insert_Chat_Log_E]

@UserUID int,
@CharID int,
@ChatType tinyint,
@TargetName varchar(30),
@ChatData varchar(128),
@MapID smallint,
@ChatTime datetime

AS

DECLARE @Sql nvarchar(4000)
DECLARE @yyyy varchar(4)
DECLARE @mm varchar(2)
DECLARE @dd varchar(2)

SET @yyyy = DATEPART(yyyy, @ChatTime)
SET @mm = DATEPART(mm, @ChatTime)
SET @dd = DATEPART(dd, @ChatTime)

IF( LEN(@mm) = 1 )
BEGIN
	SET @mm = '0' + @mm
END
IF( LEN(@dd) = 1 )
BEGIN
	SET @dd = '0' + @dd
END

SET @Sql = N'
INSERT INTO SDM_ChatLog.dbo.ChatLog
(UserUID, CharID, ChatType, TargetName, ChatData, MapID, ChatTime)
VALUES(@UserUID, @CharID, @ChatType, @TargetName, @ChatData, @MapID, @ChatTime)'

EXEC sp_executesql @Sql, 
N'@UserUID int, @CharID int, @ChatType tinyint, @TargetName varchar(30), @ChatData varchar(128),@MapID smallint, @ChatTime datetime',
@UserUID, @CharID, @ChatType, @TargetName, @ChatData, @MapID, @ChatTime
</pre>
</div>