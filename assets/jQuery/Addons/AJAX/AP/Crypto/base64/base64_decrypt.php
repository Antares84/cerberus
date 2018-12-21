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

	echo '<form class="decrypt_text">';
		#input_group($ID,$PLACEHOLDER,$VALUE,$ATTRIB,$PREPEND,$APPEND,$WIDTH=false)
		$Tpl->input_group('Text','Input Base64 text to decrypt...','','','','','');

		echo '<button type="button" class="btn btn-success" id="decrypt_text" style="width:100%;"><i class="fa fa-check-circle"></i> Decrypt Text</button>';
	echo '</form>';
?>
<script>
	$(document).ready(function(){
		$("button#decrypt_text").click(function(){
			$.ajax({
				type: "POST",
				url: "<?php echo $Style->_style_array[9];?>AJAX/AP/Crypto/base64/base64_decrypt_submit.php",
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