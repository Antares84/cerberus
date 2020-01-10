<div class="menu_description">
<pre>
USE [PS_GameData]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[Market](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[MarketID] [int] NOT NULL,
	[CharID] [int] NOT NULL,
	[MinMoney] [int] NOT NULL,
	[DirectMoney] [int] NOT NULL,
	[MarketType] [tinyint] NOT NULL,
	[GuaranteeMoney] [int] NOT NULL,
	[TenderCharID] [int] NOT NULL,
	[TenderCharName] [varchar](21) NULL,
	[TenderMoney] [int] NOT NULL,
	[EndDate] [datetime] NOT NULL,
	[Del] [int] NOT NULL,
 CONSTRAINT [PK_Market] PRIMARY KEY CLUSTERED 
(
	[MarketID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[Market] ADD  CONSTRAINT [DF_Market_Del]  DEFAULT (0) FOR [Del]
GO

</pre>
</div>