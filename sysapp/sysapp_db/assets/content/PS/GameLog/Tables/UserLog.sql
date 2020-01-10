USE [PS_GameLog]
GO

/****** Object:  Table [dbo].[UserLog]    Script Date: 8/16/2014 12:50:32 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[UserLog](
	[SessionID] [bigint] NULL,
	[UserUID] [int] NOT NULL,
	[UserIP] [varchar](15) NULL,
	[LogTime] [datetime] NULL,
	[LogType] [bit] NOT NULL,
	[LoginType] [smallint] NOT NULL,
	[LogoutType] [smallint] NULL,
	[ErrType] [int] NULL,
 CONSTRAINT [PK_UserLog_UserUID] PRIMARY KEY CLUSTERED 
(
	[UserUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


