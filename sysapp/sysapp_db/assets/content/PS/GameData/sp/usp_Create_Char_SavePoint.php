USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Create_Char_SavePoint]    Script Date: 8/14/2014 11:39:26 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



/*==================================================
@author	lenasoft
@date	2006-08-31
@return	
@brief	기록점을 생성(Insert)한다.(중국/해외측만 해당)
==================================================*/
CREATE Proc [dbo].[usp_Create_Char_SavePoint]

@CharID int,
@Slot tinyint,
@MapID smallint,
@Posx real,
@Posy real,
@Posz real

AS

SET NOCOUNT ON


INSERT INTO CharSavePoint(CharID, Slot, MapID, PosX, PosY, PosZ)
VALUES(@CharID, @Slot, @MapID, @PosX, @PosY, @PosZ)

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


