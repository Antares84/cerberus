<?php
	$this->User->Auth();
	$this->LogSys->createLog("Accessed Mail Settings");

	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			$this->SQL->_get_Options('SETTINGS_MAIN','Mail Settings','MAIL',true);
		echo '</div>';
	echo '</div>';

	$this->Modal->Display($this->Paging->PAGE_ZONE,'settings_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'lock_modal','<i class="fa fa-pencil"></i>','0','2','Lock Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'unlock_modal','<i class="fa fa-pencil"></i>','0','2','Un-lock Setting');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_editor_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#settings_modal #dynamic-content').html('');
			$('#settings_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[9];?>AJAX/AP/Settings/edit_settings.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
//				console.log(data);
				$('#settings_modal #dynamic-content').html('');
				$('#settings_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#settings_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#settings_modal #modal-loader').hide();
			});
		});
	});
	$(document).ready(function(){
		$(document).on('click','.open_lock_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#lock_modal #dynamic-content').html('');
			$('#lock_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[9];?>AJAX/AP/Access/access_lock.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
//				console.log(data);
				$('#lock_modal #dynamic-content').html('');
				$('#lock_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#lock_modal #modal-loader').hide("slow")
			})
			.fail(function(){
				$('#lock_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#lock_modal #modal-loader').hide();
			});
		});
	});
	$(document).ready(function(){
		$(document).on('click','.open_unlock_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#unlock_modal #dynamic-content').html('');
			$('#unlock_modal #modal-loader').show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[9];?>AJAX/AP/Access/access_unlock.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
//				console.log(data);
				$('#unlock_modal #dynamic-content').html('');
				$('#unlock_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#unlock_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#unlock_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#unlock_modal #modal-loader').hide();
			});
		});
	});
</script>