USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_ExpDefs_R]    Script Date: 8/14/2014 10:43:29 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_ExpDefs_R]

AS
SELECT [Level], Grow, [Exp] FROM ExpDefs
ORDER BY Grow ASC, Level ASC

GO


