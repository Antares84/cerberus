USE [PS_UserData]
GO

/****** Object:  Table [dbo].[Users_Master]    Script Date: 8/15/2014 12:22:29 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Users_Master](
	[RowID] [int] NULL,
	[UserUID] [int] IDENTITY(1,1) NOT NULL,
	[UserID] [varchar](18) NOT NULL,
	[Pw] [varchar](12) NOT NULL,
	[JoinDate] [smalldatetime] NOT NULL,
	[Admin] [bit] NOT NULL,
	[AdminLevel] [tinyint] NOT NULL,
	[UseQueue] [bit] NOT NULL,
	[Status] [smallint] NOT NULL,
	[Leave] [tinyint] NOT NULL,
	[LeaveDate] [smalldatetime] NULL,
	[UserType] [char](1) NOT NULL,
	[UserIp] [varchar](15) NULL,
	[ModiIp] [varchar](15) NULL,
	[ModiDate] [datetime] NULL,
	[Point] [int] NOT NULL,
	[Enpassword] [char](32) NULL,
	[Birth] [varchar](8) NULL,
	[Email] [varchar](50) NULL,
	[AcctOnline] [bit] NOT NULL,
	[EmailVer] [bit] NOT NULL,
	[PassVer] [bit] NOT NULL,
 CONSTRAINT [PK_Users_Master] PRIMARY KEY CLUSTERED 
(
	[UserUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__JoinD__0A9D95DB]  DEFAULT (getdate()) FOR [JoinDate]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF__Users_Mas__Point__0B91BA14]  DEFAULT ((0)) FOR [Point]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF_Users_Master_AcctOnline]  DEFAULT ((0)) FOR [AcctOnline]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF_Users_Master_EmailVer]  DEFAULT ((0)) FOR [EmailVer]
GO

ALTER TABLE [dbo].[Users_Master] ADD  CONSTRAINT [DF_Users_Master_PassVer]  DEFAULT ((0)) FOR [PassVer]
GO


