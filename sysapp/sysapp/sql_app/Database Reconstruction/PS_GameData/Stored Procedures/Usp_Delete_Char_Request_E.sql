USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[Usp_Delete_Char_Request_E]    Script Date: 8/14/2014 11:43:16 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE Proc [dbo].[Usp_Delete_Char_Request_E]

@CharID int,
@RemainTime int

AS

SET NOCOUNT ON

--캐릭터정보 삭제요청처리
UPDATE Chars SET RemainTime=@RemainTime WHERE CharID=@CharID

IF(@@ERROR = 0)
BEGIN
	RETURN 1
END
ELSE
BEGIN
	RETURN -1
END

SET NOCOUNT OFF

GO


