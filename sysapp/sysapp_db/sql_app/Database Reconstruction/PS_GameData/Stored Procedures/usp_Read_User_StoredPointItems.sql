USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_User_StoredPointItems]    Script Date: 8/14/2014 11:59:40 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO



/*==================================================
@author	lenasoft
@date	2006-09-25
@return	

@brief	유저의 포인트아이템을 리드한다.
==================================================*/


CREATE   Proc [dbo].[usp_Read_User_StoredPointItems]

@UserUID int

AS

SET NOCOUNT ON

SELECT Slot,ItemID,ItemCount FROM UserStoredPointItems WHERE UserUID=@UserUID


SET NOCOUNT OFF
GO


