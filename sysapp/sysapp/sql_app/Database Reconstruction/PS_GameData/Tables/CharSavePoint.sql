USE [PS_GameData]
GO

/****** Object:  Table [dbo].[CharSavePoint]    Script Date: 8/14/2014 10:56:27 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[CharSavePoint](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[CharID] [int] NOT NULL,
	[Slot] [tinyint] NOT NULL,
	[MapID] [smallint] NOT NULL,
	[PosX] [real] NOT NULL,
	[PosY] [real] NOT NULL,
	[PosZ] [real] NOT NULL,
 CONSTRAINT [PK_CharSavePoint] PRIMARY KEY CLUSTERED 
(
	[CharID] ASC,
	[Slot] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO


