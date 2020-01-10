<?php
	@ob_start();
	@session_start();

	require_once('Autoloader.class.php');
	$db			=	new Database();
	$Select		=	new Select();
	$Setting	=	new Setting($db);

	if($Setting->DEBUG === "1"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
#		die();
	}

	$topic_id		=	isset($_POST["topic_id_Add"])		?	trim($_POST["topic_id_Add"])		:	false;
	$cat			=	isset($_POST["cat_Add"])			?	trim($_POST["cat_Add"])				:	false;
	$title			=	isset($_POST["title_Add"])			?	trim($_POST["title_Add"])			:	false;
	$desc			=	isset($_POST["desc_Add"])			?	trim($_POST["desc_Add"])			:	false;
	$event_address1	=	isset($_POST["event_address1_Add"])	?	trim($_POST["event_address1_Add"])	:	false;
	$event_address2	=	isset($_POST["event_address2_Add"])	?	trim($_POST["event_address2_Add"])	:	false;
	$event_location	=	isset($_POST["event_location_Add"])	?	trim($_POST["event_location_Add"])	:	false;
	$image			=	isset($_SESSION["image_Add"])		?	trim($_SESSION["image_Add"])		:	false;
	$detail			=	isset($_POST["detail_Add"])			?	trim($_POST["detail_Add"])			:	false;

	echo '<form class="submit_data">';
		echo '<div class="alert alert-danger">';
			echo '<i class="fa fa-exclamation-triangle"></i> ';
			echo 'Are you sure you want to create this topic for <span class="b_i">'.$title.'</span>?';
		echo '</div>';

		echo '<input name="topic_id" type="hidden" value="'.$topic_id.'"/>';
		echo '<input name="cat" type="hidden" value="'.$cat.'"/>';
		echo '<input name="title" type="hidden" value="'.$title.'"/>';
		echo '<input name="desc" type="hidden" value="'.$desc.'"/>';
		echo '<input name="event_address1" type="hidden" value="'.$event_address1.'"/>';
		echo '<input name="event_address2" type="hidden" value="'.$event_address2.'"/>';
		echo '<input name="event_location" type="hidden" value="'.$event_location.'"/>';
		echo '<input name="image" type="hidden" value="'.$image.'"/>';
		echo '<input name="detail" type="hidden" value="'.$detail.'"/>';

		echo '<button type="button" class="btn btn-warning center-block" id="submit_data"><i class="fa fa-check-circle"></i> Create Topic?</button>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#submit_data").click(function(){
			$.ajax({
				type: "POST",
				url: "ajax/blog/submission_ule_submit.php",
				data: $('form.submit_data').serialize(),
				success: function(message){
					$('#submission_modal #dynamic-content').html(message);
					<?php if($Setting->DEBUG === "1"){ ?>
						console.log('Reloading page...');
					<?php } ?>
					$(".PageLoader").load(location.href + " #PageData");
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>