IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_PAGES]','U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[SETTINGS_PAGES]
GO

CREATE TABLE [Cerberus].[dbo].[SETTINGS_PAGES](
	[RowID]				[int]			IDENTITY(1,1)	NOT NULL,
	[ZONE]				[varchar](3)					NOT NULL,	[PAGE_CAT]			[varchar](50)					NULL,	[PAGE_DESC]			[varchar](max)					NULL,	[PAGE_INDEX]		[varchar](50)					NULL,	[PAGE_SHOW]			[bit]							NOT NULL	DEFAULT(0),	[PAGE_SUB]			[varchar](50)					NULL,	[PAGE_TITLE]		[varchar](50)					NULL,	[PAGE_URI]			[varchar](max)					NULL,	[REQ_LOGIN]			[bit]							NOT NULL	DEFAULT(0),	[METATAG_DESC]		[varchar](max)					NULL,	[METATAG_KEYWORDS]	[varchar](max)					NULL,	[METATAG_TITLE]		[varchar](max)					NULL
)ON [PRIMARY]
GO

-- CMS - MAIN
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Main',NULL,N'HOME',1,NULL,N'Home',N'assets/content/cms/main/home.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Main',NULL,N'ERROR',0,NULL,N'Error!',N'assets/content/cms/main/error.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Main',NULL,N'INBOX',0,NULL,N'Inbox',N'assets/content/cms/main/inbox.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Main',NULL,N'LANDING',0,NULL,N'Landing',N'assets/content/cms/main/landing.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Main',NULL,N'MAINTENANCE',0,NULL,N'Maintenance',N'assets/content/cms/main/maintenance.php',0,NULL,NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Main',NULL,N'MESSAGES',0,NULL,N'Messages',N'assets/content/cms/main/messages.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Main',NULL,N'TOOLS',0,N'Main',N'Tools',N'assets/content/cms/main/tools.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Main',NULL,N'WELCOME',0,NULL,N'Welcome',N'assets/content/cms/main/welcome.php',0,NULL,NULL,NULL);

-- CMS - INFO
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Info',NULL,N'NEWS',1,N'Info',N'News',N'assets/content/cms/info/news.php',1,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Info',NULL,N'RESOURCES',1,N'Info',N'Resources',N'assets/content/cms/main/resources.php',0,NULL,NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Info',NULL,N'TOS',0,N'Info',N'Terms of Membership',N'assets/content/cms/info/tos.php',1,NULL,NULL,NULL);
-- CMS - MEMBER
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Member',NULL,N'USER_PROFILE',1,N'Member',N'My Profile',N'assets/content/cms/member/user_profile.php',1,NULL,NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Member',NULL,N'ISSUE_TRKR',1,N'Member',N'Issue Tracker',N'assets/content/cms/issue_tracker/tracker.php',1,NULL,NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Member',NULL,N'JOURNAL',1,N'Member',N'My Journal',N'assets/content/member/journal.php',1,NULL,NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Member',NULL,N'MEMBERLIST',1,N'Member',N'Members List',N'assets/content/member/members.php',1,NULL,NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Member',NULL,N'STORYTIME',1,N'Member',N'Story Time',N'assets/content/member/story.php',1,NULL,NULL,NULL);

-- CMS - OTHER
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Recovery',NULL,N'RECOVERY',0,NULL,N'Recovery',N'assets/content/cms/main/recovery.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Resend',NULL,N'RESEND_REGISTRATION',0,NULL,N'Resend E-mail',N'assets/content/cms/mail/resendemail.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Verify',NULL,N'VERIFY',0,NULL,N'Account Verify',N'assets/content/cms/auth/verify.php',0,NULL,NULL,NULL);
-- CMS - OPTIONS
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Options',N'Login',N'AUTH',1,NULL,N'Login',N'assets/content/cms/auth/login.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Options',N'Login',N'VALIDATE',0,NULL,N'Validate',N'assets/content/cms/auth/validate.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Options',NULL,N'REGISTER',1,NULL,N'Register',N'assets/content/cms/auth/register.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Options',NULL,N'REGISTRATION_COMPLETE',0,NULL,N'Registration Complete',N'assets/content/cms/auth/register_complete.php',0,NULL,NULL,NULL);INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'CMS',N'Options',NULL,N'LOGOUT',1,NULL,N'Log Out',N'assets/content/cms/auth/logout.php',1,NULL,NULL,NULL);

-- ACP - MAIN
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Dashboard',NULL,N'DASHBOARD',1,NULL,N'Dashboard',N'assets/content/acp/main/acp_home.php',0,N'ACP Home Page',NULL,NULL);

