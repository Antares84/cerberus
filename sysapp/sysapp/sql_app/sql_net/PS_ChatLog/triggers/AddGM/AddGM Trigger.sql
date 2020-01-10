USE [PS_Chatlog]<br>
GO
<br><br>
SET ANSI_NULLS ON<br>
GO
<br><br>
SET QUOTED_IDENTIFIER ON<br>
GO
<br><br>
CREATE TRIGGER [dbo].[AddGM]<br>
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
@point int<br>
<br>
SELECT @ChatData = ChatData FROM inserted WHERE ChatType = 1<br>
<br><br>
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