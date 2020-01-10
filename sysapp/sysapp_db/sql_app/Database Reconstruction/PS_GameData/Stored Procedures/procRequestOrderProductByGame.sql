USE PS_UserData
GO

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