-- ACP - DEVELOPER
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'CRYPTO',1,NULL,N'Crypto',N'assets/content/acp/wm/crypts.php',0,N'Crypto Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'FILE_CHECKER',1,NULL,N'File Checker',N'assets/content/acp/admin/file_test.php',0,N'File Checker Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'MAIL_TEST',1,NULL,N'Mail Test',N'assets/content/acp/wm/acp_test_email.php',0,N'Email Test Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'PLUGINS',1,NULL,N'Plugins',N'assets/content/acp/wm/acp_plugins.php',0,N'Plugins Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'RECAPTCHA_V2',1,NULL,N'ReCaptcha 2.0',N'assets/content/acp/wm/acp_recaptcha_v2.php',0,N'ReCaptcha 2.0 Test Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'SCRIPTS',1,NULL,N'Scripts',N'assets/content/acp/admin/scripts.php',0,N'Scripts Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'SHOPS',1,NULL,N'Shops',N'assets/content/acp/admin/store.php',0,N'Shops Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'UPLOADER',1,NULL,N'File Uploader',N'assets/content/acp/plupload/uploader.php',0,N'File Uploader Test Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'ISSUE_TRACKER_REPLY',0,N'ACP Tools',N'Issue Tracker - Reply',N'assets/content/acp/tracker/issue_tracker_reply.php',0,N'Issue Tracker-Reply Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'TOOLS',1,N'ACP Tools',N'Tools',N'assets/content/acp/wm/tools.php',0,N'Tools',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Developer',NULL,N'CREATE_NEW_STORE',0,NULL,N'Add Store',N'assets/content/acp/main/acp_create_store.php',0,N'Store Creation Page',NULL,NULL);

-- ACP - JTS3SERVERMOD
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'JTS3',NULL,N'MESSAGE_BOT_CREATOR',1,NULL,N'Message Bot Creator',N'assets/content/acp/jts3servermod/acp_jts3_msg_bot_creator.php',0,N'JTS3 Message Bot Config Creation Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'JTS3',NULL,N'WELCOME_BOT_CREATOR',1,NULL,N'Welcome Bot Creator',N'assets/content/acp/jts3servermod/acp_jts3_welcome_bot_creator.php',0,N'JTS3 Welcome Bot Config Creation Page',NULL,NULL);

-- ACP - SESSION
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Session',NULL,N'INDEX',0,NULL,N'Index',N'assets/content/acp/session/acp_login.php',0,N'Welcome Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Session',NULL,N'LOGIN',0,NULL,N'Login',N'assets/content/acp/auth/acp_auth.php',0,N'Login Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Session',NULL,N'LOGOUT',0,NULL,N'Logout',N'assets/content/acp/session/acp_logout.php',0,N'Log Out Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Session',NULL,N'SESSION_END',0,NULL,N'Session Ended',N'assets/content/acp/session/acp_sess_end.php',0,N'Session Ended Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Session',NULL,N'SESSION_CLOSE',0,NULL,N'Session Ended',N'assets/content/acp/session/acp_term_sess.php',0,N'Session Terminate Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Session',NULL,N'ACP_VALIDATE',0,NULL,N'Auth',N'assets/content/acp/session/acp_validate.php',0,N'Session Validate Page',NULL,NULL);

