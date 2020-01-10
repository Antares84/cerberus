USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[procRequestOrderProductByGame]    Script Date: 8/14/2014 11:35:40 PM ******/
SET ANSI_NULLS OFF
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE PROCEDURE [dbo].[procRequestOrderProductByGame] 
@buyClientUserNumber               BIGINT,
@receiveClientUserNumber           BIGINT,
@itemCode                          VARCHAR(50),
@resultCode                        SMALLINT               OUTPUT,
@cashBalanceAfterOrder             INT                          OUTPUT,
@orderNumber                  INT            OUTPUT
AS

    SET @resultCode = 0
    RETURN @resultCode

GO


