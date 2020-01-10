USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_QuickSlots_R]    Script Date: 8/14/2014 11:51:29 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_Char_QuickSlots_R]

@CharID int

AS

SET NOCOUNT ON

SELECT QuickBar,QuickSlot,Bag,Number FROM CharQuickSlots WHERE CharID=@CharID

SET NOCOUNT OFF


GO


