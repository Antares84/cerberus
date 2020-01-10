USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_QuickSlot_Del_E]    Script Date: 8/15/2014 12:05:57 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_QuickSlot_Del_E]

@CharID int

AS

SET NOCOUNT ON

DELETE CharQuickSlots WHERE CharID=@CharID

SET NOCOUNT OFF


GO


