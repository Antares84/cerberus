USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_Items_Detail_R]    Script Date: 8/14/2014 11:50:46 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_Char_Items_Detail_R]

@CharID int

AS

SET NOCOUNT ON

SELECT ItemID, Type, TypeID, ItemUID, Bag, Slot, Quality, 
Gem1, Gem2, Gem3, Gem4, Gem5, Gem6, Craftname, [Count],  Maketype ,
DATEPART(yyyy, MakeTime) AS MakeTime_YYYY, 
DATEPART(mm, MakeTime) AS MakeTime_MM, 
DATEPART(dd, MakeTime) AS MakeTime_DD, 
DATEPART(hh, MakeTime) AS MakeTime_HH, 
DATEPART(mi, MakeTime) AS MakeTime_MI, 
DATEPART(ss, MakeTime) AS MakeTime_SS

FROM CharItems

WHERE CharID = @CharID AND Del = 0

SET NOCOUNT OFF


GO


