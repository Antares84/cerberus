-- The PS_WEB Data Bridge is used for bridging your web server database with your Shaiya database
-- if your Shaiya database is stored on a separate host.

USE [master];
EXEC master.dbo.sp_addlinkedserver @server = N'PS_WEB', @srvproduct=N'', @provider=N'SQLNCLI', @datasrc=N'SERVER_IP';
EXEC master.dbo.sp_addlinkedsrvlogin @rmtsrvname=N'PS_WEB',@useself=N'False',@locallogin=NULL,@rmtuser=N'DB_USER',@rmtpassword='DB_PASS';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'collation compatible', @optvalue=N'false';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'data access', @optvalue=N'true';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'dist', @optvalue=N'false';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'pub', @optvalue=N'false';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'rpc', @optvalue=N'false';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'rpc out', @optvalue=N'false';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'sub', @optvalue=N'false';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'connect timeout', @optvalue=N'0';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'collation name', @optvalue=null;
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'lazy schema validation', @optvalue=N'false';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'query timeout', @optvalue=N'0';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'use remote collation', @optvalue=N'true';
EXEC master.dbo.sp_serveroption @server=N'PS_WEB', @optname=N'remote proc transaction promotion', @optvalue=N'true';
GO