<?php
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			$this->Tpl->TitleBar("Supported Crypto Methods & Options");
			echo '<table id="mytable" class="table table-sm acp_table tac">';
				echo '<tr>';
					echo '<th>Encryption Method</th>';
					echo '<th>Encrypt</th>';
					echo '<th>Decrypt</th>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>Base64</td>';
					echo '<td><button class="btn btn-sm btn-primary base64_encrypt" data-id="" data-toggle="modal" data-target="#base64_encrypt_modal"><i class="fa fa-lock"></i> Encrypt</button></td>';
					echo '<td><button class="btn btn-sm btn-primary base64_decrypt" data-id="" data-toggle="modal" data-target="#base64_decrypt_modal"><i class="fa fa-unlock"></i> Decrypt</button></td>';
				echo '</tr>';
/*				echo '<tr>';
					echo '<td>PBKDF2</td>';
					echo '<td><button class="btn btn-sm btn-primary PBKDF2_encrypt" data-id="" data-toggle="modal" data-target="#base64_encrypt_modal"><i class="fa fa-trash"></i> Encrypt</button></td>';
					echo '<td><button class="btn btn-sm btn-primary PBKDF2_decrypt" data-id="" data-toggle="modal" data-target="#base64_decrypt_modal"><i class="fa fa-trash"></i> Decrypt</button></td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>BCRYPT</td>';
					echo '<td><button class="btn btn-sm btn-primary BCRYPT_encrypt" data-id="" data-toggle="modal" data-target="#base64_encrypt_modal"><i class="fa fa-trash"></i> Encrypt</button></td>';
					echo '<td><button class="btn btn-sm btn-primary BCRYPT_decrypt" data-id="" data-toggle="modal" data-target="#base64_decrypt_modal"><i class="fa fa-trash"></i> Decrypt</button></td>';
				echo '</tr>';
*/
			echo '</table>';
		echo '</div>';
	echo '</div>';

	$this->Modal->Display($this->Paging->PAGE_ZONE,'base64_encrypt_modal','<i class="fa fa-lock"></i>','0','2','Base64 Encrypt');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'base64_decrypt_modal','<i class="fa fa-unlock"></i>','0','2','Base64 Decrypt');
?>

<script>
	// Base64 Encrypt
	$(document).ready(function(){
		$(document).on("click",".base64_encrypt",function(e){
			e.preventDefault();

			var uid = $(this).val();

			$("#base64_encrypt_modal #dynamic-content").html("");
			$("#base64_encrypt_modal #modal-loader").show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[9];?>ajax/AP/Crypto/base64/base64_encrypt.php",
				type: "POST",
				data: "id="+uid,
				dataType: "html"
			})
			.done(function(data){
				$("#base64_encrypt_modal #dynamic-content").html("");
				$("#base64_encrypt_modal #dynamic-content").html(data);
				$("#base64_encrypt_modal #modal-loader").hide();
			})
			.fail(function(){
				$("#base64_encrypt_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
				$("#base64_encrypt_modal #modal-loader").hide();
			});
		});
	});
	// Base64 Decrypt
	$(document).ready(function(){
		$(document).on("click",".base64_decrypt",function(e){
			e.preventDefault();

			var uid = $(this).val();

			$("#base64_decrypt_modal #dynamic-content").html("");
			$("#base64_decrypt_modal #modal-loader").show();

			$.ajax({
				url: "<?php echo $this->Style->_style_array[9];?>ajax/AP/Crypto/base64/base64_decrypt.php",
				type: "POST",
				data: "id="+uid,
				dataType: "html"
			})
			.done(function(data){
				$("#base64_decrypt_modal #dynamic-content").html("");
				$("#base64_decrypt_modal #dynamic-content").html(data);
				$("#base64_decrypt_modal #modal-loader").hide();
			})
			.fail(function(){
				$("#base64_decrypt_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
				$("#base64_decrypt_modal #modal-loader").hide();
			});
		});
	});
</script>