USE [PS_GameData]
GO

/****** Object:  StoredProcedure [dbo].[dt_getobjwithprop_u]    Script Date: 8/14/2014 11:29:52 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

/*
**	Retrieve the owner object(s) of a given property
*/
create procedure [dbo].[dt_getobjwithprop_u]
	@property varchar(30),
	@uvalue nvarchar(255)
as
	set nocount on

	if (@property is null) or (@property = '')
	begin
		raiserror('Must specify a property name.',-1,-1)
		return (1)
	end

	if (@uvalue is null)
		select objectid id from dbo.dtproperties
			where property=@property

	else
		select objectid id from dbo.dtproperties
			where property=@property and uvalue=@uvalue

GO


