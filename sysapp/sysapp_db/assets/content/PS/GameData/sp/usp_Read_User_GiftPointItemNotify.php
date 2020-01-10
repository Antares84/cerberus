USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_User_GiftPointItemNotify]    Script Date: 8/14/2014 11:58:37 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE Proc [dbo].[usp_Read_User_GiftPointItemNotify]

@UserUID int

AS


SET NOCOUNT ON


SELECT ProductCode, SendCharName, RecvDate 
FROM    PointGiftNotify WITH (READUNCOMMITTED) 
WHERE UserUID=@UserUID
ORDER BY RecvDate


IF( @@ROWCOUNT > 0)
BEGIN
	delete PointGiftNotify
	where UserUID=@UserUID
END


SET NOCOUNT OFF

GO


