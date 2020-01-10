USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[usp_Read_CharSlots_R]    Script Date: 8/14/2014 11:52:32 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO



CREATE Proc [dbo].[usp_Read_CharSlots_R]

@ServerID tinyint,
@UserUID int,
@Slot tinyint

AS

SET NOCOUNT ON

SELECT CharID FROM Chars WHERE ServerID=@ServerID AND UserUID=@UserUID AND Slot=@Slot AND Del=0

SET NOCOUNT OFF


GO


