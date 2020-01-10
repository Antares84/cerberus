USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Guild_NpcLv_Mod_E]    Script Date: 8/15/2014 12:08:15 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO




CREATE Proc [dbo].[usp_Save_Guild_NpcLv_Mod_E]

@GuildID 	int,
@GNpcType	smallint,
@NpcLevel	tinyint,
@Number	tinyint

AS

SET NOCOUNT ON

UPDATE GuildNpcLv
SET NpcLevel=@NpcLevel
WHERE GuildID=@GuildID AND GNpcType=@GNpcType AND Number=@Number

SET NOCOUNT OFF


GO


