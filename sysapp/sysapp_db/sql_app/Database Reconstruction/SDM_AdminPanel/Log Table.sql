USE [SDM_AdminPanel]
GO

/****** Object:  Table [dbo].[Log]    Script Date: 12/4/2013 9:39:57 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Log](
	[UserID] [varchar](max) NOT NULL,
	[UserIP] [varchar](15) NOT NULL,
	[Action] [varchar](max) NOT NULL,
	[ActionTime] [datetime] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[Log] ADD  CONSTRAINT [DF_Log_ActionTime]  DEFAULT (getdate()) FOR [ActionTime]
GO


