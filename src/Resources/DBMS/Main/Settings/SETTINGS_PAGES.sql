IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_PAGES]','U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[SETTINGS_PAGES]
GO

CREATE TABLE [Cerberus].[dbo].[SETTINGS_PAGES](
	[RowID]				[int]			IDENTITY(1,1)	NOT NULL,
	[SITE_TYPE]			[varchar](5)					NOT NULL,
	[PAGE_ZONE]			[varchar](3)					NOT NULL,
	[PAGE_TYPE]			[varchar](6)					NOT NULL,	[PAGE_CAT]			[varchar](50)						NULL,	[PAGE_DESC]			[varchar](max)						NULL,	[PAGE_INDEX]		[varchar](50)						NULL,	[PAGE_SHOW]			[bit]							NOT NULL	DEFAULT(0),	[PAGE_SUB]			[varchar](50)						NULL,	[PAGE_TITLE]		[varchar](50)						NULL,
	[PAGE_ICON]			[varchar](25)						NULL,	[PAGE_URI]			[varchar](max)						NULL,	[REQ_LOGIN]			[bit]							NOT NULL	DEFAULT(0),
	[REQ_LEVEL]			[tinyint]						NOT NULL	DEFAULT(0),	[METATAG_DESC]		[varchar](max)						NULL,	[METATAG_KEYWORDS]	[varchar](max)						NULL,	[METATAG_TITLE]		[varchar](max)						NULL,
	[STANDALONE]		[bit]							NOT NULL,
	[COLUMNS]			[bit]							NOT NULL,
	[SHOW]				[bit]							NOT NULL,
	[EDIT]				[tinyint]						NOT NULL	DEFAULT(0)
)ON [PRIMARY]
GO

-- CMS - MAIN - Shared
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MAIN',NULL,N'ERROR',0,NULL,N'Error!',N'',N'CMS/Main/error.php',0,0,NULL,NULL,NULL,1,0,1,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MAIN',NULL,N'INBOX',0,NULL,N'Inbox',N'',N'CMS/Main/inbox.php',0,0,NULL,NULL,NULL,0,0,1,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MAIN',NULL,N'LANDING',0,NULL,N'Landing',N'',N'CMS/Main/landing.php',0,0,NULL,NULL,NULL,1,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MAIN',NULL,N'MAINT',0,NULL,N'Maintenance',N'',N'CMS/Main/maintenance.php',0,0,NULL,NULL,NULL,1,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MAIN',NULL,N'MESSAGES',0,NULL,N'Messages',N'',N'CMS/Main/messages.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MAIN',NULL,N'TOOLS',0,N'Main',N'Tools',N'',N'CMS/Main/tools.php',0,0,NULL,NULL,NULL,1,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MAIN',NULL,N'WELCOME',0,NULL,N'Welcome',N'',N'CMS/Main/welcome.php',0,0,NULL,NULL,NULL,0,0,0,0);

-- CMS - MAIN - STANDARD
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MAIN',NULL,N'HOME',1,NULL,N'Home',N'fa fa-home',N'CMS/Main/home.php',0,0,NULL,NULL,NULL,0,0,1,0);
-- CMS - MAIN - BDSM
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'BDSM',N'CMS',N'UNI',N'MAIN',NULL,N'HOME',1,NULL,N'Home',N'fa fa-home',N'CMS/Main/home.php',0,0,NULL,NULL,NULL,0,0,1,0);
-- CNS - MAIN - JV
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'JV',N'CMS',N'UNI',N'MAIN',NULL,N'HOME',1,NULL,N'Home',N'fa fa-home',N'CMS/Main/g_home.php',0,0,NULL,NULL,NULL,0,0,1,0);
-- CMS - MAIN - EVE
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'EVE',N'CMS',N'UNI',N'MAIN',NULL,N'HOME',1,NULL,N'Home',N'fa fa-home',N'CMS/Main/home.php',0,0,NULL,NULL,NULL,0,0,1,0);

-- CMS - INFO - Shared
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'INFO',NULL,N'NEWS',1,N'Info',N'News',N'fa fa-info-circle',N'CMS/Info/news.php',1,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'INFO',NULL,N'TOS',1,N'Info',N'Terms of Membership',N'fa fa-info-circle',N'CMS/Info/tos.php',1,0,NULL,NULL,NULL,0,0,0,0);

-- CMS - INFO - BDSM
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'BDSM',N'CMS',N'BDSM',N'INFO',NULL,N'RESOURCES',1,N'Info',N'Resources',N'',N'CMS/Info/resources.php',1,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'BDSM',N'CMS',N'BDSM',N'INFO',NULL,N'NEWS',1,N'Info',N'News',N'fa fa-info-circle',N'CMS/Info/news.php',1,0,NULL,NULL,NULL,0,0,0,0);

-- CMS - FORTE

-- CMS - INFO - MUSIC
-- CMS - INFO - SHAIYA
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'CMS',N'SHAIYA',N'Info',NULL,N'BOSS_RECORD',1,N'Info',N'Boss Record',N'',N'CMS/Info/boss_record.php',1,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'CMS',N'SHAIYA',N'Info',NULL,N'PATCH_NOTES',1,N'Info',N'Patch Notes',N'fa fa-info-circle',N'CMS/Info/patch-notes.php',1,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'CMS',N'SHAIYA',N'Info',NULL,N'PVP_RANKING',1,NULL,N'PvP Ranking',N'fa fa-info-circle',N'CMS/Info/pvp.php',1,0,N'PvP Ranking',NULL,NULL,1,0,0,0);
-- CMS - INFO - EVE
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'EVE',N'CMS',N'EVE',N'Info',NULL,N'Skills',1,NULL,N'Skills List',N'fa fa-info-circle',N'CMS/Info/EVE/Skills_List.php',0,0,N'Skills List',NULL,NULL,0,0,1,0);

-- CMS - MEMBER - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MEMBER',NULL,N'PW_CHANGE',0,N'Member',N'Password Change',N'fa fa-user-circle',N'CMS/Member/pchange.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MEMBER',NULL,N'UPDATE_EMAIL',0,N'Member',N'Update E-Mail',N'fa fa-user-circle',N'CMS/Member/emailch.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MEMBER',NULL,N'USER_PROFILE',1,N'Member',N'My Profile',N'fa fa-user-circle',N'CMS/Member/user_profile.php',1,0,NULL,NULL,NULL,1,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'MEMBER',NULL,N'ISSUE_TRKR',1,N'Member',N'Issue Tracker',N'fa fa-user-circle',N'CMS/issue_tracker/tracker.php',1,0,NULL,NULL,NULL,0,0,0,0);

-- CMS - MEMBER - BDSM
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'BDSM',N'CMS',N'BDSM',N'MEMBER',NULL,N'JOURNAL',1,N'Member',N'My Journal',N'',N'CMS/Member/journal.php',1,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'BDSM',N'CMS',N'BDSM',N'MEMBER',NULL,N'MEMBERLIST',1,N'Member',N'Members List',N'',N'CMS/Member/members.php',1,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'BDSM',N'CMS',N'BDSM',N'MEMBER',NULL,N'STORYTIME',1,N'Member',N'Story Time',N'',N'CMS/Member/story.php',1,0,NULL,NULL,NULL,0,0,0,0);

-- CMS - MEMBER - MUSIC
-- CMS - MEMBER - SHAIYA
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'SHAIYA',N'MEMBER',NULL,N'DOWNLOADS',1,N'Member',N'Downloads',N'fa fa-user-circle',N'CMS/Member/downloads.php',1,0,NULL,NULL,NULL,0,0,0,0);

