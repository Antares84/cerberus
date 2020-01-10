<div id="pl_search_php">
<?php
// Database configuration parameters
require("./assets/init/config.inc.php");
session_start();
if(!checkSession($_SESSION['UserID'], $_SESSION['SessID'])) { header("location:index.php"); die(); }
if(returnPageRank(basename($_SERVER['PHP_SELF'])) > returnUserRank($_SESSION['UserID'])) { die("Insufficient Permission To View Page"); }

//Form Data
$char  = escData(trim($_REQUEST['char']));
if (!isset($_POST['submit'])) {
?>
<body>
	<div id="pl_search_html">
		<center>
		<b>Find Player<br>
		<form action="panel.php?action=fl_srch" class="pl_search_html_form" method="POST">
			<table>
				<tr>
					<th>
						Account Handle:
					</th>
					<td>
						<input type="text" name="char" />
					</td>
				</tr>
			</table>
			<input type="submit" value="Submit" name="submit" />
		</form>
		</center>
	</div>
</body>
<?php
}
else
{
	if (strlen($char) < 1)
	{
		die("Character's name is too short.");
	}
	$query = sqlsrv_query($link, "` ?)", array($char));
//	$query1 = sqlsrv_query($link, "SELECT * FROM SDM_UserData.dbo.UsersMaster WHERE Email = (SELECT UserUID FROM SDM_GameData.dbo.Chars WHERE Del=0 AND CharName = ?)", array($char));
//	createLog($_SESSION['UserID'],"Searched For Character: ".$char."", $link);
	if (!sqlsrv_has_rows($query))
	{
		die("No chars matched the search parameters entered.");
	}
	else
	{
		echo "
		<body alink=\"blue\" vlink=\"blue\" llink=\"blue\">
		<font face=\"trebuchet MS\"><font color=\"#FF0000\">Result for the search: '$char'</font><table cellspacing=1 cellpadding=2 border=1 style=\"border-style:hidden;\">
		<tr bgcolor='#CE9E00'><td>UserUID</td><td>UserName</td><td>E-Mail</td><td>Char ID</td><td>CharName</td><td>CharLevel</td></tr>";
		while ($res = sqlsrv_fetch_array($query))
			echo "<tr bgcolor='#CE9E00'>
						<td>" . $res['Accounts'] . "</td>
						<td>" . $res['Rank'] . "</td>
					</tr>";
		echo "</table>
			  </font>
			  </body>";
	}
}
sqlsrv_close($link);
?>
</div>