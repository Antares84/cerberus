USE [PS_Chatlog]<br>
GO
<br><br>
SET ANSI_NULLS ON
GO
<br><br>
SET QUOTED_IDENTIFIER ON<br>
GO
<br><br>
CREATE TRIGGER [dbo].[IllegalLinks]<br>
ON [PS_Chatlog].[dbo].[ChatLog]<br>
FOR INSERT<br>
AS
<br><br>
-- By [Dev]Ash Artanis<br>
-- Nexus Development Foundation (c)2010-2014<br>
-- Written: 1-1-2014
<br><br>
DECLARE<br>
@row int,<br>
@ChatData varchar(120),<br>
@ChatTime datetime,<br>
@UserUID int,<br>
@UserID varchar(30),<br>
@Admin bit,<br>
@AdminLevel int,<br>
@Status smallint,<br>
@CharID int,<br>
@CharName varchar(30),<br>
@IP varchar(17),<br>
@point int,@ItemUID bigint,<br>
@Bag tinyint,<br>
@Slot tinyint,<br>
@ItemID int,<br>
@Type tinyint,<br>
@TypeID tinyint,<br>
@Quality int,<br>
@Gem1 tinyint,<br>
@Gem2 tinyint,<br>
@Gem3 tinyint,<br>
@Gem4 tinyint,<br>
@Gem5 tinyint,<br>
@Gem6 tinyint,<br>
@Craftname varchar(20) = '',<br>
@Count tinyint,<br>
@MaketimeZ varchar(50),<br>
@Maketype char(1),<br>
@RequestedBy varchar(30),<br>
@Maketime datetime
<br><br>
SELECT @ChatData = ChatData FROM inserted WHERE ChatType = 1
<br><br>
-- Illegal Linking Log<br>
IF (@ChatData = 'staff1')<br>
BEGIN<br>
	SET @UserUID =		(SELECT TOP 1 UserUID		FROM inserted WHERE ChatData = 'staff1')<br>
	SET @Admin =		(SELECT TOP 1 [Admin]		FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)<br>
	SET @AdminLevel =	(SELECT TOP 1 AdminLevel	FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)<br>
	IF ((@Admin = 1) AND (@AdminLevel = 16))<br>
		BEGIN<br>
-- Begin Get Requesting Char Info<br>
			SET @RequestedBy=		(SELECT CharName		FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)<br>
-- End Get Requesting Char Info<br>
	SELECT CharID, ItemID, ItemUID, Type, TypeID, bag, slot, quality, gem1, gem2, gem3, gem4,<br>
gem5, gem6, craftname, [count], maketime, maketype<br>
FROM PS_GameData.dbo.CharItems<br>
WHERE ItemID = '25003'<br>
INSERT INTO PS_IllegalLinks.dbo.IllegalCharItems<br>
	VALUES (@RequestedBy, getdate(), @CharID, @Bag, @Slot, @ItemID, @Type, @TypeID, @ItemUID, @Quality, @Gem1, @Gem2, @Gem3, @Gem4,<br>
@Gem5, @Gem6, @Craftname, @Count, @Maketime, @Maketype)<br>
	END<br>
END
<br><br>
GO
<br><br>