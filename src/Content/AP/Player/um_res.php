<?php
	//Form Data
	$login=isset($_POST['login']) ? escData(trim($_POST['login'])) : false;
	$class = array(
		0 => 'Warrior', 1 => 'Guardian', 2 => 'Assasin', 3 => 'Hunter', 4 => 'Pagan', 5 => 'Oracle',
		6 => 'Fighter', 7 => 'Defender', 8 => 'Ranger', 9 => 'Archer', 10 => 'Mage', 11 => 'Priest'
	);
	if (isset($_POST['submit'])) {
		if (strlen($login) < 1) {
			echo '<div id="wrapper">';
				echo '<div id="page-wrapper">';
					echo '<div class="container-fluid">';
						echo '<div class="row">';
							echo '<div class="col-lg-12">';
								echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
								echo '<div id="title" class="tac">Um Resurrection: Error</div>';
								echo '<div id="sb_content">';
									echo 'Invalid User Name.';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			die();
		}
		$res = ("SELECT * FROM ".$cfg["Users"]." WHERE UserID = ?");
		$stmt = odbc_prepare($cxn2,$sql);
		$args = array($login);
		$res = odbc_execute($stmt,$args);
		
		if (!odbc_num_rows($stmt)) {
			echo '<div id="wrapper">';
				echo '<div id="page-wrapper">';
					echo '<div class="container-fluid">';
						echo '<div class="row">';
							echo '<div class="col-lg-12">';
								echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
								echo '<div id="title" class="tac">Um Resurrection: Error</div>';
								echo '<div id="sb_content">';
									echo "User ".$login." does not exist";
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			die();
		} else {
			$sql = ("SELECT umg.Country, c.Family, c.CharName, c.CharID, c.Job, c.Level FROM ".$cfg["UMG"]." AS umg
					 INNER JOIN ".$cfg["Chars"]." AS c ON umg.UserUID = c.UserUID
					 WHERE c.UserID=? AND c.Del=?");
			$stmt = odbc_prepare($cxn2,$sql);
			$args = array($login,1);
			$res = odbc_execute($stmt,$args);
			
			if (!odbc_num_rows($stmt)) {
				echo '<div id="wrapper">';
					echo '<div id="page-wrapper">';
						echo '<div class="container-fluid">';
							echo '<div class="row">';
								echo '<div class="col-lg-12">';
									echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
									echo '<div id="title" class="tac">Um Resurrection: Error</div>';
									echo '<div id="sb_content">';
										echo "Account does not contain any dead characters.";
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				die();
			} else {
				echo '<div id="wrapper">';
					echo '<div id="page-wrapper">';
						echo '<div class="container-fluid">';
							echo '<div class="row">';
								echo '<div class="col-lg-12">';
									echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
									echo '<div id="title" class="tac">UM Resurrection: Select Character To Resurrect</div>';
									echo '<div id="sb_content">';
										echo '<form action="" class="acp-form" method="POST">';
											echo '<input type="hidden" name="username" value="'.$login.'">';
											echo '<table class="content-form-table" style="width: 100%;">';
												echo '<tr>';
													echo '<th>Select</th>';
													echo '<th>CharName</th>';
													echo '<th>Class</th>';
													echo '<th>Level</th>';
												echo '</tr>';
										while ($chars = odbc_fetch_array($res2)) {
											if ($chars['Country'] == 0) {
												if ($chars['Family'] == 0 || $chars['Family'] == 1) {
													echo '<tr>';
														echo '<td><input type="radio" name ="char" value="'.$chars['CharName'].','.$chars['CharID'].'"></td>';
														echo '<td>'.$chars['CharName'].'</td>';
														echo '<td>'.$class[$chars['Job'] + 6].'</td>';
														echo '<td>'.$chars['Level'].'</td>';
													echo '</tr>';
												}
											}elseif ($chars['Country'] == 1) {
												if ($chars['Family'] == 2 || $chars['Family'] == 3) {
													echo '<tr>';
														echo '<td><input type="radio" name ="char" value="'.$chars['CharName'].','.$chars['CharID'].'"></td>';
														echo '<td>'.$chars['CharName'].'</td><td>'.$class[$chars['Job']].'</td>';
														echo '<td>'.$chars['Level'].'</td>';
													echo '</tr>';
												}
											}
										}
										echo '</table>';
										echo '<br />';
										echo '<input type="submit" value="Submit" name="submit2" /></form>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}
	} else if (isset($_POST['submit2'])) {
		$toon  = $_POST['char'];
		$login = $_POST['username'];
		$slot  = -1;
		$res1  = odbc_exec($cxn2,
			"SELECT MIN(Slots.Slot) AS OpenSlot FROM
			(SELECT 0 AS Slot UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4) AS Slots
			LEFT JOIN
			(SELECT c.Slot
			FROM ".$cfg["Users"]." AS um
			INNER JOIN ".$cfg["Chars"]." AS c ON c.UserUID = um.UserUID
			WHERE um.UserID = '".$login."'
			AND c.Del = 0) AS Chars ON Chars.Slot = Slots.Slot
			WHERE Chars.Slot IS NULL");
		$slot  = odbc_fetch_array($res1);
		$toon2 = explode(',', $toon);
		if ($slot[0] > -1 && $slot[0] < 5) {
			odbc_exec($cxn2, "UPDATE ".$cfg["Chars"]."
								SET Del=0, Slot='".$slot[0]."', Map=42, PosX=63 , PosZ=57, DeleteDate=NULL,RemainTime=0
								WHERE CharID = '".$toon2[1]."'"
			);
			echo '<div id="wrapper">';
				echo '<div id="page-wrapper">';
					echo '<div class="container-fluid">';
						echo '<div class="row">';
							echo '<div class="col-lg-12">';
								echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
								echo '<div id="title" class="tac">UM Resurrection: Success!</div>';
								echo '<div id="sb_content">';
									echo 'Successfully resurrected <br /> Account = '.$login.'<br />In Slot = '.($slot[0] + 1).'"<br />Character = '.$toon2[0].'';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			createLog("Resurrected Character: ".$toon2[0]."");
		}else{
			echo '<div id="wrapper">';
				echo '<div id="page-wrapper">';
					echo '<div class="container-fluid">';
						echo '<div class="row">';
							echo '<div class="col-lg-12">';
								echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
								echo '<div id="title" class="tac">UM Resurrection: Error!</div>';
								echo '<div id="sb_content">';
									echo 'No slots avaliable.';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			die();
		}
	} else {
		echo '<div id="wrapper">';
			echo '<div id="page-wrapper">';
				echo '<div class="container-fluid">';
					echo '<div class="row">';
						echo '<div class="col-lg-12">';
							echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
							echo '<div id="title" class="tac">UM Resurrection</div>';
							echo '<div id="sb_content">';
								echo '<form action="" class="acp-form" method="POST">';
									echo '<center>';
										echo '<table class="acp-table tac">';
											echo '<tr>';
#												echo '<th>Insert Account UserID:</th>';
												echo '<td><input type="text" placeholder="Account ID" name="login" /></td>';
											echo '</tr>';
										echo '</table>';
										echo '<br />';
										echo '<input type="submit" value="Submit" name="submit" />';
									echo '</center';
								echo '</form>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
	odbc_close($cxn2);
?>