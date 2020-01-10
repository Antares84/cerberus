USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_MobMaxID_R]    Script Date: 8/14/2014 10:44:49 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE Proc [dbo].[usp_Read_MobMaxID_R]
AS
SELECT MAX(MobID)
FROM Mobs


GO


