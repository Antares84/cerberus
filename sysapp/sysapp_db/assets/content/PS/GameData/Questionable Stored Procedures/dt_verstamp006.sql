USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[dt_verstamp006]    Script Date: 8/14/2014 11:32:20 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

/*
**	This procedure returns the version number of the stored
**    procedures used by legacy versions of the Microsoft
**	Visual Database Tools.  Version is 7.0.00.
*/
create procedure [dbo].[dt_verstamp006]
as
	select 7000

GO


