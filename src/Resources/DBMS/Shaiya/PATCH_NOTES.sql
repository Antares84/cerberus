IF OBJECT_ID('[Cerberus].[dbo].[PATCH_NOTES]','U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[PATCH_NOTES]
GO

CREATE TABLE [Cerberus].[dbo].[PATCH_NOTES](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[Title]		varchar(MAX)					NOT NULL,
	[Detail]	varchar(MAX)					NOT NULL,
	[Date]		datetime						NOT NULL	DEFAULT (getdate()) 
)ON [PRIMARY]
GO

INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 100', N'Mobs and Mob Drops have been updated. In-game client messages have been fixed & updated.', N'2016-03-01 11:52:52.387');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 102', N'Update for new client UI. If you find any issues with the new UI, please submit a ticket to the Graphics Dept.', N'2016-03-15 20:09:46.413');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 103', N'Mob Drops & Item Update', N'2016-03-15 20:10:33.680');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 101', N'Mini-map update.
All mini-maps for regular maps should now be working.
Mini-maps for dungeons will be fixed at a later date.', N'2016-03-15 20:15:47.900');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 109', N'Item names updated. Item drops updated. Item drop rates updated. Portal colors updated. UI update. Elven armor updated. (Lv70)', N'2016-03-20 14:43:00.443');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 1', N'<p>Items update</p>', N'2016-04-12 19:08:57.473');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 2', N'<p>Interface update</p> <p>Language filter update</p> <p>In-game messages update</p>', N'2016-04-12 19:09:45.160');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 3', N'<p>Interface update</p>', N'2016-04-12 19:10:09.920');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 4', N'<p>Interface update</p>', N'2016-04-12 19:10:31.243');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 5', N'<p>Login music update</p>', N'2016-04-12 19:11:06.923');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 6', N'<p>Sky - login background update</p>', N'2016-04-12 19:13:15.520');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 7', N'<p>Interface - loadbar update</p>', N'2016-04-12 19:13:46.793');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 8', N'<p>Mobs update</p>', N'2016-04-12 19:14:07.373');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 9', N'<p>Interface - Icons update</p>', N'2016-04-12 19:14:40.920');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 10', N'<p>Characters - Fangs armor added - staff</p> <p>Items update</p> <p>Mobs update</p> <p>Quests update</p>', N'2016-04-12 19:16:02.163');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 11', N'<p>Items update</p> <p>Quests update</p> <p>Iris portal names update</p>', N'2016-04-12 19:18:20.883');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 12', N'<p>World Cup map addition update</p>', N'2016-04-12 19:19:35.870');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 13', N'<p>Quests update</p>', N'2016-04-12 19:22:10.760');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 14', N'<p>Quests update</p>', N'2016-04-12 19:22:28.653');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 15', N'<p>Interface - login interface update</p> <p>Music - login music update</p>', N'2016-04-12 19:23:12.860');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 16', N'<p>Item Mall update</p>', N'2016-04-12 19:23:35.700');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 17', N'<p>Portal effects update</p>', N'2016-04-12 19:24:14.427');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 18', N'<p>Interface - random loading images update</p>', N'2016-04-12 19:25:03.143');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 19', N'<p>Items update</p> <p>Quests update</p> <p>World - Keo portal names update</p>', N'2016-04-12 19:26:26.730');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 20', N'<p>Quests update</p>', N'2016-04-12 19:26:46.570');
INSERT INTO [Cerberus].[dbo].[PATCH_NOTES]
	VALUES (N'Patch Notes - 21', N'<p>Mobs update</p>', N'2016-04-12 19:27:09.730');
GO