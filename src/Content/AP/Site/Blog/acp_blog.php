<?php
	$this->LogSys->createLog("accessed Page(Blog Editor)");

	# Variables
	$_SESSION['topic_id']	=	$this->Data->gen_blog_post_id(16);
	$ex_topic_id			=	isset($_REQUEST['topic_id'])	?	$this->Data->escData(trim($_REQUEST['topic_id']))	:	false;

	# CONTENT
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<h1 class="page-header">'.$this->PageTitle;if(!empty($this->PageSub)){echo '<small> - '.$this->PageSub.'</small>';}echo '</h1>';
			echo '<ol class="breadcrumb">';
				echo '<li><i class="fa fa-dashboard"></i> <a href="?'.$this->Setting->PAGE_PREFIX.'=Dashboard">Dashboard</a></li>';
				echo '<li class="active"><i class="fa fa-dashboard"></i> <a href="#">'.$this->PageTitle.'</a></li>';
			echo '</ol>';
		echo '</div>';
	echo '</div>';

		echo '<div class="row">';
			echo '<div class="col-lg-12">';
				echo '<div id="title" class="tac">Blog Content Control</div>';
				echo '<div id="tabs">';
					echo '<ul>';
						echo '<li><a href="#tabs-1">Create New Topic</a></li>';
						echo '<li><a href="#tabs-2">Current Topics</a></li>';
					echo '</ul>';

					# Tab 1
					echo '<div id="tabs-1" class="PageLoader">';
						echo '<form class="acp-form" id="PageData">';
							echo '<div class="blue_base">';
								echo '<div class="label label-default b_i f20" style="width:100%;">Topic Configurator</div>';
								echo '<div class="separator_10"></div>';
								echo '<div class="row">';
									# Topic ID
									echo '<div class="col-md-3">';
										echo '<input type="text" class="form-control f16 b w_300" name="topic_id_Add" value="'.$_SESSION['topic_id'].'" readonly>';
									echo '</div>';
									# Topic Category
									echo '<div class="col-md-3">';
										$this->Select->get_selector_blog_category();
									echo '</div>';
								echo '</div>';
							echo '</div>';
							echo '<div class="separator_10"></div>';

							echo '<div class="ule select_hide">';
								# Topic Title
								echo '<div class="blue_base">';
									echo '<div class="label label-default b_i f20" style="width:100%;">Topic Title</div>';
									echo '<div class="separator_10"></div>';
									echo '<div class="row">';
										echo '<div class="col-md-6">';
											echo '<input type="text" class="form-control w_300" name="title_Add" placeholder="Topic Title">';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="separator_10"></div>';

								# Topic Description
								echo '<div class="blue_base">';
									echo '<div class="label label-default b_i f20" style="width:100%;">Topic Description (Viewable In The Footer ONLY)*</div>';
									echo '<div class="separator_10"></div>';
									echo '<div class="row">';
										echo '<div class="col-md-12">';
											echo '<textarea class="form-control" name="desc_Add" rows="3" placeholder="Add Your Post Description Here"></textarea>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="separator_10"></div>';

								# Event Location Information
								echo '<div class="blue_base">';
									echo '<div class="label label-default b_i f20" style="width:100%;">Topic Location Information</div>';
									echo '<div class="separator_10"></div>';
									echo '<div class="row">';
										# Event Address 1
										echo '<div class="col-md-4">';
											echo '<input type="text" class="form-control b w_300" name="event_address1_Add" placeholder="Event Address 1">';
										echo '</div>';
										# Event Address 2
										echo '<div class="col-md-4">';
											echo '<input type="text" class="form-control b w_300" name="event_address2_Add" placeholder="Event Address 2">';
										echo '</div>';
										# Event Location
										echo '<div class="col-md-4">';
											echo '<input type="text" class="form-control b w_300" name="event_location_Add" placeholder="Event Location">';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="separator_10"></div>';

								# Image Upload
								echo '<div class="blue_base">';
									echo '<div class="label label-default b_i f20" style="width:100%;">Topic Image(s)</div>';
									echo '<div class="separator_10"></div>';
									echo '<div class="row">';
										echo '<div class="col-md-12">';
											echo '<div id="filelist">Your browser doesn\'t have Flash, Silverlight or HTML5 support.</div>';
											echo '<div id="container">';
												echo '<a class="btn btn-primary b_i col-md-2" id="pickfiles" href="javascript:;">Select Image To Upload</a>';
												echo '<a class="btn btn-primary ml_10 b_i col-md-2" id="uploadfiles" href="javascript:;">Upload Selected Image</a>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									echo '<div class="separator_10"></div>';

