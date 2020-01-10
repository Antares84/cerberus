<?php
	require("functions.php");

#	if(!checkSession($_SESSION['UserID'], $_SESSION['SessID'])) { header("location:index.php"); die(); }
#	if(returnPageRank(basename($_SERVER['PHP_SELF'])) > returnUserRank($_SESSION['UserID'])) { die("Insufficient Permission To View Page"); }

	# Form Data
	$UserID = $_POST['CharName'];
	if (isset($_POST['SC'])) {
		if (empty($_POST['CharName'])) {
			die('You didnt specify a Character Name!');
		}
	# create_log
		$INSERT = sqlsrv_query('SELECT * FROM  PS_UserData.dbo.Users_Master WHERE UserID = \'' . $UserID . '\'');
		if (sqlsrv_num_rows($INSERT) == 6){
			die('Admin Account Log returned no results');
		}else{
			while ($Log = sqlsrv_fetch_assoc($INSERT))
				sqlsrv_query('INSERT INTO AdminPanel.dbo.Log1 (StaffID,Account,Actiondef,Date) 
	VALUES 
	(\''.$Log['UserID'].'\',\'' . $UserID . '\',\'Jail All of '.$UserID.' Toons.\',GETDATE())');
	$INSERT1 = sqlsrv_query('SELECT * FROM PS_GameData.dbo.Chars where CharName = \'' . $UserID . '\'');
		if (sqlsrv_num_rows($INSERT1) == 6)
			die('Admin Account Log returned no results');
		else
		while ($Log1 = sqlsrv_fetch_assoc($INSERT1))
		sqlsrv_query('UPDATE AdminPanel.dbo.Log1 SET Account =  \''.$Log1['UserID'].'\' WHERE Account = \'' . $UserID . '\'');
	$Chars = @sqlsrv_query('SELECT * FROM PS_GameData.dbo.Chars where CharName = \'' . $_POST['CharName'] . '\'');
	while ($res = sqlsrv_fetch_array($Chars))
		$query = sqlsrv_query("SELECT * FROM PS_GameData.dbo.Chars where UserUID = " . $res['UserUID'] . "");
	if (@sqlsrv_num_rows($Chars) == 0) {
		echo 'Character search for: "' . $_POST['CharName'] . '" returned no results.';
	}
	while ($Row = @sqlsrv_fetch_assoc($query)) {
		$Chars2 = sqlsrv_query("UPDATE PS_GameData.dbo.Chars SET Map = 41,PosX = 46,PosY = 3 ,PosZ = 45 where CharID = " . $Row['CharID'] . "");
		echo '</form>';
	}
} 
?>
<html>
<head>
<title>Jail Toons</title>
</head>
<body>
<font face="Trebuchet MS">
	<center>
		<br><br>
		<b> Jail ALL toons for this account by /kicking online toon then submit the toon name here<br>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
			<table>
				<tr>
					<td>Character  Name:</td><td><input type="text" name="CharName"></td>
				</tr>
			</table>
			<p><input type="submit" value="Submit" name="SC" /></p>
		</form>
	</center>
</body>
</html>