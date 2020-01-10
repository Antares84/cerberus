USE [PS_UserData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Try_GameLogin_Taiwan]    Script Date: 8/15/2014 12:17:26 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

CREATE  Proc [dbo].[usp_Try_GameLogin_Taiwan]

@UserID     varchar(18),
@InPassword    varchar(32),

@SessionID     bigint,
@UserIP     varchar(15),

@UserUID     int = 0,
@LoginType     smallint = 1, 
@LoginTime     datetime = NULL

AS

SET NOCOUNT ON

DECLARE 

@Leave tinyint,
@Status smallint,
@onlinePlayers int,
@CompanyIP varchar(15),
@TempIP varchar(15),
@Check int,
@EmailUpdated bit,
@AcctOnline bit
SET @Status =         -1
SET @LoginTime =     GETDATE()

--------------------------------------------------
SET @CompanyIP =     '61.107.81'
SET @UserIP =        LTRIM( RTRIM(@UserIP) )
--------------------------------------------------
SET @Check = 0
--------------------------------------------------

SELECT @UserUID=UserUID, @Status=Status, @Leave=Leave FROM Users_Master WHERE UserID = @UserID

-- NotExist User OR Leave User
IF( @UserUID = 0 OR @Leave = 1 )
BEGIN
    SET @Status = -3
END
ELSE
BEGIN
    -- Check Password
    EXEC dbo.sp_LoginSuccessCheck @UserID, @InPassword, @Check output
    IF ( @@ERROR = 0 )
    BEGIN
        IF( @Check <> 1 )
        BEGIN
            SET @Status = -1
        END
    END
    ELSE
    BEGIN
        SET @Status = -1 SET @AcctOnline = 1
	END
END
     -- Range Ban Script --
	DECLARE @IPexist int, @o1 tinyint, @o2 tinyint, @ChkIP varchar(7)
    set @o1 = PARSENAME(@UserIP, 4)
    set @o2 = PARSENAME(@UserIP, 3)
    SET @ChkIP = CONVERT(varchar(3),@o1)+'.'+ CONVERT(varchar(3),@o2)
    SET @IPexist = (SELECT COUNT(IP) FROM PS_UserData.dbo.Users_BlockIpRange WHERE IP like @ChkIP+'%')
    IF (@IPexist <> 0) SET @Status = -5 
    -- -----------------------------------

SELECT @EmailVer=EmailUpdated FROM Users_Master WHERE UserID = @UserID

IF(@EmailVer = '0')
	BEGIN
		SET @Status = -10
	END
	ELSE
	BEGIN
		SET @EmailVer = 1
		UPDATE PS_UserData.dbo.Users_Master SET UserIP=@UserIP WhERE @UserID = UserID
END

-- Select 
SELECT @Status AS Status, @UserUID AS UserUID

-- Log Insert
IF( @Status = 0 OR @Status = 16 OR @Status = 32 OR @Status = 48 OR @Status = 64 OR @Status = 80 )
BEGIN
    EXEC usp_Insert_LoginLog_E @SessionID=@SessionID, @UserUID=@UserUID, @UserIP=@UserIP, @LogType=0, @LogTime=@LoginTime, @LoginType=@LoginType
END

SET NOCOUNT OFF 

GO