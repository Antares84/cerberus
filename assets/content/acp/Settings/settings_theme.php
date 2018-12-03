<?php
	$this->User->Auth();
	$this->LogSys->createLog("accessed ACP Settings");

	# CONTENT
	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			$this->SQL->Options("SETTINGS_THEME","Theme Names","THEME",1);
			$this->SQL->Options("SETTINGS_THEME","Backgrounds","BG",0);
			$this->SQL->Options("SETTINGS_THEME","Background Colors","BG_COLOR",0);
			$this->SQL->Options("SETTINGS_THEME","Pane Settings","PANE",0);
			$this->SQL->Options("SETTINGS_THEME","Misc","Misc",0);
			$this->SQL->Options("SETTINGS_THEME","Nav","NAV",0);
			$this->SQL->Options("SETTINGS_THEME","Footer","FOOTER",0);
		echo '</div>';
	echo '</div>';

	$this->Modal->Display($this->Paging->PAGE_ZONE,'bit_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'text_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'bgcolor_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'sb_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'theme_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'lock_modal','<i class="fa fa-pencil"></i>','0','2','Lock Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'unlock_modal','<i class="fa fa-pencil"></i>','0','2','Un-lock Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'pane_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
?>
<script>
	$(document).ready(function(){
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
	});
</script>