<div class="menu_description">
<pre>
USE [PS_GameData]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[WorldInfo](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[LastWorldTime] [int] NOT NULL,
	[GodBless_Light] [int] NOT NULL,
	[GodBless_Dark] [int] NOT NULL
) ON [PRIMARY]

GO
</pre>
</div>