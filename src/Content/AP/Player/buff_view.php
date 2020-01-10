<?php
	$this->LogSys->createLog('accessed Page('.$this->Paging->PAGE_TITLE.')');

	$CharID		=	isset($_REQUEST["CharID"])		?	trim($this->Data->_do_data('escData',$_REQUEST["CharID"]))		:	false;
	$CharName	=	isset($_REQUEST["CharName"])	?	trim($this->Data->_do_data('escData',$_REQUEST["CharName"]))	:	false;

	if(isset($_POST['submit']) || strlen($CharName) > 1){
		if(strlen($CharName) < 1){
			die('
				<div class="row">
					<div class="col-lg-12">
						An invalid character name has been detected.
					</div>
				</div>
			');
		}

		$sql	=	("
						SELECT [C].[CharName],[CS].[Del],[S].[SkillName],[CAS].[LeftResetTime]
						FROM ".$this->db->get_TABLE("SH_CHARDATA")."				AS [C]
						INNER JOIN ".$this->db->get_TABLE("SH_CHARSKILLS")."		AS [CS]		ON [CS].[CharID]	=	[C].[CharID]
						INNER JOIN ".$this->db->get_TABLE("SH_CHARAPPSKILLS")."		AS [CAS]	ON [CAS].[CharID]	=	[C].[CharID]
						INNER JOIN ".$this->db->get_TABLE("SH_SKILLS")."			AS [S]		ON [S].[SkillID]	=	[CS].[SkillID] AND [S].[SkillLevel]	=	[CS].[SkillLevel]
						WHERE [C].[CharID]=? AND [CS].[Del]=?
		");
		$stmt	=	odbc_prepare($this->db->conn,$sql);
		$args	=	array($CharID,0);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			if(!odbc_num_rows($stmt)){
				$this->Tpl->TitleBar('View Applied Buffs On Character: Error!','w_100_p');
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
							echo '<div id="sb_content" class="tac">';
								echo 'No buffs/skills found for <b>'.$CharName.'</b>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				die();
			}
			else{
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						$this->Tpl->TitleBar('Current Buff(s) Activated On: '.$CharName,'w_100_p');
						echo '<div id="sb_content">';
#							echo '<center>';
							echo '<div class="table-responsive">';
								echo '<table class="table table-sm table-bordered table-inverse acp_table text-center">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Character Name</th>';
											echo '<th>Buff Name</th>';
											echo '<th>Time Left (Seconds)</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									while($data = odbc_fetch_array($stmt)){
										echo "<tr>";
											echo "<td>".$data['CharName']."</td>";
											echo "<td>".$data['SkillName']."</td>";
											echo "<td>".$data['LeftResetTime']."</td>";
										echo "</tr>";
									}
									echo '</tbody>';
								echo "</table>";
							echo '</div>';
#							echo '</center>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				$this->LogSys->createLog("Viewed Player's Buffs(Player: ".$CharName.")");
			}
		}
	}
	else{
		echo '<div id="wrapper">';
			echo '<div id="page-wrapper">';
				echo '<div class="container-fluid">';
					echo '<div class="row">';
						echo '<div class="col-lg-12">';
							echo '<div id="title" class="tac">View Applied Buffs On Character</div>';
							echo '<div id="sb_content">';
								echo '<center>';
									echo '<form action="" class="acp-form" method="POST">';
										echo '<table class="acp-table">';
											echo '<tr>';
												echo '<td class="tar">Character Name:</td>';
												echo '<td style="text-align:left;"><input type="text" name="char" /></td>';
											echo '</tr>';
										echo '</table>';
										echo '<br />';
										echo '<input type="submit" value="Submit" name="submit" />';
									echo '</form>';
								echo '</center>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
?>