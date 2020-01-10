USE [SDM_AdminPanel]
GO

/****** Object:  Table [dbo].[Users]    Script Date: 12/4/2013 9:42:18 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Users](
	[UserID] [varchar](20) NOT NULL,
	[CharName] [varchar](25) NULL,
	[Rank] [int] NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


