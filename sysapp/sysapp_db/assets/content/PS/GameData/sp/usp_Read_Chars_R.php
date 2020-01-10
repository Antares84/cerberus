USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Chars_R]    Script Date: 8/14/2014 11:52:19 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO


/****** 개체: 저장 프로시저 dbo.usp_Read_Chars_R    스크립트 날짜: 2006-05-09 오후 12:17:36 ******/


CREATE  Proc [dbo].[usp_Read_Chars_R]

@ServerID tinyint,
@UserUID int,
@Del int= 0

AS

SET NOCOUNT ON

SELECT CharID, CharName, Slot, 
Family, Grow, Hair, Face, [Size], Job, Sex, [Level], [Str], Dex, Rec, [Int], Luc, Wis, 
HP, MP, SP, Map, RenameCnt, RemainTime, 
DATEPART(yyyy, RegDate) AS MakeTime_YYYY, 
DATEPART(mm, RegDate) AS MakeTime_MM, 
DATEPART(dd, RegDate) AS MakeTime_DD, 
DATEPART(hh, RegDate) AS MakeTime_HH, 
DATEPART(mi, RegDate) AS MakeTime_MI, 
DATEPART(ss, RegDate) AS MakeTime_SS

FROM Chars

WHERE ServerID=@ServerID AND UserUID=@UserUID AND Del=@Del

SET NOCOUNT OFF



GO


