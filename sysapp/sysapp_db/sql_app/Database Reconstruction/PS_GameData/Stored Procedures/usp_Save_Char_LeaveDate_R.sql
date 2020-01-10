USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Save_Char_LeaveDate_R]    Script Date: 8/15/2014 12:04:29 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Save_Char_LeaveDate_R] 

@CharID int

AS

SET NOCOUNT ON

-- 종료시간 기록
UPDATE Chars SET LeaveDate=GETDATE(), LoginStatus=0 WHERE CharID=@CharID

SET NOCOUNT OFF

SET QUOTED_IDENTIFIER OFF 

SET ANSI_NULLS OFF

GO


