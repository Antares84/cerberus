USE [SDM_Chatlog]
GO

/****** 
File Label: Table [dbo].[ChatLog]
Script Date: 8/14/2014 10:21:36 PM 
******/

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[ChatLog](
	[row] [int] IDENTITY(1,1) NOT NULL,
	[UserUID] [char](10) NULL,
	[CharID] [char](10) NULL,
	[ChatType] [char](10) NULL,
	[TargetName] [char](10) NULL,
	[ChatData] [char](100) NULL,
	[MapID] [char](10) NULL,
	[ChatTime] [varchar](20) NOT NULL,
 CONSTRAINT [PK_ChatLog] PRIMARY KEY CLUSTERED 
(
	[row] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO
