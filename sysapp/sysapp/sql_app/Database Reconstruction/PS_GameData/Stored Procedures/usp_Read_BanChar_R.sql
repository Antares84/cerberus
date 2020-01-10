USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_BanChar_R]    Script Date: 8/14/2014 11:48:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_BanChar_R]

@CharID int

AS

SET NOCOUNT ON

SELECT BanID,BanName,Memo FROM BanChars WHERE CharID=@CharID

SET NOCOUNT OFF


GO


