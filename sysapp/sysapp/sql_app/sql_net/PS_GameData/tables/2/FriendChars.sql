USE [PS_GameData]
GO

/****** Object:  Table [dbo].[FriendChars]    Script Date: 8/14/2014 10:57:42 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[FriendChars](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[FriendID] [int] NOT NULL,
	[FriendName] [varchar](30) NOT NULL,
	[Family] [tinyint] NOT NULL,
	[Grow] [tinyint] NOT NULL,
	[Job] [tinyint] NOT NULL,
	[Memo] [varchar](50) NULL,
	[Refuse] [tinyint] NOT NULL,
	[CreateDate] [datetime] NULL,
	[RefuseDate] [datetime] NULL,
 CONSTRAINT [PK_FriendChars] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[FriendID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[FriendChars] ADD  CONSTRAINT [DF_Friends_Ban]  DEFAULT (0) FOR [Refuse]
GO


