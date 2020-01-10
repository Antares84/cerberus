<?php
	$errors		=	array();
	@$CharName	=	$this->Data->EscData(trim($_REQUEST['CharName']));

	if(isset($_POST['submit']) || strlen($CharName) > 1){
		if(strlen($CharName) < 1){
			die("Character's name is too short.");
		}

		# T-SQL 1
		$sql_a	=	("
						SELECT *
						FROM ".$this->db->get_TABLE("SH_CHARDATA")."
						WHERE CharName=? AND Del=?
		");
		$stmt_a	=	odbc_prepare($cxn2,$sql_a);
		$args_a	=	array($CharName,0);
		$exec_a	=	odbc_execute($stmt_a,$args_a);

		# T-SQL 2
		$sql_b = odbc_exec($this->db->conn,"UPDATE ".$this->db->get_TABLE("SH_USERDATA")."
											SET Status=0
											WHERE UserUID = (SELECT UserUID FROM ".$this->db->get_TABLE("SH_CHARDATA")."WHERE CharName='".$CharName."' AND Del=0)"
		);
#		$stmt_b = odbc_prepare($cxn2,$sql_b);
#		$args_b = array(0,$CharName,0);
#		$exec_b = odbc_execute($stmt_b,$args_b);
		
		# T_SQL 3
		$sql_c = ("
					DELETE FROM ".$this->db->get_TABLE("SH_BANNED_PLAYERS")."
					WHERE CharName = '".$CharName."'");
		$stmt_c = odbc_prepare($cxn1,$sql_c);
		$args_c = array($CharName);
		$exec_c = odbc_execute($stmt_c,$args_c);

		if($exec_a){
			if(!odbc_num_rows($stmt_a)){
				$errors[]="0x01";
				createLog("Failed Unban: Character Doesn't Exist");
			}
		}elseif(!$sql_b){
			$errors[]="0x02";
			createLog("Failed Unban: Query Error(".$Error[0]["message"].")");
		}elseif ($exec_c){
			$errors[]="0x03";
			echo "<div id=\"title\">Successfully unbanned '".$CharName."'!</div>";
#			createLog("Unbanned '".$CharName."'!");
		}
	}

	$this->Tpl->Titlebar('Un-ban An Account');
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div id="sb_content">';
			if(count($errors)){
				echo '<div id="error">';
					echo '<div id="error-msg">';
					foreach($errors as $error){
						echo err_msg_UA($error);
					}
					echo '</div>';
				echo '</div>';
			}
				echo '<center>';
					echo '<form action="" class="content-form" method="POST">';
						echo '<table>';
							echo '<tr>';
								echo '<td><input type="text" name="CharName" placeholder="Character Name" /></td>';
							echo '</tr>';
						echo '</table>';
						echo '<br />';
						echo '<input type="submit" value="Submit" name="submit" />';
					echo '</form>';
				echo '</center>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>