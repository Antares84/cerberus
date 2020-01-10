USE [PS_IllegalLinks]
GO

/****** Object:  Table [dbo].[Illegal_CharItems]    Script Date: 8/14/2014 10:51:02 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[IllegalCharItems](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[RequestedBy] [varchar](30) NOT NULL,
	[RequestedDate] [datetime] NOT NULL,
	[CharID] [int] NOT NULL,
	[ItemID] [int] NOT NULL,
	[ItemUID] [bigint] NOT NULL,
	[Type] [tinyint] NOT NULL,
	[TypeID] [tinyint] NOT NULL,
	[Bag] [tinyint] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[Quality] [smallint] NOT NULL,
	[Gem1] [tinyint] NOT NULL,
	[Gem2] [tinyint] NOT NULL,
	[Gem3] [tinyint] NOT NULL,
	[Gem4] [tinyint] NOT NULL,
	[Gem5] [tinyint] NOT NULL,
	[Gem6] [tinyint] NOT NULL,
	[Craftname] [varchar](20) NULL,
	[Count] [tinyint] NOT NULL,
	[Maketime] [datetime] NOT NULL,
	[Maketype] [varchar](1) NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[ItemUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


