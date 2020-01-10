<?php
	$UserID	=	isset($_REQUEST["UserID"])	?	trim($this->Data->_do_data('escData',$_REQUEST["UserID"]))	:	false;
	$Status	=	array(0=>"Normal",16=>"(Administrator)",32=>"Game Master",-1=>"Banned");

	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			if(!isset($_POST['submit'])){
				$this->LogSys->createLog('accessed Page('.$this->PAGE_TITLE.')');

				$this->Tpl->TitleBar("Account Search",'w_100_p');
				echo '<div id="sb_content">';
					echo '<div class="separator_10"></div>';
					echo '<form action="" method="POST">';
						echo '<div class="form-group row">';
							echo '<div class="col-sm-5"></div>';
							echo '<div class="col-sm-2">';
								echo '<input autocomplete="off" class="form-control tac" id="Input-UserID" name="UserID" placeholder="Enter Account ID" type="text" >';
							echo '</div>';
						echo '</div>';

						echo '<div class="form-group text-center">';
							echo '<button type="submit" value="submit" name="submit" class="badge badge-pill badge-primary">Search</button>';
						echo '</div>';
						echo '<div class="separator_10"></div>';
					echo '</form>';
				echo '</div>';
			}
			else{
				if(strlen($UserID) < 1){
					die("
						Account name is too short."
					);
				}

				$sql	=	('
								SELECT [C].[CharName],[C].[CharID],[U].[Status]
								FROM '.$this->db->get_TABLE("SH_CHARDATA").' AS [C]
								INNER JOIN '.$this->db->get_TABLE("SH_USERDATA").' AS [U] ON [U].[UserUID] = [C].[UserUID]
								WHERE [U].[UserID] = ?
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($UserID);
				$prep	=	odbc_execute($stmt,$args);

				$this->LogSys->createLog("Searched For Account: ".$UserID);

				if(!odbc_num_rows($stmt)){
					echo 'An account with the UserID "<b>'.$UserID.'</b>" could not be located. Please try again.';
					die();
				}
				else{
					$this->Tpl->TitleBar("Account Search - Results For Account: ".$UserID,"w_100_p");
					echo '<div id="sb_content">';
						$this->ShChar->LOAD_ACCT_CHARS_UID($UserID);
					echo '</div>';
				}
			}
		echo '</div>';
	echo '</div>';
?>