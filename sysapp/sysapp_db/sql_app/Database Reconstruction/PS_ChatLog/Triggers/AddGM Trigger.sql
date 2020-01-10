USE [PS_Chatlog]
GO

/****** 
File Label: Trigger [dbo].[AddGM]
Script Date: 8/14/2014 10:22:26 PM
******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TRIGGER [dbo].[AddGM]
ON [PS_Chatlog].[dbo].[ChatLog]
FOR INSERT
AS

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

-- Create A [GM]
-- Note: Only usable if you are an Admin on the server.
IF (@ChatData like 'AddGM %')
BEGIN
    SET @UserUID =        (SELECT TOP 1 UserUID    FROM inserted)
    SET @Admin =        (SELECT [Admin]            FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)
    SET @AdminLevel =    (SELECT AdminLevel        FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)
    
    IF ((@Admin = 1) AND (@AdminLevel = 16))
    BEGIN
        SET @Char = substring(@ChatData,8,29)
        SET @TargetUserUID = (SELECT TOP 1 UserUID FROM PS_GameData.dbo.Chars	WHERE Charname = @Char)
        UPDATE PS_GameData.dbo.Chars			SET GM = 1						WHERE CharName = @Char
        UPDATE PS_GameData.dbo.Chars			SET CharName = '[GM]'+@Char		WHERE CharName = @Char
        UPDATE PS_UserData.dbo.Users_Master		SET [Status] = 32				WHERE UserUID = @TargetUserUID
		UPDATE PS_UserData.dbo.Users_Master		SET Admin = 1					WHERE UserUID = @TargetUserUID
		UPDATE PS_UserData.dbo.Users_Master		SET AdminLevel = 255			WHERE UserUID = @TargetUserUID
    END
END
GO