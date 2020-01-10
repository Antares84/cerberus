<?php
	require_once('Autoloader.class.php');

	$Data		=	new Data();

	echo '<form class="encrypt_text">';
		echo '<div class="form-group row">';
			echo '<div class="col-sm-12">';
				echo '<div class="input-group">';
					echo '<div class="input-group-addon b_i"><i class="fa fa-info-circle"></i> Text</div>';
					echo '<input type="text" class="form-control b_i" name="Text" placeholder="Insert text to encrypt...">';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<button type="button" class="btn btn-success" id="encrypt_text" style="width:100%;"><i class="fa fa-check-circle"></i> Encrypt Text</button>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#encrypt_text").click(function(){
			$.ajax({
				type: "POST",
				url: "/bs_acp/ajax/crypto/base64/base64_encrypt_submit.php",
				data: $('form.encrypt_text').serialize(),
				success: function(message){
					$('#base64_encrypt_modal #dynamic-content').html(message);
				},
				error: function(){
					alert("Error");
				}
			});
		});
	});
</script>