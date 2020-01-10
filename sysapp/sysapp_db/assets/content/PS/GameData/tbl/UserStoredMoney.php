<div class="menu_description">
<pre>
USE [PS_GameData]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[UserStoredMoney](
	[RowID] [int] IDENTITY(1,1) NOT NULL,
	[ServerID] [tinyint] NOT NULL,
	[UserUID] [int] NOT NULL,
	[Money] [bigint] NOT NULL,
	[LastAccessTime] [datetime] NOT NULL,
	[Del] [bit] NOT NULL,
 CONSTRAINT [PK_UserStoredMoney] PRIMARY KEY CLUSTERED 
(
	[ServerID] ASC,
	[UserUID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[UserStoredMoney] ADD  CONSTRAINT [DF_UserStoredMoney_Money]  DEFAULT (0) FOR [Money]
GO

ALTER TABLE [dbo].[UserStoredMoney] ADD  CONSTRAINT [DF_UserStoredMoney_LastAccessTime]  DEFAULT (getdate()) FOR [LastAccessTime]
GO

ALTER TABLE [dbo].[UserStoredMoney] ADD  CONSTRAINT [DF_UserStoredMoney_Del]  DEFAULT (0) FOR [Del]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'회원 ''은행'' 으로써 캐릭터에 들어간 Money필드와 역할 동일' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'UserStoredMoney', @level2type=N'COLUMN',@level2name=N'RowID'
GO

</pre>
</div>