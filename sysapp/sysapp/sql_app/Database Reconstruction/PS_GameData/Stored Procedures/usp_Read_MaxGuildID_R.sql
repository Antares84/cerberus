USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_MaxGuildID_R]    Script Date: 8/14/2014 11:56:40 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_MaxGuildID_R]

AS

SET NOCOUNT ON

SELECT ISNULL( MAX(GuildID),0 ) + 1 FROM Guilds

SET NOCOUNT OFF


GO


