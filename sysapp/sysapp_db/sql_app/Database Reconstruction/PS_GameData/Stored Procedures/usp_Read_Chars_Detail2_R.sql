USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Chars_Detail2_R]    Script Date: 8/14/2014 11:51:58 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_Chars_Detail2_R] 

@CharID int

AS

SET NOCOUNT ON

DECLARE @UserUID int
DECLARE @Money bigint
DECLARE @GuildID int
DECLARE @GuildLevel tinyint
DECLARE @UID varchar (18)

-- 2005-12-30 스탯,스킬 이벤트관련...
DECLARE @Event1 tinyint
DECLARE @Event2 tinyint
--

SET @Money = 0
SET @UserUID = (SELECT UserUID FROM Chars WHERE CharID = @CharID)
SET @GuildID = (SELECT GuildID FROM GuildChars WHERE CharID = @CharID AND Del = 0)

IF(@UserUID IS NOT NULL)
BEGIN
	SET @Money = (SELECT ISNULL([Money], 0) FROM UserStoredMoney WHERE UserUID = @UserUID)
END
ELSE
BEGIN
	SET @Money = 0
END

IF(@GuildID IS NOT NULL)
BEGIN
	SET @GuildLevel = (SELECT GuildLevel FROM GuildChars WHERE CharID = @CharID AND Del = 0)
END
ELSE
BEGIN
	SET @GuildID = 0
	SET @GuildLevel = 0
END

-- 2005-12-30 스탯,스킬 이벤트관련...
SELECT @Event1=Event1, @Event2=Event2 FROM CharEvents WHERE CharID=@CharID
--

SELECT UserUID, CharID, CharName, Slot, Family, Grow, Hair, Face, [Size], Job, Sex, [Level], 
StatPoint AS DistPoint, SkillPoint, [Str], Dex, Rec, [Int], Luc, Wis, HP, MP, SP, Map, Dir, [Exp], [Money], 
PosX, PosY, PosZ, Hg, Vg, Cg, Og, Ig, Del, K1, K2, K3, K4, @Money AS StoredMoney, @GuildID AS GuildID, @GuildLevel AS GuildLevel,

-- 전투공로관 보상레벨
KillLevel, DeadLevel,
--

-- 스탯,스킬 이벤트관련...
@Event1, @Event2,
--

DATEPART(yyyy, LeaveDate) AS LeaveDate_YYYY, 
DATEPART(mm, LeaveDate) AS LeaveDate_MM, 
DATEPART(dd, LeaveDate) AS LeaveDate_DD, 
DATEPART(hh, LeaveDate) AS LeaveDate_HH, 
DATEPART(mi, LeaveDate) AS LeaveDate_MI, 
DATEPART(ss, LeaveDate) AS LeaveDate_SS

--

FROM Chars WHERE CharID = @CharID

--

SET NOCOUNT OFF
SET QUOTED_IDENTIFIER OFF 
SET ANSI_NULLS OFF


GO


