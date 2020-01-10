USE [PS_UserData]
GO

/****** Object:  Table [dbo].[UserLoginLog]    Script Date: 8/15/2014 12:21:45 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[UserLoginLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[SessionID] [bigint] NOT NULL,
	[UserUID] [int] NOT NULL,
	[UserIP] [varchar](15) NOT NULL,
	[LoginTime] [datetime] NOT NULL,
	[LogoutTime] [datetime] NULL,
	[LoginType] [smallint] NOT NULL,
	[ErrType] [smallint] NOT NULL,
	[ErrMsg] [varchar](300) NULL,
	[PCBangRowID] [int] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


