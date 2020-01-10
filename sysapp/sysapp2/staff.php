<html>
<head>
</head>
<body>
	<div id="staff_list_html">
		<center>
			<?php
				$res = sqlsrv_query($link, "SELECT c.CharName, c.UserID, c.UserUID, u.Point FROM SDM_GameData.dbo.Chars c INNER JOIN SDM_UserData.dbo.Users_Master u ON u.UserUID = c.UserUID WHERE c.CharName LIKE '![%' ESCAPE'!' AND c.Del=0");
				if(!sqlsrv_has_rows($res))
				{
				die("Staff Users Not Found!");
				}
			?>
		<h1>Registered Staff Members</h1>
			<table class="staff_list_html_table">
				<tr>
					<th>UserID</th>
					<th>UserUID</th>
					<th>CharName</th>
				</tr>
				<?php
					while($row = sqlsrv_fetch_array($res))
					{
					echo "<tr>";
					echo "<td width=20%><a href=\"#".$row['UserUID']."&UserID=".$row['CharName']."\">".$row['UserID']."</a></td>";
					echo "<td width=10%>".$row['UserUID']."</td>";
					echo "<td width=70%>".$row['CharName']."</td>";
					echo "</tr>";
					}
					createLog($_SESSION['UserID'], "Viewed Staff List", $link);
					sqlsrv_close($link);
				?>
			</table>
		</center>
	</div>
</body>
</html>