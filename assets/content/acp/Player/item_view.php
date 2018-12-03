<?php
	$this->LogSys->createLog('accessed Page('.$this->Paging->PAGE_TITLE.')');

	$CharID		=	isset($_REQUEST['CharID'])		?	$this->Data->escData(trim($_REQUEST['CharID']))		:	false;
	$CharName	=	isset($_REQUEST['CharName'])	?	$this->Data->escData(trim($_REQUEST['CharName']))	:	false;

	$count		=	0;

	if(isset($_POST['submit']) || strlen($CharName) > 1){
		if(strlen($CharName) < 1){
			echo '<div class="row">';
				echo '<div class="col-lg-12">';
					echo "Invalid Character Name. Please try again.";
				echo '</div>';
			echo '</div>';
			die();
		}

		$SH_CHARITEMS	=	new ShaiyaCharItems($this->db,$CharID);

		if(!$SH_CHARITEMS->readItems($this->Setting->DEBUG)){
			$this->Tpl->Titlebar('View Player\'s Equipped Items: '.$CharName);
			echo '<div class="row">';
				echo '<div class="col-lg-12">';
					echo '<div id="sb_content" class="tac">';
						echo '<b>'.$CharName.'</b> does not have any items to display.';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			die();
		}
		else{
			$this->Tpl->Titlebar('Current Links In Equipped Gear Of: '.$CharName);
			echo '<div class="row">';
				echo '<div class="col-lg-12">';
					echo '<div id="sb_content">';
						$SH_CHARITEMS->getLapis($this->Setting->DEBUG);
						$retObj	=	$SH_CHARITEMS->readItems($this->Setting->DEBUG);
						echo '<div class="table-responsive">';
							echo '<table class="table table-bordered table-striped acp_table tac">';
								echo '<thead>';
									echo '<tr>';
										echo '<th>ItemName</th>';
										echo '<th>ItemID</th>';
										echo '<th>Bag</th>';
										echo '<th>Slot</th>';
										echo '<th>Quantity</th>';
#										echo '<th></th>';
#										echo '<th>ItemUID</th>';
										echo '<th>Lapis Slot 1</th>';
										echo '<th>Lapis Slot 2</th>';
										echo '<th>Lapis Slot 3</th>';
										echo '<th>Lapis Slot 4</th>';
										echo '<th>Lapis Slot 5</th>';
										echo '<th>Lapis Slot 6</th>';
									echo '</tr>';
								echo '</thead>';
								echo '<tbody>';
								for($i=0;$i<count($retObj);$i++){
									echo '<tr>';
										echo '<td>'.$retObj[$i]["ItemName"].'</td>';
										echo '<td>'.$retObj[$i]["ItemID"].'</td>';
										echo '<td>'.$retObj[$i]["Bag"].'</td>';
										echo '<td>'.$retObj[$i]["Slot"].'</td>';
										echo '<td>'.$retObj[$i]["Count"].'</td>';
#										echo '<td>'.$retObj[$i]["ItemUID"].'</td>';
										echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis1"]].'</td>';
										echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis2"]].'</td>';
										echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis3"]].'</td>';
										echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis4"]].'</td>';
										echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis5"]].'</td>';
										echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis6"]].'</td>';
									echo '</tr>';
								}
								echo '</tbody>';
							echo '</table>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		$this->LogSys->createLog("Viewed Equipped Item Links (Player: ".$CharName.")");
	}
	else{
		$this->Tpl->Titlebar('View Gear Links of Character');
		echo '<div class="row">';
			echo '<div class="col-lg-12">';
				echo '<div id="sb_content">';
					echo '<form action="" class="content-form" method="POST">';
						echo '<input type="text" name="char" placeholder="Character Name"/>';
						echo '<br /><br />';
						echo '<input type="submit" value="Submit" name="submit" />';
					echo '</form>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
?>