<?php
	$CharName	=	isset($_POST['CharName'])	?	$this->Data->escData(trim(htmlentities($_POST['CharName'])))	:	"";
	$Reason		=	isset($_POST['Reason'])		?	$this->Data->escData(trim(htmlentities($_POST['Reason'])))		:	"";
	$Len		=	isset($_POST['Length'])		?	$this->Data->escData(trim($_POST['Length']))					:	"";
	$Length		=	array("12hr"=>1,"5days"=>4,"2weeks"=>13,"perma"=>0);

	if(isset($_POST['submit'])){
		if(strlen($Reason) < 1){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x01';
			$errors[]="0x01";
		}elseif(strlen($CharName) < 1){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x01';
			$errors[]="0x02";
		}

		if(!array_key_exists($Len,$Length)){
			$Len = "perma";
		}

		# Check if Character Exists
		$sql	=	("SELECT UserUID FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE CharName=? AND Del=?");
		$stmt	=	odbc_prepare($this->db->conn,$sql);
		$args	=	array($CharName,0);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			if(!odbc_num_rows($stmt)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x01';
				$errors[]="0x03";
				$this->LogSys->createLog("Failed Ban On ".$CharName.": Doesn't Exist");
			}else{
				while($row = odbc_fetch_array($stmt)){
					$c_UserUID = $row["UserUID"];
				}
			}
		}

		# Check If Character Is Already Banned
		$sql	=	("SELECT * FROM ".$this->db->get_TABLE("BANNED_PLAYERS")." WHERE CharName=?");
		$stmt	=	odbc_prepare($this->db->conn,$sql);
		$args	=	array($CharName);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			if(odbc_num_rows($stmt)){
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x01';
				$errors[]="0x04";
				$this->LogSys->createLog("Failed Ban On ".$CharName.": Already Banned.");
			}
		}

		# Ban Selected Character
		$sql3	=	("
						UPDATE ".$this->db->get_TABLE("SH_USERDATA")."
						SET Status=?
						WHERE UserUID = (SELECT UserUID FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE CharName=? AND Del=?)
		");
		$stmt	=	odbc_prepare($this->db->conn,$sql);
		$args	=	array(-5,$CharName,0);
		$prep	=	odbc_execute($stmt,$args);

		if(!$prep){
			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x01';
			$errors[]="0x05";
			$this->LogSys->createLog("Failed Ban On ".$CharName.": Query Error(".$error[0]['message'].")");
		}else{
			# Insert into Banned Log
			$sql	=	("INSERT INTO ".$this->db->get_TABLE("BANNED_PLAYERS")."
							(CharName,Reason,BannedBy,Duration,UserUID)
						VALUES
							(?,?,?,?,?)
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($CharName,$Reason,$_SESSION["UUID"],$Length[$Len],$c_UserUID);
			odbc_execute($stmt,$args);

			$_SESSION["MESSAGES"]["type"][].='0';
			$_SESSION["MESSAGES"]["body"][].='R-0x01';
			$errors[]="0x06";
			$this->LogSys->createLog("Banned Character: ".$CharName);
		}
	}

	# Content
		$this->Tpl->Titlebar('Account Ban');
		echo '<div class="row">';
			echo '<div class="col-md-12">';
				echo $this->Tpl->Separator("10");
				echo '<form action="" method="POST">';
					echo '<div class="form-group">';
						echo '<div class="col-md-4">';
							echo '<input autocomplete="off" class="form-control" id="Input-CharName" name="CharName" placeholder="Character Name" type="text">';
						echo '</div>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<div class="col-md-12">';
							echo '<textarea class="form-control" id="Input-Reason" name="Reason" cols="50" rows="10" placeholder="Have someone to ban? Please enter a full description to help aid admin with this issue."></textarea>';
						echo '</div>';
					echo '</div>';

					echo '<div class="form-group">';
						echo '<div class="col-sm-3">';
							$this->Select->AcctBan();
						echo '</div>';
					echo '</div>';

					echo '<div class="tac">';
						echo '<button class="badge badge-warning f16 open_acct_ban_modal" data-target="#acct_ban_modal" data-toggle="modal">Submit Report</button>';
					echo '</div>';
				echo '</form>';
			echo '</div>';
		echo '</div>';

		$this->Modal->Display($this->PageZone,'acct_ban_modal','<i class="fa fa-pencil"></i>','0','2','Ban Account');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_acct_ban_modal',function(e){
			e.preventDefault();

			$('#acct_ban_modal #dynamic-content').html('');
			$('#acct_ban_modal #modal-loader').show();

			$.ajax({
				url: "ajax/acp/sh_acct/acct_ban.php",
				type: 'POST',
				data: $('form').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
					console.log(data);
				<?php } ?>
				$('#acct_ban_modal #dynamic-content').html('');
				$('#acct_ban_modal #dynamic-content').html(data);
				$('#acct_ban_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#acct_ban_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#acct_ban_modal #modal-loader').hide();
			});
		});
	});
</script>