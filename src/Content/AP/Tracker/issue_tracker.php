<?php
	if(!($ChkUser->LoggedIn())){header("location: ?pid=Index");exit();}

	# Content
	echo '<div id="wrapper">';
		echo '<div id="page-wrapper">';
			echo '<div class="container-fluid">';
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						echo '<h1 class="page-header">'.$cfg["PageSub"].'<small> - '.$cfg["PageTitle"].'</small></h1>';
						echo '<div id="title" class="tac">Issue Tracker</div>';
						echo '<div id="sb_content">';
							$msg_sent = "";
							$msg_content = "";
							if (isset($_GET["action"]) && isset($_GET["msg_id"])) {
								if ($_GET["action"] == "delete") {
									if ($_SESSION['delete_right'] == 1) {
										$msg_id = intval($_GET["msg_id"]);
										// Verify if the message exists
										$messageById = ("SELECT msg_id FROM AdminPanel.dbo.Tracker_Messages WHERE msg_id = ?");
										$stmt=odbc_prepare($cxn1,$messageByID);
										$args=array($msg_id);
										$res=odbc_execute($stmt,$args);
										// Ok
										if (odbc_num_rows($res) > 0) {
											odbc_exec("DELETE FROM messages WHERE msg_id = " . $msg_id);
											odbc_exec("DELETE FROM answers WHERE a_msg_id = " . $msg_id);
											$msg_sent = 1;
											$msg_content = "Your message has been well deleted";
										}
									}else{$righterror = 1;}
								}
							}
							$order = "desc";
							if (isset($_GET['order'])) {$order = $_GET['order'];}
							$state = "all";
							if (isset($_POST['state'])) {$state = $_POST['state'];}
							$priority = "all";
							if (isset($_POST['priority'])) {$priority = $_POST['priority'];}
							$division = "all";
							if (isset($_POST['division'])) {$division = $_POST['division'];}
							$product = "all";
							if (isset($_POST['product'])) {$product = $_POST['product'];}
							$searchEmail = '';
							if (isset($_POST['searchEmail'])) {$searchEmail = $_POST['searchEmail'];}
							$searchId = '';
							if (isset($_POST['searchId'])) {$searchId = $_POST['searchId'];}

							$nbParPage = 25;

							$rs = odbc_exec($cxn1, "SELECT COUNT(*) AS total FROM AdminPanel.dbo.Tracker_Messages");
							$arr = odbc_fetch_array($rs);
							$total = $arr['total'];

							$nbPages = ceil($total / $nbParPage);

							if (isset($_POST['page'])) {
								$actualPage = intval($_POST['page']);
								if ($actualPage > $nbPages) {
									$actualPage = $nbPages;
								}
							}else{$actualPage = 1;}
							if (isset($_POST['msg_id']) && isset($_POST['status_edit'])) {
								if ($_SESSION['close_right'] == 1) {
									odbc_exec("UPDATE messages SET msg_status = 'close' WHERE msg_id = '" . $_POST['msg_id'] . "'");
									$msg_sent = 1;
									$msg_content = "The message has been closed.";
								}else{$righterror = 1;}
							}
							# Answer system
							if ($_POST && isset($_POST["msg_answer"])) {
								$ans_ticket_id = htmlspecialchars($_POST["ans_ticket_id"]);
								$msg_ticket_id = htmlspecialchars($_POST["msg_ticket_id"]);
								$id_msg = intval($_POST["msg_id"]);
								$email_msg = escData($_POST["msg_email"]);
								$content_msg = escData($_POST["msg_answer"]);
						## mailer addons
			#					$to = $email_msg;
			#					$support_link = $pageURL . 'comments.php?ticket_id=';
			#					$subject = 'New answer from our support team';
			#					$message = 'Hello,<br><br>A new answer has been added to your message. Please follow this link to read it and to answer : <br><br><a href="' . $support_link . $msg_ticket_id . '">' . $support_link . $msg_ticket_id . '</a><br /><br />Thank you.';
			#					$headers = 'From: ' . $config->accEmail . "\r\n" . 'Reply-To: ' . $config->accEmail . "\r\n";
			#					$headers .= 'Content-Type: text/html; charset="iso-8859-1"' . "\n";
			#					$headers .= 'Content-Transfer-Encoding: 8bit';

			#					mail($to, $subject, $message, $headers);
								$accountIdReq = ("SELECT UserUID FROM AdminPanel.dbo.ACP_UserData WHERE UserID =?");
								$stmt=odbc_prepare($cxn1,$accountIdReq);
								$args=array($_SESSION['uid']);
								$res=odbc_execute($stmt,$args);
								if($res){
									while($data=odbc_fetch_array($stmt)){
										$accountId = $data["UserUID"];
									}
								}
								# We insert the answer in the database
								$Answer=("INSERT INTO AdminPanel.dbo.Tracker_Answers (a_msg_id,a_email,a_content,a_account,ans_ticket_id) VALUES (?,?,?,?,?)");
								$stmt=odbc_prepare($cxn1,$Answer);
								$args=array($id_msg,'mail@mail.com',$content_msg,$accountId,$ans_ticket_id);
#								$_SESSION["email"]
								$res=odbc_execute($stmt,$args);

								$Message=("UPDATE AdminPanel.dbo.Tracker_Messages SET msg_status=? WHERE RowID=?");
								$stmt=odbc_prepare($cxn1,$Message);
								$args=array('Pending',$id_msg);
								$res=odbc_execute($stmt,$args);
								$msg_sent = 1;
								$msg_content = "Your answer has been well sent.";
							}
				#			echo '<h3>Administration</h3>';
				#			echo '<a class="btn" style="margin-bottom: 15px; float:right;" href="./logout.php">Log out</a>';
				#			echo '<ul class="nav nav-tabs">';
				#				$_SESSION['admin'] = false;
				#				$nPriority = '0';
				#				$admin = mysql_query("SELECT username FROM accounts limit 1");
				#				$admin_id = mysql_fetch_object($admin);
				#				if ($_SESSION['username'] == $admin_id->username) {
				#					$_SESSION['admin'] = true;
				#				}

				#				$_POST['csrf_token'] = $_SESSION['csrf_token_all'];
				#				if (isset($_SESSION['username'], $_SESSION['csrf_csrf_token'])) {
				#					try {
				#						# Run CSRF check, on POST data, in exception mode, for 60 minutes, in multiple mode.
				#						NoCSRF::check('csrf_token', $_POST, true, 60 * 60, true);
				#					} catch (Exception $e) {
				#						# CSRF attack detected
				#						$error = 2;
				#						$CSRF_error = $e->getMessage();
				#					}
				#				}
				#				createMenu(1, $_SESSION['admin']);
				#			echo '</ul>';
							echo '<div class="tab-content">';
								echo '<div class="row">';
									echo '<div class="fl">';
										echo '<form class="form-inline" method="post" action="?pid=IssueTracker&order='.$order.'">';
