USE [PS_UserData]
GO

/****** Object:  Table [dbo].[UserPauseLog]    Script Date: 8/15/2014 12:21:58 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[UserPauseLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[Status] [smallint] NOT NULL,
	[AppliedStatus] [smallint] NOT NULL,
	[UserUID] [int] NOT NULL,
	[Cause] [varchar](7000) NOT NULL,
	[ProcDate] [datetime] NOT NULL,
	[ProcAdminID] [varchar](12) NOT NULL,
	[StartDate] [datetime] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	[Enable] [bit] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


