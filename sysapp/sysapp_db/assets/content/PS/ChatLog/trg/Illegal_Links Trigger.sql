USE [PS_Chatlog]
GO

/****** Object:  Trigger [dbo].[Illegal_Links]    Script Date: 8/14/2014 10:23:24 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TRIGGER [dbo].[IllegalLinks]
ON [PS_Chatlog].[dbo].[ChatLog]
FOR INSERT
AS

-- By [Dev]Ash Artanis (c)2011
-- Written: 1-1-2014

DECLARE
@row int,
@ChatData varchar(120),
@ChatTime datetime, 
@UserUID int,
@UserID varchar(30),
@Admin bit,
@AdminLevel int,
@Status smallint,
@CharID int,
@CharName varchar(30),
@IP varchar(17),
@point int,@ItemUID bigint,
@Bag tinyint,
@Slot tinyint,
@ItemID int,
@Type tinyint,
@TypeID tinyint,
@Quality int,
@Gem1 tinyint,
@Gem2 tinyint,
@Gem3 tinyint,
@Gem4 tinyint,
@Gem5 tinyint,
@Gem6 tinyint,
@Craftname varchar(20) = '',
@Count tinyint,
@MaketimeZ varchar(50),
@Maketype char(1),
@RequestedBy varchar(30),
@Maketime datetime

SELECT @ChatData = ChatData FROM inserted WHERE ChatType = 1

-- Illegal Linking Log
IF (@ChatData = 'staff1')
BEGIN
	SET @UserUID =		(SELECT TOP 1 UserUID		FROM inserted WHERE ChatData = 'staff1')
	SET @Admin =		(SELECT TOP 1 [Admin]		FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)
	SET @AdminLevel =	(SELECT TOP 1 AdminLevel	FROM PS_UserData.dbo.Users_Master WHERE UserUID = @UserUID)
	IF ((@Admin = 1) AND (@AdminLevel = 16))
		BEGIN
-- Begin Get Requesting Char Info
			SET @RequestedBy=		(SELECT CharName		FROM PS_GameData.dbo.Chars WHERE CharID = @CharID)
-- End Get Requesting Char Info
	SELECT CharID, ItemID, ItemUID, Type, TypeID, bag, slot, quality, gem1, gem2, gem3, gem4,
gem5, gem6, craftname, [count], maketime, maketype
FROM PS_GameData.dbo.CharItems
WHERE ItemID = '25003'
INSERT INTO PS_IllegalLinks.dbo.IllegalCharItems
	VALUES (@RequestedBy, getdate(), @CharID, @Bag, @Slot, @ItemID, @Type, @TypeID, @ItemUID, @Quality, @Gem1, @Gem2, @Gem3, @Gem4,
@Gem5, @Gem6, @Craftname, @Count, @Maketime, @Maketype)
	END
END

GO


