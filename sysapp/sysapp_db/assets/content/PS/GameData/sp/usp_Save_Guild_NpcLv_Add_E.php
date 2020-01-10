USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Guild_NpcLv_Add_E]    Script Date: 8/15/2014 12:08:07 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO




CREATE Proc [dbo].[usp_Save_Guild_NpcLv_Add_E]

@GuildID 	int,
@GNpcType	smallint,
@NpcLevel	tinyint,
@Number	tinyint

AS

SET NOCOUNT ON

INSERT INTO GuildNpcLv ( GuildID, GNpcType, NpcLevel, Number )
VALUES(  @GuildID, @GNpcType, @NpcLevel, @Number )


SET NOCOUNT OFF


GO