-- CMS - DONATE - SHAIYA
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'SHAIYA',N'Member',NULL,N'DONATE',1,N'Member',N'Donate',N'',N'CMS/Member/donate.php',1,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'SHAIYA',N'Donation',NULL,N'COMPLETE_DONATION',0,N'Member',N'Donation Completed',N'',N'CMS/Donate/donate_complete.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'SHAIYA',N'Donation',NULL,N'PROCESS_DONATION',0,NULL,N'Donation Processing',N'',N'CMS/Member/donate_process.php',0,0,NULL,NULL,NULL,0,0,0,0);

-- CMS - ACCOUNT - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'Reg',NULL,N'PW_RESET',1,NULL,N'Password Reset',N'',N'CMS/register/reset-pw.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'Recovery',NULL,N'RECOVERY',0,NULL,N'Recovery',N'',N'CMS/Main/recovery.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'Resend',NULL,N'RESEND_REGISTRATION',0,NULL,N'Resend E-mail',N'',N'CMS/mail/resendemail.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'Verify',NULL,N'VERIFY',0,NULL,N'Account Verify',N'',N'CMS/auth/verify.php',0,0,NULL,NULL,NULL,0,0,0,0);

-- CMS - OPTIONS - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'OPTIONS',N'Login',N'AUTH',1,NULL,N'Login',N'',N'CMS/Auth/login.php',0,0,NULL,NULL,NULL,1,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'OPTIONS',N'Login',N'VALIDATE',0,NULL,N'Validate',N'',N'CMS/Auth/validate.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'OPTIONS',NULL,N'REGISTER',1,NULL,N'Register',N'',N'CMS/Auth/register.php',0,0,NULL,NULL,NULL,1,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'OPTIONS',NULL,N'REGISTRATION_COMPLETE',0,NULL,N'Registration Complete',N'',N'CMS/Auth/register_complete.php',0,0,NULL,NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'CMS',N'UNI',N'OPTIONS',NULL,N'LOGOUT',1,NULL,N'Log Out',N'','CMS/Auth/logout.php',1,0,NULL,NULL,NULL,0,0,0,0);

-- AP - ACCOUNT - SHARED
-- AP - ACCOUNT - BDSM
-- AP - ACCOUNT - MUSIC
-- AP - ACCOUNT - SHAIYA
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'SHAIYA',N'ACCOUNT',NULL,N'ACCT_SEARCH',1,N'Account Tools',N'Account Search',N'',N'AP/Account/account_search.php',0,0,N'Account Search Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'SHAIYA',N'ACCOUNT',NULL,N'ACCT_BAN',1,N'Account Tools',N'Account Ban',N'',N'AP/Account/ban_account.php',0,0,N'Account Ban Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'SHAIYA',N'ACCOUNT',NULL,N'ACCT_BAN_SEARCH',1,N'Account Tools',N'Account Ban Search',N'',N'AP/Account/bansearch.php',0,0,N'Account Ban Search Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'SHAIYA',N'ACCOUNT',NULL,N'ACCT_UNBAN',1,N'Account Tools',N'Account Unban',N'',N'AP/Account/unban_account.php',0,0,N'Account Unban Page(Shaiya)',NULL,NULL,0,0,0,0);

-- AP - MAIN - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'Dashboard',NULL,N'DASHBOARD',1,NULL,N'Dashboard',N'',N'AP/Main/AP_home.php',0,0,N'AP Home Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'BDSM',N'AP',N'UNI',N'Dashboard',NULL,N'DASHBOARD',1,NULL,N'Dashboard',N'',N'AP/Main/AP_home.php',0,0,N'AP Home Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'MSC',N'AP',N'UNI',N'Dashboard',NULL,N'DASHBOARD',1,NULL,N'Dashboard',N'',N'AP/Main/AP_home.php',0,0,N'AP Home Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'UNI',N'Dashboard',NULL,N'DASHBOARD',1,NULL,N'Dashboard',N'',N'AP/Main/AP_home.php',0,0,N'AP Home Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'FORTE',N'AP',N'UNI',N'Dashboard',NULL,N'DASHBOARD',1,NULL,N'Dashboard',N'',N'AP/Main/AP_home.php',0,0,N'AP Home Page',NULL,NULL,0,0,0,0);

