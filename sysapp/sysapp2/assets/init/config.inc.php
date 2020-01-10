<?php
error_reporting(E_ALL ^ E_NOTICE);
$host = '127.0.0.1';
$connInfo = array("ReturnDatesAsStrings"=>1,"UID"=>"Sacred", "PWD"=>"Platinum1520");
$link = @sqlsrv_connect($host, $connInfo) or die("MSSQL Server Connection Failed. Please report this error to an Admin.");
?>