#											echo '<div class="panel panel-default">';
#												echo '<div class="panel-heading">';
#													echo '<h3 class="panel-title">Options</h3>';
#												echo '</div>';
#												echo '<div class="panel-body" style="color:#000;">';
#													echo '<div class="input-group fl">';
#														echo '<div class="input-group-btn">';
#															echo '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
#															echo '<div id="name-to-send" class="selectpicker">';
#																echo '<button data-id="prov" type="button" class="btn btn-lg btn-block btn-default dropdown-toggle">';
#																	echo '<span class="placeholder">Choose an option</span>';
#																	echo '<span class="caret"></span>';
#																echo '</button>';
#																echo '<div class="dropdown-menu">';
#																	echo '<ul class="list-unstyled">';
#																		echo '<li class="items" data-value="all">All States</li>';
#																		echo '<li class="items" data-value="open">Open</li>';
#																		echo '<li class="items" data-value="pending">Pending</li>';
#																		echo '<li class="items" data-value="closed">Closed</li>';
#																	echo '</ul>';
#																echo '</div>';
#																echo '<input type="hidden" name="name-to-send" value="">';
#															echo '</div>';
#															echo '<ul class="select-replace dropdown-menu">';
#																echo '<li class="selected" data-value="all">All</li>';
#																echo '<li class="" data-value="comp">Complaints</li>';
#																echo '<li class="" data-value="appl">Applications</li>';
#																echo '<li class="" data-value="crap">Crap to read</li>';
#																echo '<li class="" data-value="junk">More Junk</li>';
#															echo '</ul>';
#														echo '</div>';#<!-- /btn-group -->
#													echo '</div>';#<!-- /input-group -->
#													echo $state;
#													echo '<div class="input-group fr">';
#														echo '<div class="input-group-btn">';
#															echo '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
#															echo '<ul class="dropdown-menu">';
#																echo '<li><a href="#">Action</a></li>';
#																echo '<li><a href="#">Another action</a></li>';
#																echo '<li><a href="#">Something else here</a></li>';
#																echo '<li role="separator" class="divider"></li>';
#																echo '<li><a href="#">Separated link</a></li>';
#															echo '</ul>';
#														echo '</div>';#<!-- /btn-group -->
#													echo '</div>';#<!-- /input-group -->
#													echo '<div class="clear"></div>';
#												echo '</div>';# panel-body close
#											echo '</div>';# panel close

											echo '<select name="state" class="state span3 tac">';
												echo '<option class="tac" value="all"';
												if ($state == "all") {echo 'selected="selected"';}echo'>All States</option>';
												echo '<option class="tac" value="open"';
												if ($state == "open") {echo 'selected="selected"';}echo '>Open</option>';
												echo '<option class="tac" value="pending"';
												if ($state == "pending") {echo 'selected="selected"';}echo '>Pending</option>';
												echo '<option class="tac" value="close"';
												if ($state == "close") {echo 'selected="selected"';}echo '>Closed</option>';
											echo '</select>';

											echo '<select name="priority" class="state span3 tac">';
												echo '<option class="tac" value="all"';
												if ($priority == "all") {echo 'selected="selected"';}echo '>All Priorities</option>';
												echo '<option class="tac" value="urgent"';
												if ($priority == "urgent") {echo 'selected="selected"';$nPriority = 1;}echo '>Critical</option>';
												echo '<option class="tac" value="high"';
												if ($priority == "high") {echo 'selected="selected"';$nPriority = 2;}echo '>High</option>';
												echo '<option class="tac" value="medium"';
												if ($priority == "medium") {echo 'selected="selected"';$nPriority = 3;}echo '>Normal</option>';
												echo '<option class="tac" value="low"';
												if ($priority == "low") {echo 'selected="selected"';$nPriority = 4;}echo '>Low</option>';
											echo '</select>';
