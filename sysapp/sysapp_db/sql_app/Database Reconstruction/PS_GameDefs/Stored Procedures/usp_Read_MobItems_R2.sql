USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_MobItems_R2]    Script Date: 8/14/2014 10:44:29 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO






CREATE Proc [dbo].[usp_Read_MobItems_R2]
@MobID smallint

AS

SET NOCOUNT ON

SELECT MobID, ItemOrder, Grade, DropRate 
FROM MobItems
WHERE MobID = @MobID

SET NOCOUNT OFF




GO


