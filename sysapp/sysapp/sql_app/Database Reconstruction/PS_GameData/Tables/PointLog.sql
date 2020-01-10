USE [PS_GameData]
GO

/****** Object:  Table [dbo].[PointLog]    Script Date: 8/14/2014 11:02:54 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[PointLog](
	[UserUID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[UsePoint] [int] NOT NULL,
	[ProductCode] [varchar](20) NOT NULL,
	[TargetName] [varchar](30) NULL,
	[UseDate] [datetime] NOT NULL,
	[UseType] [tinyint] NOT NULL,
	[RemainPoint] [int] NULL,
	[OrderNumber] [int] NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[PointLog] ADD  CONSTRAINT [DF_PointLog_UseDate]  DEFAULT (getdate()) FOR [UseDate]
GO


