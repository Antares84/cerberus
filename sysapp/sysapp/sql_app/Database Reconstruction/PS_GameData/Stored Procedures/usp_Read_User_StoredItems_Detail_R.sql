USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_User_StoredItems_Detail_R]    Script Date: 8/14/2014 11:59:28 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_User_StoredItems_Detail_R]

@ServerID tinyint,
@UserUID int

AS

SET NOCOUNT ON

SELECT ItemID, Type, TypeID, ItemUID, Slot, Quality, 
Gem1, Gem2, Gem3, Gem4, Gem5, Gem6, Craftname, [Count], Maketype,
DATEPART(yyyy, MakeTime) AS MakeTime_YYYY, 
DATEPART(mm, MakeTime) AS MakeTime_MM, 
DATEPART(dd, MakeTime) AS MakeTime_DD, 
DATEPART(hh, MakeTime) AS MakeTime_HH, 
DATEPART(mi, MakeTime) AS MakeTime_MI, 
DATEPART(ss, MakeTime) AS MakeTime_SS

FROM UserStoredItems

WHERE ServerID=@ServerID AND UserUID=@UserUID

ORDER BY MakeTime DESC

SET NOCOUNT OFF


GO


