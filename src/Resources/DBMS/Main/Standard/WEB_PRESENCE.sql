IF OBJECT_ID('[Cerberus].[dbo].[WEB_PRESENCE]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[WEB_PRESENCE]
GO

CREATE TABLE [Cerberus].[dbo].[WEB_PRESENCE](
--	Basic
	[UserUID]		[int]			IDENTITY(1,1)	NOT NULL,
	[MemberID]		varchar(20)							NULL,
	[DisplayName]	varchar(50)							NULL,
	[UserID]		varchar(18)						NOT NULL,
	[Pw]			varchar(32)						NOT NULL,
--	Profile
	[Referer]		varchar(50)							NULL,
	[UserIP]		varchar(15) 					NOT NULL,
	[RegIP]			varchar(15)						NOT NULL,
	[Country]		varchar(2) 							NULL,
	[DateOfBirth]	varchar(20) 						NULL,
	[Gender]		varchar(6) 							NULL,
	[Role]			[smallint] 							NULL,
	[SecQuestion]	[int] 								NULL,
	[SecAnswer]		varchar(30) 						NULL,
	[Email]			varchar(50) 					NOT NULL 	DEFAULT ('@email.com'),
	[EmailVerified]	[bit]								NULL	DEFAULT (0),
	[RecoveryKey]	varchar(75)							NULL,
	[Admin]			[bit]								NOT NULL 	DEFAULT (0),
	[AdminLevel]	[tinyint]							NOT NULL	DEFAULT (0),
	[LoginStatus]	[bit]							NOT NULL	DEFAULT (0),
	[Status]		[smallint]						NOT NULL	DEFAULT (0),
	[JoinDate]		[datetime] 							NULL	DEFAULT getdate(),
	[LeaveDate]		[datetime] 						NOT NULL	DEFAULT getdate(),
	[RegDate]		[datetime] 						NOT NULL	DEFAULT getdate(),
	[Leave]			[tinyint] 						NOT NULL	DEFAULT (0),
	[UserType]		char(1)							NOT NULL 	DEFAULT ('N'),
--	BDSM
	[PartnerID_1]	varchar(20) 						NULL,
	[PartnerID_2]	varchar(20) 						NULL,
	[PartnerID_3]	varchar(20) 						NULL,
	[TestURI]		varchar(40) 						NULL,
--	Security
	[VerifyKey]		[varchar](50)						NULL,
	[ActivationKey]	[varchar](65)					NOT NULL,
	[BanEndDate]	[datetime]							NULL,
	[Enabled]		[tinyint] 						NOT NULL	DEFAULT (0),
)ON [PRIMARY]
GO

INSERT INTO [Cerberus].[dbo].[WEB_PRESENCE]
VALUES (N'960-581-720-375-597',N'Nexus',N'Nexus',N'Platinum',N'',N'108.176.234.146',N'108.176.234.146',null,N'10/29/1984',N'Male',null,N'1',N'Red',N'support@ndf-innovations.net',N'0',null,N'0',N'16',N'1',N'16',N'2019-04-27 21:33:21.200',N'2019-04-27 21:33:21.200',N'2019-04-27 21:33:21.200',N'0',N'A',N'965-205-411-809-565',N'620-065-892-387-067',null,null,null,N'HQNoEYOZisxL5vu3vfnUruyI4zPR6M3f0Mmnbe4jXiwDYdeEpAHQulKSVsudY86u',null,N'1');
GO

ALTER TABLE [Cerberus].[dbo].[WEB_PRESENCE] ADD PRIMARY KEY ([UserUID])
GO