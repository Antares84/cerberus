IF OBJECT_ID('[Zerox_ACP].[dbo].[MESSAGES]', 'U') IS NOT NULL DROP TABLE [Zerox_ACP].[dbo].[MESSAGES]
GO

CREATE TABLE [Zerox_ACP].[dbo].[MESSAGES](
	[RowID]		[int]			IDENTITY(1,1)	NOT NULL,
	[MSG_ID]	[varchar](255)					NOT NULL,
	[MSG_TEXT]	[varchar](255)					NOT NULL
)ON [PRIMARY]
GO

-- SITE-WIDE MESSAGES
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'WS-0x01',	N'The page you are looking for either doesn''t exist or has been moved.');
-- LOGIN MESSAGES - USERNAME
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x01',	N'A UserID is required. How else would you be able to log in?');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x02',	N'Your UserID must be between 3 and 16 characters in length.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x03',	N'Your UserID must consist of numbers and letters only.<br>Special characters are not allowed.');
-- LOGIN MESSAGES - PASSWORD
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x04',	N'A password is required for all accounts.<br>Please provide a password.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x05',	N'Your password must be between 3 and 16 characters in length.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x06',	N'Your password must consist of numbers and letters only.<br>Special characters are not allowed.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x07',	N'Your account has been banned due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a GM or GS.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x08',	N'Login successful.<br>Loading your homepage now...');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'L-0x09',	N'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.');
-- REGISTRATION MESSAGES - USERNAME
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x01',	N'Please provide a UserID.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x02',	N'UserID must be between 3 and 16 characters in length.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x03',	N'UserID must consist of numbers and letters only.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x04',	N'UserID already exists, please choose a different UserID.');
-- REGISTRATION MESSAGES - EMAIL
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x05',	N'Please provide your e-mail.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x06',	N'Invalid e-mail format.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x07',	N'The e-mail address provided has already been used. Please choose a different e-mail address.');
-- REGISTRATION MESSAGES - PASSWORD
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x08',	N'Please provide a password.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x09',	N'Password must be between 3 and 16 characters in length.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x10',	N'Passwords do not match.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x11',	N'Failed to determine if this username already exists in the database.');
-- REGISTRATION MESSAGES - TERMS OF SERVICE/USE
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x12',	N'You must agree to our Terms Of Service to register.');
-- REGISTRATION MESSAGES - VALIDATION
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x13',	N'Your account, <font class="b_i">-text0-,</font> has been successfully created!');
--INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
--	VALUES (N'R-0x14',	N'A verification email has been sent to <font class="b_i">-text1-</font> with an activation key.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.<br>Didn''t receive an e-mail? Please try to resend the e-mail by clicking <a href="-text2-" target="_blank">here</a>.<br>Your Activation/Recovery Key is <font class="b_i">-text3-</font>.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x15',	N'Verification e-mail failed to send to the e-mail that you provided. Please contact an administrator for further assistance.');
INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
	VALUES (N'R-0x16',	N'Account creation has failed. Please contact an admin for assistance.');
-- REGISTRATION MESSAGES - VALIDATION && RESEND
-- INSERT INTO [Zerox_ACP].[dbo].[MESSAGES]
--	VALUES (N'R-0x17',	N'A verification email has been resent to <font class="b_i">-text2-</font> with an activation key for the account <font class="b_i">-text0-</font>.<br>Please check your e-mail to complete your registration.<br>If the e-mail is not in your Inbox, please check your Spam folder.<br>Still didn''t receive the e-mail? Contact an administrator for further assistance.');
GO