#											echo '<select name="division" class="state span2">';
#												echo '<option value="all"';
#												if ($division == "all") {echo 'selected="selected"';}
#												echo '>All divisions</option>';
#												foreach ($config->divisions->division as $divisionC) {
#													echo "<option value='" . $divisionC . "'";
#													if ($divisionC == $division) {echo " selected ";}
#													echo ">" . $divisionC . "</option>";
#												}
#											echo '</select>';
#											if ($config->productOption == "yes") {
#												echo '<select name="product" class="state span2">';
#													echo '<option value="all"';
#														if ($product == "all") {echo 'selected="selected"';}echo '>All products</option>';
#														foreach ($config->products->product as $productC) {
#															echo "<option value= '" . $productC . "'";
#															if ($productC == $product) {echo " selected ";}
#															echo ">" . $productC . "</option>";
#														}
#												echo '</select>';
#											}
											echo '<select name="page" class="state span3">';
											for ($i = 1; $i <= $nbPages; $i++) {
												echo "<option value=" . $i;
												if($i==$actualPage){echo " selected ";}
												echo ">Page " . $i . "</option>";
											}
											echo '</select>';
										echo '</form>';
									echo '</div>';
									echo '<div class="fr">';
										echo '<form action="?pid=IssueTracker&order='.$order.'" id="search" class="form-inline" method="post">';
											echo '<div class="row">';
												echo '<div class="col-lg-6">';
													echo '<div class="input-group">';
														echo '<input type="text" class="form-control span2" name="searchEmail" placeholder="Email address">';
														echo '<span class="input-group-btn">';
															echo '<button class="btn submit" name="emailSearch" type="button" style="width:90px;">By email</button>';
														echo '</span>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
											echo '<br /><br />';

											echo '<div class="row">';
												echo '<div class="col-lg-6">';
													echo '<div class="input-group">';
														echo '<input type="text" class="form-control span2" name="searchId" placeholder="Ticket number">';
														echo '<span class="input-group-btn">';
															echo '<button class="btn submit" name="idSearch" type="button" style="width:90px;">By ID</button>';
														echo '</span>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
											echo '<input type="hidden" name="searchType" id="searchType" value=""/>';
										echo '</form>';
									echo '</div>';# close right float
								echo '</div>';

								echo '<div style="display:block;">';
									$req = "SELECT RowID, msg_ticket_id, msg_date, msg_subject, msg_name, msg_email, msg_priority, msg_division, msg_content, msg_phone, msg_product, msg_status, msg_spam ";
									$req .= "FROM AdminPanel.dbo.Tracker_Messages WHERE 1=1 ";
									if ($state != "all") {$req .= "AND msg_status='".$state."' ";}
									if ($priority != "all") {$req .= "AND msg_priority=".$nPriority." ";}
									if ($division != "all") {$req .= "AND msg_division ='".$division."' ";}
									if ($product != "all") {$req .= "AND msg_product='".ucfirst($product)."' ";}
