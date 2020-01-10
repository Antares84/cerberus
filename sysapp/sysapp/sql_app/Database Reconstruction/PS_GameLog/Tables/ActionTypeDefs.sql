USE [PS_GameLog]
GO

/****** Object:  Table [dbo].[ActionTypeDefs]    Script Date: 8/14/2014 10:30:56 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[ActionTypeDefs](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ActionTypeID] [tinyint] NOT NULL,
	[ActionTypeName] [varchar](50) NOT NULL,
	[BindText] [varchar](500) NULL,
	[Value1_Desc] [varchar](50) NULL,
	[Value2_Desc] [varchar](50) NULL,
	[Value3_Desc] [varchar](50) NULL,
	[Value4_Desc] [varchar](50) NULL,
	[Value5_Desc] [varchar](50) NULL,
	[Value6_Desc] [varchar](50) NULL,
	[Value7_Desc] [varchar](50) NULL,
	[Value8_Desc] [varchar](50) NULL,
	[Value9_Desc] [varchar](50) NULL,
	[Value10_Desc] [varchar](50) NULL,
	[Text1_Desc] [varchar](50) NULL,
	[Text2_Desc] [varchar](50) NULL,
	[Text3_Desc] [varchar](50) NULL,
	[Text4_Desc] [varchar](50) NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


