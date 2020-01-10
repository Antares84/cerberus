USE [PS_GameLog]
GO

/****** Object:  StoredProcedure [dbo].[usp_Insert_Queue_E]    Script Date: 8/16/2014 12:06:04 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Insert_Queue_E]

@QueueID int,
@CharID int,
@CharName varchar(50),
@Question varchar(2000),
@OwnerAdminID varchar(30),
@Type tinyint = 1,
@QuestionDate datetime

AS

INSERT INTO QuestionQueueList(QueueID, CharID, CharName, Question, Type, OwnerAdminID, QuestionDate)
VALUES(@QueueID, @CharID, @CharName, @Question, @Type, @OwnerAdminID, @QuestionDate)

GO