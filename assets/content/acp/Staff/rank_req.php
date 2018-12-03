<center>
	<div class="page_req">
	<?php
		$res = sqlsrv_query($link, "SELECT PageDesc, [Rank] FROM PS_AdminPanel.dbo.Pages ORDER BY [Rank] ASC");
		if(!sqlsrv_has_rows($res)) { die("An error has occured. Please try again later."); } ?>
		<h1>Page Rank Requirements</h1>
		<table class="req">
			<tr>
				<th>Page Name</th>
				<th>Rank Required</th>
			</tr>
	<?php
	while($row = sqlsrv_fetch_array($res))
	{
		echo "<tr>";
		echo "<td>".$row['PageDesc']."</td>";
		echo "<td>Rank ".$row['Rank']."</td>";
		echo "</tr>";
	}
	createLog($_SESSION['UserID'], "Viewed Page Rank Requirements", $link);
	sqlsrv_close($link);
	?>
	</table>
	</div>
	<div class="page_ranks">
	<h1>Ranks</h1>
	<table class="ranks">
		<tr>
			<th>Rank Number</th>
			<th>Usage</th>
		</tr>
		<tr>
			<td>0</td>
			<td>Game Sage</td>
		</tr>
		<tr>
			<td>1</td>
			<td>Game Master</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Developer</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Administrator</td>
		</tr>
	</table>
	</div>
</center>