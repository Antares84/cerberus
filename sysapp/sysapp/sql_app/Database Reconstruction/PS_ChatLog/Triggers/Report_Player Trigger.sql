USE [PS_Chatlog]
GO

/****** Object:  Trigger [dbo].[Report_Player]    Script Date: 8/14/2014 10:23:54 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TRIGGER [dbo].[ReportPlayer]
ON [PS_Chatlog].[dbo].[ChatLog]
FOR INSERT
AS


-- ********* SHAIYA ALLIANCE ********* --
-- By [Dev]HoaX (c)2011

DECLARE
@ChatData varchar(128),
@Char varchar(60),
@row int,
@ChatTime datetime, 
@UserUID int,
@UserID varchar(30),
@Admin bit,
@AdminLevel int,
@Status smallint,
@CharID int,
@CharName varchar(30),
@Family tinyint,
@GM tinyint,
@GS tinyint,
@TargetUserUID int,
@TargetUserID varchar(30),
@T_CharID int,
@T_GS tinyint,
@TargetFamily tinyint,
@TargetStatus smallint,
@TargetAdmin bit,
@TargetAdminLevel int,
@dead bit,
@PosX real,
@PosY real,
@PosZ real,
@MapID tinyint,
@user varchar(20),
@IP varchar(17),
@BlockENDDate datetime,
@bantime smallint,
@mhd char(1),
@point int

SELECT @ChatData = ChatData FROM inserted WHERE ChatType = 1


-- Report_player
IF (@ChatData like 'report_player %')
BEGIN
    SET @ChatData = substring(@ChatData,15,128)
    SET @Char = substring(@ChatData,CHARINDEX(' ', @ChatData)+1,110) 
    SET @ChatData = substring(@ChatData,1,CHARINDEX(' ', @ChatData)-1) 
    
    SET @Row=        (SELECT TOP 1 Row        FROM inserted)
    SET @ChatTime=    (SELECT TOP 1 ChatTime    FROM inserted)
    SET @MapID=        (SELECT TOP 1 MapID        FROM inserted)
    SET @UserUID=    (SELECT TOP 1 UserUID    FROM inserted)
    SET @CharID=    (SELECT TOP 1 CharID    FROM inserted)
    SET @UserID=    (SELECT UserID            FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)
    SET @CharName=    (SELECT CharName        FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)
    SET @PosZ=        (SELECT Posz CharName    FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)
    SET @PosX=        (SELECT PosX CharName    FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)

    INSERT INTO PS_ChatLog.dbo.Reported_Players 
        (UserUID,UserID,CharID,CharName,Map,PosX,PosZ,[Reported Character],Reason,Time) 
    VALUES
        (@UserUID,@UserID,@CharID,@CharName,@MapID,@PosX,@PosZ,@ChatData,@Char,@ChatTime)
    DELETE FROM dbo.ChatLog WHERE Row = @Row
END
GO


