USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Guild2_R]    Script Date: 8/14/2014 11:53:54 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO







CREATE Proc [dbo].[usp_Read_Guild2_R]

AS

SET NOCOUNT ON

SELECT G.GuildID, G.GuildName, G.MasterName, G.Country, G.GuildPoint, 
ISNULL(H.Rank,31) Rank, ISNULL(H.Etin,0) Etin, ISNULL(H.UseHouse,0) UseHouse, ISNULL(H.Remark, '') Remark, ISNULL( H.BuyHouse,0) BuyHouse, ISNULL(H.EtinReturnCnt, 0 )  EtinReturnCnt, ISNULL(H.KeepEtin, 0) KeepEtin
FROM Guilds G
LEFT OUTER JOIN GuildDetails H ON H.GuildID = H.GuildID
WHERE G.Del=0
ORDER BY H.Rank DESC

SET NOCOUNT OFF


GO


