<html>
<head>
</head>
<body>
	<div id="staff_list_html">
		<center>
			<?php
				$count = 1;
				$res = sqlsrv_query($link, "SELECT Account@handle, JoinDate, Contribution, AccountLastSignOn FROM STO_DB.dbo.Promotion WHERE Contribution IS NOT NULL ORDER BY AccountLastSignOn DESC");
				if(!sqlsrv_has_rows($res))
				{
				die("An error has occured. No data was found for display!");
				}
			?>
		<h1>Members Due For Promotion</h1>
			<table class="staff_list_html_table">
				<tr>
					<th>Count</th>
					<th>Account@Handle</th>
					<th>Join Date</th>
					<th>Contribution</th>
					<th>Last Online (Days)</th>
				</tr>
				<?php
					while($row = sqlsrv_fetch_array($res))
					{
					echo "<tr>";
						echo "<td class=\"ac_fl_count\">".$count."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['Account@handle']."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['JoinDate']."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['Contribution']."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['AccountLastSignOn']."</td>";
					echo "</tr>";
					$count++;
					}
					createLog($_SESSION['UserID'], "Viewed Staff List", $link);
					sqlsrv_close($link);
				?>
			</table>
		</center>
	</div>
</body>
</html>