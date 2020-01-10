<?php
	namespace classes\Utils;

	#############################################################################################
	#	Title: Modal.class.php																	#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS modal class, used for loading all modal resources								#
	#	Last Update Date: 04.27.2019	0246													#
	#																							#
	#	USAGE																					#
	#	@Zone	(string)	gets the zone you're in, ie. CMS || ACP								#
	#	@ID		(string)	name of the id for the modal (custom for each modal to				#
	#						prevent duplicates)													#
	#	@Icon	(string)	icon that you want to use in front of the modal title 				#
	#						(available icon libraries are Fontawesome && FontIcons)				#
	#	@Pos	(int)		modal position, empty for default or 1 for centered					#
	#	@Size	(int)		modal size, options are: modal-sm || modal-lg || modal-xl			#
	#	@Title	(string)	modal title															#
	#############################################################################################

	class Modal{

		private $output;

		public function __construct($Colors,$Dirs,$Paging,$Setting,$Style){
			$this->Colors		=	$Colors;
			$this->Dirs			=	$Dirs;
			$this->Paging		=	$Paging;
			$this->Setting		=	$Setting;
			$this->Style		=	$Style;
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function Display($Zone,$ID,$Icon,$Pos=false,$Size=false,$Title){
			$this->output.='<div class="modal" id="'.$ID.'" tabindex="-1" role="dialog">';
				$this->output.='<div class="modal-dialog'.$this->ModalPos($Pos).$this->ModalSize($Size).'" role="document">';
					$this->output.='<div class="modal-content" style="'.$this->Colors->_do_ColorBuilder('BGColor','Black','0.4').'">';
						$this->ModalHeader($ID,$Icon,$Title);
						$this->ModalBody($Zone);
					#	$this->ModalFooter();
					$this->output.='</div>';
				$this->output.='</div>';
			$this->output.='</div>';
		}
		private function ModalPos($data){
			switch($data){
				case '0':	return '';							break;
				case '1':	return ' modal-dialog-centered ';	break;
			}
		}
		private function ModalSize($data){
			switch($data){
				case '0':	return '';			break;
				case '1':	return ' modal-sm';	break;
				case '2':	return ' modal-lg';	break;
				case '3':	return ' modal-xl';	break;
			}
		}
		private function ModalHeader($ID,$Icon,$Title){
			$this->output.='<div class="modal-header">';
				$this->output.='<h5 class="modal-title" id="'.$ID.'">'.$Icon.' '.$Title.'</h5>';
				$this->output.='<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
					$this->output.='<span class="text-white" aria-hidden="true"><i class="fa fa-times-circle"></i></span>';
				$this->output.='</button>';
			$this->output.='</div>';
		}
		private function ModalBody($Zone){
			$this->output.='<div class="modal-body">';
				$this->output.='<div class="container-fluid">';
					$this->output.='<div id="modal-loader">';
						$this->output.='<div class="mx-auto bt-spinner"></div>';
					$this->output.='</div>';
					$this->output.='<div id="dynamic-content"></div>';
				$this->output.='</div>';
			$this->output.='</div>';
		}
		private function ModalFooter(){
			echo '<div class="modal-footer">';
				echo '<button type="button" class="btn btn-danger btn_close" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>';
				echo '<button type="button" class="btn btn-primary btn_save">Save changes</button>';
			echo '</div>';
		}
		public function _get_MDOAL_LINKS(){
			# Theme Modals
#			$this->Display($this->Paging->PAGE_ZONE,'settings_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
#			$this->Display($this->Paging->PAGE_ZONE,'bgcolor_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
#			$this->Display($this->Paging->PAGE_ZONE,'sb_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
#			$this->Display($this->Paging->PAGE_ZONE,'theme_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
#			$this->Display($this->Paging->PAGE_ZONE,'theme_enable_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
#			$this->Display($this->Paging->PAGE_ZONE,'theme_lock_modal','<i class="fa fa-pencil"></i>','0','2','Lock Setting');
#			$this->Display($this->Paging->PAGE_ZONE,'theme_unlock_modal','<i class="fa fa-pencil"></i>','0','2','Un-lock Setting');
#			$this->Display($this->Paging->PAGE_ZONE,'pane_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');

			# Session Modals
			$this->Display($this->Paging->PAGE_ZONE,'login_modal','<i class="fa fa-pencil"></i>','0','2','Login');
			$this->Display($this->Paging->PAGE_ZONE,'logout_modal','<i class="fa fa-pencil"></i>','0','2','Logout');

			# Registration Modals
			$this->Display($this->Paging->PAGE_ZONE,'register_modal','<i class="fa fa-pencil"></i>','0','2','Registration');
			$this->Display($this->Paging->PAGE_ZONE,'verify_userid_modal','<i class="fa fa-pencil"></i>','0','2','Check UserID Availability');
			$this->Display($this->Paging->PAGE_ZONE,'verify_displayname_modal','<i class="fa fa-pencil"></i>','0','2','Check Display Name Availability');
			# Mail Testing
#			$this->Display($this->Paging->PAGE_ZONE,'mail_test_modal','<i class="fa fa-pencil"></i>','0','2','Mail Test');
			# Plugins
#			$this->Display($this->Paging->PAGE_ZONE,'pl_stng_modal','<i class="fa fa-pencil"></i>','1','2','Edit Setting');
#			$this->Display($this->Paging->PAGE_ZONE,'plugin_info_modal','<i class="fa fa-pencil"></i>','1','2','Plugin Info');
			# User Profile
#			$this->Display($this->Paging->PAGE_ZONE,'settings_modal','<i class="fa fa-pencil"></i>','0','2','Update Profile Information');
#			$this->Display($this->Paging->PAGE_ZONE,'delete_modal','<i class="fa fa-pencil"></i>','0','2','Delete Journal Entry');
			# AP Update Info
#			$this->Display($this->Paging->PAGE_ZONE,'updater_modal','<i class="fa fa-pencil"></i>','1','3','Update Information');
###
			# Bit Modal
			$this->Display($this->Paging->PAGE_ZONE,'bit_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
			# Select Modal
			$this->Display($this->Paging->PAGE_ZONE,'select_modal','<i class="fa fa-pencil"></i>','1','1','Edit Setting');
			# Textual Modal
			$this->Display($this->Paging->PAGE_ZONE,'textual_modal','<i class="fa fa-pencil"></i>','1','1','Edit AP Settings');
			# Settings Modals
#			$this->Display($this->Paging->PAGE_ZONE,'settings_modal','<i class="fa fa-pencil"></i>','1','0','Edit Setting');
			$this->Display($this->Paging->PAGE_ZONE,'lock_modal','<i class="fa fa-pencil"></i>','1','0','Lock Setting');
			$this->Display($this->Paging->PAGE_ZONE,'unlock_modal','<i class="fa fa-pencil"></i>','1','0','Un-lock Setting');
			# Journal Modal
			$this->Display($this->Paging->PAGE_ZONE,'journal_modal','<i class="fa fa-pencil"></i>','1','0','Save Your Journal Entry');
#			$this->Modal->Display($this->PAGE_ZONE,'journal_modal','<i class="fa fa-pencil"></i>','0','2','Save Entry');
			# Site - HP Editor
			$this->Display($this->Paging->PAGE_ZONE,'hp_editor_modal','<i class="fa fa-pencil"></i>','0','2','Add New Post');
			$this->Display($this->Paging->PAGE_ZONE,'delete_post_modal','<i class="fa fa-pencil"></i>','0','2','Delete Post?');
			$this->Display($this->Paging->PAGE_ZONE,'unlock_modal','<i class="fa fa-pencil"></i>','0','2','Un-lock Setting');
			$this->Display($this->Paging->PAGE_ZONE,'userinfo_modal','<i class="fa fa-pencil"></i>','0','2','User Info');
		}
		function _get_MODAL_SCRIPTS(){
			echo '<div class="modals_js">';
			?>
			<script>
				$(document).ready(function(){
					// Login - Submit Login
					$(document).on("click",".open_login_modal",function(e){
						e.preventDefault();

						$("#login_modal #dynamic-content").html("");
						$("#login_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>Site/Session/login.php",
							type: "POST",
							data: $('form.login_form').serialize(),
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === 'true'){ ?>
							console.log(data);
							<?php } ?>
							$('#login_modal #dynamic-content').html('');
							$('#login_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#login_modal #modal-loader').hide("slow");
							setTimeout(' window.location.href = "?<?php echo $this->Setting->_arr["PAGE_PREFIX"]; ?>=HOME" ',4000);
						})
						.fail(function(){
							$('#login_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#login_modal #modal-loader').hide();
						});
					});
					// Logout
					$(document).on("click",".open_logout_modal",function(e){
						e.preventDefault();

						$("#logout_modal #dynamic-content").html("");
						$("#logout_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>Site/Session/logout.php",
							type: "POST",
							data: $('form.login_form').serialize(),
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === 'true'){ ?>
							console.log(data);
							<?php } ?>
							$('#logout_modal #dynamic-content').html('');
							$('#logout_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#logout_modal #modal-loader').hide("slow");
							setTimeout(' window.location.href = "?<?php echo $this->Setting->_arr["PAGE_PREFIX"]; ?>=HOME" ',4000);
						})
						.fail(function(){
							$('#logout_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#logout_modal #modal-loader').hide();
						});
					});
					// Register - Submit Registration
					$(document).on("click",".open_register_modal",function(e){
						e.preventDefault();

						$("#register_modal #dynamic-content").html("");
						$("#register_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>Site/Registration/register.php",
							type: "POST",
							data: $('form.register_form').serialize(),
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
							console.log(data);
							<?php } ?>
							$('#register_modal #dynamic-content').html('');
							$('#register_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#register_modal #modal-loader').hide("slow");
//							setTimeout(' window.location.href = "?<?php echo $this->Setting->_arr["PAGE_PREFIX"]; ?>=HOME" ',4000);
						})
						.fail(function(){
							$('#register_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#register_modal #modal-loader').hide();
						});
					});
					// Register - UserID Validator Modal
					$(document).on('click','.open_verify_userid_modal',function(e){
						e.preventDefault();

						$('#verify_userid_modal #dynamic-content').html('');
						$('#verify_userid_modal #modal-loader').show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>Site/Registration/verify_userid.php",
							type: 'POST',
							data: $('form#register').serialize(),
							dataType: 'html'
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1" || $this->Setting->_arr["DEBUG"] === "2"){ ?>
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
					// Register - Display Name Validator Modal
					$(document).on('click','.open_verify_displayname_modal',function(e){
						e.preventDefault();

						$('#verify_displayname_modal #dynamic-content').html('');
						$('#verify_displayname_modal #modal-loader').show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>Site/Registration/verify_displayname.php",
							type: 'POST',
							data: $('form').serialize(),
							dataType: 'html'
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1" || $this->Setting->_arr["DEBUG"] === "2"){ ?>
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
					});// Mail Test Modal
					// Mail Test
					$(document).on("click",".open_mail_test_modal",function(e){
						e.preventDefault();

						$("#mail_test_modal #dynamic-content").html("");
						$("#mail_test_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Mail/mail_test.php",
							type: "POST",
							data: $('form.mail_test_form').serialize(),
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
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
					// Settings - Bit
					$(document).on("click",".open_bit_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#bit_modal #dynamic-content").html("");
						$("#bit_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Theme/edit_theme_bit_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
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
					// Settings - Select
					$(document).on("click",".open_select_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#select_modal #dynamic-content").html("");
						$("#select_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Universal/Select/edit_stng_select.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
								console.log(data);
							<?php } ?>
							$('#select_modal #dynamic-content').html('');
							$('#select_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#select_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#select_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#select_modal #modal-loader").hide();
						});
					});
					// Settings - Textual
					$(document).on("click",".open_textual_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#textual_modal #dynamic-content").html('');
						$("#textual_modal #modal-loader").show();

						$.ajax({
							url			:	"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Universal/Textual/edit_stng_textual.php",
							type		:	"POST",
							data		:	"id="+uid,
							dataType	:	"html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
								console.log(data);
							<?php } ?>
							$("#textual_modal #dynamic-content").html("");
							$("#textual_modal #dynamic-content").hide().html(data).fadeIn("slow");
							$("#textual_modal #modal-loader").hide("slow");
						})
						.fail(function(){
							$("#textual_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#textual_modal #modal-loader").hide();
						});
					});
					// Settings - Color
					$(document).on("click",".open_bgcolor_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#bgcolor_modal #dynamic-content").html("");
						$("#bgcolor_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Theme/edit_theme_bgcolor_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
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
					// Settings - Sidebar
					$(document).on("click",".open_sb_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#sb_modal #dynamic-content").html("");
						$("#sb_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Theme/edit_theme_sidebar_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
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
					// Settings - Theme
					$(document).on("click",".open_theme_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#theme_modal #dynamic-content").html("");
						$("#theme_modal #modal-loader").show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Theme/edit_theme_site_theme_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
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
					// Settings - Pane
					$(document).on("click",".open_pane_modal",function(e){

						e.preventDefault();

						var uid = $(this).data("id");

						$("#pane_modal #dynamic-content").html("");
						$("#pane_modal #modal-loader").show();
						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Theme/edit_theme_pane_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
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
					// Settings - Theme Enable
					$(document).on("click",".open_theme_enable_modal",function(e){

						e.preventDefault();

						var uid = $(this).data("id");

						$("#theme_enable_modal #dynamic-content").html("");
						$("#theme_enable_modal #modal-loader").show();
						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Theme/edit_theme_enable_settings.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
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
					// Settings - Theme Lock
					$(document).on("click",".open_theme_lock_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#theme_lock_modal #dynamic-content").html("");
						$("#theme_lock_modal #modal-loader").show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>AP/Theme/theme_access_lock.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
								console.log(data);
							<?php } ?>
							$('#theme_lock_modal #dynamic-content').html('');
							$('#theme_lock_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#theme_lock_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#theme_lock_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#theme_lock_modal #modal-loader").hide();
						});
					});
					// Settings - Theme Unlock
					$(document).on("click",".open_theme_unlock_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#theme_unlock_modal #dynamic-content").html("");
						$("#theme_unlock_modal #modal-loader").show();
						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>AP/Theme/theme_access_unlock.php",
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
					// Settings - Editor
					$(document).on('click','.open_editor_modal',function(e){
						e.preventDefault();

						var uid = $(this).data('id');

						$('#settings_modal #dynamic-content').html('');
						$('#settings_modal #modal-loader').show();

						$.ajax({
							url			:	'<?php echo $this->Dirs->_arr["AJAX"];?>AP/Settings/edit_settings.php',
						//	enctype		:	'x-www-form-urlencoded',
						//	cache		:	false,
							type		:	'POST',
							datatype	:	'html',
							data		:	'id='+uid
						})
						.done(function(data){
							$('#settings_modal #dynamic-content').html('');
							$('#settings_modal #dynamic-content').hide().html(data).fadeIn('slow');
							$('#settings_modal #modal-loader').hide('slow');
						})
						.fail(function(){
							$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#settings_modal #modal-loader').hide();
						});
					});
					// Plugin - Editor
					$(document).on('click','.open_pl_editor_modal',function(e){
						e.preventDefault();

						var uid = $(this).data('id');

						$('#pl_stng_modal #dynamic-content').html('');
						$('#pl_stng_modal #modal-loader').show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Plugins/edit_plugins.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
						<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
							console.log(data);
						<?php } ?>
							$('#pl_stng_modal #dynamic-content').html('');
							$('#pl_stng_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#pl_stng_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$('#pl_stng_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#pl_stng_modal #modal-loader').hide();
						});
					});
					// Plugin - Info
					$(document).on('click','.open_plugin_info_modal',function(e){
						e.preventDefault();

						var uid = $(this).data('id');

						$('#plugin_info_modal #dynamic-content').html('');
						$('#plugin_info_modal #modal-loader').show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Plugins/plugin_info.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
						<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
							console.log(data);
						<?php } ?>
							$('#plugin_info_modal #dynamic-content').html('');
							$('#plugin_info_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#plugin_info_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$('#plugin_info_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#plugin_info_modal #modal-loader').hide();
						});
					});
					// Profile - Edit Profile Information
					$(document).on('click','.open_settings_modal',function(e){
						e.preventDefault();

						var uid = $(this).data('id');

						$('#settings_modal #dynamic-content').html('');
						$('#settings_modal #modal-loader').show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>Site/Profile/update_profile.php",
							type: 'POST',
							data: 'id='+uid,
							dataType: 'html'
						})
						.done(function(data){
						<?php if($this->Setting->_arr["DEBUG"] === "1" || $this->Setting->_arr["DEBUG"] === "2"){ ?>
							console.log(data);
						<?php } ?>
							$('#settings_modal #dynamic-content').html('');
							$('#settings_modal #dynamic-content').html(data);
							$('#settings_modal #modal-loader').hide();
						})
						.fail(function(){
							$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#settings_modal #modal-loader').hide();
						});
					});
					// Journal - Delete Entry
					$(document).on('click','.open_journal_delete_modal',function(e){
						e.preventDefault();

						var uid = $(this).data('id');

						$('#journal_delete_modal #dynamic-content').html('');
						$('#journal_delete_modal #modal-loader').show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>Site/Journal/entry_delete.php",
							type: 'POST',
							data: 'id='+uid,
							dataType: 'html'
						})
						.done(function(data){
						<?php if($this->Setting->_arr["DEBUG"] === "1" || $this->Setting->_arr["DEBUG"] === "2"){ ?>
							console.log(data);
						<?php } ?>
							$('#journal_delete_modal #dynamic-content').html('');
							$('#journal_delete_modal #dynamic-content').html(data);
							$('#journal_delete_modal #modal-loader').hide();
						})
						.fail(function(){
							$('#journal_delete_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#journal_delete_modal #modal-loader').hide();
						});
					});
					// Journal - Save Entry
					$(document).on('click','.open_journal_save_modal',function(e){
						e.preventDefault();

						var uid = $(this).data('id');

						$('#journal_save_modal #dynamic-content').html('');
						$('#journal_save_modal #modal-loader').show();

						$.ajax({
							url: '<?php echo $this->Dirs->_arr["AJAX"];?>Site/Journal/entry_save.php',
							type: 'POST',
							data: 'id='+uid,
							dataType: 'html'
						})
						.done(function(data){
						<?php if($this->Setting->_arr["DEBUG"] === "1" || $this->Setting->_arr["DEBUG"] === "2"){ ?>
							console.log(data);
						<?php } ?>
							$('#journal_save_modal #dynamic-content').html('');
							$('#journal_save_modal #dynamic-content').html(data);
							$('#journal_save_modal #modal-loader').hide();
						})
						.fail(function(){
							$('#journal_save_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#journal_save_modal #modal-loader').hide();
						});
					});
					// AP Update Info
					$(document).on('click','.open_updater_modal',function(e){
						e.preventDefault();

						var uid = $(this).data('id');

						$('#updater_modal #dynamic-content').html('');
						$('#updater_modal #modal-loader tac').show();

						$.ajax({
							url:"<?php echo $this->Dirs->_arr["AJAX"];?>AP/Updater/updater.php",
							type: 'POST',
							data: 'id='+uid,
							dataType: 'html'
						})
						.done(function(data){
						<?php if($this->Setting->_arr["DEBUG"] === "1"){ ?>
							console.log(data);
						<?php } ?>
							$('#updater_modal #dynamic-content').html('');
							$('#updater_modal #dynamic-content').html(data);
							$('#updater_modal #modal-loader').hide();
						})
						.fail(function(){
							$('#updater_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#updater_modal #modal-loader').hide();
						});
					});
					// Settings - Lock
					$(document).on("click",".open_lock_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#lock_modal #dynamic-content").html("");
						$("#lock_modal #modal-loader").show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>AP/Access/access_lock.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							$('#lock_modal #dynamic-content').html('');
							$('#lock_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#lock_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#lock_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#lock_modal #modal-loader").hide();
						});
					});
					// Settings - Un-lock
					$(document).on("click",".open_unlock_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#unlock_modal #dynamic-content").html("");
						$("#unlock_modal #modal-loader").show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>AP/Access/access_unlock.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
							$('#unlock_modal #dynamic-content').html('');
							$('#unlock_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#unlock_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#unlock_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#unlock_modal #modal-loader").hide();
						});
					});
					// Site - HP Editor
					$(document).on("click",".open_hp_editor",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#hp_editor_modal #dynamic-content").html("");
						$("#hp_editor_modal #modal-loader").show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>AP/editor.hp/hp_post_add.php",
							dataType: "html"
						})
						.done(function(data){
			//				console.log(data);
							$('#hp_editor_modal #dynamic-content').html('');
							$('#hp_editor_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#hp_editor_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#hp_editor_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#hp_editor_modal #modal-loader").hide();
						});
					});
					$(document).on("click",".open_deleter",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#delete_post_modal #dynamic-content").html("");
						$("#delete_post_modal #modal-loader").show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>AP/editor.hp/hp_del_post.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
			//				console.log(data);
							$('#delete_post_modal #dynamic-content').html('');
							$('#delete_post_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#delete_post_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$('#delete_post_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
							$('#delete_post_modal #modal-loader').hide();
						});
					});
					$(document).on("click",".open_unlock_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#unlock_modal #dynamic-content").html("");
						$("#unlock_modal #modal-loader").show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>AP/Access/access_unlock.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
			//				console.log(data);
							$('#unlock_modal #dynamic-content').html('');
							$('#unlock_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#unlock_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#unlock_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#unlock_modal #modal-loader").hide();
						});
					});
					// User Info
					$(document).on("click",".open_userinfo_modal",function(e){
						e.preventDefault();

						var uid = $(this).data("id");

						$("#userinfo_modal #dynamic-content").html("");
						$("#userinfo_modal #modal-loader").show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>AP/Misc/user_info.php",
							type: "POST",
							data: "id="+uid,
							dataType: "html"
						})
						.done(function(data){
			//				console.log(data);
							$('#userinfo_modal #dynamic-content').html('');
							$('#userinfo_modal #dynamic-content').hide().html(data).fadeIn("slow");
							$('#userinfo_modal #modal-loader').hide("slow");
						})
						.fail(function(){
							$("#userinfo_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
							$("#userinfo_modal #modal-loader").hide();
						});
					});
					// Journal
					$(document).on('click','.open_journal_modal',function(e){
						e.preventDefault();

						$('#journal_modal #dynamic-content').html('');
						$('#journal_modal #modal-loader').show();

						$.ajax({
							url: "<?php echo $this->Dirs->_arr["AJAX"];?>Journal/journal.php",
							type: 'POST',
							data: $('#New_Entry').serialize(),
							dataType: 'html'
						})
						.done(function(data){
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
			<?php
			echo '</div>';
		}
		public function _output(){
			echo $this->output;
		}
	}
?>