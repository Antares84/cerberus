USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_WorldInfo_E]    Script Date: 8/14/2014 10:49:23 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Read_WorldInfo_E]
AS
SELECT LastWorldTime FROM WorldInfo WHERE RowID = 1

GO


