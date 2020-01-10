USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[dt_dropuserobjectbyid]    Script Date: 8/14/2014 11:29:15 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

/*
**	Drop an object from the dbo.dtproperties table
*/
create procedure [dbo].[dt_dropuserobjectbyid]
	@id int
as
	set nocount on
	delete from dbo.dtproperties where objectid=@id

GO


