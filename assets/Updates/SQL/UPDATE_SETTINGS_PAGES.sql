IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_PAGES]','U') IS NOT NULL DROP TABLE [Cerberus].[dbo].[SETTINGS_PAGES]
GO

CREATE TABLE [dbo].[SETTINGS_PAGES](
	[RowID]				[int]			IDENTITY(1,1)	NOT NULL,
	[ZONE]				[varchar](3)					NOT NULL,
	[SITE_TYPE]			[varchar](6)					NOT NULL,
	[PAGE_CAT]			[varchar](50)					NOT NULL,
	[PAGE_DESC]			[varchar](max)					NULL,
	[PAGE_INDEX]		[varchar](50)					NOT NULL,
	[PAGE_SUB]			[varchar](50)					NULL,
	[PAGE_TITLE]		[varchar](50)					NOT NULL,
	[PAGE_URI]			[varchar](max)					NOT NULL,
	[URI_TYPE]			[varchar](10)					NULL,
	[METATAG_DESC]		[varchar](max)					NULL,
	[METATAG_KEYWORDS]	[varchar](max)					NULL,
	[METATAG_TITLE]		[varchar](max)					NULL,
	[PAGE_ICON]			[varchar](50)					NULL,
	[PAGE_TYPE]			[varchar](4)					NOT NULL,
	[PAGE_SHOW]			[bit]							NOT NULL	DEFAULT(0),
	[REQ_LOGIN]			[bit]							NOT NULL	DEFAULT(0),
	[SHOW]				[bit]							NOT NULL	DEFAULT(0)
)
GO

-- CMS - MAIN
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Main',null,N'HOME',null,N'Home',N'assets/content/cms/main/home.php',N'Single',null,null,null,null,N'MAIN',N'1',N'0',N'1');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Main',null,N'ERROR',null,N'Error!',N'assets/content/cms/main/error.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'1');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Main',null,N'INBOX',null,N'Inbox',N'assets/content/cms/main/inbox.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'1');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Main',null,N'LANDING',null,N'Landing',N'assets/content/cms/main/landing.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Main',null,N'MAINTENANCE',null,N'Maintenance',N'assets/content/cms/main/maintenance.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Main',null,N'MESSAGES',null,N'Messages',N'assets/content/cms/main/messages.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Main',null,N'TOOLS',N'Main',N'Tools',N'assets/content/cms/main/tools.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Main',null,N'WELCOME',null,N'Welcome',N'assets/content/cms/main/welcome.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');

-- CMS - INFO
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'SHAIYA',N'Info',null,N'BOSS_RECORD',N'Info',N'Boss Record',N'assets/content/cms/info/boss_record.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Info',null,N'NEWS',N'Info',N'News',N'assets/content/cms/info/news.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'SHAIYA',N'Info',null,N'PATCH_NOTES',N'Info',N'Patch Notes',N'assets/content/cms/info/patch-notes.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'SHAIYA',N'Info',null,N'PVP_RANKING',null,N'PvP Ranking',N'assets/content/cms/info/pvp.php',N'Single',N'PvP Ranking',null,null,null,N'MAIN',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Info',null,N'TOS',N'Info',N'Terms of Membership',N'assets/content/cms/info/tos.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');

-- CMS - MEMBER
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'SHAIYA',N'Member',null,N'DONATE',N'Member',N'Donate',N'assets/content/cms/member/donate.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'SHAIYA',N'Member',null,N'DOWNLOADS',N'Member',N'Downloads',N'assets/content/cms/member/downloads.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Member',null,N'PW_CHANGE',N'Member',N'Password Change',N'assets/content/cms/member/pchange.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Member',null,N'UPDATE_EMAIL',N'Member',N'Update E-Mail',N'assets/content/cms/member/emailch.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Member',null,N'USER_PROFILE',N'Member',N'My Profile',N'assets/content/cms/member/user_profile.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Member',null,N'ISSUE_TRKR',N'Member',N'Issue Tracker',N'assets/content/cms/issue_tracker/tracker.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');

