<?php
	require_once('../../Autoloader.php');

	$db			=	new Database();
	$Select		=	new Select();
	$Data		=	new Data($db);
	$Theme		=	new Theme($db);
	$Style		=	new Style($db,$Theme);
	$Template	=	new Template($Data,$Style,$Theme);
	$Setting	=	new Setting($Data,$db,$Template);
	$db			=	new Database();

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	echo '<form class="encrypt_text">';
		$Template->input_group("Text","Text to encrypt...","","","Text","");
		#input_group($ID,$PLACEHOLDER,$VALUE,$ATTRIB,$PREPEND,$APPEND)

		echo '<div class="text-center f20">';
			echo '<button type="button" class="badge badge-warning" id="encrypt_text"><i class="fa fa-check-circle"></i> Encrypt Text</button>';
		echo '</div>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#encrypt_text").click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo $Style->JQUERY_ADDONS_DIR;?>ajax/Crypto/base64/base64_encrypt_submit.php",
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