USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_WorldInfo_E]    Script Date: 8/15/2014 12:11:12 AM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Save_WorldInfo_E]

@LastWorldTime int

AS

SET NOCOUNT ON

DECLARE @Cnt int

SET @Cnt = (SELECT ISNULL(COUNT(*), 0) FROM WorldInfo)

IF(@Cnt = 1)
BEGIN
	UPDATE WorldInfo SET LastWorldTime=@LastWorldTime
END
ELSE
BEGIN
	INSERT INTO WorldInfo(LastWorldTime,GodBless_Light,GodBless_Dark) VALUES(@LastWorldTime,0,0)
END

SET NOCOUNT OFF


GO


