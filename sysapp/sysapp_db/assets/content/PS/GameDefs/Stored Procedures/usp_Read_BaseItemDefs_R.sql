USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_BaseItemDefs_R]    Script Date: 8/14/2014 10:43:19 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE Proc [dbo].[usp_Read_BaseItemDefs_R]
AS
SELECT Family, Job, ItemID, Type, TypeID, [Count], Slot, Quality 
FROM BaseItemsDefs 
ORDER BY Family ASC, Job ASC


GO


