USE [PS_UserData]
GO

/****** Object:  Table [dbo].[UserPointChargeLog]    Script Date: 8/15/2014 12:22:09 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[UserPointChargeLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[UserID] [varchar](18) NOT NULL,
	[Point] [int] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


