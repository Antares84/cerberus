IF OBJECT_ID('[Cerberus].[dbo].[SETTINGS_MAIN]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[SETTINGS_MAIN]
GO

CREATE TABLE [Cerberus].[dbo].[SETTINGS_MAIN](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[ZONE]		[varchar](4)					NOT NULL,
	[TYPE]		[varchar](50)					NULL,
	[DESC]		[varchar](100)					NOT NULL,
	[SETTING]	[varchar](50)					NULL,
	[VALUE]		[varchar](max)					NULL,
	[EDIT]		[tinyint]						NOT NULL	DEFAULT(0),
	[SHOW]		[bit]							NOT NULL	DEFAULT(0)
)ON [PRIMARY]
GO

-- SITE MAIN
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'META',N'Site Author',N'AUTHOR',N'Bradley Sweeten',2,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'CMS',N'META',N'Site Title',N'SITE_TITLE',N'Cerberus CMS',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'META',N'Site Title',N'ACP_SITE_TITLE',N'NDF Admin Panel',2,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'META',N'Site WebMaster',N'WEBMASTER',N'Bradley Sweeten : nexusdevelopment2013@gmail.com',2,1);

-- ACP MAIN
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CORE',N'Setup Completed?',N'SETUP',N'0',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CORE',N'Site Type',N'SITE_TYPE',N'BDSM',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CORE',N'Page Prefix',N'PAGE_PREFIX',N'pageid',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CORE',N'Site Domain',N'SITE_DOMAIN',N'http://cerberus.ndf-innovations.net',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MODE',N'HTTPS Mode',N'HTTPS_SSL',N'0',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MODE',N'ACP Access Logging Mode',N'LOGGING',N'1',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MODE',N'Debug Mode',N'DEBUG',N'0',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MODE',N'Maintenance Mode',N'MAINTENANCE',N'0',0,1);

-- CONTACT
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CONTACT',N'Primary Phone Number',N'PHONE_PRIMARY',N'(012)-345-6789',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CONTACT',N'Secondary Phone Number',N'PHONE_SECONDARY',N'(012)-345-6789',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CONTACT',N'Address Line 1',N'ADDRESS_1',N'123 Find Me Lane',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CONTACT',N'Address Line 2',N'ADDRESS_2',N'Apt. 1',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CONTACT',N'Address Line 3',N'ADDRESS_3',N'Somewhere, USA 01234',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CONTACT',N'Sales E-mail',N'EMAIL_SALES',N'mail@mail.com',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'CONTACT',N'Support E-mail',N'EMAIL_SUPPORT',N'mail@mail.com',0,1);

-- PHPMAILER
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MAIL',N'Enable Mail System',N'MAILSYS_ENABLE',0,0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MAIL',N'E-mail Sender Account ID',N'PHPMAILER_ACCOUNT_ID',N'',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MAIL',N'E-mail Sender Account Password',N'PHPMMAILER_ACCOUNT_PW',N'',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MAIL',N'Reply-To Name',N'PHPMAILER_REPLY_NAME',N'NDF Admin',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MAIL',N'Reply-To Email',N'PHPMAILER_REPLY_EMAIL',N'admin@mail.com',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'MAIL',N'Mail Host (local/Gmail)',N'PHPMAILER_HOST',N'localhost',0,1);

-- PAYPAL
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - Enable Debugging (Used with IPN System)',N'PAYPAL_DEBUG',N'false',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - Payment Receiver E-mail',N'PAYPAL_RECEIVER',N'mail@mail.com',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - Sandbox URI (Req for testing IPN System)',N'PAYPAL_SANDBOX_URI',N'https://www.sandbox.paypal.com/cgi-bin/webscr',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - Standard URI',N'PAYPAL_STANDARD_URI',N'https://www.paypal.com/cgi-bin/webscr',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - Enable Sandbox (Req for testing IPN System',N'PAYPAL_SANDBOX',N'true',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - E-mail A (Req for IPN System)',N'PAYPAL_EMAIL_1',N'seller@paypalsandbox.com',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - E-mail B (Req for IPN System)',N'PAYPAL_EMAIL_2',N'mail@mail.com',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - E-mail C (Req for IPN System)',N'PAYPAL_EMAIL_3',N'mail@mail.com',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - Send Confirmation E-mail (Req for IPN System)',N'PAYPAL_CONF_EMAIL',N'true',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - Log Purchases To File (Req for IPN System)',N'PAYPAL_LOG_TO_FILE',N'true',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - IPN Logs Directory (Req for IPN System)',N'PAYPAL_LOG_DIR',N'logs',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'PAYPAL',N'PayPal - Log Purchases To Database (Req for IPN System)',N'PAYPAL_LOG_TO_DB',N'true',0,1);

-- RECAPTCHA KEYS
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'SEC',N'ReCaptcha v2.0 - Site Key',N'RECAPTCHA_SITE_KEY',N'6LdQ8RETAAAAAD2qZC4Q1dXSTfuGAqw2Kai77dHa',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'SEC',N'ReCaptcha v2.0 - Secret Key',N'RECAPTCHA_SEC_KEY',N'6LdQ8RETAAAAAPl-2DzW8Ewt25oFYgPY2nFJFatc',0,1);

-- VERSIONING
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'VERSIONING',N'CMS Version',N'VERSION',N'3.7.0',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'VERSIONING',N'Version Key',N'UPDATER_KEY',N'NHMzbFqcAFaFzSNH9MQO3VqB',0,1);
INSERT INTO [Cerberus].[dbo].[SETTINGS_MAIN]
VALUES (N'ACP',N'VERSIONING',N'Version Validator URI',N'UPDATER_URI',N'aHR0cDovL2Nkbi5uZGYtaW5ub3ZhdGlvbnMubmV0L2Ntcy92ZXJzaW9uLnhtbA',0,1);
GO