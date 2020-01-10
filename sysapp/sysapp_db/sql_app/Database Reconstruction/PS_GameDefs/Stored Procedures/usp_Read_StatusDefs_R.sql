USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_StatusDefs_R]    Script Date: 8/14/2014 10:49:11 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Read_StatusDefs_R]

AS
SELECT [Level], Job, HP, SP, MP FROM StatusDefs
ORDER BY [Level] ASC, Job ASC

GO