-- AP - MAIN - FORTE
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'FORTE',N'AP',N'UNI',N'FORTE',NULL,N'FORTE_REQUESTS',0,NULL,N'New Requests',NULL,N'AP/Forte/Requests/AP_forte_requests.php',0,0,N'View New Requests',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'FORTE',N'AP',N'UNI',N'FORTE',NULL,N'FORTE_COMPLETED',0,NULL,N'Completed Requests',NULL,N'AP/Forte/Requests/AP_forte_completed.php',0,0,N'View Completed Requests',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'FORTE',N'AP',N'UNI',N'FORTE',NULL,N'FORTE_VALIDATE',0,NULL,N'Validate Requests',NULL,N'AP/Forte/Requests/AP_forte_validate.php',0,0, N'Validate Request Data',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'FORTE',N'AP',N'UNI',N'FORTE',NULL,N'FORTE_POST_LEAD',0,NULL,N'Post New Lead',NULL,N'AP/Forte/Leads/AP_forte_post_lead.php',0,0,N'Post Lead To Forte System',NULL,NULL,0,0,0,0);

-- AP - DEVELOPER - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'DEVELOPER',NULL,N'CRYPTO',1,N'Developer Tools',N'Crypto',N'',N'AP/Developer/crypts.php',0,0,N'Crypto Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'DEVELOPER',NULL,N'AP_TOOLS',1,N'Developer Tools',N'Tools',N'',N'AP/Developer/tools.php',0,0,N'Tools/Testing Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'DEVELOPER',NULL,N'INT_VAL',1,N'Developer Tools',N'Integrity Validator',N'',N'AP/Developer/integrity_validator.php',0,0,N'CMS File Integrity Validator Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'DEVELOPER',NULL,N'MAIL_TEST',1,N'Developer Tools',N'Mail Test',N'',N'AP/Developer/test_email.php',0,0,N'Email Test Page',NULL,NULL,0,0,0,0);

-- dev folder --- verify
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'DEVELOPER',NULL,N'RECAPTCHA_V2',1,N'Developer Tools',N'ReCAPtcha 2.0',N'',N'AP/Developer/recAPtcha_v2.php',0,0,N'ReCAPtcha 2.0 Test Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'DEVELOPER',NULL,N'SCRIPTS',1,N'Developer Tools',N'Scripts',N'',N'AP/Developer/scripts.php',0,0,N'Scripts Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'DEVELOPER',NULL,N'SHOPS',1,N'Developer Tools',N'Shops',N'',N'AP/Developer/store.php',0,0,N'Shops Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'DEVELOPER',NULL,N'CREATE_NEW_STORE',0,N'Developer Tools',N'Add Store',N'',N'AP/Developer/create_store.php',0,0,N'Store Creation Page',NULL,NULL,0,0,0,0);

-- AP - JTS3SERVERMOD - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'JTS3',NULL,N'MESSAGE_BOT_CREATOR',1,NULL,N'Message Bot Creator',N'',N'AP/jts3servermod/AP_jts3_msg_bot_creator.php',0,0,N'JTS3 Message Bot Config Creation Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'JTS3',NULL,N'WELCOME_BOT_CREATOR',1,NULL,N'Welcome Bot Creator',N'',N'AP/jts3servermod/AP_jts3_welcome_bot_creator.php',0,0,N'JTS3 Welcome Bot Config Creation Page',NULL,NULL,0,0,0,0);

