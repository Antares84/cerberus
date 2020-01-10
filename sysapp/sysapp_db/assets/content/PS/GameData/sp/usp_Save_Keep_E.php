USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Keep_E]    Script Date: 8/15/2014 12:09:18 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Save_Keep_E]

@KeepID int,
@OwnCountry tinyint,
@ResetTime int

AS

SET NOCOUNT ON

UPDATE Keeps SET OwnCountry=@OwnCountry,ResetTime=@ResetTime WHERE KeepID=@KeepID

SET NOCOUNT OFF


GO


