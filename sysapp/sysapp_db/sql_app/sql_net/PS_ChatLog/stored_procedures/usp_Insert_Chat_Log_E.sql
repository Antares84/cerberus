USE [PS_ChatLog]<br>
GO
<br><br>
SET ANSI_NULLS ON<br>
GO
<br><br>
SET QUOTED_IDENTIFIER ON<br>
GO
<br><br>
CREATE PROC [dbo].[usp_Insert_Chat_Log_E]<br>
@UserUID int,<br>
@CharID int,<br>
@ChatType tinyint,<br>
@TargetName varchar(30),<br>
@ChatData varchar(128),<br>
@MapID smallint,<br>
@ChatTime datetime<br>
<br><br>
AS
<br><br>
DECLARE @Sql nvarchar(4000)<br>
DECLARE @yyyy varchar(4)<br>
DECLARE @mm varchar(2)<br>
DECLARE @dd varchar(2)<br>
<br><br>
SET @yyyy = DATEPART(yyyy, @ChatTime)<br>
SET @mm = DATEPART(mm, @ChatTime)<br>
SET @dd = DATEPART(dd, @ChatTime)<br>
<br><br>
IF( LEN(@mm) = 1 )<br>
BEGIN<br>
	SET @mm = '0' + @mm<br>
END<br>
<br><br>
IF( LEN(@dd) = 1 )<br>
BEGIN<br>
	SET @dd = '0' + @dd<br>
END<br>
<br><br>
SET @Sql = N'<br>
INSERT INTO SDM_ChatLog.dbo.ChatLog<br>
(UserUID, CharID, ChatType, TargetName, ChatData, MapID, ChatTime)<br>
VALUES(@UserUID, @CharID, @ChatType, @TargetName, @ChatData, @MapID, @ChatTime)'<br>
<br><br>
EXEC sp_executesql @Sql, <br>
N'@UserUID int, @CharID int, @ChatType tinyint, @TargetName varchar(30), @ChatData varchar(128),@MapID smallint, @ChatTime datetime',<br>
@UserUID, @CharID, @ChatType, @TargetName, @ChatData, @MapID, @ChatTime<br>
<br>