USE [PS_GameLog]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_Action_Log_R]    Script Date: 8/16/2014 12:06:37 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO

CREATE Proc [dbo].[usp_Read_Action_Log_R]

@UserID varchar(18) = '',
@CharName varchar(50) = '',
@ActionType varchar(50) = '',
@Text1 varchar(50) = '',
@Text2 varchar(50) = '',
@StDate datetime,
@EnDate datetime, 
@Cond varchar(1000) = '',
@yyyy varchar(4) = '',
@mm varchar(2) = '',
@dd varchar(2) = '',
@stdd int = 0,
@endd int = 0,
@SqlDef varchar(8000) = '',
@SqlTop varchar(8000) = '',
@SqlView varchar(8000) = '',
@Sql1 varchar(8000) = '',
@Sql2 varchar(8000) = '',
@SqlAll varchar(8000) = '',
@Cnt int = 0,
@DBCnt int = 0,
@TableSCnt int = 0,
@TableECnt int = 0

AS

SET @yyyy = DATEPART(yyyy, @StDate)
SET @mm = DATEPART(mm, @StDate)

IF( LEN(@mm) = 1)
BEGIN
	SET @mm = '0' + @mm
END

SET @SqlTop = 'SELECT UserID, UserUID, CharID, CharName, CharLevel, CharExp, 
MapID, PosX, PosY, PosZ, ActionTime, ActionType, 
Value1, Value2, Value3, Value4, Value5, Value6, Value7, Value8, Value9, Value10, 
Text1, Text2, Text3, Text4 FROM ( 
'
SET @SqlDef = 
'

SELECT *
FROM PS_GameLog_' + @yyyy + @mm + '.dbo.ActionLog[DD]

'

SET @stdd = DATEPART(dd, @StDate)
SET @endd = DATEPART(dd, @EnDate)

SET @Cnt = @stdd

WHILE(@Cnt <= @endd)
BEGIN

	SET @Sql1 = @SqlDef
	SET @DD = CAST ( @Cnt as varchar (2) )
	IF( LEN (@DD) = 1 )
	BEGIN
		SET @DD = '0' + @DD
	END

	SET @Sql1 = REPLACE(@Sql1, '[DD]', @DD)
	
	SET @SqlView = @SqlView + @Sql1

	IF(@Cnt < @endd)
	BEGIN
		SET @SqlView = @SqlView + ' UNION ALL '
	END

	SET @Cnt  = @Cnt + 1
END

SET @SqlAll = @SqlTop + @SqlView + ' ) AS T '

IF(@UserID <> '')
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( UserID = ''' + @UserID + ''' ) '
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( UserID = ''' + @UserID + ''' ) '
	END
END

IF(@CharName <> '')
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( CharName = ''' + @CharName + ''' ) '
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( CharName = ''' + @CharName + ''' ) '
	END
END

IF(@ActionType <> '')
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( ActionType IN (' + @ActionType + '))'
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( ActionType IN (' + @ActionType + '))'
	END
END

IF(@Text1 <> '')
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( Text1 = ''' + @Text1 + ''' ) '
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( Text1 = ''' + @Text1 + ''' ) '
	END
END

IF(@Text2 <> '')
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( Text2 = ''' + @Text2 + ''' ) '
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( Text2 = ''' + @Text2 + ''' ) '
	END
END

IF( (@StDate IS NOT NULL) AND (@EnDate IS NOT NULL) )
BEGIN
	IF(@Cond = '')
	BEGIN
		SET @Cond = ' WHERE ( ActionTime >= ''' + CONVERT(varchar(40), @StDate, 120) + ''' AND ActionTime <= '''  + CONVERT(varchar(40), @EnDate, 120) + ''' ) ' 
	END
	ELSE
	BEGIN
		SET @Cond = @Cond +  ' AND ( ActionTime >= ''' + CONVERT(varchar(40), @StDate, 120) + ''' AND ActionTime <= '''  + CONVERT(varchar(40), @EnDate, 120) + ''' ) ' 
	END
END

IF(@Cond <> '')
BEGIN

	SET @SqlAll = @SqlAll + @Cond
	EXEC(@SqlAll)
--	SELECT (@SqlAll)

END
ELSE
BEGIN
	RETURN -1
END

GO