USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Create_Char_R2]    Script Date: 8/14/2014 11:39:13 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



/****** 개체: 저장 프로시저 dbo.usp_Create_Char_R    스크립트 날짜: 2006-05-30 오후 12:53:23 ******/

CREATE  Proc [dbo].[usp_Create_Char_R2]

@ServerID tinyint,
@UserID varchar(12),
@UserUID int,
@CharName varchar(50) ,

@Slot Tinyint,
@Family Tinyint,
@Grow Tinyint,
@Hair Tinyint,
@Face Tinyint,
@Size Tinyint,
@Job Tinyint,
@Sex Tinyint,
@Level Smallint,
@Statpoint Smallint,
@Skillpoint Smallint,
@Str Smallint,
@Dex Smallint,
@Rec Smallint,
@Int Smallint,
@Luc Smallint,
@Wis Smallint,
@Hp Smallint,
@Mp Smallint,
@Sp Smallint,
@Map Smallint,
@Dir Smallint,
@Exp Int,
@Money Int,
@Posx Real,
@Posy Real,
@Posz Real,
@Hg Smallint,
@Vg Smallint,
@Cg Tinyint,
@Og Tinyint,
@Ig Tinyint,


/* 여기까지 인자값 주어져야 함 */

/* SP 내부 참조용 변수 */

@CharID int = 0,
@NameCnt tinyint = 0

AS

SET NOCOUNT ON

DECLARE @Ret int

SET @CharName = LTRIM(RTRIM(@CharName))
SET @SkillPoint = 5
SET @Ret = 0


BEGIN TRANSACTION

INSERT INTO Chars(ServerID,UserID, UserUID, CharName, Slot, Family, Grow, 
Hair, Face, [Size], Job, Sex, [Level], StatPoint, SkillPoint, 
[Str], Dex, Rec, [Int], Luc, Wis, HP, MP, SP, Map, Dir, [Exp], [Money], 
PosX, PosY, Posz, Hg, Vg, Cg, Og, Ig, RenameCnt, RemainTime)

VALUES(@ServerID,@UserID, @UserUID, @CharName, @Slot, @Family, @Grow, 
@Hair, @Face, @Size, @Job, @Sex, @Level, @StatPoint, @SkillPoint, 
@Str, @Dex, @Rec, @Int, @Luc, @Wis, @HP, @MP, @SP, @Map, @Dir, @Exp, @Money, 
@PosX, @PosY, @Posz, @Hg, @Vg, @Cg, @Og, @Ig, 0, 0)

IF( @@ERROR=0 )
BEGIN
	COMMIT TRANSACTION
END
ELSE
BEGIN
	ROLLBACK TRANSACTION
	RETURN -1
END

SET @CharID = IDENT_CURRENT('Chars')


RETURN @CharID

SET NOCOUNT OFF

GO


