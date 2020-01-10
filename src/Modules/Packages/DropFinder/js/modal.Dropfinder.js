$(document).ready(function(){
	$(document).on('click','.open_plugin_modal',function(e){
		e.preventDefault();

		var uid = $(this).data('id');

		$('#plugin_modal #dynamic-content').html('');
		$('#plugin_modal #modal-loader').show();

		$.ajax({
			url: 'search.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
//			console.log(data);
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