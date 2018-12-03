<?php
	require_once('Autoloader.class.php');

	$db			=	new Database();
	$Data		=	new Data($db);

	echo '<form class="decrypt_text">';
		echo '<div class="form-group row">';
			echo '<div class="col-sm-12">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon b_i"><i class="fa fa-info-circle"></i></div>';
					echo '<input type="text" class="form-control b_i" name="Text" placeholder="Input Base64 text to decrypt...">';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<button type="button" class="btn btn-success" id="decrypt_text" style="width:100%;"><i class="fa fa-check-circle"></i> Decrypt Text</button>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#decrypt_text").click(function(){
			$.ajax({
				type: "POST",
				url: "ajax/crypto/base64/base64_decrypt_submit.php",
				data: $('form.decrypt_text').serialize(),
				success: function(message){
					$('#base64_decrypt_modal #dynamic-content').html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>