<?php
	$this->User->get_Auth();

	$EntryID	=	isset($_GET['EntryID'])	?	$this->Data->escData(trim($_GET['EntryID']))	:	false;

	if($EntryID){
		$sql		=	("SELECT TOP 1 * FROM ".$this->db->get_TABLE("JOURNAL")." WHERE MemberID=? AND RowID=?");
		$stmt		=	odbc_prepare($this->db->conn,$sql);
		$args		=	array($this->User->MemberID,$EntryID);
		$prep		=	odbc_execute($stmt,$args);
	}

	echo '<div class="badge badge-secondary tac f16" style="width:100%;">Welcome To Your Journal, <span class="b_i">'.$this->User->DisplayName.'</span></div>';
	echo '<div class="separator_10"></div>';
	if(!$EntryID){
		echo '<div class="card no_bg no_border no_radius">';
			echo '<div class="card-block card_border content_bg content no_radius">';
				echo '<div class="card-text">';
					echo '<div class="tar">';
						echo '<button class="btn btn-sm btn-success mr_10" id="isJournalCreate">Create A New Entry</button>';
						echo '<button class="btn btn-sm btn-success" id="isJournalOpen">View Entries</button>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		echo '<div class="separator_10"></div>';

		echo '<div class="hide" id="isJournalCreating">';
			echo '<div class="card no_bg no_border no_radius">';
				echo '<div class="card-block card_border content_bg content no_radius">';
					echo '<div class="card-text">';
						echo '<div class="separator_10"></div>';
						echo '<form id="New_Entry">';
							echo '<div class="form-group">';
								echo '<input type="text" class="form-control" id="input-Title" name="Title" placeholder="Entry Title" />';
							echo '</div>';

							echo '<div class="form-group">';
								echo '<div class="mce_standard_textbox"></div>';
							echo '</div>';

							echo '<div class="separator_10"></div>';
							echo '<div class="form-group tac">';
								echo '<button class="btn btn-sm btn-primary open_journal_modal" data-id="" data-target="#journal_modal" data-toggle="modal"><i class="fa fa-pencil"></i> Save</button>';
							echo '</div>';
						echo '</form>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="hide" id="isJournalOpened">';
				$this->SQL->get_sql_partnerid_search();
		echo '</div>';
	}
	else{
		if($prep){
			if(odbc_num_rows($stmt) > 0){
				while($data = odbc_fetch_array($stmt)){
					$this->PAGE_CARD($data['Title'],$data['Detail'],"");
				}
			}
			else{
				echo '<div class="card no_bg no_border no_radius">';
					echo '<div class="card-header card_border tac title pTitle show no_radius">';
						echo 'Uh oh, I wasn\'t able to find the entry that you requested. How unfortunate...';
					echo '</div>';
				echo '</div>';
			}
		}
	}

	$this->Modal->Display($this->PAGE_ZONE,'journal_modal','<i class="fa fa-pencil"></i>','0','2','Save Entry');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_journal_modal',function(e){
			e.preventDefault();

			$('#journal_modal #dynamic-content').html('');
			$('#journal_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->JQUERY_ADDONS_DIR;?>ajax/journal/journal.php",
				type: 'POST',
				data: $('#New_Entry').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
					console.log(data);
				<?php } ?>
				$('#journal_modal #dynamic-content').html('');
				$('#journal_modal #dynamic-content').html(data);
				$('#journal_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#journal_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#journal_modal #modal-loader').hide();
			});
		});
	});
</script>