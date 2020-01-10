USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_SavePoint]    Script Date: 8/15/2014 12:06:05 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



/*==================================================
@author	lenasoft
@date	2006-08-31
@return	
@brief	기록점을 저장(Update)한다.(중국/해외측만 해당)
==================================================*/
CREATE Proc [dbo].[usp_Save_Char_SavePoint]

@CharID int,
@Slot tinyint,
@MapID smallint,
@PosX real,
@PosY real,
@PosZ real

AS

SET NOCOUNT ON


UPDATE CharSavePoint SET MapID=@MapID, PosX=@PosX, PosY=@PosY, PosZ=@PosZ
WHERE CharID=@CharID AND Slot=@Slot

IF( @@ERROR = 0 )
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF




GO


