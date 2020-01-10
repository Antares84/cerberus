USE [PS_UserData]
GO

/****** Object:  Table [dbo].[Users_BlockIpRange]    Script Date: 8/15/2014 12:22:18 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Users_BlockIpRange](
	[row] [int] IDENTITY(1,1) NOT NULL,
	[IP] [varchar](15) NOT NULL,
	[Time] [datetime] NOT NULL,
	[Reason] [varchar](128) NULL,
 CONSTRAINT [PK_Users_BlockIP] PRIMARY KEY CLUSTERED 
(
	[row] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


