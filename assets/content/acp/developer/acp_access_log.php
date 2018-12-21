<?php
#	createLog("Viewed Panel Log");
	#if(!($ChkUser->LoggedIn())){header("Location: ?p=index");die();}
	$count	=	1;
	$Where	=	false;
	$User	=	false;
	$Cat	=	false;

	# Content
	echo '<div id="page-wrapper">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div class="col-lg-12">';
					echo '<h1 class="page-header">'.$Data->PageTitle;if(!empty($Data->PageSub)){echo '<small> - '.$Data->PageSub.'</small>';}echo '</h1>';
					echo '<ol class="breadcrumb">';
						echo '<li><i class="fa fa-dashboard"></i> <a href="?id=Dashboard">Dashboard</a></li>';
						echo '<li class="active"><i class="fa fa-dashboard"></i> <a href="#">'.$Data->PageTitle.'</a></li>';
					echo '</ol>';
					echo '<div id="title" class="tac">Admin Panel Access Log</div>';

/*					echo '<div id="sb_content">';
						echo '<form class="acp-form" action="?id=AccessLog&value='.$Cat.'" method="POST">';
							echo '<table class="acp-table" cellpadding="0" cellspacing="0" width="100%">';
								echo '<tr>';
									echo '<td class="tac">UserID</td>';
									echo '<td class="tac">Category</td>';
								echo '</tr>';
								echo '<tr>';
									echo '<td class="tac"><input type="text" name="User" /></td>';
									echo '<td class="tac">';
										echo '<select name="Category">';
											echo '<option value="all">All</option>';
											echo '<option value="ban">Banned Character</option>';
											echo '<option value="unban">Unbanned Character</option>';
											echo '<option value="vpl">Viewed Panel Log</option>';
											echo '<option value="vou">Viewed Banned Users</option>';
											echo '<option value="vbu">Viewed Online Users</option>';
											echo '<option value="vgl">Viewed GS List</option>';
											echo '<option value="vprr">Viewed Page Ranks</option>';
											echo '<option value="fc">Faction Change</option>';
											echo '<option value="login">Login Log</option>';
											echo '<option value="logout">Logout Log</option>';
											echo '<option value="mc">Modified Character</option>';
											echo '<option value="sfc">Searched Character</option>';
											echo '<option value="sfa">Searched Account</option>';
											echo '<option value="sfg">Searched Guild</option>';
											echo '<option value="glc">Guild Leader Changed</option>';
											echo '<option value="cr">Character Ressurected</option>';
											echo '<option value="ga">Gave Staff AP</option>';
											echo '<option value="vpb">Viewed Player Buffs</option>';
											echo '<option value="vel">Viewed Equipped Links</option>';
										echo '</select>';
									echo '</td>';
								echo '</tr>';
							echo '</table><br />';
							echo '<div style="margin-left:50%;">';
								echo '<input type="submit" value="Submit" name="submit"/>';
							echo '</div><br /><br />';
						echo '</form>';
*/						if(isset($_POST['submit'])){
							if(isset($_POST['Category'])){
								$Cat	=	$Data->escData($_POST['Category']);
								switch($Cat){
									case "all":																									break;
									case "ban":		$Where	.=	"WHERE Action LIKE 'Banned Character: %' OR Action LIKE 'Failed Ban On %' ";	break;
									case "unban":	$Where	.=	"WHERE Action LIKE '%Unban%' ";													break;
									case "vpl":		$Where	.=	"WHERE Action = 'Viewed Panel Log' ";											break;
									case "vou":		$Where	.=	"WHERE Action = 'Viewed Online Log' ";											break;
									case "vbu":		$Where	.=	"WHERE Action = 'Viewed Banned Log' ";											break;
									case "vgl":		$Where	.=	"WHERE Action = 'Viewed GS Staff List' ";										break;
									case "vprr":	$Where	.=	"WHERE Action = 'Viewed Page Rank Requirements' ";								break;
									case "fc":		$Where	.=	"WHERE Action LIKE 'Faction Change: %' ";										break;
									case "login":	$Where	.=	"WHERE Action LIKE '%Login%' ";													break;
									case "logout":	$Where	.=	"WHERE Action = 'User logged out.' ";											break;
									case "mc":		$Where	.=	"WHERE Action LIKE 'Modified Character: %' ";									break;
									case "sfc":		$Where	.=	"WHERE Action LIKE 'Searched For Character: %' ";								break;
									case "sfa":		$Where	.=	"WHERE Action LIKE 'Searched For Account: %' ";									break;
									case "sfg":		$Where	.=	"WHERE Action LIKE 'Searched For Guild: %' ";									break;
									case "glc":		$Where	.=	"WHERE Action LIKE 'Guild Leader Changed: %' ";									break;
									case "cr":		$Where	.=	"WHERE Action LIKE 'Resurrected Character: %' ";								break;
									case "ga":		$Where	.=	"WHERE Action LIKE 'Gave 25k AP to: %' ";										break;
									case "vpb":		$Where	.=	"WHERE Action LIKE 'Viewed Player''s Buffs(Player: %)' ";						break;
									case "vel":		$Where	.=	"WHERE Action LIKE 'Viewed Equipped Item Links (Player: %)' ";					break;
									default:																									break;
								}
							}
							if(isset($_POST['User']) && $_POST['User']!==""){

								$User	=	escData(trim($_POST['User']));

								if($Where	===	""){
									$Where="WHERE UserID=".$User."";
								}
								elseif($Where	===	"Action LIKE 'Banned Character: %' OR Action LIKE 'Failed Ban On %' "){
									$Where	=	"Action LIKE 'Banned Character: %' AND UserID = ".$User." OR Action LIKE 'Failed Ban On %' AND UserID=".$User."";
								}else{
									$Where	.=	"AND UserID=?";}
							}
							if($User === ""){
								$res	=	odbc_exec($DB->conn,"SELECT * FROM ".$DB->get_table("FTW_ACP_LOG")." ".$Where." ORDER BY ActionTime DESC");
							}
							if($res === false){
								echo '<div id="sb_content">';
									echo 'An error has occured.';
									die();
								echo '</div>';
							}
						}else{
							$res	=	odbc_exec($DB->conn,"SELECT TOP 50 * FROM ".$DB->get_table("FTW_ACP_LOG")." ORDER BY ActionTime DESC");
						}
						if(!odbc_fetch_array($res)){
							echo '<div id="sb_content">';
								echo 'Nothing in the logs!';
								die();
							echo '</div>';
						}
					echo '</div>';
					echo '<div id="sb_content">';
						echo '<table class="acp-table" border=1>';
							echo '<tr>';
								echo '<th width=2%>#</th>';
								echo '<th>UserID</th>';
								echo '<th>UserIP</th>';
								echo '<th>Action</th>';
								echo '<th>Action Time</th>';
							echo '</tr>';
						while($row = odbc_fetch_array($res)){
							echo "<tr>";
								echo "<td>".$count."</td>";
								echo "<td>".$row['UserID']."</td>";
								echo "<td>".$row['UserIP']."</td>";
								echo "<td>".$row['Action']."</td>";
								echo "<td>".date("m/d/y H:i A", strtotime($row['ActionTime']))."</td>";
							echo "</tr>";
							$count++;
						}
					echo '</div>';
				echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>