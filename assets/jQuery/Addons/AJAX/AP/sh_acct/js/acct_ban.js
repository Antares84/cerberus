$(document).ready(function(){
	$("button#edit_page").click(function(){
		$.ajax({
			type: "POST",
			url: "ajax/acp/sh_acct/acct_ban_submit.php",
			data: $('form').serialize(),
			success: function(message){
				$('#acct_ban_modal #dynamic-content').html(message);
//					console.log('Reloading tabular data...');
				$("#TableLoader").load(location.href + " #TabularData");
			},
			error: function(){
				alert("Error");
			}
		});
	});
});