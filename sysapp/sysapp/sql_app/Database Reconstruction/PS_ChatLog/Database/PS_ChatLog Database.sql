USE [master]
GO

/****** Object:  Database [PS_ChatLog]    Script Date: 12/5/2014 6:50:52 AM ******/
CREATE DATABASE [PS_ChatLog]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'PS_ChatLog_Data', FILENAME = N'C:\ShaiyaServer\DevData\Old Database\PS_ChatLog.mdf' , SIZE = 2560KB , MAXSIZE = UNLIMITED, FILEGROWTH = 10%)
 LOG ON 
( NAME = N'PS_ChatLog_Log', FILENAME = N'C:\ShaiyaServer\DevData\Old Database\PS_ChatLog.ldf' , SIZE = 5120KB , MAXSIZE = UNLIMITED, FILEGROWTH = 10%)
GO

ALTER DATABASE [PS_ChatLog] SET COMPATIBILITY_LEVEL = 90
GO

IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [PS_ChatLog].[dbo].[sp_fulltext_database] @action = 'disable'
end
GO

ALTER DATABASE [PS_ChatLog] SET ANSI_NULL_DEFAULT OFF 
GO

ALTER DATABASE [PS_ChatLog] SET ANSI_NULLS OFF 
GO

ALTER DATABASE [PS_ChatLog] SET ANSI_PADDING OFF 
GO

ALTER DATABASE [PS_ChatLog] SET ANSI_WARNINGS OFF 
GO

ALTER DATABASE [PS_ChatLog] SET ARITHABORT OFF 
GO

ALTER DATABASE [PS_ChatLog] SET AUTO_CLOSE ON 
GO

ALTER DATABASE [PS_ChatLog] SET AUTO_CREATE_STATISTICS ON 
GO

ALTER DATABASE [PS_ChatLog] SET AUTO_SHRINK ON 
GO

ALTER DATABASE [PS_ChatLog] SET AUTO_UPDATE_STATISTICS ON 
GO

ALTER DATABASE [PS_ChatLog] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO

ALTER DATABASE [PS_ChatLog] SET CURSOR_DEFAULT  GLOBAL 
GO

ALTER DATABASE [PS_ChatLog] SET CONCAT_NULL_YIELDS_NULL OFF 
GO

ALTER DATABASE [PS_ChatLog] SET NUMERIC_ROUNDABORT OFF 
GO

ALTER DATABASE [PS_ChatLog] SET QUOTED_IDENTIFIER OFF 
GO

ALTER DATABASE [PS_ChatLog] SET RECURSIVE_TRIGGERS OFF 
GO

ALTER DATABASE [PS_ChatLog] SET  DISABLE_BROKER 
GO

ALTER DATABASE [PS_ChatLog] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO

ALTER DATABASE [PS_ChatLog] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO

ALTER DATABASE [PS_ChatLog] SET TRUSTWORTHY OFF 
GO

ALTER DATABASE [PS_ChatLog] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO

ALTER DATABASE [PS_ChatLog] SET PARAMETERIZATION SIMPLE 
GO

ALTER DATABASE [PS_ChatLog] SET READ_COMMITTED_SNAPSHOT OFF 
GO

ALTER DATABASE [PS_ChatLog] SET HONOR_BROKER_PRIORITY OFF 
GO

ALTER DATABASE [PS_ChatLog] SET RECOVERY SIMPLE 
GO

ALTER DATABASE [PS_ChatLog] SET  MULTI_USER 
GO

ALTER DATABASE [PS_ChatLog] SET PAGE_VERIFY TORN_PAGE_DETECTION  
GO

ALTER DATABASE [PS_ChatLog] SET DB_CHAINING OFF 
GO

ALTER DATABASE [PS_ChatLog] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO

ALTER DATABASE [PS_ChatLog] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO

ALTER DATABASE [PS_ChatLog] SET  READ_WRITE 
GO


