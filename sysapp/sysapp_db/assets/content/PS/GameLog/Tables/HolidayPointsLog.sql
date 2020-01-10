USE [PS_GameLog]
GO

/****** Object:  Table [dbo].[HolidayPointsLog]    Script Date: 8/14/2014 10:33:28 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[HolidayPointsLog](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[UserUID] [int] NOT NULL,
	[UserID] [varchar](18) NOT NULL,
	[CharID] [int] NOT NULL,
	[CharName] [varchar](30) NOT NULL,
	[LogDate] [datetime] NOT NULL,
	[UserIp] [varchar](15) NULL,
 CONSTRAINT [PK_Holiday_Points] PRIMARY KEY CLUSTERED 
(
	[UserUID] DESC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[HolidayPointsLog] ADD  CONSTRAINT [DF__HolidayPointsLog_JoinDate]  DEFAULT (getdate()) FOR [LogDate]
GO