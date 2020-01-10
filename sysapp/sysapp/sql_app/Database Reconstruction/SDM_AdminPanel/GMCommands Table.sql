USE [SDM_AdminPanel]
GO

/****** Object:  Table [dbo].[GMCommands]    Script Date: 12/4/2013 9:39:06 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[GMCommands](
	[CharName] [varchar](20) NOT NULL,
	[Command] [varchar](max) NULL,
	[PlayerAffected] [varchar](max) NULL,
	[CommandEffect] [varchar](max) NULL,
	[DateUsed] [datetime] NOT NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[GMCommands] ADD  CONSTRAINT [DF_GMCommands_DateUsed]  DEFAULT (getdate()) FOR [DateUsed]
GO


