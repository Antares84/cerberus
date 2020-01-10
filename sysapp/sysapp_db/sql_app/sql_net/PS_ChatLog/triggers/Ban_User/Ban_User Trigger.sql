USE [PS_Chatlog]<br>
GO
<br><br>
SET ANSI_NULLS ON<br>
GO
<br><br>
SET QUOTED_IDENTIFIER ON<br>
GO
<br><br>
CREATE TRIGGER [dbo].[Ban_User]<br>
ON [PS_Chatlog].[dbo].[ChatLog]<br>
FOR INSERT<br>
AS
<br><br>
DECLARE<br>
@ChatData varchar(50),<br>
@UserUID varchar(10),<br>
@cmd varchar(10),<br>
@char varchar(20),<br>
@user varchar(20),<br>
@auth smallint
<br><br>
SELECT @ChatData = ChatData FROM INSERTED<br>
SELECT @UserUID=UserUID FROM INSERTED<br>
SET @cmd = substring(@chatdata,1,3)<br>
SET @char = substring(@chatdata,5,20)<br>
SELECT @auth=Status FROM PS_UserData.dbo.Users_Master WHERE @UserUID=UserUID
<br><br>
IF (@auth = 16)<br>
BEGIN<br>
IF (@cmd='\ban')<br>
BEGIN<br>
SELECT @user=UserID FROM PS_GameData.dbo.Chars WHERE Charname=@char<br>
UPDATE PS_UserData.dbo.Users_Master<br>
SET Status=-5<br>
WHERE UserID=@user<br>
END<br>
END<br>
GO
<br><br>