USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_ItemCount_ByServer_R]    Script Date: 8/14/2014 11:54:32 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_ItemCount_ByServer_R]

AS

SET NOCOUNT ON

SELECT V.Type, V.TypeID, V.ItemID, COUNT(*) AS COUNT
FROM View_Items V WITH(NOLOCK) INNER JOIN PS_DEFINEDB.PS_GameDefs.dbo.Items I
ON V.ItemID = I.ItemID
WHERE I.Server <> 0
GROUP BY V.Type, V.TypeID, V.ItemID

SET NOCOUNT OFF
GO


