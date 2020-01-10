USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_Info_E]    Script Date: 8/15/2014 12:03:44 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_Info_E]

@CharID int,
@Level int,
@StatPoint smallint,
@SkillPoint smallint,
@Str smallint,
@Dex smallint,
@Rec smallint,
@Int smallint,
@Wis smallint,
@Luc smallint,
@Hp smallint,
@Mp smallint,
@Sp smallint,
@Map smallint,
@Dir smallint,
@Exp int,
@Money int,
@Posx real,
@Posy real,
@Posz real,
@Hg int,
@Vg int,
@Cg int,
@Og int,
@Ig int,
@K1 int = null,
@K2 int = null,
@K3 int = null,
@K4 int = null,
@KillLevel tinyint,
@DeadLevel tinyint

AS

SET NOCOUNT ON

DECLARE @ServerID int
SET @ServerID = 1

UPDATE Chars
SET [Level] = @Level, StatPoint = @StatPoint, SkillPoint = @SkillPoint,
[Str] = @Str, dex = @Dex, Rec = @Rec, [int] = @Int, Wis = @Wis, Luc = @Luc,
HP = @Hp, Mp = @Mp, Sp = @Sp,
Map = @Map, dir = @Dir, [exp] = @Exp, [money] = @Money,
PosX = @Posx, PosY = @PosY, PosZ = @PosZ, hg = @Hg, vg = @Vg, cg = @Cg, og = @Og, ig = @Ig, 
KillLevel=@KillLevel, DeadLevel=@DeadLevel,LeaveDate=GETDATE(), LoginStatus = 0
WHERE CharID = @CharID

IF( (@K1 IS NOT NULL) AND (@K2 IS NOT NULL) AND (@K3 IS NOT NULL) AND (@K4 IS NOT NULL))
BEGIN
	UPDATE Chars SET K1=@K1, K2=@K2, K3=@K3, K4=@K4 WHERE CharID=@CharID
END

--EXEC PS_USERDB01.PS_UserData_IDC_T3.dbo.usp_Update_CharsPVPData_E @ServerID = @ServerID, @CharID = @CharID, @K1 = @K1, @K2 = @K2, @K3 = @K3, @K4 = @K4

IF(@@ERROR = 0 AND @@ROWCOUNT = 1)
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF


GO


