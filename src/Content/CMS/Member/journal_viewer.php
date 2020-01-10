<?php
	echo '<div class="card no_bg no_border no_radius">';
		echo '<div class="card-header card_border tac title pTitle show no_radius">Welcome To Your Journal, <span class="b_i">'.$_SESSION["UID"].'</div>';
		echo '<div class="card-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
				echo '<div class="row tar isCreate">';
					echo '<input type="submit" value="Add New Journal Entry" class="btn btn-sm btn-success"/>';
				echo '</div>';

				echo '<div class="row isMessage hide">';
					echo '<div class="separator_10"></div>';
					echo '<form id="New_Entry">';
						echo '<div class="form-group">';
							echo '<input type="text" class="form-control" id="entry_title" name="Title" placeholder="Entry Title" />';
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

	echo '<div class="card no_bg no_border no_radius">';
		echo '<div class="card-header card_border tac title pTitle show no_radius">Current Entries</div>';
		echo '<div class="card-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
				$sql	=	("SELECT * FROM ".$this->db->get_TABLE("JOURNAL")." ORDER BY RowID ASC");
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array();
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					if(odbc_num_rows($stmt) > 0){
						while($row = odbc_fetch_array($stmt)){
							$this->PAGE_CARD($row['Title'],$row['Detail'],"");
						}
					}else{
						echo 'Doesn\'t look like you\'ve added any entries yet. What are you waiting for?';
					}
				}
			echo '</div>';
		echo '</div>';
	echo '</div>';

	$this->Modal->Display($this->PAGE_ZONE,'journal_modal','<i class="fa fa-pencil"></i>','0','2','Save Entry');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_journal_modal',function(e){
			e.preventDefault();

			$('#journal_modal #dynamic-content').html('');
			$('#journal_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->JQUERY_ADDONS_DIR;?>ajax/journal/ajax_journal.php",
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