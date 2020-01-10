USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Items_R2]    Script Date: 8/14/2014 10:43:52 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO






CREATE Proc [dbo].[usp_Read_Items_R2]
@ItemID	int
AS

SET NOCOUNT ON

SELECT ItemID, ItemName, Type, TypeID, Reqlevel, Country, 
Attackfighter, Defensefighter, Patrolrogue, Shootrogue, Attackmage, Defensemage, 
Grow, ReqStr, ReqDex, ReqRec, ReqInt, ReqWis, Reqluc, ReqVg, ReqOg, ReqIg, 
Range, AttackTime, Attrib, Special, Slot, Quality, Effect1, Effect2, Effect3, Effect4, 
ConstHP, ConstSP, ConstMP, ConstStr, ConstDex, ConstRec, ConstInt, ConstWis, ConstLuc, 
Speed, [Exp], Buy, Sell, Grade, [Drop], Server, [Count]
FROM Items
WHERE ItemID = @ItemID

SET NOCOUNT OFF




GO


