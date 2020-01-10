USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Chars_PointLog_R]    Script Date: 8/14/2014 11:52:08 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO




CREATE Proc [dbo].[usp_Read_Chars_PointLog_R]

@CharID int
--@UseType tinyint

AS

SET NOCOUNT ON


SELECT TOP 10 ProductCode, UseDate, UsePoint FROM PointLog WITH (READUNCOMMITTED) WHERE CharID=@CharID
ORDER BY UseDate desc

SET NOCOUNT OFF
GO


