USE [PS_Chatlog]<br>
GO
<br><br>
SET ANSI_NULLS ON
GO
<br><br>
SET QUOTED_IDENTIFIER ON<br>
GO
<br><br>
CREATE TRIGGER [dbo].[ReportPlayer]<br>
ON [PS_Chatlog].[dbo].[ChatLog]<br>
FOR INSERT<br>
AS
<br><br>
DECLARE<br>
@ChatData varchar(128),<br>
@Char varchar(60),<br>
@row int,<br>
@ChatTime datetime,<br>
@UserUID int,<br>
@UserID varchar(30),<br>
@Admin bit,<br>
@AdminLevel int,<br>
@Status smallint,<br>
@CharID int,<br>
@CharName varchar(30),<br>
@Family tinyint,<br>
@GM tinyint,<br>
@GS tinyint,<br>
@TargetUserUID int,<br>
@TargetUserID varchar(30),<br>
@T_CharID int,<br>
@T_GS tinyint,<br>
@TargetFamily tinyint,<br>
@TargetStatus smallint,<br>
@TargetAdmin bit,<br>
@TargetAdminLevel int,<br>
@dead bit,<br>
@PosX real,<br>
@PosY real,<br>
@PosZ real,<br>
@MapID tinyint,<br>
@user varchar(20),<br>
@IP varchar(17),<br>
@BlockENDDate datetime,<br>
@bantime smallint,<br>
@mhd char(1),<br>
@point int
<br><br>
SELECT @ChatData = ChatData FROM inserted WHERE ChatType = 1
<br><br>
-- Report_player<br>
IF (@ChatData like 'report_player %')<br>
BEGIN<br>
    SET @ChatData = substring(@ChatData,15,128)<br>
    SET @Char = substring(@ChatData,CHARINDEX(' ', @ChatData)+1,110)<br>
    SET @ChatData = substring(@ChatData,1,CHARINDEX(' ', @ChatData)-1)
<br><br>    
    SET @Row=        (SELECT TOP 1 Row        FROM inserted)<br>
    SET @ChatTime=    (SELECT TOP 1 ChatTime    FROM inserted)<br>
    SET @MapID=        (SELECT TOP 1 MapID        FROM inserted)<br>
    SET @UserUID=    (SELECT TOP 1 UserUID    FROM inserted)<br>
    SET @CharID=    (SELECT TOP 1 CharID    FROM inserted)<br>
    SET @UserID=    (SELECT UserID            FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)<br>
    SET @CharName=    (SELECT CharName        FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)<br>
    SET @PosZ=        (SELECT Posz CharName    FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)<br>
    SET @PosX=        (SELECT PosX CharName    FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)
<br><br>
    INSERT INTO PS_ChatLog.dbo.Reported_Players<br>
        (UserUID,UserID,CharID,CharName,Map,PosX,PosZ,[Reported Character],Reason,Time)<br>
    VALUES<br>
        (@UserUID,@UserID,@CharID,@CharName,@MapID,@PosX,@PosZ,@ChatData,@Char,@ChatTime)<br>
    DELETE FROM dbo.ChatLog WHERE Row = @Row<br>
END<br>
GO
<br><br>