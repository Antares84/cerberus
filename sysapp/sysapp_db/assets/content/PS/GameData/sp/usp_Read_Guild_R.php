USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Guild_R]    Script Date: 8/14/2014 11:53:35 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_Guild_R]

AS

SET NOCOUNT ON

SELECT GuildID,GuildName,MasterName,Country FROM Guilds WHERE Del=0

SET NOCOUNT OFF


GO


