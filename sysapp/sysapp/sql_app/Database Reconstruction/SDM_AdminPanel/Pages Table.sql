USE [SDM_AdminPanel]
GO

CREATE TABLE [dbo].[Pages] (
[Page] varchar(30) NOT NULL ,
[Rank] int NOT NULL ,
[PageDesc] varchar(MAX) NOT NULL 
)

GO

-- ----------------------------
-- Records of Pages
-- ----------------------------
INSERT INTO [dbo].[Pages] VALUES (N'restore_um.php', N'3', N'UM Restoration');
GO
INSERT INTO [dbo].[Pages] VALUES (N'guild_leader_change.php', N'3', N'Change Guld Leader');
GO
INSERT INTO [dbo].[Pages] VALUES (N'login_status.php', N'3', N'Login Status');
GO
INSERT INTO [dbo].[Pages] VALUES (N'player_edit.php', N'3', N'Edit Player Info');
GO
INSERT INTO [dbo].[Pages] VALUES (N'player_search.php', N'1', N'Player Search');
GO
INSERT INTO [dbo].[Pages] VALUES (N'global_chat.php', N'0', N'Global Chat Array');
GO
INSERT INTO [dbo].[Pages] VALUES (N'ban_account.php', N'3', N'Account Ban');
GO
INSERT INTO [dbo].[Pages] VALUES (N'bansearch.php', N'3', N'Account Ban');
GO
INSERT INTO [dbo].[Pages] VALUES (N'unban_account.php', N'3', N'Unban Accounts');
GO
INSERT INTO [dbo].[Pages] VALUES (N'account_search.php', N'2', N'Account Search');
GO
INSERT INTO [dbo].[Pages] VALUES (N'item_view.php', N'1', N'View Player Items');
GO
INSERT INTO [dbo].[Pages] VALUES (N'log.php', N'3', N'Panel Access Logs');
GO
INSERT INTO [dbo].[Pages] VALUES (N'gmcomsrch.php', N'3', N'GM Commands Log');
GO
INSERT INTO [dbo].[Pages] VALUES (N'guild_search.php', N'1', N'Guild Member Search');
GO
INSERT INTO [dbo].[Pages] VALUES (N'staff.php', N'1', N'Staff Search');
GO
INSERT INTO [dbo].[Pages] VALUES (N'rankreq.php', N'0', N'Page Ranks');
GO
INSERT INTO [dbo].[Pages] VALUES (N'buff_view.php', N'2', N'View Player Buffs');
GO
INSERT INTO [dbo].[Pages] VALUES (N'Faction Change', N'3', N'Faction Change');
GO
