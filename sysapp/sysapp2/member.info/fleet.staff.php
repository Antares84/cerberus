<html>
<head>
</head>
<body>
	<div id="staff_list_html">
		<center>
			<?php
				$count = 1;
				$res = sqlsrv_query($link, "SELECT * FROM STO_DB.dbo.NewData WHERE FleetRank IN  ('Temporal Fleet Commander', 'Armada Operations Officer','Fleet Operations Officer') ORDER BY FleetRank DESC");
				if(!sqlsrv_has_rows($res))
				{
				die("Staff Users Not Found!");
				}
			?>
		<h1>Registered Staff Members</h1>
			<table class="staff_list_html_table">
				<tr>
					<th>Count</th>
					<th>Handle</th>
					<th>Character Name</th>
					<th>Position</th>
				</tr>
				<?php
					while($row = sqlsrv_fetch_array($res))
					{
					echo "<tr>";
						echo "<td class=\"ac_fl_count\">".$count."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['User']."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['Handle']."</td>";
						echo "<td class=\"ac_fl_fill\">".$row['FleetRank']."</td>";
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