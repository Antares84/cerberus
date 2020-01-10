USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_QuickSlot_Add_E]    Script Date: 8/15/2014 12:05:46 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO





CREATE  Proc [dbo].[usp_Save_Char_QuickSlot_Add_E]

@CharID int,
@QuickBar tinyint,
@QuickSlot tinyint,
@Bag tinyint, 
@Number smallint

AS

SET NOCOUNT ON

INSERT INTO CharQuickSlots(CharID,QuickBar,QuickSlot,Bag,Number) VALUES(@CharID,@QuickBar,@QuickSlot,@Bag,@Number)

SET NOCOUNT OFF


GO


