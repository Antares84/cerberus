USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_User_GiftPointItemNotify]    Script Date: 8/15/2014 12:09:38 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO





CREATE Proc [dbo].[usp_Save_User_GiftPointItemNotify]

@UserUID int,
@ProductCode varchar(20),
@SendCharName varchar(30),
@RecvDate datetime

AS

SET NOCOUNT ON



-- 선물 로그 기록
INSERT INTO PointGiftNotify(UserUID,ProductCode,SendCharName,RecvDate)
VALUES(@UserUID,@ProductCode,@SendCharName,@RecvDate)



IF(@@ERROR = 0 AND @@ROWCOUNT = 1)
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END



SET NOCOUNT OFF

GO


