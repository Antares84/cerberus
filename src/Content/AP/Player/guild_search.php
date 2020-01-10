<center>
<?php
	$GuildName  = escData(trim($_REQUEST['Guild']));

	$Rank=array(0=>"Waiting List",1=>"Guild Leader",2=>"Officer",3=>"Rank 3",4=>"Rank 4",5=>"Rank 5",6=>"Rank 6",7=>"Rank 7",8=>"Rank 8",9=>"Rank 9");
	if(!isset($_POST['submit'])){
		echo '<div id="page-wrapper">';
			echo '<div id="content">';
				echo '<div id="title">Find Players Within A Guild</div>';
				echo '<br />';
				echo '<form action="" class="content-form" method="POST">';
					echo '<table>';
						echo '<tr>';
							echo '<td><input type="text" name="Guild" placeholder="Guild Name" /></td>';
						echo '</tr>';
					echo '</table>';
					echo '<br />';
					echo '<input type="submit" value="Submit" name="submit" />';
				echo '</form>';
			echo '</div>';
		echo '</div>';
	}else{
		if(strlen($GuildName)<1){
			echo '<div id="page-wrapper">';
				echo '<div id="content">';
					echo "Guilds's name is too short!";
					echo '<form class="content-form" action="" method="post">';
						echo '<br />';
						echo '<input type="submit" value="Try Again" name="?p=pl_srch" />';
					echo '</form>';
				echo '</div>';
			echo '</div>';
			die();
		}
		$query=odbc_exec($dbConn,"SELECT g.GuildName, gc.GuildLevel, c.CharName, gc.JoinDate
								  FROM PS_GameData.dbo.GuildChars gc
								  INNER JOIN PS_GameData.dbo.Guilds g ON g.GuildID = gc.GuildID
								  INNER JOIN PS_GameData.dbo.Chars c on c.CharID = gc.CharID
								  WHERE gc.Del = 0 AND c.Del = 0 and g.Del = 0 AND g.GuildName = '".$GuildName."' ORDER BY gc.GuildLevel");
		createLog($_SESSION['UserID'],"Searched For Guild: ".$char);
		if(!odbc_num_rows($query)){
			echo '<div id="page-wrapper">';
				echo '<div id="content">';
					echo "No guilds were found that matched the search criteria.";
					echo '<form class="content-form" action="" method="post">';
						echo '<br />';
						echo '<input type="submit" value="Try Again" name="?p=pl_srch" />';
					echo '</form>';
				echo '</div>';
			echo '</div>';
			die();
		}else{
		echo '<body alink="blue" vlink="blue" llink="blue">';
		echo '<div id="page-wrapper">';
			echo '<div id="content">';
				echo 'Characters Found in Guild '.$GuildName.':';
				echo '<table class="content-form-table">';
					echo '<tr>';
						echo '<th>Guild Name</th>';
						echo '<th>Rank</th>';
						echo '<th>Character Name</th>';
						echo '<th>Join Date</th>';
					echo '</tr>';
				while($res=odbc_fetch_array($query)){
					echo "<tr>";
						echo '<td>'.$res['GuildName'].'</td>';
						echo '<td>'.$Rank[$res['GuildLevel']].'</td>';
						echo '<td>'.$res['CharName'] .'</td>';
						echo '<td>'.date("m/d/Y g:i:s A", strtotime($res['JoinDate'])).'</td>';
					echo '</tr>';
				}
				echo '</table>';
			echo '</div>';
		echo '</div>';
		}
	}
?>
</center>