-- CMS - OTHER
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'SHAIYA',N'Donation',null,N'COMPLETE_DONATION',N'Member',N'Donation Completed',N'assets/content/cms/member/donate_complete.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'SHAIYA',N'Donation',null,N'PROCESS_DONATION',null,N'Donation Processing',N'assets/content/cms/member/donate_process.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Reg',null,N'PW_RESET',null,N'Password Reset',N'assets/content/cms/register/reset-pw.php',N'Single',null,null,null,null,N'MAIN',N'1',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Recovery',null,N'RECOVERY',null,N'Recovery',N'assets/content/cms/main/recovery.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Resend',null,N'RESEND_REGISTRATION',null,N'Resend E-mail',N'assets/content/cms/mail/resendemail.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Verify',null,N'VERIFY',null,N'Account Verify',N'assets/content/cms/auth/verify.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');

-- CMS - OPTIONS
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Options',N'Login',N'AUTH',null,N'Login',N'assets/content/cms/auth/login.php',N'Single',null,null,null,null,N'MAIN',N'1',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Options',N'Login',N'VALIDATE',null,N'Validate',N'assets/content/cms/auth/validate.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Options',null,N'REGISTER',null,N'Register',N'assets/content/cms/auth/register.php',N'Single',null,null,null,null,N'MAIN',N'1',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Options',null,N'REGISTRATION_COMPLETE',null,N'Registration Complete',N'assets/content/cms/auth/register_complete.php',N'Single',null,null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'UNI',N'Options',null,N'LOGOUT',null,N'Log Out',N'assets/content/cms/auth/logout.php',N'Single',null,null,null,null,N'MAIN',N'1',N'1',N'0');

-- AP - ACCOUNT
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Account',null,N'ACCT_SEARCH',N'Account Tools',N'Account Search',N'assets/content/acp/account/account_search.php',N'Sub',N'Account Search Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Account',null,N'ACCT_BAN',N'Account Tools',N'Account Ban',N'assets/content/acp/account/ban_account.php',N'Sub',N'Account Ban Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Account',null,N'ACCT_BAN_SEARCH',N'Account Tools',N'Account Ban Search',N'assets/content/acp/account/bansearch.php',N'Sub',N'Account Ban Search Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Account',null,N'ACCT_UNBAN',N'Account Tools',N'Account Unban',N'assets/content/acp/account/unban_account.php',N'Sub',N'Account Unban Page(Shaiya)',null,null,null,N'SUB',N'1',N'0',N'0');

-- AP - MAIN
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Dashboard',null,N'DASHBOARD',null,N'Dashboard',N'assets/content/acp/main/acp_home.php',N'Single',N'ACP Home Page',null,null,null,N'MAIN',N'1',N'0',N'0');

-- AP - DEVELOPER
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'CRYPTO',N'Developer Tools',N'Crypto',N'assets/content/acp/developer/crypts.php',N'Sub',N'Crypto Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'FILE_CHECKER',N'Developer Tools',N'File Checker',N'assets/content/acp/admin/file_test.php',N'Sub',N'File Checker Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'MAIL_TEST',N'Developer Tools',N'Mail Test',N'assets/content/acp/developer/acp_test_email.php',N'Sub',N'Email Test Page',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'PLUGINS',N'Developer Tools',N'Plugins',N'assets/content/acp/wm/acp_plugins.php',N'Sub',N'Plugins Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'RECAPTCHA_V2',N'Developer Tools',N'ReCaptcha 2.0',N'assets/content/acp/wm/acp_recaptcha_v2.php',N'Sub',N'ReCaptcha 2.0 Test Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'SCRIPTS',N'Developer Tools',N'Scripts',N'assets/content/acp/admin/scripts.php',N'Sub',N'Scripts Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'SHOPS',N'Developer Tools',N'Shops',N'assets/content/acp/admin/store.php',N'Sub',N'Shops Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'UPLOADER',N'Developer Tools',N'File Uploader',N'assets/content/acp/plupload/uploader.php',N'Sub',N'File Uploader Test Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'ISSUE_TRACKER_REPLY',N'Developer Tools',N'Issue Tracker - Reply',N'assets/content/acp/tracker/issue_tracker_reply.php',N'Sub',N'Issue Tracker-Reply Page',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'TOOLS',N'Developer Tools',N'Tools',N'assets/content/acp/wm/tools.php',N'Sub',N'Tools',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Developer',null,N'CREATE_NEW_STORE',N'Developer Tools',N'Add Store',N'assets/content/acp/main/acp_create_store.php',N'Sub',N'Store Creation Page',null,null,null,N'SUB',N'0',N'1',N'0');

