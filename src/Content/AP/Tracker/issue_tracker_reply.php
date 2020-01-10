<?php
	# Vars
	$TicketID=isset($_REQUEST['TicketID']) ? escData(trim($_REQUEST['TicketID'])) : false;
	
	# Post Errors To Array
	$errors = array();

	if(isset($_POST['submit'])){
		$TicketID=escData(htmlentities($_POST['TicketID']));
		$responseAdd=escData(htmlentities($_POST['responseAdd']));
		$sql=("UPDATE ".$cfg["Tickets"]." SET Status=?,ResponderID=?,Response=? WHERE TicketID = ?");
		$stmt = odbc_prepare($cxn1,$sql);
		$args = array(1,$_SESSION["uid"],htmlspecialchars_decode($responseAdd),$TicketID);
		if(!odbc_execute($stmt,$args)){
			$errors[] = "Unable to execute response post.<br />A DB issue has occured.";
		}else{
			$errors[] = "Ticket successfully updated.";
			createLog("Updated Ticket(TicketID: ".$TicketID.")");
		}
		
	}
	elseif(empty($TicketID)){
		$errors[] = "No Ticket ID?!?<br />I need something to work with!!";
	}elseif(isset($TicketID)){
		$sql=("SELECT * FROM ".$cfg["Tickets"]." WHERE TicketID = ?");
		$stmt = odbc_prepare($cxn1,$sql);
		$args = array($TicketID);
		$res = odbc_execute($stmt,$args);
		if(!odbc_num_rows($stmt)){
			$errors[] = "No ticket found for Ticket ID: $TicketID";
		}
	}
	echo '<div id="wrapper">';
		echo '<div id="page-wrapper">';
			echo '<div class="container-fluid">';
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
						echo '<div id="title" class="tac">Issue Tracker - Reply To Ticket: '.$TicketID.'</div>';
						echo '<div id="sb_content">';
							if(count($errors)!=0){
								echo '<div id="dialog-confirm" title="ISSUE TRACKER: MSG">';
									echo '<br />';
									echo '<div id="error-msg">';
										foreach($errors as $error){echo $error;}
									echo '</div>';
								echo '</div>';
							}
							echo '<center>';
								if (!@odbc_num_rows($stmt)) {}
								else{
									echo '<form action="" class="acp-form" method="POST">';
										echo '<div id="label1" class="tal" style="margin-left:10px;">Issue:</div>';
									while ($data = @odbc_fetch_array($stmt)){
										echo '<input type="hidden" name="TicketID" value="'.$data["TicketID"].'">';
										echo '<div id="label2" class="readonly">'.$data["Detail"].'</div>';
									}
										echo '<br />';
										echo '<div id="label1" class="tal" style="margin-left:10px;">Response:</div>';
										echo '<div id="label2"><textarea name="responseAdd" placeholder="Your response. Please be thorough!"></textarea></div>';
										echo '<input type="submit" value="Submit" name="submit" />';
									echo '</form>';
								}
							echo '</center>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>