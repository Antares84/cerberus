<?php
	require_once('../Autoloader.php');

	$Browser=new Browser();$db=new Database();$Select=new Select();$Data=new Data($db);$Theme=new Theme($db);$Messenger=new Messenger($Browser);$Style=new Style($db,$Theme);$Tpl=new Template($Data,$Messenger,$Select,$Style,$Theme);$Setting=new Setting($Data,$db,$Tpl);

	if($Setting->DEBUG === "1" || $Setting->DEBUG === "2"){
		echo '<pre>';
			echo var_dump($_POST);
		echo '</pre>';

		if($Setting->DEBUG === "2"){
			die();
		}
	}

	echo '<form class="encrypt_text">';
		$Tpl->input_group("Text","Text to encrypt...","","","","");

		echo '<div class="text-center f_20">';
			echo '<button type="button" class="badge badge-warning" id="encrypt_text"><i class="fa fa-check-circle"></i> Encrypt Text</button>';
		echo '</div>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#encrypt_text").click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo $Style->_style_array[9];?>AJAX/AP/Crypto/base64/base64_encrypt_submit.php",
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