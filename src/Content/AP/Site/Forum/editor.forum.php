<?php
	if(isset($_POST['submit'])){
		if(isset($MSNGR["MESSAGES"])){
			unset($MSNGR["MESSAGES"]);
			$MSNGR["MESSAGES"] = $this->Messenger->Init_Messenger();
		}
		elseif(!isset($MSNGR["MESSAGES"])){
			$MSNGR["MESSAGES"] = $this->Messenger->Init_Messenger();
		}

		$titleAdd	=	isset($_POST['titleAdd'])	?	$this->Data->escData(trim(htmlentities($_POST['titleAdd'])))	:	"";
		$detailAdd	=	isset($_POST['detailAdd'])	?	$this->Data->escData(trim(htmlentities($_POST['detailAdd'])))	:	"";

		if(empty($titleAdd) || empty($detailAdd)){
			$MSNGR["MESSAGES"]["type"][].='0';
			$MSNGR["MESSAGES"]["body"][].='R-0x01';
		}
		if(empty($errors)){
			$sql	=	("INSERT INTO ".$cfg["HomePage"]."(title,detail) VALUES(?,?)");
			$stmt	=	odbc_prepare($cxn1,$sql);
			$args	=	array($titleAdd,$detailAdd);
			$res	=	odbc_execute($stmt,$args);
			
			if($prep){
				$MSNGR["MESSAGES"]["type"][].='0';
				$MSNGR["MESSAGES"]["body"][].='R-0x01';
				$postSuccess='<strong>SUCCESS:</strong> News has been posted!';
			}
		}
	}
	if(isset($_POST['deleteBtn'])){
		$deletes=$_POST['deleteCheck'];
		foreach($deletes as $delete){
			$sql=("DELETE FROM ".$cfg["HomePage"]." WHERE RowID=?");
			$stmt=odbc_prepare($cxn1,$sql);
			$args=array($delete);
			$res=odbc_execute($stmt,$args);

			if($prep){
				$MSNGR["MESSAGES"]["type"][].='0';
				$MSNGR["MESSAGES"]["body"][].='R-0x01';
				$deleteSuccess = '<strong>SUCCESS:</strong> News Has Been Removed!';
			}
		}
	}

	# CONTENT
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div class="label label-default b_i f20" style="width:100%;">Resource Center Content Control</div>';
			echo '<div id="sb_content">';
				echo '<div id="tabs">';
					echo '<ul>';
						echo '<li><a href="#tabs-1">Post Content</a></li>';
						echo '<li><a href="#tabs-2">Delete Content</a></li>';
					echo '</ul>';
					echo '<div id="tabs-1">';
						echo '<div class="separator_10"></div>';
						echo '<div class="col-lg-12">';
							echo '<form action="" method="post" id="forum_post">';
								echo '<input type="hidden" id="MemberID" name="MemberID" value="'.$this->User->MemberID.'" />';
								echo '<div class="form-group">';
									echo '<input type="text" class="form-control" id="titleAdd" name="titleAdd" placeholder="Title" />';
								echo '</div>';

								echo '<div class="form-group">';
									echo '<div class="mce_standard_textbox"></div>';
								echo '</div>';

								echo '<div class="form-group tac">';
									echo '<button class="btn btn-sm btn-primary open_forum_modal m_auto" data-target="#forum_modal" data-toggle="modal"><i class="fa fa-comments"></i> Submit</button>';
								echo '</div>';
							echo '</form>';
						echo '</div>';
					echo '</div>';

					echo '<div id="tabs-2">';
						echo '<form action="" class="acp-form" method="POST">';
							echo '<table class="acp-table tac">';
								echo '<tr>';
									echo '<th width="5%"><input type="checkbox" disabled="disabled" /></th>';
									echo '<th width="5%">Post ID</th>';
									echo '<th width="15%">Post Title</th>';
									echo '<th>Post Details</th>';
									echo '<th width="12%">Post Date</th>';
								echo '</tr>';

								$sql	=	odbc_exec($this->db->conn,'SELECT * FROM '.$this->db->get_TABLE("FORUM").' ORDER BY TopicID ASC');
								while($show = odbc_fetch_array($sql)){
									echo '<tr>';
										echo '<td><input type="checkbox" name="deleteCheck[]" value="'.$show['TopicID'].'"/></td>';
										echo '<td>'.$this->Data->escData(htmlentities($show["TopicID"])).'</td>';
										echo '<td>'.$this->Data->escData(htmlentities($show["TopicTitle"])).'</td>';
										echo '<td>'.$this->Data->escData(htmlspecialchars_decode(htmlentities($show["TopicBody"]))).'</td>';
										echo '<td>'.$this->Data->escData(htmlentities(date("m/d/y h:i A", strtotime($show["TopicDate"])))).'</td>';
									echo '</tr>';
								}
							echo '</table>';
							echo '<br>';
							echo '<div style="text-align:right;">';
								echo '<input type="submit" value="Delete Selected News" name="deleteBtn" />';
							echo '</div>';
						echo '</form>';
					echo '</div>';
				echo '</div>'; # end of tabs
			echo '</div>';
		echo '</div>';
	echo '</div>';

	echo $this->ds_modal('','forum_modal','<i class="fa fa-comments"></i>','Post Topic');
?>
<script>
	// Post Modal
	$(document).ready(function(){
		$(document).on('click','.open_forum_modal',function(e){
			<?php if($this->Setting->DEBUG === 2){ ?>
				console.log('Forum modal opened.');
			<?php } ?>
			e.preventDefault();

//			var uid = $(this).data('id');

			$('#forum_modal #dynamic-content').html('');
			$('#forum_modal #modal-loader').show();

			$.ajax({
				url: 'ajax/site/Forum/forum_post.php',
				type: 'POST',
				data: $('form#forum_post').serialize(),
//				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === 2){ ?>
					console.log(data);
				<?php } ?>
				$('#forum_modal #dynamic-content').html('');
				$('#forum_modal #dynamic-content').html(data);
				$('#forum_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#forum_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#forum_modal #modal-loader').hide();
			});
		});
	});
</script>