#									if ($config->spamshow == "no") {$req .= "AND msg_spam = 0 ";}
									if ($searchEmail != '') {$req .= "AND msg_email='".ucfirst($searchEmail)."' ";}
									if ($searchId != '') {$req .= "AND RowID='".ucfirst($searchId)."' ";}
									if ($order == "asc") {$req .= "ORDER BY msg_date ";}
									else{$req .= "ORDER BY msg_date DESC ";}

									$first = ($actualPage - 1) * $nbParPage;
#									$req .= "TOP " . $first . ", " . $nbParPage;
									$messages = odbc_exec($cxn1,$req);

									if ($msg_sent) {echo "<div class='alert alert-success'>" . ($msg_content) . "</div>";}
									if (isset($righterror)) {echo "<div class='alert alert-error'>You're not allowed to do that</div>";}
									if (isset($error) && $error = 2) {echo "<div class='alert alert-error'>" . $CSRF_error . "</div>";exit;}
								echo '</div>';
								echo '<div class="row custom1">';
									if($order=="desc"){echo '<div class="span2"><a href="?pid=IssueTracker&order=asc'.'&amp;state='.$state.'">Oldest</a></div>';}
									else{echo '<div class="span1"><a href="?pid=IssueTracker&order=desc'.'&amp;state='.$state.'">Newest</a></div>';}
									echo '<div class="span3">Subject</div>';
									echo '<div class="span2">Date</div>';
