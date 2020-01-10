USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_WorldInfo_E]    Script Date: 8/14/2014 10:50:02 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Save_WorldInfo_E]
@LastWorldTime int
AS
UPDATE WorldInfo
SET LastWorldTime = @LastWorldTime

GO


