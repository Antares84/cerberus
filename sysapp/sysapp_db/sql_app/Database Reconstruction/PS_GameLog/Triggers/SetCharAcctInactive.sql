USE [PS_GameLog]
GO

/****** Object:  Trigger [dbo].[SetCharAcctInactive]    Script Date: 8/14/2014 10:36:22 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TRIGGER [dbo].[SetCharAcctInactive]
ON [PS_GameLog].[dbo].[ActionLog]
FOR INSERT
AS
-- Created By [Dev]Ash Artanis 12-26-2013
DECLARE
@UserUID int,
@ActionType int,
@UserLeave int,
@CharLogin int,
@CharID int

IF ( @ActionType = 108 )
BEGIN

SET @ActionType=	(SELECT ActionType	FROM Inserted)
SET @CharID=		(SELECT CharID		FROM Inserted)
SET @UserUID=		(SELECT UserUID		FROM inserted)
SET @UserLeave=		(SELECT Leave				FROM PS_UserData.dbo.Users_Master	WHERE @UserUID=UserUID)
SET @CharLogin=		(SELECT LoginStatus			FROM PS_GameData.dbo.Chars			WHERE @CharID=CharID)

UPDATE PS_UserData.dbo.Users_Master		SET Leave=0			WHERE UserUID=@UserUID
UPDATE PS_GameData.dbo.Chars			SET LoginStatus=0	WHERE CharID=@CharID

END
GO


