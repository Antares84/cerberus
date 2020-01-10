<html>
<head>
</head>
<body>
	<div id="staff_list_html">
		<center>
			<?php
				$count = 1;
				$res = sqlsrv_query($link, "SELECT * FROM STO_DB.dbo.Kickable ORDER BY AccountLastSignOn ASC");
				if(!sqlsrv_has_rows($res))
				{
				die("An error has occured. No data was found for display!");
				}
			?>
		<h1>Members Due For Removal From Fleet</h1>
			<table class="staff_list_html_table">
				<tr>
					<th>Count</th>
					<th>Char & Handle</th>
					<th>Fleet Rank</th>
					<th>Char Last Online (Days)</th>
					<th>Acct Last Online (Days)</th>
					<th>Officer Notes</th>
				</tr>
				<?php
					while($row = sqlsrv_fetch_array($res))
					{
					echo "<tbody>";
						echo "<tr>";
							echo "<td class=\"ac_fl_count\">".$count."</td>";
							echo "<td class=\"ac_fl_fill\">".$row['Account@handle']."</td>";
							echo "<td class=\"ac_fl_fill\">".$row['FleetRank']."</td>";
							echo "<td class=\"ac_fl_fill\">".$row['LastSignOn']."</td>";
							echo "<td class=\"ac_fl_fill\">".$row['AccountLastSignOn']."</td>";
							echo "<td class=\"ac_fl_fill\">".$row['OfficerNotes']."</td>";
						echo "</tr>";
					echo "</tbody>";
					$count++;
					}
//					createLog($_SESSION['UserID'], "Viewed Staff List", $link);
					sqlsrv_close($link);
				?>
			</table>
		</center>
	</div>
</body>
</html>