USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_User_MaxGrow_R]    Script Date: 8/14/2014 11:59:16 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_User_MaxGrow_R]

@ServerID tinyint,
@UserUID int

AS

SET NOCOUNT ON

SELECT Country,3 as MaxGrow FROM UserMaxGrow WHERE ServerID=@ServerID AND UserUID=@UserUID

SET NOCOUNT OFF
GO