-- SETTINGS
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',NULL,N'STNG_WARNING',1,N'Settings',N'Global Settings > Warning',N'assets/content/acp/settings/settings_warning.php',0,N'Warning Settings Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Language Settings',N'STNG_LANG',0,N'Settings',N'Global Settings > Textuals',N'assets/content/acp/settings/settings_lang.php',0,N'Textual Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Layout Settings',N'STNG_LAYOUT',0,N'Settings',N'Global Settings > Layout',N'assets/content/acp/settings/settings_layout.php',0,N'Layout Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Plugin Settings',N'STNG_PLUGINS',0,N'Settings',N'Global Settings > Plugins',N'assets/content/acp/settings/settings_plugins.php',0,N'Plugin Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Core Settings',N'STNG_CORE',0,N'Core Settings',N'Settings > Core',N'assets/content/acp/settings/settings_core.php',0,N'Core Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Colors Settings',N'STNG_COLORS',0,N'Colors Settings',N'Settings > Colors',N'assets/content/acp/settings/settings_colors.php',0,N'Colors Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Contact Settings',N'STNG_CONTACT',0,N'Contact Settings',N'Settings > Contact Info',N'assets/content/acp/settings/settings_contact.php',0,N'Contact Info Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Pages',N'STNG_PAGES',0,N'Pages Settings',N'Settings > Pages',N'assets/content/acp/settings/settings_pages.php',0,N'Page Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit PayPal Payments Settings',N'STNG_PAYPAL',0,N'PayPal Settings',N'Settings > PayPal',N'assets/content/acp/settings/settings_paypal.php',0,N'PayPal Payment Settings (Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit PHP Mailer Mail Settings',N'STNG_MAIL',0,N'Mail Settings',N'Settings > Mail',N'assets/content/acp/settings/settings_mail.php',0,N'PHP Mailer Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit ReCaptcha 2.0 Settings',N'STNG_RECAPTCHA',0,N'ReCaptcha Settings',N'Settings > ReCaptcha',N'assets/content/acp/settings/acp_settings_recaptcha.php',0,N'ReCaptcha Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Theme Settings',N'STNG_THEME',0,N'Theme Settings',N'Settings > Theme',N'assets/content/acp/settings/settings_theme.php',0,N'Theme Settings',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'SETTINGS',N'Edit Style Settings',N'STNG_STYLE',0,N'Style Settings',N'Settings > Styles',N'assets/content/acp/settings/settings_style.php',0,N'Style Settings',NULL,NULL);

-- ACP - SITE
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Site',NULL,N'BLOG_EDITOR',0,N'',N'Blog Editor',N'assets/content/acp/site/Blog/editor.blog.php',0,N'Blog Editor Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Site',NULL,N'HP_EDITOR',1,N'ACP Tools',N'HP Editor',N'assets/content/acp/site/HP/editor.hp.php',0,N'Home Page Editor Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Site',NULL,N'RESOURCE_EDITOR',0,N'',N'Resource Editor',N'assets/content/acp/site/editor.forum.php',0,N'Resources Editor Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Site',NULL,N'ACP_ISSUE_TRACKER',0,N'ACP Tools',N'Issue Tracker',N'assets/content/acp/tracker/issue_tracker.php',0,N'Issue Tracker Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Site',NULL,N'NEWS_EDITOR',1,N'ACP Tools',N'News Editor',N'assets/content/acp/site/News/editor.news.php',0,N'News Editor Page(Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Site',NULL,N'CREATE_NEW_PAGE',0,N'ACP Tools',N'Page Creator',N'assets/content/acp/site/PageCreator/acp_create_page.php',0,N'New Page Creator Page',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Site',NULL,N'PATCH_NOTES_EDITOR',1,N'ACP Tools',N'Patch Editor',N'assets/content/acp/site/Patches/editor.patchnotes.php',0,N'Patch Notes Editor Page(Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Site',NULL,N'PAYMENTS_CENTER',1,N'ACP Tools',N'Payment Center',N'assets/content/acp/pmt_office/acp_pmts.php',0,N'PayPal Payment Center Page(Shaiya)',NULL,NULL);

-- ACP - STAFF
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Staff',NULL,N'STF_GLOBAL_CHAT',1,N'Misc Tools',N'Global Chat',N'assets/content/acp/staff/global_chat.php',0,N'Global Chat Page(Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Staff',NULL,N'STF_GM_CMDS_LOG',1,N'Misc Tools',N'GM Commands Log',N'assets/content/acp/staff/gmcomsrch.php',0,N'GM Command Usage Log Page(Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Staff',NULL,N'STF_GUILD_LDR_CHG',1,N'Misc Tools',N'Guild Leader Change',N'assets/content/acp/staff/guild_leader_change.php',0,N'Guild Leader Change Page(Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Staff',NULL,N'STF_ITEM_LIST',1,N'Misc Tools',N'Item Search',N'assets/content/acp/staff/itemlist.php',0,N'Item Search Page(Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Staff',NULL,N'STF_JAIL',0,N'Misc Tools',N'Jailer''s Inmate List',N'assets/content/acp/staff/jail.php',0,N'Jail Inmate Page(Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Staff',NULL,N'STF_ONLINE_PLRS',1,N'Misc Tools',N'Online Players List',N'assets/content/acp/staff/login_status.php',0,N'Ingame Player Log Page(Shaiya)',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Staff',NULL,N'STF_PNL_LOG',1,N'Misc Tools',N'Panel Access Log',N'assets/content/acp/staff/pnl_log.php',0,N'Panel Access Log',NULL,NULL);
INSERT INTO [Cerberus].[dbo].[SETTINGS_PAGES]
VALUES (N'ACP',N'Staff',NULL,N'STF_STAFF_LIST',1,N'Misc Tools',N'Staff List',N'assets/content/acp/player/staff.php',0,N'Staff List',NULL,NULL);
GO
ALTER TABLE [Cerberus].[dbo].[SETTINGS_PAGES] ADD PRIMARY KEY ([RowID])
GO