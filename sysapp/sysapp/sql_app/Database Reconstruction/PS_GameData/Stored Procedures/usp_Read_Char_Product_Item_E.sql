USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_Product_Item_E]    Script Date: 8/14/2014 11:51:02 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE Proc [dbo].[usp_Read_Char_Product_Item_E]

@UserUID int

AS

SELECT Slot,ItemID,ItemCount FROM PS_GameData.dbo.Users_Product WHERE UserUID=@UserUID


GO


