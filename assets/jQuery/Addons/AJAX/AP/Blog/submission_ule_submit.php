<?php
	@ob_start();
	@session_start();

	require_once('Autoloader.class.php');

	$db			=	new Database();
	$Setting	=	new Setting($db);

	if($Setting->DEBUG === "1"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';
#		die();
	}

	if(isset($_POST["topic_id"])){
		$topic_id				=	isset($_POST["topic_id"])		?	trim($_POST["topic_id"])		:	false;
		$topic_cat				=	isset($_POST["cat"])			?	trim($_POST["cat"])				:	false;
		$topic_title			=	isset($_POST["title"])			?	trim($_POST["title"])			:	false;
		$topic_desc				=	isset($_POST["desc"])			?	trim($_POST["desc"])			:	false;
		$topic_event_address1	=	isset($_POST["event_address1"])	?	trim($_POST["event_address1"])	:	false;
		$topic_event_address2	=	isset($_POST["event_address2"])	?	trim($_POST["event_address2"])	:	false;
		$topic_event_length		=	isset($_POST["event_location"])	?	trim($_POST["event_location"])	:	false;
		$topic_image			=	isset($_POST["image"])			?	trim($_POST["image"])			:	false;
		$topic_detail			=	isset($_POST["detail"])			?	trim($_POST["detail"])			:	false;

		$sql	=	('
						INSERT INTO '.$db->get_TABLE("BLOG_CONTENT").'
							(topic_id,topic_cat,topic_title,topic_desc,topic_event_address1,topic_event_address2,topic_event_length,topic_image,topic_detail)
						VALUES
							(?,?,?,?,?,?,?,?,?)
		');
		$stmt	=	odbc_prepare($db->conn,$sql);
		$args	=	array($topic_id,$topic_cat,$topic_title,$topic_desc,$topic_event_address1,$topic_event_address2,$topic_event_length,$topic_image,$topic_detail);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo '<button class="btn btn-success btn-lg" style="width:100%;"><i class="fa fa-info-circle"></i> Uploading topic information...</button>';
			echo '<div class="separator_10"></div>';
			echo '<button class="btn btn-success btn-lg" style="width:100%;"><i class="fa fa-info-circle"></i> Topic successfully created.</button>';
			echo '<div class="separator_10"></div>';
			echo '<button class="btn btn-info btn-lg" style="width:100%;"><i class="fa fa-info-circle"></i> Close this window to refresh.</button>';
			header('Refresh: 5;url=?'.$Setting->PAGE_PREFIX.'=EditBlog');
		}else{
			echo '<button class="btn btn-danger btn-lg" style="width:100%;"><i class="fa fa-info-circle"></i> Topic creation failed. Please check the information you provided and try again.</button>';
		}
	}
?>