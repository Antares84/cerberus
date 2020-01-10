USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_GodBless_R]    Script Date: 8/14/2014 11:52:56 PM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER OFF
GO



CREATE Proc [dbo].[usp_Read_GodBless_R]

AS

SET NOCOUNT ON

SELECT GodBless_Light, GodBless_Dark FROM WorldInfo

SET NOCOUNT OFF


GO


