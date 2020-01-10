USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_GuildJoinDate_R]    Script Date: 8/15/2014 3:25:48 AM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER OFF
GO

CREATE Proc [dbo].[usp_Read_Char_GuildJoinDate_R]
@CharID	int
AS

SET NOCOUNT ON

DECLARE 
@RemainTime	int

SET @RemainTime = 0

SELECT TOP 1 @RemainTime = CASE 
WHEN DATEDIFF ( Hour , JoinDate , GETDATE() ) >=72 THEN 0
else 72-DATEDIFF ( Hour , JoinDate , GETDATE() ) END
FROM GuildChars
WHERE CharID = @CharID
ORDER BY JoinDate DESC

PRINT(@RemainTime)

RETURN @RemainTime

SET NOCOUNT OFF

GO