-- AP - PLAYER - SHAIYA
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'PLAYER',NULL,N'PLR_BUFF_VIEW',0,N'Player Tools',N'View Player''s Buffs',N'',N'AP/player/buff_view.php',0,0,N'View Player Buffs Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'PLAYER',NULL,N'PLR_FC',0,N'Player Tools',N'Faction Change',N'',N'AP/Player/fc.php',0,0,N'Faction Change Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'PLAYER',NULL,N'PLR_GUILD_SEARCH',1,N'Player Tools',N'Guild Search',N'',N'AP/Player/guild_search.php',0,0,N'Guild Search Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'PLAYER',NULL,N'PLR_ITEM_VIEW',0,N'Player Tools',N'View Players Equipped Items',N'',N'AP/Player/item_view.php',0,0,N'Item View Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'PLAYER',NULL,N'PLR_SEARCH',1,N'Player Tools',N'Player Search',N'',N'AP/Player/search.php',0,0,N'Player Search Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'PLAYER',NULL,N'PLR_STATS_EDITOR',0,N'Player Tools',N'Player Stats Editor',N'',N'AP/Player/stat_edit.php',0,0,N'Stat Editor Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'PLAYER',NULL,N'PLR_RES',1,N'Player Tools',N'UM Res',N'',N'AP/Player/um_res.php',0,0,N'UM Res Page(Shaiya)',NULL,NULL,0,0,0,0);

-- AP - SESSION - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SESSION',NULL,N'INDEX',0,NULL,N'Index',N'',N'AP/Session/AP_login.php',0,0,N'Welcome Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SESSION',NULL,N'LOGIN',0,NULL,N'Login',N'',N'AP/auth/AP_auth.php',0,0,N'Login Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SESSION',NULL,N'LOGOUT',0,NULL,N'Logout',N'',N'AP/Session/AP_logout.php',0,0,N'Log Out Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SESSION',NULL,N'SESSION_END',0,NULL,N'Session Ended',N'',N'AP/Session/AP_sess_end.php',0,0,N'Session Ended Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SESSION',NULL,N'SESSION_CLOSE',0,NULL,N'Session Ended',N'',N'AP/Session/AP_term_sess.php',0,0,N'Session Terminate Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SESSION',NULL,N'AP_VALIDATE',0,NULL,N'Auth',N'',N'AP/Session/AP_validate.php',0,0,N'Session Validate Page',NULL,NULL,0,0,0,0);

-- AP - SETTINGS - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',NULL,N'STNG_WARNING',1,N'Settings',N'Settings Warning',N'',N'AP/Settings/settings_warning.php',0,0,N'Warning Settings Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit Plugin Settings',N'STNG_PLUGINS',0,N'Settings',N'Plugin Settings',N'',N'AP/Settings/settings_plugins.php',0,0,N'Plugin Settings',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit Core Settings',N'STNG_CORE',0,N'Core Settings',N'Core Settings',N'',N'AP/Settings/settings_core.php',0,0,N'Core Settings',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit Colors Settings',N'STNG_COLORS',0,N'Colors Settings',N'Colors Settings',N'',N'AP/Settings/settings_colors.php',0,0,N'Colors Settings',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit Contact Settings',N'STNG_CONTACT',0,N'Contact Settings',N'Contact Settings',N'',N'AP/Settings/settings_contact.php',0,0,N'Contact Info Settings',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit Pages',N'STNG_PAGES',0,N'Pages Settings',N'Pages Settings',N'',N'AP/Settings/SETTINGS_PAGES.php',0,0,N'Page Settings',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit PayPal Payments Settings',N'STNG_PAYPAL',0,N'PayPal Settings',N'PayPal Settings',N'',N'AP/Settings/settings_paypal.php',0,0,N'PayPal Payment Settings (Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit PHP Mailer Mail Settings',N'STNG_MAIL',0,N'Mail Settings',N'Mail Daemon Settings',N'',N'AP/Settings/settings_mail.php',0,0,N'PHP Mailer Settings',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit ReCAPtcha 2.0 Settings',N'STNG_RECAPTCHA',0,N'ReCAPtcha Settings',N'ReCAPtcha Settings',N'',N'AP/Settings/AP_settings_recAPtcha.php',0,0,N'ReCAPtcha Settings',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit Theme Settings',N'STNG_THEME',0,N'Theme Settings',N'Theme Settings',N'',N'AP/Settings/settings_theme.php',0,0,N'Theme Settings',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SETTINGS',N'Edit Style Settings',N'STNG_STYLE',0,N'Style Settings',N'Style Settings',N'',N'AP/Settings/settings_style.php',0,0,N'Style Settings',NULL,NULL,0,0,0,0);

