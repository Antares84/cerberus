<?php
	$this->User->Auth();
	$this->LogSys->createLog("Viewed Access Log");

	$count	=	1;
	$Where	=	"";
	$User	=	"";
	$Cat	=	"";

	$this->Tpl->Titlebar('Admin Panel Access Logs');
	echo '<div class="row ap_content">';
		echo '<div class="col-lg-12">';
			echo '<div id="sb_content" class="tac">';
				echo '<form action="?'.$this->Setting->PAGE_PREFIX.'=STF_PNL_LOG&value='.$Cat.'" method="POST">';
					echo '<div class="form-group row">';
						echo '<div class="col-sm-4"></div>';

						echo '<div class="col-sm-2">';
							echo '<div class="input-group">';
								echo '<div class="input-group-addon"><i class="fa fa-info-circle"></i></div>';
								echo '<input class="form-control" id="User" name="User" type="text" value="User ID"/>';
							echo '</div>';
						echo '</div>';

						echo '<div class="col-sm-2">';
							echo '<div class="input-group">';
								echo '<div class="input-group-addon"><i class="fa fa-eye"></i></div>';
								echo '<select class="form-control" id="page_show_select" name="Category">';
									echo '<option disabled selected>Category*</option>';
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
							echo '</div>';
						echo '</div>';
					echo '</div>';

					echo '<button type="submit" class="btn btn-warning"><i class="fa fa-search"></i> Search</button>';

				echo '</form>';
			echo '</div>';
		echo '</div>';
	echo '</div>';

	if(isset($_POST['submit'])){
		if(isset($_POST['Category'])){
			$Cat	=	$this->Data->escData($_POST['Category']);

			switch($Cat){
				case "all": break;
				case "ban": $Where .= "WHERE Action LIKE 'Banned Character: %' OR Action LIKE 'Failed Ban On %' "; break;
				case "unban": $Where .= "WHERE Action LIKE '%Unban%' "; break;
				case "vpl": $Where .= "WHERE Action = 'Viewed Panel Log' "; break;
				case "vou": $Where .= "WHERE Action = 'Viewed Online Log' "; break;
				case "vbu": $Where .= "WHERE Action = 'Viewed Banned Log' "; break;
				case "vgl": $Where .= "WHERE Action = 'Viewed GS Staff List' "; break;
				case "vprr": $Where .= "WHERE Action = 'Viewed Page Rank Requirements' "; break;
				case "fc": $Where .= "WHERE Action LIKE 'Faction Change: %' "; break;
				case "login": $Where .= "WHERE Action LIKE '%Login%' "; break;
				case "logout": $Where .= "WHERE Action = 'User logged out.' "; break;
				case "mc": $Where .= "WHERE Action LIKE 'Modified Character: %' "; break;
				case "sfc": $Where .= "WHERE Action LIKE 'Searched For Character: %' "; break;
				case "sfa": $Where .= "WHERE Action LIKE 'Searched For Account: %' "; break;
				case "sfg": $Where .= "WHERE Action LIKE 'Searched For Guild: %' "; break;
				case "glc": $Where .= "WHERE Action LIKE 'Guild Leader Changed: %' "; break;
				case "cr": $Where .= "WHERE Action LIKE 'Resurrected Character: %' "; break;
				case "ga": $Where .= "WHERE Action LIKE 'Gave 25k AP to: %' "; break;
				case "vpb": $Where .= "WHERE Action LIKE 'Viewed Player''s Buffs(Player: %)' "; break;
				case "vel": $Where .= "WHERE Action LIKE 'Viewed Equipped Item Links (Player: %)' "; break;
				default: break;
			}
		}

		if(isset($_POST['User']) && $_POST['User']!==""){
			$User=$this->Data->escData(trim($_POST['User']));
			if($Where===""){$Where="WHERE UserID=".$User."";}
			elseif($Where==="Action LIKE 'Banned Character: %' OR Action LIKE 'Failed Ban On %' "){
				$Where="Action LIKE 'Banned Character: %' AND UserID = ".$User." OR Action LIKE 'Failed Ban On %' AND UserID=".$User."";
			}else{
				$Where.="AND UserID=?";
			}
		}
		if($User===""){
			$res=odbc_exec($this->db->conn,"SELECT * FROM ".$this->db->get_TABLE("LOG_ACCESS")." ".$Where." ORDER BY ActionTime DESC");
		}else{
			$res=odbc_exec($this->db->conn,"SELECT * FROM ".$this->db->get_TABLE("LOG_ACCESS")." ".$Where." ORDER BY ActionTime DESC");
		}
		if($res === false){
			echo 'An error has occured.';
			die();
		}
	}else{
		$res = odbc_exec($this->db->conn, "SELECT TOP 50 * FROM ".$this->db->get_TABLE("LOG_ACCESS")." ORDER BY ActionTime DESC");
	}
	if(!odbc_fetch_array($res)){
		echo '<div id="sb_content">';
			echo 'Nothing in the logs!';
		echo '</div>';
		die();
	}else{
		echo '<div id="sb_content">';
			echo '<div class="table-responsive">';
				echo '<table id="mytable" class="table table-sm acp_table tac">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>#</th>';
							echo '<th>UserID</th>';
							echo '<th>UserIP</th>';
							echo '<th>Action</th>';
							echo '<th>Action Time</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					while($row = odbc_fetch_array($res)){
						echo '<tr>';
							echo '<td>'.$count.'</td>';
							echo '<td>'.$row['UserID'].'</td>';
							echo '<td>'.$row['UserIP'].'</td>';
							echo '<td>'.$row['Action'].'</td>';
							echo '<td>'.date("m/d/y H:i A", strtotime($row["ActionTime"])).'</td>';
						echo '</tr>';
						$count++;
					}
					echo '</tbody>';
				echo '</table>';
			echo '</div>';
		echo '</div>';
	}
?>