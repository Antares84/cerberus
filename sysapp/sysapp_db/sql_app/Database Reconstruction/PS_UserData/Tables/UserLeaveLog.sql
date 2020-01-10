USE [PS_UserData]
GO

/****** Object:  Table [dbo].[UserLeaveLog]    Script Date: 8/15/2014 12:21:36 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[UserLeaveLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[LeaveApplyNo] [int] NOT NULL,
	[Status] [smallint] NOT NULL,
	[AppliedStatus] [smallint] NOT NULL,
	[UserUID] [int] NOT NULL,
	[UserID] [varchar](18) NOT NULL,
	[UserName] [varchar](50) NOT NULL,
	[Phone1] [varchar](3) NOT NULL,
	[Phone2] [varchar](4) NOT NULL,
	[Phone3] [varchar](4) NOT NULL,
	[Email] [varchar](100) NOT NULL,
	[LeaveQuestion1] [varchar](2000) NOT NULL,
	[LeaveQuestion2] [varchar](2000) NOT NULL,
	[LeaveQuestion3] [varchar](3000) NOT NULL,
	[LeaveApplyDate] [datetime] NOT NULL,
	[Result] [tinyint] NOT NULL,
	[ProcAdminID] [varchar](12) NULL,
	[ProcDate] [datetime] NULL,
	[Enable] [bit] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF

GO