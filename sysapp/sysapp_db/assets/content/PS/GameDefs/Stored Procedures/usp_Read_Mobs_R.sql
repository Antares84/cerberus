USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Mobs_R]    Script Date: 8/14/2014 10:47:00 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO


CREATE Proc [dbo].[usp_Read_Mobs_R]
/* Created by frsunny@hotmail.com, 2004-08-11
몬스터 테이블 읽어오기 */
AS
SELECT MobID, MobName, [Level], [Exp], AI, Money1, Money2, QuestItemID, 
HP, SP, MP, Dex, Wis, Luc, [Day], [Size], Attrib, Defense, Magic, 
ResistState1, ResistState2, ResistState3, ResistState4, ResistState5, ResistState6, ResistState7, ResistState8,
ResistState9, ResistState10, ResistState11, ResistState12, ResistState13, ResistState14, ResistState15, 
ResistSkill1, ResistSkill2, ResistSkill3, ResistSkill4, ResistSkill5, ResistSkill6, 
NormalTime, NormalStep, ChaseTime, ChaseStep, ChaseRange, 
AttackType1, AttackTime1, Attackrange1, Attack1, Attackplus1, Attackattrib1, Attackspecial1, Attackok1, 
Attacktype2, Attacktime2, Attackrange2, Attack2, Attackplus2, Attackattrib2, Attackspecial2, Attackok2, 
Attacktype3, Attacktime3, Attackrange3, Attack3, Attackplus3, Attackattrib3, Attackspecial3, Attackok3 
FROM Mobs
ORDER BY MobID ASC


GO


