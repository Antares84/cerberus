<?php
	if(!($ChkUser->LoggedIn())){header("Location: ?p=index");die();}

	$Guild = escData(@trim($_POST['Guild']));

	if (isset($_POST['submit'])){
		if (strlen($Guild) < 1){
			die("Invalid Guild Name.");
		}
		$res=odbc_exec($cxn2,"SELECT g.MasterName,g.GuildID,c.CharName,c.UserUID,c.UserID,c.CharID
							  FROM ".$cfg["Chars"]." as c
							  INNER JOIN ".$cfg["GuildChars"]." as gc on c.CharID=gc.CharID
							  INNER JOIN ".$cfg["Guilds"]." as g on gc.GuildID=g.GuildID
							  WHERE gc.GuildLevel=2 and g.GuildName='".$Guild."'");
		if(!odbc_num_rows($res)){
			die("Guild '".$Guild."' does not exist");
		}else{
			$chars=odbc_fetch_array($res);
			echo '<div id="wrapper">';
				echo '<div id="page-wrapper">';
					echo '<div class="container-fluid">';
						echo '<div class="row">';
							echo '<div class="col-lg-12">';
								echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
								echo '<div id="title" class="tac">Select New Guild Leader for: '.$guild.'</div>';
								echo '<div id="sb_content">';
									echo '<form class="acp-form" action="" method="POST">';
										echo '<center>';
											echo 'Select New Leader: ';
											echo '<input type="hidden" name="Guild" value="'.$Guild.'">';
											echo '<input type="hidden" name="guild-id" value="'.$chars['GuildID'].'">';
											echo '<input type="hidden" name="oldlead" value="'.$chars['MasterName'].'">';
											echo '<select name="newlead" width="20" style="width:100px">';
#												echo "<option value=\"".$chars['UserUID'].",".$chars['UserID'].",".$chars['CharName'].",".$chars['CharID']."\">".$chars['CharName']."</option>";
											while($chars=odbc_fetch_array($res)){
												echo "<option value=\"".$chars['UserUID'].",".$chars['UserID'].",".$chars['CharName'].",".$chars['CharID']."\">".$chars['CharName']."</option>";
											}
											echo "</select><br /><br />";
											echo "<input type=\"submit\" value=\"Submit\" name=\"submit2\" />";
										echo '</center>';
									echo "</form>";
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
	}else if (isset($_POST['submit2'])){
		$newlead = $_POST['newlead'];
		$oldlead = $_POST['oldlead'];
		$guild   = $_POST['guild'];
		$guildid = $_POST['guild-id'];
		$newlead = explode(',', $newlead);
		echo '<div id="wrapper">';
			echo '<div id="page-wrapper">';
				echo '<div class="container-fluid">';
					echo '<div class="row">';
						echo '<div class="col-lg-12">';
							echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
							echo '<div id="title" class="tac">Leader changed for: '.$Guild.'</div>';
							echo '<div id="sb_content">';
								echo "Guild = ".$Guild."<br />";
								echo "Old Leader = ".$oldlead."<br />";
								echo "New Leader = ".$newlead[2]."";
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		odbc_exec($cxn2,"UPDATE ".$cfg["GuildChars"]." SET GuildLevel=8 WHERE GuildLevel=1 and GuildID='".$guildid."'");
		odbc_exec($cxn2,"UPDATE ".$cfg["Guilds"]." SET MasterUserID='".$newlead[1]."', MasterCharID='".$newlead[3]."',MasterName='".$newlead[2]."' WHERE GuildName='".$Guild."'");
		odbc_exec($cxn2,"UPDATE ".$cfg["GuildChars"]." SET GuildLevel=1 WHERE CharID='".$newlead[3]."'");
		createLog($_SESSION['uid'],"Guild leader changed. Guild Name: (".$Guild.") Old Leader: (".$oldlead.") => New Leader: (".$newlead[2].")");
	}else{
		echo '<div id="wrapper">';
			echo '<div id="page-wrapper">';
				echo '<div class="container-fluid">';
					echo '<div class="row">';
						echo '<div class="col-lg-12">';
							echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
							echo '<div id="title" class="tac">Guild Leader Change</div>';
							echo '<div id="sb_content">';
								echo '<form class="acp-form" action="" method="POST">';
									echo '<table class="acp-table">';
										echo '<tr>';
											echo '<td style="text-align:right;">Guild Name:</td>';
											echo '<td style="text-align:left;"><input type="text" name="Guild" class="tac" /></td>';
										echo '</tr>';
									echo '</table><br />';
									echo '<center>';
										echo '<input type="submit" value="Submit" name="submit" />';
									echo '</center>';
								echo '</form>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
?>