#									echo '<div class="row">';
#										echo '<div class="col-md-12">';
#											# Debugging
#											echo '<pre id="console"></pre>';
#										echo '</div>';
#									echo '</div>';

									echo '<div class="row">';
										echo '<div class="col-md-12">';
											echo '<div class="label label-default b_i f20" style="width:100%;">Images Size Guide</div>';
											echo '<table id="mytable" class="table table-sm acp_table tac">';
												echo '<thead>';
													echo '<tr>';
														echo '<th>Image Location</th>';
														echo '<th>Image Width</th>';
														echo '<th>Image Height</th>';
														echo '<th>Example</th>';
													echo '</tr>';
												echo '</thead>';
												echo '<tbody>';
													echo '<tr>';
														echo '<td>Upcoming Events (Home Page)</td>';
														echo '<td>275</td>';
														echo '<td>370</td>';
														echo '<td>filename_275_370.png</td>';
													echo '</tr>';
													echo '<tr>';
														echo '<td>Blog Topics (Blog Page)</td>';
														echo '<td>850</td>';
														echo '<td>350</td>';
														echo '<td>filename_850_350.png</td>';
													echo '</tr>';
												echo '</tbody>';
											echo '</table>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="separator_10"></div>';

								# Blog Post Content
								echo '<div class="blue_base">';
									echo '<div class="label label-default b_i f20" style="width:100%;">Topic Content*</div>';
									echo '<div class="separator_10"></div>';
									echo '<div class="row">';
										echo '<div class="col-md-12">';
											echo '<textarea class="form-control" name="detail_Add" rows="3" placeholder="Add Your Topic Content Here"></textarea>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="separator_10"></div>';

								echo '<div class="blue_base">';
									echo '<div class="label label-default b_i f20" style="width:100%;">Topic Submission</div>';
									echo '<div class="separator_10"></div>';
									echo '<div class="row">';
										echo '<div class="col-md-12">';
											echo 'All items with (<b>*</b>) are required, and must be provided in order to submit your topic.';
										echo '</div>';
									echo '</div>';

									echo '<div class="row">';
										echo '<div class="col-md-12">';
											echo '<center>';
												echo '<button class="btn btn-sm btn-primary open_submission_modal" data-target="#submission_modal" data-toggle="modal"><i class="fa fa-comments"></i> Submit</button>';
								#				echo '<button class="btn btn-sm btn-primary open_preview" data-target="#preview_modal" data-toggle="modal"><i class="fa fa-comments"></i> Preview</button>';
											echo '</center>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</form>';
					echo '</div>';

					# Tab 2
					echo '<div id="tabs-2">';
						echo '<form action="" method="POST">';
							echo '<div class="table-responsive">';
								echo '<table class="table table-inverse">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>ID</th>';
											echo '<th>Post Title</th>';
											echo '<th>Post Details</th>';
											echo '<th>Post Date</th>';
											echo '<th>Edit</th>';
											echo '<th>Remove</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									$sql = odbc_exec($this->db->conn,"SELECT * FROM ".$this->db->get_TABLE('BLOG_CONTENT')." ORDER BY RowID ASC");
									while($show = odbc_fetch_array($sql)){
										echo '<tr>';
											echo '<td>'.$this->Data->escData(htmlentities($show['RowID'])).'</td>';
											echo '<td>'.$this->Data->escData(htmlentities($show['topic_title'])).'</td>';
											echo '<td>'.$this->Data->escData(htmlspecialchars_decode(htmlentities($show['topic_detail']))).'</td>';
											echo '<td>'.$this->Data->escData(htmlentities(date("m/d/y h:i A", strtotime($show['topic_postdate'])))).'</td>';
											echo '<td><a class="btn btn-primary" href="?'.$this->Setting->PAGE_PREFIX.'=EditBlog&amp;topic_id='.$show['topic_id'].'">Edit</a></td>';
											echo '<td><button type="submit" class="btn btn-sm btn-primary" name="Del_Blog_Content deleteCheck[]" value="'.$show['RowID'].'" title="Remove item">X</button></td>';
										echo '</tr>';
									}
	
	echo '</tbody>';
								echo '</table>';
							echo '</div>';
						echo '</form>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';


	# MODALS
	# @function display::ds_modal
	# @ModalID (void)
	# @ModalIcon (void) - can use either FontAwesome/FontIcons/Glyphicons
	# @ModalTitle (void)
	echo $this->ds_modal('','submission_modal','<i class="fa fa-pencil"></i>','Submit New Topic');
	echo $this->ds_modal('','preview_modal','<i class="fa fa-comments"></i>','Blog Post Preview');
?>
<script>
	// Selection Opener
	$(document).ready(function(){
		$("select").change(function(){
			$(this).find("option:selected").each(function(){
				var optionValue = $(this).attr("value");
				if(optionValue){
					$(".select_hide").not("." + optionValue).hide();
					$("." + optionValue).show();
				}else{
					$(".select_hide").hide();
				}
			});
		}).change();
	});
	// Submission Modal
	$(document).ready(function(){
		$(document).on('click','.open_submission_modal',function(e){
			<?php if($this->Setting->DEBUG === "1"){ ?>
				console.log('Submission modal opened.');
			<?php } ?>
			e.preventDefault();

			$('#submission_modal #dynamic-content').html('');
			$('#submission_modal #modal-loader').show();

			$.ajax({
				url: 'ajax/blog/submission_ule.php',
				type: 'POST',
				data: $('form.acp-form').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
				$('#submission_modal #dynamic-content').html('');
				$('#submission_modal #dynamic-content').html(data);
				$('#submission_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#submission_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#submission_modal #modal-loader').hide();
			});
		});
	});
	// Preview Modal
	$(document).ready(function(){
		$(document).on('click','.open_preview',function(e){
			<?php if($this->Setting->DEBUG === "1"){ ?>
				console.log('Preview modal opened.');
			<?php } ?>
			e.preventDefault();

			var uid = $(this).data('id');

			$('#preview_modal #dynamic-content').html('');
			$('#preview_modal #modal-loader').show();

			$.ajax({
				url: 'ajax/blog/preview.php',
				type: 'POST',
//				data: 'id='+uid,
				data: $('form.acp-form').serialize(),
				dataType: 'html'
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
				$('#preview_modal #dynamic-content').html('');
				$('#preview_modal #dynamic-content').html(data);
				$('#preview_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#preview_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#preview_modal #modal-loader').hide();
			});
		});
	});
</script>