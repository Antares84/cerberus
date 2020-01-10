USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_MobItems_R]    Script Date: 8/14/2014 10:44:08 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER OFF
GO


CREATE Proc [dbo].[usp_Read_MobItems_R]
/* Created by frsunny@hotmail.com, 2004-08-11
몬스터 드롭 아이템 테이블 읽어오기 */
AS
SELECT MobID, ItemOrder, Grade, DropRate 
FROM MobItems
ORDER BY MobID ASC, ItemOrder ASC


GO


