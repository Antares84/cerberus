USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Market_CharResultMoney_ADD]    Script Date: 8/14/2014 11:46:24 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO






CREATE  Proc [dbo].[usp_Market_CharResultMoney_ADD]

@MoneyID		int,
@CharID 		int,
@MarketID		int,
@Result		tinyint,

@Money		int,
@GuaranteeMoney	int,
@ReturnMoney		int,

@EndDate		datetime,

@Type			tinyint,
@TypeID		tinyint,
@Quality		smallint,
@Gem1			tinyint,
@Gem2			tinyint,
@Gem3			tinyint,
@Gem4			tinyint,
@Gem5			tinyint,
@Gem6			tinyint,
@Craftname		varchar(20),
@Count			tinyint

AS

SET NOCOUNT ON



INSERT INTO [MarketCharResultMoney]([MoneyID], [CharID], [MarketID], [Result], [Money], [GuaranteeMoney], [ReturnMoney], [EndDate], [Type], [TypeID], [Quality], [Gem1], [Gem2], [Gem3], [Gem4], [Gem5], [Gem6], [Craftname], [Count])
VALUES( @MoneyID, @CharID, @MarketID, @Result, @Money, @GuaranteeMoney, @ReturnMoney, @EndDate, @Type, @TypeID, @Quality, @Gem1, @Gem2, @Gem3, @Gem4, @Gem5, @Gem6, @Craftname, @Count )
IF( @@ERROR <> 0 )
BEGIN
	RETURN 0
END


RETURN 1

SET NOCOUNT OFF

GO


