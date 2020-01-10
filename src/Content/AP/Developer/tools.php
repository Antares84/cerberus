<?php
	$Show_Welcome=1;
	if(isset($_SESSION) && $this->User->_is_ADM()){
		if($Show_Welcome){
			echo '<div id="adm-auth" class="container-fluid">';
				echo 'Admin access granted.<br>';
				echo 'Please un-comment or add content to this page in order for it to be displayed.<br>';
			echo '</div>';
			$this->Tpl->Separator(20);
		}

		$fn			=	'page_index.txt';
		$validate	=	$this->FileSys->_do('validate','',$this->Dirs->_array[0],$fn,'',1);
		$read		=	$this->FileSys->_do('validate','',$this->Dirs->_array[0],$fn,'',2);
		$write		=	$this->FileSys->_do('validate','',$this->Dirs->_array[0],$fn,'',3);

		$this->Tpl->Titlebar('File Status','w_100_p');
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<idv class="col-md-12">';
					echo '<div class="table-responsive">';
						echo '<table class="table table-sm acp_table">';
							echo '<thead>';
								echo '<tr>';
									echo '<th>File Name</th>';
									echo '<th>Integrity Status</th>';
									echo '<th>Read Status</th>';
									echo '<th>Write Status</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';
								echo '<tr>';
									echo '<td class="tac">Pages</td>';
								if($validate == true){
									echo $this->FileSys->_return();

									if($read == true){
										echo $this->FileSys->_return();

										if($write == true){echo $this->FileSys->_return();}
										else{echo $this->FileSys->_return();}
									}
									else{
										echo $this->FileSys->_return();
										echo '<td></td>';
									}
								}
								else{
									echo $this->FileSys->_return();
									echo '<td></td>';
									echo '<td></td>';
								}
								echo '</tr>';
							#	echo '<tr>';
							#		echo '<td></td>';
							#		echo '<td></td>';
							#	echo '</tr>';
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<idv class="col-md-12">';
					echo $this->FileSys->_write_theme($this->Dirs->_array[0],'page_index.txt');
				echo '</div>';
			echo '</div>';
		echo '</div>';

		echo '<div class="text-white" style="background-color:#000;"></div>';
	}
	else{
		echo 'You are not authorized to view this content.';
		#header("Location: ?".$this->Setting->_array[0]."=HOME");
	}
?>