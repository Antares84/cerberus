USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Keep_R]    Script Date: 8/14/2014 11:56:22 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_Keep_R]

@KeepID int = 0

AS

SET NOCOUNT ON

IF( @KeepID = 0 )
BEGIN
	SELECT KeepID,OwnCountry,ResetTime FROM Keeps
END
ELSE
BEGIN
	SELECT KeepID,OwnCountry,ResetTime FROM Keeps WHERE KeepID=@KeepID
END

SET NOCOUNT OFF


GO


