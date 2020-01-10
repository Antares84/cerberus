USE [PS_GameLog]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_ActionTypeDefs_R]    Script Date: 8/16/2014 12:08:50 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Read_ActionTypeDefs_R]

AS

SELECT ActionTypeID, ActionTypeName, BindText, Value1_Desc, Value2_Desc, Value3_Desc, Value4_Desc, Value5_Desc, Value6_Desc, Value7_Desc, Value8_Desc, Value9_Desc, Value10_Desc, Text1_Desc, Text2_Desc, Text3_Desc, Text4_Desc 
FROM ActionTypeDefs
ORDER BY ActionTypeID ASC

GO