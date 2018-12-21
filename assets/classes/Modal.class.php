<?php
	class Modal{

	/*
		@Size	(void)	modal-sm || modal-lg
		@Pos	(void)	modal-dialog-centered
		@ID		(bool)
		@Icon	(void)	can use either FontAwesome or FontIcons
		@Title	(bool)
	*/

		function __construct($Colors,$Paging,$Setting,$Style){
			$this->Colors		=	$Colors;
			$this->Paging		=	$Paging;
			$this->Setting		=	$Setting;
			$this->Style		=	$Style;
		}
		function Display($Zone,$ID,$Icon,$Pos=NULL,$Size,$Title){
			echo '<div class="modal" id="'.$ID.'" tabindex="-1" role="dialog">';
				echo '<div class="modal-dialog'.$this->ModalPos($Pos).$this->ModalSize($Size).'" role="document">';
					echo '<div class="modal-content" style="'.$this->Colors->_do_ColorBuilder('BGColor','Black','0.4').'">';
						echo $this->ModalHeader($ID,$Icon,$Title);
						echo $this->ModalBody($Zone);
						echo $this->ModalFooter();
					echo '</div>';
				echo '</div>';
			echo '</div>';
		}
		function ModalPos($data){
			switch($data){
				case '0':	return '';							break;
				case '1':	return ' modal-dialog-centered ';	break;
			}
		}
		function ModalSize($data){
			switch($data){
				case '0':	return '';			break;
				case '1':	return ' modal-sm';	break;
				case '2':	return ' modal-lg';	break;
			}
		}
		function ModalHeader($ID,$Icon,$Title){
			echo '<div class="modal-header">';
				echo '<h5 class="modal-title" id="'.$ID.'">'.$Icon.' '.$Title.'</h5>';
				echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
					echo '<span class="text-white" aria-hidden="true"><i class="fa fa-times-circle"></i></span>';
				echo '</button>';
			echo '</div>';
		}
		function ModalBody($Zone){
			echo '<div class="modal-body">';
				echo '<div class="container-fluid">';
					echo '<div id="modal-loader">';
						echo '<div class="row">';
							echo '<div class="col-md-6"></div>';
							echo '<div class="col-md-2">';
								echo '<div class="bt-spinner"></div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div id="error" style="border:1px dashed red;"></div>';
					echo '<div id="dynamic-content"></div>';
				echo '</div>';
			echo '</div>';
		}
		function ModalFooter(){
			echo '<div class="modal-footer">';
				echo '<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>';
			#	echo '<button type="button" class="btn btn-primary">Save changes</button>';
			echo '</div>';
		}
		function _get_MDOAL_LINKS(){
			# Theme Modals
			$this->Display($this->Paging->PAGE_ZONE,'bit_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			$this->Display($this->Paging->PAGE_ZONE,'text_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			$this->Display($this->Paging->PAGE_ZONE,'bgcolor_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			$this->Display($this->Paging->PAGE_ZONE,'sb_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			$this->Display($this->Paging->PAGE_ZONE,'theme_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			$this->Display($this->Paging->PAGE_ZONE,'theme_enable_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			$this->Display($this->Paging->PAGE_ZONE,'theme_lock_modal','<i class="fa fa-pencil"></i>','0','2','Lock Setting');
			$this->Display($this->Paging->PAGE_ZONE,'theme_unlock_modal','<i class="fa fa-pencil"></i>','0','2','Un-lock Setting');
			$this->Display($this->Paging->PAGE_ZONE,'pane_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			# Login Modals
			$this->Display($this->Paging->PAGE_ZONE,'login_modal','<i class="fa fa-pencil"></i>','0','2','Log In');
			$this->Display($this->Paging->PAGE_ZONE,'pane_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			# Registration Modals
			$this->Display($this->Paging->PAGE_ZONE,'register_modal','<i class="fa fa-pencil"></i>','0','2','Registration');
			$this->Display($this->Paging->PAGE_ZONE,'verify_userid_modal','<i class="fa fa-pencil"></i>','0','2','Check UserID Availability');
			$this->Display($this->Paging->PAGE_ZONE,'verify_displayname_modal','<i class="fa fa-pencil"></i>','0','2','Check Display Name Availability');
			# Mail Testing
			$this->Display($this->Paging->PAGE_ZONE,'mail_test_modal','<i class="fa fa-pencil"></i>','0','2','Mail Test');
		}
		function _get_MODAL_SCRIPTS(){
			echo '<div class="modals_js">';
			?>
			<script>
				$(document).ready(function(){
					// Login Modal
					$(document).on("click",".open_login_modal",function(e){
						e.preventDefault();

						$("#login_modal #dynamic-content").html("");
						$("#login_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/Site/Login/login.php",
							type: "POST",
							data: $('form.login_form').serialize(),
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
							console.log(data);
							<?php } ?>
							$('#login_modal #dynamic-content').html('');
							$('#login_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#login_modal #modal-loader').hide("slow");
							setTimeout(' window.location.href = "?<?php echo $this->Setting->PAGE_PREFIX; ?>=HOME" ',4000);
						})
						.fail(function(){
							$('#login_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#login_modal #modal-loader').hide();
						});
					});
					// Registration Modals
					$(document).on("click",".open_register_modal",function(e){
						e.preventDefault();

						$("#register_modal #dynamic-content").html("");
						$("#register_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/Site/Registration/register.php",
							type: "POST",
							data: $('form.register_form').serialize(),
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
							console.log(data);
							<?php } ?>
							$('#register_modal #dynamic-content').html('');
							$('#register_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#register_modal #modal-loader').hide("slow");
//							setTimeout(' window.location.href = "?<?php echo $this->Setting->PAGE_PREFIX; ?>=HOME" ',4000);
						})
						.fail(function(){
							$('#register_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#register_modal #modal-loader').hide();
						});
					});
					// Mail Test Modal
					$(document).on("click",".open_mail_test_modal",function(e){
						e.preventDefault();

						$("#mail_test_modal #dynamic-content").html("");
						$("#mail_test_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Mail/mail_test.php",
							type: "POST",
							data: $('form.mail_test_form').serialize(),
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
							console.log(data);
							<?php } ?>
							$('#mail_test_modal #dynamic-content').html('');
							$('#mail_test_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#mail_test_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$('#mail_test_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#mail_test_modal #modal-loader').hide();
						});
					});
					$(document).on('click','.open_verify_userid_modal',function(e){
						e.preventDefault();

						$('#verify_userid_modal #dynamic-content').html('');
						$('#verify_userid_modal #modal-loader').show();

						$.ajax({
							url: "<?php echo $this->Style->_style_array[9];?>AJAX/Site/Registration/verify_userid.php",
							type: 'POST',
							data: $('form#register').serialize(),
							dataType: 'html'
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
								console.log(data);
							<?php } ?>
							$('#verify_userid_modal #dynamic-content').html('');
							$('#verify_userid_modal #dynamic-content').html(data);
							$('#verify_userid_modal #modal-loader').hide();
						})
						.fail(function(){
							$('#verify_userid_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#verify_userid_modal #modal-loader').hide();
						});
					});
					$(document).on('click','.open_verify_displayname_modal',function(e){
						e.preventDefault();

						$('#verify_displayname_modal #dynamic-content').html('');
						$('#verify_displayname_modal #modal-loader').show();

						$.ajax({
							url: "<?php echo $this->Style->_style_array[9];?>AJAX/Site/Registration/verify_displayname.php",
							type: 'POST',
							data: $('form').serialize(),
							dataType: 'html'
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1" || $this->Setting->DEBUG === "2"){ ?>
								console.log(data);
							<?php } ?>
							$('#verify_displayname_modal #dynamic-content').html('');
							$('#verify_displayname_modal #dynamic-content').html(data);
							$('#verify_displayname_modal #modal-loader').hide();
						})
						.fail(function(){
							$('#verify_displayname_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#verify_displayname_modal #modal-loader').hide();
						});
					});
					// Bit Modal
					$(document).on("click",".open_bit_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#bit_modal #dynamic-content").html("");
						$("#bit_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_bit_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
							console.log(data);
							<?php } ?>
							$('#bit_modal #dynamic-content').html('');
							$('#bit_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#bit_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#bit_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#bit_modal #modal-loader").hide();
						});
					});
					// Textual Modal
					$(document).on("click",".open_text_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#text_modal #dynamic-content").html("");
						$("#text_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_text_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
								console.log(data);
							<?php } ?>
							$('#text_modal #dynamic-content').html('');
							$('#text_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#text_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#text_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#text_modal #modal-loader").hide();
						});
					});
					// Color Modal
					$(document).on("click",".open_bgcolor_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#bgcolor_modal #dynamic-content").html("");
						$("#bgcolor_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_bgcolor_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
								console.log(data);
							<?php } ?>
							$('#bgcolor_modal #dynamic-content').html('');
							$('#bgcolor_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#bgcolor_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#bgcolor_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#bgcolor_modal #modal-loader").hide();
						});
					});
					// Sidebar Modal
					$(document).on("click",".open_sb_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#sb_modal #dynamic-content").html("");
						$("#sb_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_sidebar_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
								console.log(data);
							<?php } ?>
							$('#sb_modal #dynamic-content').html('');
							$('#sb_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#sb_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#sb_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#sb_modal #modal-loader").hide();
						});
					});
					// Theme Modal
					$(document).on("click",".open_theme_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#theme_modal #dynamic-content").html("");
						$("#theme_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_site_theme_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
							console.log(data);
							<?php } ?>
							$('#theme_modal #dynamic-content').html('');
							$('#theme_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#theme_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#theme_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#theme_modal #modal-loader").hide();
						});
					});
					// Selector Modal
					$(document).on("click",".open_pane_modal",function(e){

						e.preventDefault();

						var uid = $(this).data("id");

						$("#pane_modal #dynamic-content").html("");
						$("#pane_modal #modal-loader").show();
						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_pane_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
								console.log(data);
							<?php } ?>
							$('#pane_modal #dynamic-content').html('');
							$('#pane_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#pane_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#pane_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#pane_modal #modal-loader").hide();
						});
					});
					// Theme Enable Modal
					$(document).on("click",".open_theme_enable_modal",function(e){

						e.preventDefault();

						var uid = $(this).data("id");

						$("#theme_enable_modal #dynamic-content").html("");
						$("#theme_enable_modal #modal-loader").show();
						$.ajax({
							url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/edit_theme_enable_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->DEBUG === "1"){ ?>
								console.log(data);
							<?php } ?>
							$('#theme_enable_modal #dynamic-content').html('');
							$('#theme_enable_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#theme_enable_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#theme_enable_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#theme_enable_modal #modal-loader").hide();
						});
					});
					// Theme Lock Modal
					$(document).on("click",".open_theme_lock_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#theme_lock_modal #dynamic-content").html("");
						$("#theme_lock_modal #modal-loader").show();

						$.ajax({
							url: "<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/theme_access_lock.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
						//	console.log(data);
							$('#theme_lock_modal #dynamic-content').html('');
							$('#theme_lock_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#theme_lock_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#theme_lock_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#theme_lock_modal #modal-loader").hide();
						});
					});
					// Theme Unlock Modal
					$(document).on("click",".open_theme_unlock_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#theme_unlock_modal #dynamic-content").html("");
						$("#theme_unlock_modal #modal-loader").show();
						$.ajax({
							url: "<?php echo $this->Style->_style_array[9];?>AJAX/AP/Theme/theme_access_unlock.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
						//	console.log(data);
							$('#theme_unlock_modal #dynamic-content').html('');
							$('#theme_unlock_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#theme_unlock_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#theme_unlock_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#theme_unlock_modal #modal-loader").hide();
						});
					});
				});
			</script>
			<?php
			echo '</div>';
		}
	}
?>