#									if ($config->productOption == "yes") {echo '<div class="span2">Product</div>';}
									echo '<div class="span3">Division</div>';
									echo '<div class="span2">Status</div>';
									echo '<div class="span2">Priority</div>';
									echo '<div class="span1">Action</div>';
								echo '</div>';
							while ($message = odbc_fetch_array($messages)) {
								echo '<div class="row description custom2">';
									echo '<div class="span2 openable tac"><a href="#" class="custom">+</a></div>';
									echo '<div class="span3 tac">'.substr(htmlspecialchars($message["msg_subject"]), 0, 35).'</div>';
									echo '<div class="span2 tac">'.htmlspecialchars(getDataDiff($message["msg_date"])).'</div>';
	#								if ($config->productOption == "yes") {echo '<div class="span2">'.htmlspecialchars($message->msg_product).'</div>';}
									echo '<div class="span3 tac">'.htmlspecialchars($message["msg_division"]).'</div>';
									echo '<div class="span2 tac">';
										$msg_status = htmlspecialchars($message["msg_status"]);
										$msg_spam = $message["msg_spam"];
										if ($msg_spam == 1) {$msg_status = "Spam";}
										echo htmlspecialchars(messageStatus($msg_status));
									echo '</span></div>';
									echo '<div class="span2 tac">';
										echo htmlspecialchars(setPriority($message["msg_priority"]));
										echo setPriorityLevel($message["msg_priority"]).'</span>';
										echo '</span>';
									echo '</div>';
									echo '<div class="span1 tac"><a href="admin.php?action=delete&msg_id='.intval($message["RowID"]).'"><img src="images/cross.png"/></a></div>';
								echo '</div>';
								echo '<div class="row details" style="padding-top:10px;display:none;background-color:#000;">';
									echo '<div class="row">';
										echo '<div class="alert alert-info" style="margin-left:10px;margin-right:10px;">';
											$division = ($message["msg_division"] == "" ? "-" : $message["msg_division"]);
											$product = ($message["msg_product"] == "" ? "-" : $message["msg_product"]);
											$phone = ($message["msg_phone"] == "" ? "-" : $message["msg_phone"]);
											echo '<table class="acp_table row">';
												echo '<tr>';
													echo '<td width="50%">';
														echo '<ul>';
															echo '<li><strong>Subject</strong> : '.htmlspecialchars($message["msg_subject"]).'</li>';
															echo '<li><strong>Name</strong> : '.htmlspecialchars($message["msg_name"]).'</li>';
															echo '<li><strong>Email</strong> : '.htmlspecialchars($message["msg_email"]).'</li>';
															echo '<li><strong>Phone</strong> : '.htmlspecialchars($phone).'</li>';
														echo '</ul>';
													echo '</td>';
													echo '<td width="50%">';
														echo '<ul>';
															echo '<li><strong>Msg/Ticket ID</strong> : '.htmlspecialchars($message["RowID"]).'</li>';
															echo '<li><strong>Date</strong> : '.htmlspecialchars($message["msg_date"]).'</li>';
															echo '<li><strong>Division</strong> : '.htmlspecialchars($division).'</li>';
															echo '<li><strong>Product</strong> : '.htmlspecialchars($product).'</li>';
														echo '</ul>';
													echo '</td>';
												echo '</tr>';
											echo '</table>';
										echo '</div>';
									echo '</div>';
									echo '<div class="clear"></div>';
# Message From Ticket Issuer
									echo '<div class="row">';
										echo '<div class="fl">';
											echo '<div class="conversRight" style="padding-top:10px;margin-left:-4px;">';
#												echo '<div class="span1" style="">'.get_gravatar($message->msg_email).'</div>';
												echo '<div class="span">';
													echo '<div style="font-weight:bold;border-bottom:1px dashed silver;margin-bottom:5px;line-height:25px;">Issue Sent From: '.$message["msg_email"].'</div>';
													echo '<blockquote style="min-height:80px;">'.quoted_printable_decode($message["msg_content"]).'</blockquote>';
												echo '</div>';
											echo '</div>';
										echo '</div>';
# Attachments Send/View
										$dir = dirname(__FILE__);
										$savefilepath = $dir . "/uploads/".$message["msg_ticket_id"];
										if (is_dir($savefilepath)) {
											echo '<span class="label label-info">Attachments</span>';
											echo '<div class="alert alert-default" style="margin-left:-4px;">';
												$attach_files = scandir($savefilepath."/");
												$savefilepath2 = $pageURL."/uploads/".$message["msg_ticket_id"].'/';
												for ($i = 2; $i < count($attach_files); $i++) {
													echo '<a href="'.$savefilepath2.$attach_files[$i].'" target="_blank">'.$attach_files[$i].'</a>';
												}
												if (count($attach_files) == 2) {echo 'This email has an attachment which was removed due to being suspicious to be infected';}
											echo '</div>';
										}
										$req = "SELECT a_content,a_email,a_date,ans_ticket_id FROM AdminPanel.dbo.Tracker_Answers WHERE a_msg_id=? order by a_date DESC"; // AND a_account = accounts.id ";
										$stmt = odbc_prepare($cxn1,$req);
										$args = array($message["RowID"]);
										$res = odbc_execute($stmt,$args);
										while ($answer = odbc_fetch_array($stmt)) {
											echo '<div class="fr">';
												echo '<div class="conversRight" style="padding-top:10px;margin-left:-4px;">';
#													echo '<div class="span1">'.get_gravatar($answer["a_email"]).'</div>';
													echo '<div class="span">';
														echo '<div style="font-weight:bold;margin-bottom:5px;line-height:25px;">Answer Sent By: '.$answer["a_email"].'</div>';
														echo '<blockquote style="min-height:80px;">'.quoted_printable_decode($answer["a_content"]).'</blockquote>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
# Attachments Send/View
											$dir = dirname(__FILE__);
											$savefilepath = $dir."/uploads/".$answer["ans_ticket_id"];
											if (is_dir($savefilepath)) {
												echo '<span class="label label-info">Attachments</span>';
												echo '<div class="alert alert-default" style="margin-left:-4px;">';
													$attach_files = scandir($savefilepath."/");
													$savefilepath2 = $pageURL."/uploads/".$answer["ans_ticket_id"]."/";
													for ($i = 2; $i < count($attach_files); $i++) {
														echo '<a href="'.$savefilepath2.$attach_files[$i].'" target="_blank">'.$attach_files[$i].'</a>';
													}
													if (count($attach_files) == 2) {
														echo 'This ticket has an attachment which was removed due to being suspicious or possibly infected';
													}
												echo '</div>';
											}
										}
										echo '<form class="acp_form" method="post" action="?pid=IssueTracker&order='.$order.'&amp;state='.$state.'">';
											echo '<input type="hidden" value="'.htmlspecialchars($message["RowID"]).'" name="msg_id">';
											echo '<input type="hidden" value="'.htmlspecialchars($message["msg_ticket_id"]).'" name="ticket_id">';
											echo '<input type="hidden" name="status_edit" value="close"/>';
											echo '<div class="form-inline" style="margin-bottom: 10px; text-align: center;">';
											echo '<br /><br /><br />';
											if ($message["msg_status"] != 'Closed') {
												echo '<button type="submit" class="btn btn-danger">Close This Ticket?</button>';
											}
											echo '</div>';
										echo '</form>';
									echo '</div>';
									echo '<br /><br />';
									echo '<div class="clear"></div>';

									echo '<div class="row" style="border:1px solid orange;">';
									if ($message["msg_status"] != 'Closed') {
										$ans_ticket_id = md5(rand().$message["msg_email"]);
										echo '<div class="fl">';
											echo '<form id="uploadForm" enctype="multipart/form-data" action="upload.php" target="uploadFrame" method="post">';
												echo '<input type="hidden" id="ticketid" name="ticketid" value="'.$ans_ticket_id.'"/>';
												echo '<input id="uploadFile" name="uploadFile" type="file"/>';
												echo '<iframe type="hidden" id="uploadFrame" name="uploadFrame" src="#"></iframe>';
												echo '<br />';
												echo '<input type="submit" class="btn btn-success" value="Upload Attachments" disabled  style="margin-top:5px;margin-left:80px;"/>';
											echo '</form>';
										echo '</div>';
										echo '<div class="fr">';
											echo '<form method="post" action="?pid=IssueTracker&order='.$order.'&amp;state='.$state.'" style="text-align:center;">';
												echo '<textarea name="msg_answer" placeholder="Your answer"></textarea>';
												echo '<br/>';
												echo '<input type="hidden" value="'.$message["msg_email"].'" name="msg_email"/>';
												echo '<input type="hidden" value="'.intval($message["RowID"]).'" name="msg_id">';
												echo '<input type="hidden" value="'.htmlspecialchars($ans_ticket_id).'" name="ans_ticket_id">';
												echo '<input type="hidden" value="'.htmlspecialchars($message["msg_ticket_id"]).'" name="msg_ticket_id">';
												echo '<input type="submit" value="Answer" class="btn btn-success" style="margin-top: 5px;"/>';
											echo '</form>';
										echo '</div>';
										echo '<div class="clear"></div>';
										echo '<br /><br />';
									}
									else{echo '<div class="alert" style="margin-top: 20px;">This message is closed.</div>';}
									echo '</div>';# span12 div close
								echo '</div>';# row details div close
							}
							echo '</div>';# row description div close
						echo '<br>';
					echo '</div>';
					?>
							<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
							<script type="text/javascript">
								(function ($) {
									$('.description .openable').live("click", function (event) {
										event.preventDefault();
										$(this).parent().next().slideDown();
										$(this).parent().find('a:first').addClass("opened");
										$(this).addClass('closable').removeClass('openable');
									});
									$('.description .closable').live("click", function (event) {
										event.preventDefault();
										$(this).parent().next().slideUp();
										$(this).parent().find('a:first').removeClass("opened");
										$(this).addClass('openable').removeClass('closable');
									});
									$('.state').live("change", function (event) {
										event.preventDefault();
										$(this).parent().submit();
//										$(this).parent().previous().submit();
//										$(this).parent(".form-inline").submit();
									});
									$("ul.select-replace li").click(function(){
										$("input[name=select_val").prop("value", $(this).text());
									});
									$('form#search input.searchEmail').keyup(function (e) {
										if (e.keyCode == 13) {
											$("form#search input#searchType").val("emailSearch");
											$("form#search").submit();
										}
									});
									$('form#search input.searchId').keyup(function (e) {
										if (e.keyCode == 13) {
											$("form#search input#searchType").val("idSearch");
											$("form#search").submit();
										}
									});
									$("button.submit").click(function () {
										$("form#search input#searchType").val(this.name);
										$("form#search").submit();
									});
								})(jQuery);
							</script>
							<?php
						echo '</div>';# close sb_content
					echo '</div>';# close col-lg-12
				echo '</div>';# close row
			echo '</div>';# close container-fluid
		echo '</div>';# close page-wrapper
	echo '</div>';# close wrapper
?>