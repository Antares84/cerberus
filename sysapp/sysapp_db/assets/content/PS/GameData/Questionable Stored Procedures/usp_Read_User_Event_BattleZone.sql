USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_User_Event_BattleZone]    Script Date: 8/14/2014 11:58:06 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO





CREATE PROCEDURE [dbo].[usp_Read_User_Event_BattleZone]
@UserUID 	int

AS

SET NOCOUNT ON

SELECT Country FROM PS_USERDB01.PS_UserData.dbo.Users_EventBattleZone WHERE UserUID=@UserUID 


SET NOCOUNT OFF



GO


