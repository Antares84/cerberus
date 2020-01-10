USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[Artanis_StaffStatus]    Script Date: 8/14/2014 11:23:27 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[Artanis_StaffStatus] 

AS

SET NOCOUNT ON

DECLARE @UserUID int
DECLARE @UID varchar (18)
DECLARE @CharID int
DECLARE @Event1 tinyint
DECLARE @Event2 tinyint
DECLARE @LoginStatus tinyint
DECLARE @StaffStatus tinyint
-- Web Status Update By [DEV]Ash Artanis 12-8-2013

--
SELECT @UserUID=UserUID, @LoginStatus=LoginStatus FROM Chars WHERE CharID = @CharID
--
IF @CharID = 2050
BEGIN
UPDATE Chars SET StaffStatus = 1 WHERE CharID=@CharID
END
ELSE
IF @CharID = 4
BEGIN
UPDATE Chars SET StaffStatus = 1 WHERE CharID=@CharID
END
-- Tested and working.
/* -- All you have to do is copy this section starting with the BEGIN and
change the CharID to match a staff CharID. Thus, it will update the Web Script
and show that Character as being a Staff Member.
IF @CharID = 2050
BEGIN
UPDATE Chars SET JoinDate=GETDATE(), LoginStatus = 1, StaffStatus = 1 WHERE CharID=@CharID
END
*/
GO


