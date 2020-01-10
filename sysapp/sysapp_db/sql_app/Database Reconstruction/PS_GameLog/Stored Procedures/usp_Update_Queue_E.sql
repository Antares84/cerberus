USE [PS_GameLog]
GO

/****** Object:  StoredProcedure [dbo].[usp_Update_Queue_E]    Script Date: 8/16/2014 12:10:49 AM ******/

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE Proc [dbo].[usp_Update_Queue_E]

@QueueID int,
@Answer varchar(4000),
@OwnerAdminID varchar(30),
@Type tinyint,
@AnswerDate datetime

AS

UPDATE PS_GameLog.dbo.QuestionQueueList
SET Answer=@Answer, Type=@Type, OwnerAdminID=@OwnerAdminID, AnswerDate=@AnswerDate
WHERE QueueID = @QueueID

GO