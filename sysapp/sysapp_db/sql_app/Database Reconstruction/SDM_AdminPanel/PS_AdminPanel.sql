USE [master]
GO

/****** Object:  Database [SDM_AdminPanel]    Script Date: 12/4/2013 9:42:56 PM ******/
CREATE DATABASE [SDM_AdminPanel]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'SDM_AdminPanel', FILENAME = N'C:\ShaiyaServer\DevData\SDM_AdminPanel.mdf' , SIZE = 4096KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'SDM_AdminPanel_log', FILENAME = N'C:\ShaiyaServer\DevData\SDM_AdminPanel_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO

ALTER DATABASE [SDM_AdminPanel] SET COMPATIBILITY_LEVEL = 100
GO

IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [SDM_AdminPanel].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO

ALTER DATABASE [SDM_AdminPanel] SET ANSI_NULL_DEFAULT OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET ANSI_NULLS OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET ANSI_PADDING OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET ANSI_WARNINGS OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET ARITHABORT OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET AUTO_CLOSE OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET AUTO_CREATE_STATISTICS ON 
GO

ALTER DATABASE [SDM_AdminPanel] SET AUTO_SHRINK OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET AUTO_UPDATE_STATISTICS ON 
GO

ALTER DATABASE [SDM_AdminPanel] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET CURSOR_DEFAULT  GLOBAL 
GO

ALTER DATABASE [SDM_AdminPanel] SET CONCAT_NULL_YIELDS_NULL OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET NUMERIC_ROUNDABORT OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET QUOTED_IDENTIFIER OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET RECURSIVE_TRIGGERS OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET  DISABLE_BROKER 
GO

ALTER DATABASE [SDM_AdminPanel] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET TRUSTWORTHY OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET PARAMETERIZATION SIMPLE 
GO

ALTER DATABASE [SDM_AdminPanel] SET READ_COMMITTED_SNAPSHOT OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET HONOR_BROKER_PRIORITY OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET RECOVERY SIMPLE 
GO

ALTER DATABASE [SDM_AdminPanel] SET  MULTI_USER 
GO

ALTER DATABASE [SDM_AdminPanel] SET PAGE_VERIFY CHECKSUM  
GO

ALTER DATABASE [SDM_AdminPanel] SET DB_CHAINING OFF 
GO

ALTER DATABASE [SDM_AdminPanel] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO

ALTER DATABASE [SDM_AdminPanel] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO

ALTER DATABASE [SDM_AdminPanel] SET  READ_WRITE 
GO