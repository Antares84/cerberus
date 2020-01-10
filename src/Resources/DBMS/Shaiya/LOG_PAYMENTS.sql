IF OBJECT_ID('[Cerberus].[dbo].[LOG_PAYMENTS]', 'U') IS NOT NULL
DROP TABLE [Cerberus].[dbo].[LOG_PAYMENTS]
GO

CREATE TABLE [Cerberus].[dbo].[LOG_PAYMENTS](
	[RowID]					[int]			IDENTITY(1,1)	NOT NULL,
	[UserID]				[varchar](50)					NOT NULL,
	[Paid]					[varchar](50)					NOT NULL,
	[Reward]				[int]							NOT NULL,
	[DonatorEmail]			[varchar](50)					NOT NULL,
	[PaymentStatus]			[varchar](50)					NOT NULL,
	[TransID]				[varchar](50)					NOT NULL,
	[TransValidationKey]	[varchar](MAX)					NOT NULL,
	[PaymentType]			[varchar](50)					NOT NULL,
	[PaymentDate]			[datetime]						NOT NULL	DEFAULT (getdate())
)ON [PRIMARY]
GO