-- AP - SITE - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SITE',NULL,N'BLOG_EDITOR',0,N'',N'Blog Editor',N'',N'AP/Site/Blog/editor.blog.php',0,0,N'Blog Editor Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SITE',NULL,N'HP_EDITOR',1,N'AP Tools',N'HP Editor',N'',N'AP/Site/HP/editor.hp.php',0,0,N'HomePage Editor Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SITE',NULL,N'RESOURCE_EDITOR',0,N'',N'Resource Editor',N'',N'AP/Site/editor.forum.php',0,0,N'Resources Editor Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SITE',NULL,N'AP_ISSUE_TRACKER',0,N'AP Tools',N'Issue Tracker',N'',N'AP/tracker/issue_tracker.php',0,0,N'Issue Tracker Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SITE',NULL,N'NEWS_EDITOR',1,N'AP Tools',N'News Editor',N'',N'AP/Site/News/editor.news.php',0,0,N'News Editor Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SITE',NULL,N'CREATE_NEW_PAGE',0,N'AP Tools',N'Page Creator',N'',N'AP/Site/PageCreator/AP_create_page.php',0,0,N'New Page Creator Page',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SITE',NULL,N'PATCH_NOTES_EDITOR',1,N'AP Tools',N'Patch Editor',N'',N'AP/Site/Patches/editor.patchnotes.php',0,0,N'Patch Notes Editor Page(Shaiya)',NULL,NULL,0,0,0,0);

-- AP - DONATE - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'SITE',NULL,N'PAYMENTS_CENTER',1,N'AP Tools',N'Payment Center',N'',N'AP/PmtOffice/AP_pmts.php',0,0,N'PayPal Payment Center Page(Shaiya)',NULL,NULL,0,0,0,0);

-- AP - STAFF - SHARED
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'UNI',N'STAFF',NULL,N'STF_PNL_LOG',1,N'Misc Tools',N'Panel Access Log',N'','AP/Staff/pnl_log.php',0,0,N'Panel Access Log',NULL,NULL,0,0,0,0);

-- edit for shared use
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'STD',N'AP',N'SHAIYA',N'STAFF',NULL,N'STF_STAFF_LIST',1,N'Misc Tools',N'Staff List',N'',N'AP/Staff/staff.php',0,0,N'Staff List',NULL,NULL,0,0,0,0);

-- AP - STAFF - SHAIYA
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'STAFF',NULL,N'STF_GLOBAL_CHAT',1,N'Misc Tools',N'Global Chat',N'',N'AP/Staff/global_chat.php',0,0,N'Global Chat Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'STAFF',NULL,N'STF_GM_CMDS_LOG',1,N'Misc Tools',N'GM Commands Log',N'',N'AP/Staff/gmcomsrch.php',0,0,N'GM Command Usage Log Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'STAFF',NULL,N'STF_GUILD_LDR_CHG',1,N'Misc Tools',N'Guild Leader Change',N'',N'AP/Staff/guild_leader_change.php',0,0,N'Guild Leader Change Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'STAFF',NULL,N'STF_ITEM_LIST',1,N'Misc Tools',N'Item Search',N'',N'AP/Staff/itemlist.php',0,0,N'Item Search Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'STAFF',NULL,N'STF_JAIL',0,N'Misc Tools',N'Jailers Inmate List',N'',N'AP/Staff/jail.php',0,0,N'Jail Inmate Page(Shaiya)',NULL,NULL,0,0,0,0);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'SH',N'AP',N'SHAIYA',N'STAFF',NULL,N'STF_ONLINE_PLRS',1,N'Misc Tools',N'Online Players List',N'',
N'AP/Staff/login_status.php',0,0,N'In-game Player Log Page(Shaiya)',NULL,NULL,0,0,0,0);
GO
ALTER TABLE [Cerberus].[dbo].[SETTINGS_PAGES] ADD PRIMARY KEY ([RowID])
GO