-- AP - JTS3SERVERMOD
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'JTS3',null,N'MESSAGE_BOT_CREATOR',null,N'Message Bot Creator',N'assets/content/acp/jts3servermod/acp_jts3_msg_bot_creator.php',N'Sub',N'JTS3 Message Bot Config Creation Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'JTS3',null,N'WELCOME_BOT_CREATOR',null,N'Welcome Bot Creator',N'assets/content/acp/jts3servermod/acp_jts3_welcome_bot_creator.php',N'Sub',N'JTS3 Welcome Bot Config Creation Page',null,null,null,N'SUB',N'1',N'1',N'0');

-- AP - PLAYER
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Player',null,N'PLR_BUFF_VIEW',N'Player Tools',N'View Player''s Buffs',N'assets/content/acp/player/buff_view.php',N'Sub',N'View Player Buffs Page(Shaiya)',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Player',null,N'PLR_FC',N'Player Tools',N'Faction Change',N'assets/content/acp/player/fc.php',N'Sub',N'Faction Change Page(Shaiya)',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Player',null,N'PLR_GUILD_SEARCH',N'Player Tools',N'Guild Search',N'assets/content/acp/player/guild_search.php',N'Sub',N'Guild Search Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Player',null,N'PLR_ITEM_VIEW',N'Player Tools',N'View Player''s Equipped Items',N'assets/content/acp/player/item_view.php',N'Sub',N'Item View Page(Shaiya)',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Player',null,N'PLR_SEARCH',N'Player Tools',N'Player Search',N'assets/content/acp/player/search.php',N'Sub',N'Player Search Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Player',null,N'PLR_STATS_EDITOR',N'Player Tools',N'Player Stats Editor',N'assets/content/acp/player/stat_edit.php',N'Sub',N'Stat Editor Page(Shaiya)',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Player',null,N'PLR_RES',N'Player Tools',N'UM Res',N'assets/content/acp/player/um_res.php',N'Sub',N'UM Res Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');

-- AP - SESSION
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Session',null,N'INDEX',null,N'Index',N'assets/content/acp/session/acp_login.php',N'Single',N'Welcome Page',null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Session',null,N'LOGIN',null,N'Login',N'assets/content/acp/auth/acp_auth.php',N'Single',N'Login Page',null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Session',null,N'LOGOUT',null,N'Logout',N'assets/content/acp/session/acp_logout.php',N'Single',N'Log Out Page',null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Session',null,N'SESSION_END',null,N'Session Ended',N'assets/content/acp/session/acp_sess_end.php',N'Single',N'Session Ended Page',null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Session',null,N'SESSION_CLOSE',null,N'Session Ended',N'assets/content/acp/session/acp_term_sess.php',N'Single',N'Session Terminate Page',null,null,null,N'MAIN',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Session',null,N'ACP_VALIDATE',null,N'Auth',N'assets/content/acp/session/acp_validate.php',N'Single',N'Session Validate Page',null,null,null,N'MAIN',N'0',N'0',N'0');

-- AP - SETTINGS
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',null,N'STNG_WARNING',N'Settings',N'Settings Warning',N'assets/content/acp/settings/settings_warning.php',N'Sub',N'Warning Settings Page',null,null,null,N'MAIN',N'1',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit Plugin Settings',N'STNG_PLUGINS',N'Settings',N'Plugin Settings',N'assets/content/acp/settings/settings_plugins.php',N'Sub',N'Plugin Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit Core Settings',N'STNG_CORE',N'Core Settings',N'Core Settings',N'assets/content/acp/settings/settings_core.php',N'Sub',N'Core Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit Colors Settings',N'STNG_COLORS',N'Colors Settings',N'Colors Settings',N'assets/content/acp/settings/settings_colors.php',N'Sub',N'Colors Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit Contact Settings',N'STNG_CONTACT',N'Contact Settings',N'ContactUs Settings',N'assets/content/acp/settings/settings_contact.php',N'Sub',N'Contact Info Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit Logging Settings',N'STNG_LOG',N'Logging Settings',N'Logging Settings',N'assets/content/acp/settings/settings_logging.php',N'Sub',N'Logging Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit Pages',N'STNG_PAGES',N'Pages Settings',N'Pages Settings',N'assets/content/acp/settings/settings_pages.php',N'Sub',N'Page Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit PayPal Payments Settings',N'STNG_PAYPAL',N'PayPal Settings',N'PayPal Settings',N'assets/content/acp/settings/settings_paypal.php',N'Sub',N'PayPal Payment Settings (Shaiya)',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit PHP Mailer Mail Settings',N'STNG_MAIL',N'Mail Settings',N'Mail Daemon Settings',N'assets/content/acp/settings/settings_mail.php',N'Sub',N'PHP Mailer Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit ReCaptcha 2.0 Settings',N'STNG_RECAPTCHA',N'ReCaptcha Settings',N'ReCaptcha Settings',N'assets/content/acp/settings/acp_settings_recaptcha.php',N'Sub',N'ReCaptcha Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit Theme Settings',N'STNG_THEME',N'Theme Settings',N'Theme Settings',N'assets/content/acp/settings/settings_theme.php',N'Sub',N'Theme Settings',null,null,null,N'SUB',N'0',N'0',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'SETTINGS',N'Edit Style Settings',N'STNG_STYLE',N'Style Settings',N'Style Settings',N'assets/content/acp/settings/settings_style.php',N'Sub',N'Style Settings',null,null,null,N'SUB',N'0',N'0',N'0');

