USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Insert_UserPauseLog_R]    Script Date: 8/15/2014 12:16:10 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Insert_UserPauseLog_R]

@Status smallint,
@UserID varchar(18),
@Cause  varchar(7000),
@ProcDate datetime = null,
@ProcAdminID varchar(12),
@StartDate datetime = null,
@EndDate datetime = null,
@Enable bit = 1

AS

DECLARE @UserUID bigint
DECLARE @AppliedStatus smallint


SELECT @UserUID = UserUID, @AppliedStatus = Status
FROM Users_Master 
WHERE UserID = @UserID

IF(@ProcDate IS NULL)
BEGIN
	SET @ProcDate = getdate()
END

IF(@StartDate IS NULL)
BEGIN
	SET @StartDate = getdate()
END
IF(@EndDate IS NULL)
BEGIN
	SET @EndDate = '9999-12-31'
END

SET @AppliedStatus = (@AppliedStatus | @Status)

INSERT UserPauseLog(Status, AppliedStatus, UserUID, Cause, ProcDate, ProcAdminID,
 StartDate, EndDate, Enable)
VALUES(@Status, @AppliedStatus, @UserUID, @Cause, @ProcDate, @ProcAdminID,
 @StartDate, @EndDate, @Enable)

UPDATE Users_Master
SET Status = @AppliedStatus
WHERE UserID = @UserID

RETURN @@rowcount

GO