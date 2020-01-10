USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Insert_WorldInfo_E]    Script Date: 8/14/2014 10:42:37 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Insert_WorldInfo_E]
AS
INSERT INTO WorldInfo(LastWorldTime) VALUES(0)

GO