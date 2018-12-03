<?php
	$this->User->Auth();
	$this->LogSys->createLog("Accessed Main ACP Settings");

	$this->Tpl->Titlebar('Style Settings');
	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			echo '<div class="table-responsive">';

			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE("SETTINGS_STYLE").'

			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				echo '<table id="mytable" class="table table-sm acp_table">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>Description</th>';
							echo '<th>Value</th>';
							echo '<th>Lock</th>';
							echo '<th>Modify</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					while($data = odbc_fetch_array($stmt)){
						echo '<tr>';
							echo '<td width="30%">'.$data["DESC"].'</td>';
							echo '<td width="50%">'.$data["VALUE"].'</td>';
						if($data["EDIT"] === "0"){
							echo '<td class="tac"><button class="badge badge-success open_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
						}
						else{
							echo '<td class="tac"><button class="badge badge-warning open_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
						}
						if($data["EDIT"] === "0"){
							echo '<td class="tac badge-danger"><i class="fa fa-lock"></i> Locked</td>';
						}else{
							echo '<td class="tac"><button class="badge badge-warning open_editor_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#settings_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
						}
						echo '</tr>';
					}
					echo '</tbody>';
				echo '</table>';
			}
			echo '</div>';
		echo '</div>';
	echo '</div>';

	$this->Modal->Display($this->Paging->PAGE_ZONE,'settings_modal','<i class="fa fa-pencil"></i>','0','2','Edit Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'lock_modal','<i class="fa fa-pencil"></i>','0','2','Lock Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'unlock_modal','<i class="fa fa-pencil"></i>','0','2','Un-lock Setting');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_editor_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#settings_modal #dynamic-content').html('');
			$('#settings_modal #modal-loader').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Styles/edit_styles.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);
				$('#settings_modal #dynamic-content').html('');
				$('#settings_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#settings_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#settings_modal #modal-loader').hide();
			});
		});
	});
	$(document).ready(function(){
		$(document).on('click','.open_lock_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#lock_modal #dynamic-content').html('');
			$('#lock_modal #modal-loader').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Styles/access_lock.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
//				console.log(data);
				$('#lock_modal #dynamic-content').html('');
				$('#lock_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#lock_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#lock_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#lock_modal #modal-loader').hide();
			});
		});
	});
	$(document).ready(function(){
		$(document).on('click','.open_unlock_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#unlock_modal #dynamic-content').html('');
			$('#unlock_modal #modal-loader').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Styles/access_unlock.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
//				console.log(data);
				$('#unlock_modal #dynamic-content').html('');
				$('#unlock_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#unlock_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#unlock_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#unlock_modal #modal-loader').hide();
			});
		});
	});
</script>