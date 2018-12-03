<?php
	$StoryID	=	isset($_POST['StoryID'])	?	$this->Data->escData(trim($_POST['StoryID']))	:	"";

	$sql		=	('SELECT TOP 1 * FROM '.$this->db->get_TABLE("STORIES").' WHERE StoryID=?');
	$stmt		=	odbc_prepare($this->db->conn,$sql);
	$args		=	array($StoryID);
	$prep		=	odbc_execute($stmt,$args);

	echo '<div class="label label-default tac f16" style="width:100%;">Story Time</span></div>';
	echo '<div class="separator_10"></div>';
	if($StoryID == null){
		echo '<div class="col-md-12">';
			echo '<div class="row tar">';
				echo '<button class="btn btn-sm btn-success mr_10" id="isSearch">Story Search</button>';
				echo '<button class="btn btn-sm btn-success" id="isStory">Create New Story</button>';
			echo '</div>'; // end row
			echo '<div class="separator_5"></div>';

			echo '<div class="row hide" id="isSearchable">';
				echo '<div class="separator_10"></div>';
				echo '<div class="card no_bg no_border no_radius">';
					echo '<div class="card-header card_border tac title no_border no_radius">Search For A Story</div>';
					echo '<div class="card-block card_border content_bg content no_radius pContent">';
						echo '<div class="card-text">';
							echo '<form action="" method="post">';
								echo '<div class="form-group">';
									echo '<input type="text" class="form-control tac" id="StoryID" name="StoryID" placeholder="Story Key" />';
								echo '</div>';

								echo '<div class="form-group tac">';
									echo '<button type="submit" value="submit" name="submit" class="btn btn-primary m_auto">Submit</button>';
								echo '</div>';
							echo '</form>';
						echo '</div>';
					echo '</div>'; // end row
				echo '</div>';
			echo '</div>';

			echo '<div class="row hide" id="isStoryCreate">';
				echo '<div class="separator_10"></div>';
				echo '<div class="card no_bg no_border no_radius">';
					echo '<div class="card-header card_border tac title no_border no_radius">Create A New Story</div>';
					echo '<div class="card-block card_border content_bg content no_radius pContent">';
						echo '<div class="card-text">';
							echo '<form id="New_Entry">';
							//	echo '<input type="text" class="form-control" id="input-MemberID" name="MemberID" placeholder="Entry Title" />';
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
			echo '</div>'; // end row
		echo '</div>';
	}
	else{
		echo '<div class="card no_bg no_border no_radius">';
			echo '<div class="card-header card_border tac title pTitle show no_radius">Story Search - Results</div>';
			echo '<div class="card-block card_border content_bg content no_radius">';
				echo '<div class="card-text">';
				if($prep){
					if(odbc_num_rows($stmt) > 0){
						while($row = odbc_fetch_array($stmt)){
							$this->PAGE_CARD($row['Title'],$row['Detail'],"");
						}
					}else{
						echo 'Doesn\'t look like there\'s a story with that key yet. What are you waiting for?';
					}
				}
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
?>