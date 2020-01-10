USE [PS_GameData]
GO

/****** Object:  Table [dbo].[GuildChars]    Script Date: 8/14/2014 10:57:50 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[GuildChars](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[GuildID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[GuildLevel] [tinyint] NOT NULL,
	[Del] [tinyint] NOT NULL,
	[JoinDate] [datetime] NOT NULL,
	[LeaveDate] [datetime] NULL,
 CONSTRAINT [PK_GuildChars] PRIMARY KEY NONCLUSTERED 
(
	[RowID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[GuildChars] ADD  CONSTRAINT [DF_GuildChars_Del]  DEFAULT (0) FOR [Del]
GO


