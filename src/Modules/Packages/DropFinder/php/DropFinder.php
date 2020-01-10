<?php
	# CONTENT
	$Title='Drop Finder';
	$Body='<button class="badge badge-primary m_auto open_plugin_modal" data-target="#plugin_modal" data-toggle="modal"><i class="fa fa-search"></i> Search</button>';

	$T_Cards=new classes\Display\Templates\CMS\Cards;
	$T_Cards->_build('module',$Title,$Body,'','tac');
	$this->output.=$T_Cards->_output();

	$this->Modal->Display($this->PageZone,'plugin_modal','<i class="fa fa-search"></i>','0','2','Drop Finder - Item Search');
	$this->output.=$this->Modal->_output();
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.open_plugin_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#plugin_modal #dynamic-content').html('');
			$('#plugin_modal #modal-loader').show();

			$.ajax({
				url: '<?php echo $this->Dirs->_arr["MODULES"].$this->MODULE_NAME;?>/ajax/search.php',
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);
				$('#plugin_modal #dynamic-content').html('');
				$('#plugin_modal #dynamic-content').html(data);
				$('#plugin_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#plugin_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#plugin_modal #modal-loader').hide();
			});
		});
	});
</script>