USE [PS_UserData]
GO

/****** Object:  Table [dbo].[BannedIPs]    Script Date: 8/15/2014 12:21:01 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[BannedIPs](
	[Row] [int] IDENTITY(1,1) NOT NULL,
	[banIP] [varchar](15) NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF

GO