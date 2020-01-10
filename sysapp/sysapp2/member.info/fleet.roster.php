<?php
// Database configuration parameters
require("./assets/init/config.inc.php");
// session_start();
// if(!checkSession($_SESSION['UserID'], $_SESSION['SessID'])) { header("location:index.php"); die(); }
// if(returnPageRank(basename($_SERVER['PHP_SELF'])) > returnUserRank($_SESSION['UserID'])) { die("Insufficient Permission To View Page"); }
// createLog($_SESSION['UserID'], "Viewed Online Users", $link);
$count = 1;
?>
<html>
<head>
</head>
<body>
	<center>
		<div id="active_fleet_roster">
			<?php
				$res = sqlsrv_query($link, "SELECT * FROM STO_DB.dbo.NewData WHERE Handle IS NOT NULL AND Career != 'Not Active' ORDER BY Handle ASC");
				if(!sqlsrv_has_rows($res))
			{
				die("No results found!");
			}
			?>
			<h1>Current Active Fleet Members</h1>
			<table class="ac_fl_roster_data",>
				<thead>
					<tr>
						<th width=\"20px\">Count</th>
						<th width=\"50px\">Character</th>
						<th width=\"50px\">Handle</th>
						<th width=\"20px\">Fleet Rank</th>
					</tr>
				</thead>
			<?php
				while ($row = sqlsrv_fetch_array($res))
			{
				echo "<tbody>";
					echo "<tr>";
						echo "<td class=\"ac_fl_count\">".$count."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['User']."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['Handle']."</td>";
						echo "<td class=\"ac_fl_career\">".$row['Career']."</td>";
					echo "</tr>";
				echo "</tbody>";
				$count++;
			}
				sqlsrv_close($link);
			?>
		</table>
		</div>
	</center>
</font>
</body>
</html>