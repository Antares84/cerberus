USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_GuildNpcLv_R]    Script Date: 8/14/2014 11:54:22 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO







CREATE Proc [dbo].[usp_Read_GuildNpcLv_R]

@GuildID 	int

AS

SET NOCOUNT ON

SELECT GNpcType, NpcLevel, Number  FROM GuildNpcLv 
WHERE GuildID=@GuildID AND Del=0 ORDER BY Number ASC

SET NOCOUNT OFF


GO


