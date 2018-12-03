<?php
	$Title	=	NULL;
	$Body	=	NULL;

	# CONTENT
	$Title	.=	'Drop Finder';
	$Body	.=	'<button class="badge badge-primary m_auto open_plugin_modal" data-target="#plugin_modal" data-toggle="modal"><i class="fa fa-search"></i> Search</button>';

	echo $this->Tpl->PLUGIN_CARD($Title,'tac',$Body,'');

	$this->Modal->Display($this->PageZone,'plugin_modal','<i class="fa fa-search"></i>','0','2','Drop Finder - Item Search');
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.open_plugin_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#plugin_modal #dynamic-content').html('');
			$('#plugin_modal #modal-loader').show();

			$.ajax({
				url: '<?php echo $this->get_PLUGINS_DIR().$this->PLUGIN_NAME; ?>/ajax/search.php',
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