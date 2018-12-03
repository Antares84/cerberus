<?php
	$this->Tpl->Titlebar('Plugin Settings');
	echo '<div class="row" id="TableLoader">';
		echo '<div class="col-lg-12" id="TabularData">';
			echo '<div class="table-responsive">';

			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE("SETTINGS_PLUGINS").'
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				echo '<table id="mytable" class="table table-sm acp_table">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>Plugin Name</th>';
							echo '<th>Version</th>';
							echo '<th>Enabled</th>';
							echo '<th>Plugin Order</th>';
							echo '<th>Actions</th>';
							echo '<th>Access</th>';
							echo '<th>Info</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					while($data = odbc_fetch_array($stmt)){
						echo '<tr>';
							echo '<td>'.$data["PLUGIN_NAME"].'</td>';
							echo '<td class="tac">'.$data["PLUGIN_VERSION"].'</td>';
							echo '<td class="tac align-middle">'.$this->Data->bit_2_text($data["PLUGIN_ENABLED"]).'</td>';
							echo '<td class="tac">'.$data["PLUGIN_ORDER"].'</td>';
						if($data["EDIT"] === "0"){
							echo '<td class="tac badge-danger b_i"><i class="fa fa-lock"></i> Locked</td>';
						}else{
							echo '<td class="tac badge-primary align-middle"><button class="badge badge-info b_i open_editor_modal" data-id="'.$data['RowID'].'~'.$data["PLUGIN_ORDER"].'~'.$data["PLUGIN_ENABLED"].'" data-target="#settings_modal" data-toggle="modal"><i class="fa fa-gear"></i> Modify</button></td>';
						}
						if($data["EDIT"] === "0"){
							echo '<td class="tac badge-warning align-middle"><button class="badge badge-warning b_i open_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
						}else{
							echo '<td class="tac badge-danger align-middle"><button class="badge badge-warning b_i open_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
						}
							echo '<td class="tac align-middle"><button class="tac badge-pill badge-info open_plugin_info_modal" data-id="'.$data['RowID'].'~'.$data['PLUGIN_VERSION'].'~'.$data['PLUGIN_DATE'].'~'.$data['PLUGIN_ORDER'].'~'.$data['PLUGIN_OPT_0'].'~'.$data['PLUGIN_OPT_1'].'~'.$data['PLUGIN_OPT_2'].'~'.$data['PLUGIN_OPT_3'].'~'.$data['PLUGIN_OPT_4'].'~'.$data['PLUGIN_OPT_5'].'~'.$data['PLUGIN_OPT_6'].'~'.$data['PLUGIN_OPT_7'].'~'.$data['PLUGIN_OPT_8'].'~'.$data['PLUGIN_OPT_9'].'" data-target="#plugin_info_modal" data-toggle="modal"><i class="fa fa-info-circle"></i></button></td>';
						echo '</tr>';
					}
					echo '</tbody>';
				echo '</table>';
			}
			echo '</div>'; # close .table-responsive
		echo '</div>'; # close .col-lg-12
	echo '</div>'; # close .row

	$this->Modal->Display($this->Paging->PAGE_ZONE,'settings_modal','<i class="fa fa-pencil"></i>','1','2','Edit Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'plugin_info_modal','<i class="fa fa-pencil"></i>','1','2','Plugin Info');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'lock_modal','<i class="fa fa-pencil"></i>','1','2','Lock Setting');
	$this->Modal->Display($this->Paging->PAGE_ZONE,'unlock_modal','<i class="fa fa-pencil"></i>','1','2','Un-lock Setting');
?>
<script>
	$(document).ready(function(){
		$(document).on('click','.open_editor_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#settings_modal #dynamic-content').html('');
			$('#settings_modal #modal-loader').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Plugins/edit_plugins.php",
				type: "POST",
				data: "id="+uid,
				dataType: "html"
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
				$('#settings_modal #dynamic-content').html('');
				$('#settings_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#settings_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#settings_modal #modal-loader').hide();
			});
		});
		$(document).on('click','.open_plugin_info_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#plugin_info_modal #dynamic-content').html('');
			$('#plugin_info_modal #modal-loader').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Plugins/plugin_info.php",
				type: "POST",
				data: "id="+uid,
				dataType: "html"
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
				$('#plugin_info_modal #dynamic-content').html('');
				$('#plugin_info_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#plugin_info_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#plugin_info_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#plugin_info_modal #modal-loader').hide();
			});
		});
		$(document).on('click','.open_lock_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#lock_modal #dynamic-content').html('');
			$('#lock_modal #modal-loader').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Plugins/access_lock.php",
				type: "POST",
				data: "id="+uid,
				dataType: "html"
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
				$('#lock_modal #dynamic-content').html('');
				$('#lock_modal #dynamic-content').hide().html(data).fadeIn("slow");
				$('#lock_modal #modal-loader').hide("slow");
			})
			.fail(function(){
				$('#lock_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#lock_modal #modal-loader').hide();
			});
		});
		$(document).on('click','.open_unlock_modal',function(e){
			e.preventDefault();

			var uid = $(this).data('id');

			$('#unlock_modal #dynamic-content').html('');
			$('#unlock_modal #modal-loader').show();

			$.ajax({
				url:"<?php echo $this->Style->_style_array[9];?>AJAX/AP/Plugins/access_unlock.php",
				type: "POST",
				data: "id="+uid,
				dataType: "html"
			})
			.done(function(data){
				<?php if($this->Setting->DEBUG === "1"){ ?>
					console.log(data);
				<?php } ?>
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