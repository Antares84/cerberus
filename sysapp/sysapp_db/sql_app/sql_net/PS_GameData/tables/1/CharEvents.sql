USE [PS_GameData]
GO

/****** Object:  Table [dbo].[CharEvents]    Script Date: 8/14/2014 10:55:27 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[CharEvents](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[Event1] [tinyint] NOT NULL,
	[Event2] [tinyint] NOT NULL,
	[Event3] [tinyint] NULL,
	[Event4] [tinyint] NULL,
	[Event5] [tinyint] NULL,
	[Event6] [tinyint] NULL,
	[Event7] [tinyint] NULL,
	[Event8] [tinyint] NULL,
	[Event9] [tinyint] NULL,
	[Event10] [tinyint] NULL,
 CONSTRAINT [PK_CharEvents] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[CharEvents] ADD  CONSTRAINT [DF_CharEvents_Event1]  DEFAULT (0) FOR [Event1]
GO

ALTER TABLE [dbo].[CharEvents] ADD  CONSTRAINT [DF_CharEvents_Event2]  DEFAULT (0) FOR [Event2]
GO


