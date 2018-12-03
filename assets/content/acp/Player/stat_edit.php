<?php
	$CharName	=	isset($_REQUEST['CharName'])	?	$this->Data->escData(trim($_REQUEST['CharName'])) : false;
	$count = 0;

	# ARRAYS
	$Columns=array('CharName','Grow','Hair','Face','Size','Job','Sex','Level','StatPoint','SkillPoint','Str','Dex','Rec','Int','Luc','Wis','Map','Dir','Exp','Money','PosX','PosY','Posz','K1','K2','K3','K4','KillLevel','DeadLevel','OldCharName');
	$greyed  = array('UserID','UserUID','CharID','Slot','Level','StatPoint','SkillPoint','Str','Dex','Rec','Int','Luc','Wis','K1','K2','K3','K4','KillLevel','DeadLevel');

	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			if(isset($_POST['submit']) || strlen($CharName) > 1){
				if(strlen($CharName) < 1){
					echo '<div id="title" class="tac">Player Stat Editor - Error</div>';
					echo '<div id="sb_content">';
						echo 'Invalid Char Name.';
					echo '</div>';
					die();
				}

				$sql	=	('
								SELECT *
								FROM '.$this->db->get_TABLE("SH_CHARDATA").'
								WHERE CharName=?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($CharName);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					if(odbc_num_rows($stmt) == 0){
						echo '<div id="title" class="tac">Player Stat Editor - Error</div>';
						echo '<div id="sb_content">';
							echo 'User '.$CharName.' does not exist.';
						echo '</div>';
						die();
					}
					else{
						$Info	=	odbc_fetch_array($stmt);
						$this->Tpl->TitleBar("Account Search - Results For Account: Current Status Of Character: ".$CharName);
						
						echo '<form action="" method="POST" class="acp-form">';
							echo '<div class="table-responsive">';
								echo '<table class="table table-sm table-bordered table-inverse acp_table">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>Name</th>';
											echo '<th>Value</th>';
											echo '<th>Action_1</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									foreach($Columns as $Value){
										echo '<tr>';
											echo '<td class="m_t_5">'.$Value.'</td>';
											if(in_array($Value,$greyed)){
												echo '<td><input type="text" readonly="readonly" class="form-control form-control-sm" name="'.$Value.'" value="'.$Info[$Value].'" /></td>';
											}
											else{
												echo '<td><input type="text"  class="form-control form-control-sm" name="'.$Value.'" value="'.$Info[$Value].'" /></td>';
											}
											if(!in_array($Value,$greyed)){
												echo '<td class="text-center"><a class="badge badge-warning m_t_5" href="#">Action_1</a></td>';
											}
											else{
												echo '<td></td>';
											}
										echo '</tr>';
										$count++;
									}
									echo '</tbody>';
								echo '</table>';
							echo '</div>';
						echo '</form>';
					}
				}
			}
			elseif(isset($_POST['submit2']) && !empty($_POST['submit2'])){
				$CharName	=	isset($_POST['CharID'])	?	$this->Data->escData(trim($_POST['CharID'])) : false;
				$Report		=	"";

				echo "Results updated successfully. <br>";
				foreach($Columns as $Value){
					odbc_exec($this->db->conn,"UPDATE ".$this->db->get_TABLE("SH_CHARDATA")." SET ".$Value."='".$_REQUEST[$Value]."' WHERE CharID=".$CharID."");
				}
				foreach($_POST as $Name=>$Value){
					if($Name !="submit2"){
						echo $Name.'='.$Value.'<br>';
						$Report.=$Name."=>".$Value.";";
					}
				}
			}
			else{
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						$this->Tpl->TitleBar("badge-secondary","Player Stat Editor");
						echo '<div id="sb_content">';
							echo '<form action="" method="POST" class="acp-form">';
								echo '<center>';
									echo '<table class="acp-table">';
										echo '<tr>';
											echo '<td class="tac"><input type="text" name="CharName" placeholder="Enter Character Name"/></td>';
										echo '</tr>';
									echo '</table>';
									echo '<br />';
									echo '<input type="submit" value="Submit" name="submit" />';
								echo '</center>';
							echo '</form>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		echo '</div>';
	echo '</div>';
?>