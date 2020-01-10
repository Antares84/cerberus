USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_WorldInfo_E]    Script Date: 8/14/2014 11:59:52 PM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER OFF
GO

CREATE PROC [dbo].[usp_Read_WorldInfo_E]

AS

SET NOCOUNT ON

SELECT TOP 1 LastWorldTime FROM WorldInfo

SET NOCOUNT OFF

GO


