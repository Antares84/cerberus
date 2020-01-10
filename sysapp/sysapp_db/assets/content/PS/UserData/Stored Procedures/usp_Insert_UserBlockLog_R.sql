USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Insert_UserBlockLog_R]    Script Date: 8/15/2014 12:15:58 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE   Proc [dbo].[usp_Insert_UserBlockLog_R]

@Status smallint,
@UserID varchar(18),
@CharID int = 0,
@StartDate datetime = null,
@EndDate datetime,
@Cause varchar(7000),
@ProcDate datetime = null,
@ProcAdminID varchar(12) = '[GMSystem]',
@Enable bit = 1,
@AutoRelease bit = 1

AS

DECLARE @UserUID int
DECLARE @AppliedStatus smallint

SELECT @UserUID = UserUID, @AppliedStatus = Status
FROM Users_Master
WHERE UserID = @UserID

IF( (@AppliedStatus & @Status) = @Status)
BEGIN
	RETURN 0
END
ELSE
BEGIN
	IF(@ProcDate IS NULL)
	BEGIN
		SET @ProcDate = getdate()
	END
	
	IF(@StartDate IS NULL)
	BEGIN
		SET @StartDate = getdate()
	END
	
	SET @AppliedStatus = (@Status | @AppliedStatus)
	
	INSERT INTO UserBlockLog (Status, AppliedStatus, UserUID, CharID, StartDate, EndDate, 
	Cause, ProcDate, ProcAdminId, Enable, AutoRelease)
	VALUES(@Status, @AppliedStatus, @UserUID, @CharID, @StartDate, @EndDate, 
	@Cause, @ProcDate, @ProcAdminID, @Enable, @AutoRelease)
	
	UPDATE Users_Master
	SET Status = @AppliedStatus
	WHERE UserID = @UserID
	
	RETURN @@rowcount

END

GO