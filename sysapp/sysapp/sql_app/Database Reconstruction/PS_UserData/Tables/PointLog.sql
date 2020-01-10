USE [PS_UserData]
GO

/****** Object:  Table [dbo].[PointLog]    Script Date: 8/15/2014 12:21:17 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[PointLog](
	[UseType] [int] NULL,
	[UserUID] [int] NOT NULL,
	[CharID] [int] NULL,
	[UsePoint] [int] NULL,
	[ProductCode] [varchar](20) NULL,
	[UseDate] [datetime] NULL,
 CONSTRAINT [PK_PointLog] PRIMARY KEY CLUSTERED 
(
	[UserUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF

GO