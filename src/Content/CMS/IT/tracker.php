<?php
#	$this->User->get_Auth();

	$ScriptHome		=	dirname(__FILE__);
	$msg_sent		=	"";
	$msg_content 	=	"";
	$pageURL 		=	dirname("http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]) . "/";

	$Title			=	false;
	$Body			=	false;
	$ans_ticket_id	=	false;

	
	
/*
	if(isset($_GET["action"]) && isset($_GET["msg_id"])){
		if($_GET["action"] == "delete"){
			if($_SESSION['delete_right'] == 1){
				$msg_id = intval($_GET["msg_id"]);
				// Verify if the message exists
				$messageById = ("SELECT msg_id FROM ".$this->db->get_TABLE("IT_MESSAGES")." WHERE msg_id = ?");
				$stmt=odbc_prepare($cxn,$messageByID);
				$args=array($msg_id);
				$res=odbc_execute($stmt,$args);
				// Ok
				if (odbc_num_rows($res) > 0) {
					odbc_exec("DELETE FROM ".$this->db->get_TABLE("IT_MESSAGES")." WHERE msg_id = " . $msg_id);
					odbc_exec("DELETE FROM ".$this->db->get_TABLE("IT_ANSWERS")." WHERE a_msg_id = " . $msg_id);
					$msg_sent = 1;
					$msg_content = "Your message has been well deleted";
				}
			}else{$righterror = 1;}
		}
	}

	$order = "desc";
	if(isset($_GET['order'])){$order = $_GET['order'];}
	$state = "all";
	if(isset($_POST['state'])){$state = $_POST['state'];}
	$priority = "all";
	if(isset($_POST['priority'])){$priority = $_POST['priority'];}
	$division = "all";
	if(isset($_POST['division'])){$division = $_POST['division'];}
	$product = "all";
	if(isset($_POST['product'])){$product = $_POST['product'];}
	$searchEmail = '';
	if(isset($_POST['searchEmail'])){$searchEmail = $_POST['searchEmail'];}
	$searchId = '';
	if(isset($_POST['searchId'])){$searchId = $_POST['searchId'];}

	$nbParPage = 25;

	$rs		=	odbc_exec($this->db->conn, "SELECT COUNT(*) AS total FROM ".$this->db->get_TABLE("IT_MESSAGES")."");
	$arr	=	odbc_fetch_array($rs);
	$total	=	$arr['total'];

	$nbPages = ceil($total / $nbParPage);

	if(isset($_POST['page'])){
		$actualPage = intval($_POST['page']);
		if($actualPage > $nbPages){
			$actualPage = $nbPages;
		}
	}else{
		$actualPage = 1;
	}
	if(isset($_POST['msg_id']) && isset($_POST['status_edit'])){
		if($_SESSION['close_right'] == 1){
			odbc_exec("UPDATE ".$this->db->get_TABLE("IT_MESSAGES")." SET msg_status=? WHERE RowID=?");
			$stmt = odbc_prepare($cxn,$sql);
			$args = array('close',$_POST['RowID']);
#			$res = odbc_execute($stmt,$args);
			odbc_execute($stmt,$args);

			$msg_sent = 1;
			$msg_content = "The message has been closed.";
		}else{
			$righterror = 1;
		}
	}

	# Answer system
	if(isset($_POST["msg_answer"]) && !empty($_POST["msg_answer"])){
		$ans_ticket_id = htmlspecialchars($_POST["ans_ticket_id"]);
		$msg_ticket_id = htmlspecialchars($_POST["msg_ticket_id"]);
		$id_msg = intval($_POST["msg_id"]);
		$email_msg = escData($_POST["msg_email"]);
		$content_msg = escData($_POST["msg_answer"]);
	## mailer addons
#		$to = $email_msg;
#		$support_link = $pageURL . 'comments.php?ticket_id=';
#		$subject = 'New answer from our support team';
#		$message = 'Hello,<br><br>A new answer has been added to your message. Please follow this link to read it and to answer : <br><br><a href="' . $support_link . $msg_ticket_id . '">' . $support_link . $msg_ticket_id . '</a><br /><br />Thank you.';
#		$headers = 'From: ' . $config->accEmail . "\r\n" . 'Reply-To: ' . $config->accEmail . "\r\n";
#		$headers .= 'Content-Type: text/html; charset="iso-8859-1"' . "\n";
#		$headers .= 'Content-Transfer-Encoding: 8bit';

#		mail($to, $subject, $message, $headers);

		$accountId = $_SESSION["UUID"];

		# We insert the answer in the database
		$Answer=("INSERT INTO ".$this->db->get_TABLE("IT_ANSWERS")." (a_msg_id,a_email,a_content,a_account,ans_ticket_id) VALUES (?,?,?,?,?)");
		$stmt=odbc_prepare($this->db->conn,$Answer);
		$args=array($id_msg,'mail@mail.com',$content_msg,$accountId,$ans_ticket_id);
#			$_SESSION["email"]
		$res=odbc_execute($stmt,$args);

		$Message	=	("
							UPDATE ".$this->db->get_TABLE("IT_MESSAGES")."
							SET msg_status=?
							WHERE RowID=?
		");
		$stmt		=	odbc_prepare($this->db->conn,$Message);
		$args		=	array('Pending',$id_msg);
		$res		=	odbc_execute($stmt,$args);
		$msg_sent	=	1;
		$msg_content = "Your answer has been well sent.";
	}
*/
	# Output
	$Title	.=	'Issue Tracker';
/*
	$Body	.=	'<div class="row" style="display:none;>';
#		$Body	.=	'<div class="row hide">';
			$Body	.=	'<form method="post" action="?'.$this->Setting->PAGE_PREFIX.'=tracker&order='.$order.'" style="border:1px solid lime;">';
				$Body	.=	'<div class="form-group row">';

					$Body	.=	'<div class="col-sm-4">';
						$Body	.=	'<div class="input-group">';
							#$Body	.=	'<div class="input-group-addon"><i class="fa fa-eye"></i></div>';
							$Body	.=	'<select name="state" class="form-control col-sm-4">';
								$Body	.=	'<option class="tac" value="all"';if($state=="all"){$Body.='selected="selected"';}$Body.='>All States</option>';
								$Body	.=	'<option class="tac" value="open"';if($state=="open"){$Body.='selected="selected"';}$Body.='>Open</option>';
								$Body	.=	'<option class="tac" value="pending"';if($state=="pending"){$Body	.=	'selected="selected"';}$Body	.=	'>Pending</option>';
								$Body	.=	'<option class="tac" value="close"';if($state=="close"){$Body.='selected="selected"';}$Body.='>Closed</option>';
							$Body	.=	'</select>';
						$Body	.=	'</div>';
					$Body	.=	'</div>';

					$Body	.=	'<div class="col-sm-4">';
						$Body	.=	'<div class="input-group">';
							#$Body	.=	'<div class="input-group-addon"><i class="fa fa-eye"></i></div>';
							$Body	.=	'<select name="priority" class="form-control state custom-select">';
								$Body	.=	'<option class="tac" value="all"';if($priority == "all"){$Body.='selected="selected"';}$Body.='>All Priorities</option>';
								$Body	.=	'<option class="tac" value="urgent"';if($priority == "urgent"){$Body.='selected="selected"';$nPriority = 1;}$Body.='>Critical</option>';
								$Body	.=	'<option class="tac" value="high"';if($priority == "high"){$Body.='selected="selected"';$nPriority = 2;}$Body.='>High</option>';
								$Body	.=	'<option class="tac" value="medium"';if($priority == "medium"){$Body.='selected="selected"';$nPriority = 3;}$Body.='>Normal</option>';
								$Body	.=	'<option class="tac" value="low"';if($priority == "low"){$Body.='selected="selected"';$nPriority = 4;}$Body.='>Low</option>';
							$Body	.=	'</select>';
						$Body	.=	'</div>'; // end input-group
					$Body	.=	'</div>'; // end col-sm-4
					$Body	.=	'<div class="col-sm-4">';
						$Body	.=	'<div class="input-group">';
							#$Body	.=	'<div class="input-group-addon"><i class="fa fa-eye"></i></div>';
							$Body	.=	'<select name="page" class="form-control state custom-select">';
							for($i=1;$i<=$nbPages;$i++){
								$Body	.=	 "<option value=".$i;if($i==$actualPage){$Body.= " selected ";}$Body.= ">Page ".$i."</option>";
							}
							$Body	.=	'</select>';
						$Body	.=	'</div>'; // end input-group
					$Body	.=	'</div>'; // end col-sm-4
				$Body	.=	'</div>'; // end form-group row
			$Body	.=	'</form>'; // end form
		$Body	.=	'</div>'; // end row
#		$Body	.=	'<div class="separator_10"></div>';

#		$Body	.=	'<div class="row" style="display:none;">';
		$Body	.=	'<div class="row">';
			$req = "SELECT RowID,TICKET_ID,DATE,SUBJECT,NAME,EMAIL,PRIORITY,DIVISION,CONTENT,PHONE,PRODUCT,STATUS,SPAM ";
			$req .= "FROM ".$this->db->get_TABLE("IT_MESSAGES")." WHERE 1=1 ";
			if($state != "all"){$req.="AND STATUS='".$state."' ";}
			if($priority != "all"){$req.="AND PRIORITY=".$nPriority." ";}
			if($division != "all"){$req.="AND DIVISION ='".$division."' ";}
			if($product != "all"){$req.="AND PRODUCT='".ucfirst($product)."' ";}
	#		if($config->spamshow == "no"){$req.="AND SPAM = 0 ";}
			if($searchEmail != ''){$req.="AND EMAIL='".ucfirst($searchEmail)."' ";}
			if($searchId != ''){$req.="AND RowID='".ucfirst($searchId)."' ";}
			if($order == "asc"){$req.="ORDER BY DATE ";}
			else{$req.="ORDER BY DATE DESC ";}

			$first = ($actualPage - 1) * $nbParPage;
			$messages = odbc_exec($this->db->conn,$req);

			if($msg_sent){$Body	.=	 "<div class='alert alert-success'>".($msg_content)."</div>";}
			if(isset($righterror)){$Body	.=	 "<div class='alert alert-error'>You're not allowed to do that.</div>";}
			if(isset($error) && $error = 2){$Body	.=	 "<div class='alert alert-error'>" . $CSRF_error . "</div>";exit;}
		$Body	.=	'</div>'; // end row

		$Body	.=	'<div class="row custom1" style="display:none;">';
			if( $order=="desc" ){$Body	.=	'<div class="span1"><a href="?pid=IssueTracker&order=asc'.'&amp;state='.$state.'">Oldest</a></div>';}
			else{$Body	.=	'<div class="span1"><a href="?pid=IssueTracker&order=desc'.'&amp;state='.$state.'">Newest</a></div>';}
			$Body	.=	'<div class="span2">Subject</div>';
			$Body	.=	'<div class="span3">Date</div>';
			$Body	.=	'<div class="span2">Division</div>';
			$Body	.=	'<div class="span2">Status</div>';
			$Body	.=	'<div class="span2">Priority</div>';
			$Body	.=	'<div class="span1">Action</div>';
		$Body	.=	'</div>'; // end row
	while($message = odbc_fetch_array($messages)){
		$Body	.=	'<div class="row description custom2">';
#		$Body	.=	'<div class="row description custom2" style="display:none;">';
			$Body	.=	'<div class="ViewTicket span1" style="cursor:pointer;">+</div>';
			$Body	.=	'<div class="span2 tac">'.substr(htmlspecialchars($message["msg_subject"]),0,35).'</div>';
			$Body	.=	'<div class="span3 tac">'.htmlspecialchars(getDataDiff($message["msg_date"])).'</div>';
#			if ($config->productOption == "yes") {$Body	.=	'<div class="span2">'.htmlspecialchars($message->msg_product).'</div>';}
			$Body	.=	'<div class="span2 tac">'.htmlspecialchars($message["msg_division"]).'</div>';
			$Body	.=	'<div class="span2 tac">';
				$msg_status		=	htmlspecialchars($message["msg_status"]);
				$msg_spam		=	$message["msg_spam"];
				if($msg_spam == 1){$msg_status = "Spam";}
				$Body	.=	 htmlspecialchars(messageStatus($msg_status));
				$Body	.=	'</span>';# status
			$Body	.=	'</div>';
			$Body	.=	'<div class="span2 tac">';
				$Body	.=	 setPriorityLevel($message["msg_priority"]);
				$Body	.=	 setPriority($message["msg_priority"]).'</span>';
			$Body	.=	'</span>';# priority
		$Body	.=	'</div>'; // end row
		$Body	.=	'<div class="span1 ts_action">';
			$Body	.=	'<a href="?page=tracker&action=delete&msg_id='.intval($message["RowID"]).'">';
				$Body	.=	'<img src="'.$cfg["CMS_IMAGES"].'cross.png"/>';
			$Body	.=	'</a>';
		$Body	.=	'</div>';# action
#	$Body	.=	'</div>';

		$Body	.=	'<div class="row details" style="padding-top:10px;display:none;">';
			$Body	.=	'<div class="row" style="display:none;">';
				$Body	.=	'<div class="alert alert-info" style="margin-left:10px;margin-right:10px;">';
					$division = ($message["msg_division"] == "" ? "-" : $message["msg_division"]);
					$product = ($message["msg_product"] == "" ? "-" : $message["msg_product"]);
					$phone = ($message["msg_phone"] == "" ? "-" : $message["msg_phone"]);
					$Body	.=	'<table width=100%>';
						$Body	.=	'<tr>';
							$Body	.=	'<td width="50%">';
								$Body	.=	'<ul>';
									$Body	.=	'<li><strong>Subject</strong> : '.htmlspecialchars($message["msg_subject"]).'</li>';
									$Body	.=	'<li><strong>Name</strong> : '.htmlspecialchars($message["msg_name"]).'</li>';
									$Body	.=	'<li><strong>Email</strong> : '.htmlspecialchars($message["msg_email"]).'</li>';
									$Body	.=	'<li><strong>Phone</strong> : '.htmlspecialchars($phone).'</li>';
								$Body	.=	'</ul>';
							$Body	.=	'</td>';
							$Body	.=	'<td width="50%">';
								$Body	.=	'<ul>';
									$Body	.=	'<li><strong>Msg/Ticket ID</strong> : '.htmlspecialchars($message["RowID"]).'</li>';
									$Body	.=	'<li><strong>Date</strong> : '.htmlspecialchars($message["msg_date"]).'</li>';
									$Body	.=	'<li><strong>Division</strong> : '.htmlspecialchars($division).'</li>';
									$Body	.=	'<li><strong>Product</strong> : '.htmlspecialchars($product).'</li>';
								$Body	.=	'</ul>';
							$Body	.=	'</td>';
						$Body	.=	'</tr>';
					$Body	.=	'</table>';
				$Body	.=	'</div>';
			$Body	.=	'</div>'; // end row
	# Player Sent In Ticket
			$Body	.=	'<div class="row" style="display:none;">';
				$Body	.=	'<div class="row fl" style="background-color:rgba(255,194,0,0.4);width:75%">';
					$Body	.=	'<div style="padding-top:10px;margin-left:-4px;">';
	#					<div class='span1' style=''>" . get_gravatar($message->msg_email) . "</div>
						$Body	.=	'<div class="span">';
							$Body	.=	'<div style="font-weight:bold;border-bottom:1px solid #ddd;margin-bottom:5px;line-height:25px;">Issue From: '.$message["msg_email"].'</div>';
							$Body	.=	'<blockquote style="min-height:80px;">'.quoted_printable_decode($message["msg_content"]).'</blockquote>';
						$Body	.=	'</div>';
					$Body	.=	'</div>';
				$Body	.=	'</div>';
# show attachments
				$savefilepath = $pageURL."/uploads/".$message["msg_ticket_id"];
				if(is_dir($savefilepath)){
					$Body	.=	'<div class="row fr" style="width:25%;background-color:#000;">';
						$Body	.=	'<span class="label label-info">Attachments</span>';
						$Body	.=	'<div class="alert alert-default" style="margin-left:-4px;">';
							$attach_files = scandir($savefilepath . "/");
							$savefilepath2 = $pageURL."/uploads/".$message["msg_ticket_id"].'/';
							for($i=2;$i<count($attach_files);$i++){
								$Body	.=	'<a href="'.$savefilepath2.$attach_files[$i].'" target="_blank">'.$attach_files[$i].'</a><br>';
							}
							if(count($attach_files) == 2){
								$Body	.=	 "No attachments found.";
							}
						$Body	.=	'</div>';
					$Body	.=	'</div>';
				}
			$Body	.=	'</div>'; // end row
			$Body	.=	'<div class="separator_10"></div>';

			# Staff Answer to Ticket (only shown if an answer is found for msg)
			$req = "SELECT a_content,a_email,a_date,ans_ticket_id FROM ".$this->db->get_TABLE("IT_ANSWERS")." WHERE a_msg_id=? order by a_date DESC"; // AND a_account = accounts.id ";
			$stmt = odbc_prepare($this->db->conn,$req);
			$args = array($message["RowID"]);
			$res = odbc_execute($stmt,$args);

			while ($answer = odbc_fetch_array($stmt)) {
				$Body	.=	'<div class="row">';
					$Body	.=	'<div class="row fl" style="background-color:rgba(0,148,255,0.4);display:block;width:75%;">';
						$Body	.=	'<div style="padding-top:10px;margin-left:-4px;">';
#							$Body	.=	'<div class="span1">".get_gravatar($answer->a_email)."</div>';
							$Body	.=	'<div class="span">';
								$Body	.=	'<div style="font-weight:bold;margin-bottom:5px;line-height:25px;">Answer Sent By: '.$answer["a_email"].'</div>';
									$Body	.=	'<blockquote style="min-height:80px;">'.quoted_printable_decode($answer["a_content"]).'</blockquote>';
								$Body	.=	'</div>';
							$Body	.=	'</div>';
						$Body	.=	'</div>';
// show attachments
					$savefilepath = $pageURL."/uploads/".$answer["ans_ticket_id"];
					if(is_dir($savefilepath)){
						$Body	.=	'<div class="row fr" style="background-color:#000;width:25%;">';
							$Body	.=	'<span class="label label-info">Attachments</span>';
							$Body	.=	'<div class="alert alert-default" style="margin-left:-4px;word-wrap:break-word;">';
#								$Body	.=	 basename(__dir__);
#								$Body	.=	 $pageURL;
								$attach_files = scandir($savefilepath . "/");
								$savefilepath2 = $pageURL."/uploads/".$answer["ans_ticket_id"]."/";
								for($i=2;$i<count($attach_files);$i++){
									$Body	.=	'<a href="'.$savefilepath2.$attach_files[$i].'" target="_blank">'.$attach_files[$i].'</a><br>';
								}
								if(count($attach_files)==2){
									$Body	.=	 "No attachments found.";
								}
							$Body	.=	'</div>';
						$Body	.=	'</div>';
					}
				$Body	.=	'</div>'; // end row
			}
			$Body	.=	'<div class="separator_10"></div>';

			$Body	.=	'<div class="row" style="display:block;">';
				$Body	.=	'<form method="post" action="?page=tracker&order='.$order.'&amp;state='.$state.'">';
					$Body	.=	'<input type="hidden" value="'.htmlspecialchars($message["RowID"]).'" name="msg_id">';
					$Body	.=	'<input type="hidden" value="'.htmlspecialchars($message["msg_ticket_id"]).'" name="ticket_id">';
					$Body	.=	'<input type="hidden" name="status_edit" value="close"/>';
					$Body	.=	'<div class="form-inline" style="margin-bottom:10px;text-align:center;">';
						if ($message["msg_status"] != 'Closed') {
							$Body	.=	'<button type="submit" class="btn btn-danger">Close Ticket</button>';
						}
					$Body	.=	'</div>';
				$Body	.=	'</form>';
			$Body	.=	'</div>'; // end row
			$Body	.=	'<div class="separator_10"></div>';
# Uploader
			$Body	.=	'<div class="row" style="display:block;">';
				if ($message["msg_status"] != 'Closed') {
					$ans_ticket_id = md5(rand().$message["msg_email"]);
					$Body	.=	'<div class="row fl" style="width:70%;padding-top:0 !important;">';
						$Body	.=	'<form method="post" action="?page=tracker">';
							$Body	.=	'<textarea style="height:148px;" name="msg_answer" placeholder="Your answer"></textarea>';
							$Body	.=	'<input type="hidden" value="'.$message["msg_email"].'" name="msg_email"/>';
							$Body	.=	'<input type="hidden" value="'.intval($message["RowID"]).'" name="msg_id">';
							$Body	.=	'<input type="hidden" value="'.htmlspecialchars($ans_ticket_id).'" name="ans_ticket_id">';
							$Body	.=	'<input type="hidden" value="'.htmlspecialchars($message["msg_ticket_id"]).'" name="msg_ticket_id">';
							$Body	.=	'<div class="separator"></div>';
							$Body	.=	'<div style="margin-left:50%;">';
								$Body	.=	'<input type="submit" value="Answer" class="btn btn-success"/>';
							$Body	.=	'</div>';
						$Body	.=	'</form>';
					$Body	.=	'</div>';

					$Body	.=	'<div class="row fr" style="width:30%;background-color:#000;">';
						$Body	.=	'<h5>Select files from your computer</h4>';
						$Body	.=	'<form id="uploadForm" enctype="multipart/form-data" action="upload.php" target="uploadFrame" method="post">';
							$Body	.=	'<div class="">';
								$Body	.=	'<input type="hidden" id="ticketid" name="ticketid" value="'.$ans_ticket_id.'"/>';
								$Body	.=	'<input id="uploadFile" name="uploadFile" type="file"/>';
								$Body	.=	'<iframe type="hidden" id="uploadFrame" name="uploadFrame" src="#"></iframe>';
								$Body	.=	'<div class="separator"></div>';
								$Body	.=	'<div style="margin-left:33%;">';
									$Body	.=	'<input type="submit" id="upload-attachment" value="Upload File(s)" disabled class="btn btn-success"/>';
								$Body	.=	'</div>';
							$Body	.=	'</div>';
						$Body	.=	'</form>';
					$Body	.=	'</div>';
				}else{$Body	.=	'<div class="alert" style="margin-top: 20px;">This message is closed.</div>';}
			$Body	.=	'</div>';
		$Body	.=	'</div>';
	}
#	$Body	.=	'</div>';
*/
	# NEW TICKET SECTION

	if(isset($_GET) && !empty($_GET)){
#		$Body	.=	'<pre>';
#			$Body	.=	'POST set.';
#			$Body	.=	var_dump($_GET);
#		$Body	.=	'</pre>';
#		$Body	.=	exit();
	}

	$Body	.=	'<div class="row">';
		$Body	.=	$this->Tpl->Separator("10");
		$Body	.=	'<div class="col-md-2 m_t_5">';
			$Body	.=	'<button class="btn btn-sm btn-primary isCreate">Create New Ticket</buton>';
		$Body	.=	'</div>';
		$Body	.=	'<div class="col-md-2 m_t_5">';
			$Body	.=	'<button class="btn btn-sm btn-primary m_l_5 isView">View Tickets</button>';
		$Body	.=	'</div>';
		$Body	.=	$this->Tpl->Separator("5");

		$Body	.=	'<div class="col-md-12">';
			$Body	.=	'<div class="isMessage hide">';
				$msg_ticket_id = md5(rand().$_SESSION["Email"]);

				$Body	.=	'<form id="TicketSubmission">';
					$Body	.=	'<div class="form-group">';
						$Body	.=	'<textarea style="height:148px;" name="msg_answer" placeholder="Your answer"></textarea>';
					$Body	.=	'</div>';

#					$Body	.=	'<input type="hidden" value="'.$message["msg_email"].'" name="msg_email"/>';
#					$Body	.=	'<input type="hidden" value="'.intval($message["RowID"]).'" name="msg_id">';
#					$Body	.=	'<input type="hidden" value="'.htmlspecialchars($ans_ticket_id).'" name="ans_ticket_id">';
#					$Body	.=	'<input type="hidden" value="'.htmlspecialchars($message["msg_ticket_id"]).'" name="msg_ticket_id">';

					$Body	.=	'<div class="form-group">';
/*
						$Body	.=	'<h5>Upload any screenshots or files for review...</h5>';
						$Body	.=	'<form id="uploadForm" enctype="multipart/form-data" action="upload.php" target="uploadFrame" method="post">';
							$Body	.=	'<div>';
								$Body	.=	'<input type="hidden" id="ticketid" name="ticketid" value="'.@$ans_ticket_id.'"/>';
								$Body	.=	'<input id="uploadFile" name="uploadFile" type="file"/>';
								$Body	.=	'<iframe type="hidden" id="uploadFrame" name="uploadFrame" src="#"></iframe>';
								$Body	.=	'<div class="separator_10"></div>';
								$Body	.=	'<div style="margin-left:33%;">';
									$Body	.=	'<input type="submit" id="upload-attachment" value="Upload File(s)" disabled class="btn btn-success"/>';
								$Body	.=	'</div>';
							$Body	.=	'</div>';
						$Body	.=	'</form>';
*/
						$Body	.=	'<label for="exampleInputFile">Upload any screenshots or files for review...</label>';
						$Body	.=	'<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">';
						$Body	.=	'<small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It\'s a bit lighter and easily wraps to a new line.</small>';
					$Body	.=	'</div>';

					$Body	.=	$this->Tpl->Separator("10");
					$Body	.=	'<div class="form-group tac">';
						$Body	.=	'<button class="btn btn-sm btn-primary open_editor_modal" data-id="" data-target="#settings_modal" data-toggle="modal"><i class="fa fa-pencil"></i> Submit Ticket</button>';
	//					$Body	.=	'<input type="submit" name="submit_ticket" value="Submit Ticket" class="btn btn-success"/>';
					$Body	.=	'</div>';
				$Body	.=	'</form>';
			$Body	.=	'</div>';
		$Body	.=	'</div>';
	$Body	.=	'</div>'; # end new ticket section

	echo $this->Tpl->PAGE_CARD($Title,'',$Body,'');

	$this->Modal->Display($this->PageZone,'settings_modal','<i class="fa fa-pencil"></i>','0','2','Submit Ticket');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_editor_modal',function(e){
			e.preventDefault();

//			var uid = $(this).data('id');

			$('#settings_modal #dynamic-content').html('');
			$('#settings_modal #modal-loader').show();

			$.ajax({
				url: "ajax/Site/TicketSystem/ticket.php",
				type: 'POST',
//				data: 'id='+uid,
				data: $('#TicketSubmission').serialize(),
				dataType: 'html'
			})
			.done(function(data){
//				<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
					console.log(data);
//				<?php } ?>
				$('#settings_modal #dynamic-content').html('');
				$('#settings_modal #dynamic-content').html(data);
				$('#settings_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#settings_modal #modal-loader').hide();
			});
		});
	});
</script>