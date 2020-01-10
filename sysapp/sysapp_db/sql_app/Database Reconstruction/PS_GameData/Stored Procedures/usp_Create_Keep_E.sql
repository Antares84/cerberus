USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Create_Keep_E]    Script Date: 8/14/2014 11:42:19 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Create_Keep_E]

@KeepID int,
@OwnCountry tinyint,
@ResetTime int

AS

SET NOCOUNT ON

INSERT INTO Keeps(KeepID,OwnCountry,ResetTime) VALUES(@KeepID,@OwnCountry,@ResetTime)

SET NOCOUNT OFF


GO


