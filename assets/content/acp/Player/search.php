<?php
	$CharID		=	isset($_REQUEST['CharID'])		?	$this->Data->escData(trim($_REQUEST['CharID']))		:	false;
	$CharName	=	isset($_REQUEST['CharName'])	?	$this->Data->escData(trim($_REQUEST['CharName']))	:	false;

	echo '<div class="row">';
		echo '<div class="col-lg-12">';
		if(!empty($CharName)){
			$this->LogSys->createLog("Searched for: ".$CharName);
			$this->ShChar->SEARCH_PLAYER($CharID,$CharName);
		}
		else{
			$this->Tpl->TitleBar("Player Search");
			echo '<div id="sb_content">';
				echo '<div class="separator_10"></div>';
				echo '<form action="" method="POST">';
					echo '<div class="form-group row">';
						echo '<div class="col-sm-5"></div>';
						echo '<div class="col-sm-2">';
							echo '<input autocomplete="off" class="form-control tac" id="Input-CharName" name="CharName" placeholder="Enter Character Name" type="text" >';
						echo '</div>';
					echo '</div>';

					echo '<div class="form-group text-center">';
						echo '<button type="submit" value="submit" name="submit" class="badge badge-pill badge-primary">Search</button>';
					echo '</div>';
					echo '<div class="separator_10"></div>';
				echo '</form>';
			echo '</div>';
		}
		echo '</div>';
	echo '</div>';
?>