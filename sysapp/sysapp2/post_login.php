<center>
<?php
require('./assets/init/functions.php');
$UserID = isset($_POST['UserID']) ? escData($_POST['UserID']) : '';
$Pw = isset($_POST['Pw']) ? escData($_POST['Pw']) : '';

if(strlen($UserID) && strlen($Pw))
{
	require('./assets/init/config.inc.php');
	$query = sqlsrv_query($link, "EXEC PS_UserData.dbo.CheckPw ?, ?", array($UserID, $Pw)) or die( print_r( sqlsrv_errors(), true));
	if(!sqlsrv_has_rows($query))
	{
		createLog($UserID, "Failed Login", $link);
		die("Incorrect login information used! Login attempt has been sent to an Administrator for processing.
			<br />
			If you think this page is incorrect an Administrator will review the logs and contact you.");
	}
	$check = sqlsrv_query($link, "SELECT [Status] FROM PS_UserData.dbo.Users_Master WHERE UserID = ?", array($UserID));
	$res = sqlsrv_fetch_array($check);
	if($res['Status'] !== 16)
	{
		$gsCheck = sqlsrv_query($link, "SELECT * FROM SDM_AdminPanel.dbo.Users WHERE UserID = ?", array($UserID));
		if(!sqlsrv_has_rows($gsCheck))
		{
			createLog($UserID, "Failed Login Attempt: Normal User", $link);
			die("Your login credentials do not allow you to use these resources. If you believe this to be an error, please message an Admin.");
		}
	}
	session_start();
	$_SESSION['UserID'] = $UserID;
	$_SESSION['SessID'] = createSession($UserID);
	$add = sqlsrv_query($link, "SELECT * FROM SDM_AdminPanel.dbo.Users WHERE UserID = ?", array($UserID));
	if(!sqlsrv_has_rows($add))
	{
		$add2 = sqlsrv_query($link, "INSERT INTO SDM_AdminPanel.dbo.Users (UserID, Rank) VALUES(?, ?)", array($UserID, 0));
	}
	createLog($UserID, "Login Successful", $link);
	header("location:panel.php");
}
else
{
	header("location:index.php");
}
?>