-- AP - SITE
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Site',null,N'BLOG_EDITOR',N'',N'Blog Editor',N'assets/content/acp/site/Blog/editor.blog.php',N'Sub',N'Blog Editor Page',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Site',null,N'HP_EDITOR',N'ACP Tools',N'HP Editor',N'assets/content/acp/site/HP/editor.hp.php',N'Sub',N'Home Page Editor Page',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Site',null,N'RESOURCE_EDITOR',N'',N'Resource Editor',N'assets/content/acp/site/editor.forum.php',N'Sub',N'Resources Editor Page',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Site',null,N'ACP_ISSUE_TRACKER',N'ACP Tools',N'Issue Tracker',N'assets/content/acp/tracker/issue_tracker.php',N'Sub',N'Issue Tracker Page',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Site',null,N'NEWS_EDITOR',N'ACP Tools',N'News Editor',N'assets/content/acp/site/News/editor.news.php',N'Sub',N'News Editor Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Site',null,N'CREATE_NEW_PAGE',N'ACP Tools',N'Page Creator',N'assets/content/acp/site/PageCreator/acp_create_page.php',N'Sub',N'New Page Creator Page',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Site',null,N'PATCH_NOTES_EDITOR',N'ACP Tools',N'Patch Editor',N'assets/content/acp/site/Patches/editor.patchnotes.php',N'Sub',N'Patch Notes Editor Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Site',null,N'PAYMENTS_CENTER',N'ACP Tools',N'Payment Center',N'assets/content/acp/PmtOffice/acp_pmts.php',N'Sub',N'PayPal Payment Center Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');

-- AP - STAFF
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Staff',null,N'STF_GLOBAL_CHAT',N'Misc Tools',N'Global Chat',N'assets/content/acp/staff/global_chat.php',N'Sub',N'Global Chat Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Staff',null,N'STF_GM_CMDS_LOG',N'Misc Tools',N'GM Commands Log',N'assets/content/acp/staff/gmcomsrch.php',N'Sub',N'GM Command Usage Log Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Staff',null,N'STF_GUILD_LDR_CHG',N'Misc Tools',N'Guild Leader Change',N'assets/content/acp/staff/guild_leader_change.php',N'Sub',N'Guild Leader Change Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Staff',null,N'STF_ITEM_LIST',N'Misc Tools',N'Item Search',N'assets/content/acp/staff/itemlist.php',N'Sub',N'Item Search Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Staff',null,N'STF_JAIL',N'Misc Tools',N'Jailer''s Inmate List',N'assets/content/acp/staff/jail.php',N'Sub',N'Jail Inmate Page(Shaiya)',null,null,null,N'SUB',N'0',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Staff',null,N'STF_ONLINE_PLRS',N'Misc Tools',N'Online Players List',N'assets/content/acp/staff/login_status.php',N'Sub',N'Ingame Player Log Page(Shaiya)',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'UNI',N'Staff',null,N'STF_PNL_LOG',N'Misc Tools',N'Panel Access Log',N'assets/content/acp/staff/pnl_log.php',N'Sub',N'Panel Access Log',null,null,null,N'SUB',N'1',N'1',N'0');
INSERT INTO [dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SHAIYA',N'Staff',null,N'STF_STAFF_LIST',N'Misc Tools',N'Staff List',N'assets/content/acp/player/staff.php',N'Sub',N'Staff List',null,null,null,N'SUB',N'1',N'1',N'0');
GO

ALTER TABLE [dbo].[SETTINGS_PAGES] ADD PRIMARY KEY ([RowID])
GO