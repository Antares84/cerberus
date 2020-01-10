USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_GodBless_E]    Script Date: 8/15/2014 12:07:01 AM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Save_GodBless_E]

@GodBless_Light int,
@GodBless_Dark int

AS

SET NOCOUNT ON

UPDATE WorldInfo SET GodBless_Light=@GodBless_Light, GodBless_Dark=@GodBless_Dark

IF( @@ERROR = 0 AND @@ROWCOUNT = 1 )
	RETURN 1
ELSE
	RETURN -1

SET NOCOUNT OFF


GO


