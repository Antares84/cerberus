USE [PS_GameData]
GO

/****** Object:  Table [dbo].[UserMaxGrow]    Script Date: 8/14/2014 11:03:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[UserMaxGrow](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[UserUID] [int] NOT NULL,
	[Country] [tinyint] NOT NULL,
	[MaxGrow] [tinyint] NOT NULL,
	[Del] [bit] NOT NULL,
 CONSTRAINT [PK_UserMaxGrow] PRIMARY KEY CLUSTERED 
(
	[ServerID] ASC,
	[UserUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[UserMaxGrow] ADD  CONSTRAINT [DF_UserMaxGrow_Del]  DEFAULT (0) FOR [Del]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'세력(0:빛, 1:분노)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'UserMaxGrow', @level2type=N'COLUMN',@level2name=N'Country'
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'최고 성장모드(0~3)' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'UserMaxGrow', @level2type=N'COLUMN',@level2name=N'MaxGrow'
GO


