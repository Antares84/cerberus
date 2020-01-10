USE [SDM_AdminPanel]
GO

/****** Object:  Table [dbo].[Banned]    Script Date: 12/4/2013 9:36:43 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Banned](
	[CharName] [varchar](25) NOT NULL,
	[Reason] [varchar](max) NULL,
	[BannedBy] [varchar](30) NULL,
	[Duration] [int] NULL,
	[BanDate] [datetime] NOT NULL,
	[UserUID] [int] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[Banned] ADD  CONSTRAINT [DF_Banned_BanDate]  DEFAULT (getdate()) FOR [BanDate]
GO


