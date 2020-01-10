USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Char_SavePoint]    Script Date: 8/14/2014 11:51:37 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



/*==================================================
@author	lenasoft
@date	2006-08-29
@return	
@brief	저장된 기록점을 가져온다.(중국/해외측만 해당)
==================================================*/
CREATE Proc [dbo].[usp_Read_Char_SavePoint]

@CharID int

AS

SET NOCOUNT ON

SELECT Slot, MapID, PosX, PosY, PosZ FROM CharSavePoint
WHERE CharID = @CharID

SET NOCOUNT OFF


GO


