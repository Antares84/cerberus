IF OBJECT_ID('[Cerberus].[dbo].[WEB_PRESENCE]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[WEB_PRESENCE]
GO

CREATE TABLE [Cerberus].[dbo].[WEB_PRESENCE](
	[UserUID]		[int]			IDENTITY(1,1)	NOT NULL,
	[UserID]		[varchar](50)					NOT NULL,
	[Pw]			[varchar](50)					NOT NULL,
	[DisplayName]	[varchar](50)					NOT NULL,
	[DOB]			[varchar](10)					NOT NULL,
	[Gender]		[varchar](50)					NOT NULL,
	[Referer]		[varchar](50)					NOT NULL,
	[SecQuestion]	[int]							NOT NULL,
	[SecAnswer]		[varchar](50)					NOT NULL,
	[VerifyKey]		[varchar](50)					NOT NULL,
	[ActivationKey]	[varchar](65)					NOT NULL,
	[Email]			[varchar](50)					NOT NULL,
	[Admin]			[bit]							NOT NULL	DEFAULT(0),
	[Status]		[tinyint]						NOT NULL	DEFAULT(0),
	[LoginStatus]	[bit]							NOT NULL	DEFAULT(0),
	[UserIP]		[varchar](15)					NOT NULL,
	[BanEndDate]	[datetime]						NULL
)ON [PRIMARY]
GO