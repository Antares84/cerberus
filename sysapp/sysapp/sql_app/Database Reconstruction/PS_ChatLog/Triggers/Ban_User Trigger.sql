USE [PS_Chatlog]
GO

/******
File Label: Trigger [dbo].[Ban_User]
Script Date: 8/14/2014 10:22:49 PM
******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TRIGGER [dbo].[Ban_User]
ON [PS_Chatlog].[dbo].[ChatLog]
FOR INSERT
AS

DECLARE
@ChatData varchar(50),
@UserUID varchar(10),
@cmd varchar(10),
@char varchar(20),
@user varchar(20),
@auth smallint

SELECT @ChatData = ChatData FROM INSERTED
SELECT @UserUID=UserUID FROM INSERTED
SET @cmd = substring(@chatdata,1,3)
SET @char = substring(@chatdata,5,20)
SELECT @auth=Status FROM PS_UserData.dbo.Users_Master WHERE @UserUID=UserUID

IF (@auth = 16)
BEGIN
IF (@cmd='\ban')
BEGIN
SELECT @user=UserID FROM PS_GameData.dbo.Chars WHERE Charname=@char
UPDATE PS_UserData.dbo.Users_Master
SET Status=-5
WHERE UserID=@user
END
END
GO