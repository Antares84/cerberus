<?php
#	$this->User->Auth();

	# AUTOREFRESH, $timer = 30, UNITS ARE IN SECONDS
	$time		=	10;
	$timezone	=	'EST';

	# Map ChatType integer to a meaningful string
	$ArrChatType	=	array(1=>'Normal',2=>'Whisper',3=>'Guild',4=>'Party',5=>'Trade',6=>'Yelling',7=>'Area');

	# Content
	$this->Tpl->Titlebar('Live In-Game Chat');
	echo '<div class="row">';
		echo '<div class="col-lg-12">';
			echo '<div class="ap_content tac">';
				echo '<h4 class="b_i">';
					echo date('l jS \of F Y h:i:s A').' '.$timezone.'<br> Auto-Update In: <font class="timer" data-seconds-left="'.$time.'"></font> Seconds';
				echo '</h4>';
				echo '<h4>Chat Legend:<br>';
					echo '&sect; <font style="'.$this->Colors->_do_ColorBuilder('COLOR','White').'">Normal</font> ';
					echo '&sect; <font style="'.$this->Colors->_do_ColorBuilder('COLOR','Magenta').'">Whisper</font> ';
					echo '&sect; <font style="'.$this->Colors->_do_ColorBuilder('COLOR','Purple').'">Guild</font> ';
					echo '&sect; <font style="'.$this->Colors->_do_ColorBuilder('COLOR','Green1').'">Party</font> ';
					echo '&sect; <font style="'.$this->Colors->_do_ColorBuilder('COLOR','Gold3').'">Trade</font> ';
					echo '&sect; <font style="'.$this->Colors->_do_ColorBuilder('COLOR','Orange2').'">Yelling</font> ';
					echo '&sect; <font style="'.$this->Colors->_do_ColorBuilder('COLOR','DarkBlue').'">Area</font> ';
					echo '&sect;';
				echo '</h4>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	echo '<div class="row" id="ChatLoader">';
		echo '<div class="col-lg-12" id="Chat">';
			# Query
			$sql	=	('
							SELECT TOP 250
								[CL].[CharID],[CL].[ChatType],[CL].[TargetName],[CL].[ChatData],[CL].[ChatTime],[CL].[MapID],
								[C].[CharName],[C].[Family],
								[M].[MapName]
							FROM '.$this->db->get_TABLE("SH_CHATLOG").'			AS [CL]
							INNER JOIN '.$this->db->get_TABLE("SH_CHARDATA").'	AS [C]		ON [C].[CharID]	=	[CL].[CharID]
							INNER JOIN '.$this->db->get_TABLE("SH_MAPS").'		AS [M]		ON [M].[MapID]	=	[CL].[MapID]
							ORDER BY [CL].[ChatTime] DESC
			');
			$result = odbc_exec($this->db->conn,$sql);

			echo '<div class="table-responsive">';
				echo '<table class="table table-sm table-striped acp_table">';
					echo '<thead>';
						echo '<tr>';
							echo '<th class="tac">Map</th>';
							echo '<th class="tac">Character</th>';
							echo '<th class="tac">Alliance of Light</th>';
							echo '<th class="tac">Union of Fury</th>';
							echo '<th class="tac">Date</th>';
						echo '</tr>';
					echo '</thead>';
					echo '<tbody>';
					$i=0;
					while($ChatData = odbc_fetch_array($result)){
						# Table Row Color Depending On Specific Faction
						if($ChatData['Family'] == 0 || $ChatData['Family'] == 1){
							echo '<tr style="'.$this->Colors->_do_ColorBuilder('BGColor','DarkBlue','0.25').'">';
						}
						elseif($ChatData['Family'] == 2 || $ChatData['Family'] == 3){
							echo '<tr style="'.$this->Colors->_do_ColorBuilder('BGColor','Red','0.25').'">';
						}
							# Character's Current Map
							if(isset($ChatData['MapName'])){
								echo '<th class="tac">'.$ChatData['MapName'].'</th>';
							}
							# Character Name && Stat Browser URI
							if(isset($ChatData['CharName'])){
								echo '<td class="tac b_i" style="'.$ChatData["ChatType"].'">';
									echo '<a href="?'.$this->Setting->PAGE_PREFIX.'=stat_edit&amp;char='.$ChatData['CharName'].'">'.$ChatData['CharName'].'</a>';
								echo '</td>';
							}
							# Chat Data
							if($ChatData['Family'] == 0 || $ChatData['Family'] == 1){
								if(!empty($ChatData['TargetName'])){
									echo '<td class="b_i" style="'.$this->Colors->GetChat($ChatData['ChatType']).'">';
										echo 'PM => '.$ChatData["TargetName"].': '.str_replace("_","'",$ChatData["ChatData"]);
									echo '</td>';
								}
								else{
									echo '<td class=" b_i" style="'.$this->Colors->GetChat($ChatData['ChatType']).'">';
										echo str_replace("_","'",$ChatData["ChatData"]);
									echo '</td>';
								}
								echo '<td>&nbsp;</td>';
							}
							elseif($ChatData['Family'] == 2 || $ChatData['Family'] == 3){
								echo '<td>&nbsp;</td>';
								if(!empty($ChatData['TargetName'])){
									echo '<td class=" b_i" style="'.$this->Colors->GetChat($ChatData['ChatType']).'">';
										echo 'PM => '.$ChatData["TargetName"].': '.str_replace("_","'",$ChatData["ChatData"]);
									echo '</td>';
								}
								else{
									echo '<td class=" b_i" style="'.$this->Colors->GetChat($ChatData['ChatType']).'">';
										echo str_replace("_","'",$ChatData["ChatData"]);
									echo '</td>';
								}
							}
							if(isset($ChatData['ChatTime'])){
								echo '<td class="tac">';
									echo date("M d, y H:i:s A", strtotime($ChatData['ChatTime']));
								echo '</td>';
							}
						echo '</tr>';
					$i++;
					}
					echo '</tbody>';
				echo '</table>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>
<!--
<script type="text/javascript">
	$('.timer').startTimer({
		onComplete: function(element){
			element.addClass('is-complete');
			$("#ChatLoader").load(location.href + " #Chat");
		},
		loop: true,
		loopInterval: 3,
	});
</script>
-->