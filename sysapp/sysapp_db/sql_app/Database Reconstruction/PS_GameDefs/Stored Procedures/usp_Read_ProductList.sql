USE [PS_GameDefs]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_ProductList]    Script Date: 8/14/2014 10:47:59 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



/*==================================================
@author	lenasoft
@date	2006-09-05
@return	
@brief	유료아이템 리스트를 가져온다.
==================================================*/
CREATE Proc [dbo].[usp_Read_ProductList]

AS

SET NOCOUNT ON

SELECT	
	ProductCode, 
	ISNULL(ItemID1,0) ItemID1, ISNULL(ItemCount1,0) ItemCount1,
	ISNULL(ItemID2,0) ItemID2, ISNULL(ItemCount2,0) ItemCount2,
	ISNULL(ItemID3,0) ItemID3, ISNULL(ItemCount3,0) ItemCount3,
	ISNULL(ItemID4,0) ItemID4, ISNULL(ItemCount4,0) ItemCount4,
	ISNULL(ItemID5,0) ItemID5, ISNULL(ItemCount5,0) ItemCount5,
	ISNULL(ItemID6,0) ItemID6, ISNULL(ItemCount6,0) ItemCount6,
	ISNULL(ItemID7,0) ItemID7, ISNULL(ItemCount7,0) ItemCount7,
	ISNULL(ItemID8,0) ItemID8, ISNULL(ItemCount8,0) ItemCount8,
	ISNULL(ItemID9,0) ItemID9, ISNULL(ItemCount9,0) ItemCount9,
	ISNULL(ItemID10,0) ItemID10, ISNULL(ItemCount10,0) ItemCount10,
	ISNULL(ItemID11,0) ItemID11, ISNULL(ItemCount11,0) ItemCount11,
	ISNULL(ItemID12,0) ItemID12, ISNULL(ItemCount12,0) ItemCount12,
	ISNULL(ItemID13,0) ItemID13, ISNULL(ItemCount13,0) ItemCount13,
	ISNULL(ItemID14,0) ItemID14, ISNULL(ItemCount14,0) ItemCount14,
	ISNULL(ItemID15,0) ItemID15, ISNULL(ItemCount15,0) ItemCount15,
	ISNULL(ItemID16,0) ItemID16, ISNULL(ItemCount16,0) ItemCount16,
	ISNULL(ItemID17,0) ItemID17, ISNULL(ItemCount17,0) ItemCount17,
	ISNULL(ItemID18,0) ItemID18, ISNULL(ItemCount18,0) ItemCount18,
	ISNULL(ItemID19,0) ItemID19, ISNULL(ItemCount19,0) ItemCount19,
	ISNULL(ItemID20,0) ItemID20, ISNULL(ItemCount20,0) ItemCount20,
	ISNULL(ItemID21,0) ItemID21, ISNULL(ItemCount21,0) ItemCount21,
	ISNULL(ItemID22,0) ItemID22, ISNULL(ItemCount22,0) ItemCount22,
	ISNULL(ItemID23,0) ItemID23, ISNULL(ItemCount23,0) ItemCount23,
	ISNULL(ItemID24,0) ItemID24, ISNULL(ItemCount24,0) ItemCount24,
	BuyCost, ProductName

FROM ProductList

SET NOCOUNT OFF
GO


