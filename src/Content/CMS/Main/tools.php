<?php
	if(!defined('IN_CMS')){exit;}

	$Show_Welcome=0;
#	if(isset($_SESSION) && $this->User->_is_ADM()){
		echo '<div class="container">';

			echo '<div class="text-white" style="background-color:#000;">';
			#	echo '<pre>';
			#		if(isset($_SESSION)){
			#			var_dump($_SESSION);
			#		}
			#	echo '</pre>';

				# Browser Data
				$data=array();
				$data["head"]=array("OS","Browser","UserAgent","IP");
				$data["body"]=array($this->Browser->OS,$this->Browser->Browser,$this->Browser->UA,$this->Browser->IP);

				$this->Tbl->_build_tb($data,'Tools');

			#	echo 'Visitor Log Status: '.$this->Visitors->log_status.'<br>';
				echo '<p>Total Online (last 5 minutes) <font class="badge badge-pill badge-info b_i">'.$this->Visitors->_output().'</font></p>';

				echo $this->DateTime->_time();

#				$date = new DateTime();
#				$datetime_formatted = date_format($date, 'Y-m-d H:i:s');
#				echo 'Date: '.$date.'<br>';

#				$this->Visitors->_show_contents();

			#	$this->Tpl->TitleBar('Session _arr Data','w_100_p');
			#	echo '<pre>';
			#		var_dump($this->Session->_arr);
			#	echo '</pre>';

			#	$this->Tpl->TitleBar('Session _arr_tmp Data','w_100_p');
			#	echo '<pre>';
			#		var_dump($this->Session->_tmp);
			#	echo '</pre>';

				if($Show_Welcome){
					echo '<div id="adm-auth" class="container-fluid">';
						echo 'Admin access granted.<br>';
						echo 'Please un-comment or add content to this page in order for it to be displayed.<br>';
					echo '</div>';
				}

/*
			$sql	=	('
							SELECT TOP 25 [UserUID],[UserID],[UserType],[Leave]
							FROM '.$this->db->_table_list("SH_USERDATA").'
							ORDER BY UserUID ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				echo '<div class="table-responsive">';
					echo '<table class="table table-sm acp_table text-white">';
						echo '<thead>';
							echo '<tr>';
								echo '<th>UserID</th>';
								echo '<th>User Type</th>';
								echo '<th>Status</th>';
								echo '<th></th>';
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
						while($data=odbc_fetch_array($stmt)){
							echo '<tr>';
								echo '<td class="tac">'.$data["UserID"].'</td>';
								echo '<td class="tac">'.$data["UserType"].'</td>';
								echo '<td class="tac">'.$this->Data->_do('online_status_2_text',$data["Leave"]).'</td>';
								echo '<td class="tac"><button class="badge badge-info open_userinfo_modal" data-id="'.$data["UserUID"].'" data-target="#userinfo_modal" data-toggle="modal"><i class="fa fa-unlock"></i> View</button></td>';
								echo '</tr>';
							#	echo '<button class="badge badge-info open_userinfo_modal" data-id="'.$data["UserUID"].'" data-target="#userinfo_modal" data-toggle="modal"><i class="fa fa-unlock"></i> View</button>';
						}
						echo '</tbody>';
					echo '</table>';
				echo '</div>';
			}

		#	$this->SQL->_update_stng_modals($ARR,$ARR_MSG,$ARRAY,$DB,$DEBUG,$QUERY);
		#	$this->SQL->_update_stng_modals(true,false,'textual','SETTINGS_MAIN',false,true);

/*
			# LoadLab Loader Testing
			echo '<div class="container-fluid">';
				echo '<div class="row">';
					echo '<div class="col-md-6"></div>';
					echo '<div class="col-md-2" style="border:1px solid lime;">';
						echo '<div class="spinner-fixed bt-spinner"></div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
*/
		#echo phpversion();
		#echo phpinfo(32);
		#echo $this->PHP->phpinfo2array();
/*
			echo 'CharID = 6 for [GM]RIAS<br>';
			$SH_CHARITEMS	=	new ShaiyaCharItems($this->db,6);

			if($key == "Lapis"){
				if($debug == 1 || $debug == 2){
					echo $SH_CHARITEMS->getLapis($debug);
				}
				#$SH_CHARITEMS->getLapis($debug);

				$retObj	=	$SH_CHARITEMS->getLapis($debug);
				echo '<div class="table-responsive">';
					echo '<table class="table table-bordered table-striped acp_table tac">';
						echo '<thead>';
							echo '<tr>';
								echo '<th>TypeID</th>';
								echo '<th>ItemName</th>';
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
						for($i=0;$i<count($retObj);$i++){
							echo '<tr>';
								echo '<td>'.$retObj[$i]["TypeID"].'<br>';
								echo '<td>'.$retObj[$i]["ItemName"].'<br>';
							echo '</tr>';
						}
						echo '</tbody>';
					echo '</table>';
				echo '</div>';
				die();
			}
			elseif($key == "Items"){
				if($debug == 1 || $debug == 2){
					echo $SH_CHARITEMS->readItems($debug);
				}
				$SH_CHARITEMS->getLapis($debug);
				$retObj	=	$SH_CHARITEMS->readItems($debug);
				echo '<div class="table-responsive">';
					echo '<table class="table table-bordered table-striped acp_table tac">';
						echo '<thead>';
							echo '<tr>';
								echo '<th>ItemName</th>';
								echo '<th>ItemID</th>';
								echo '<th>Bag</th>';
								echo '<th>Slot</th>';
								echo '<th>Quantity</th>';
#								echo '<th></th>';
#								echo '<th>ItemUID</th>';
#								echo '<th>Lapis Slot 1</th>';
#								echo '<th>Lapis Slot 2</th>';
#								echo '<th>Lapis Slot 3</th>';
#								echo '<th>Lapis Slot 4</th>';
#								echo '<th>Lapis Slot 5</th>';
#								echo '<th>Lapis Slot 6</th>';
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
						for($i=0;$i<count($retObj);$i++){
							echo '<tr>';
								echo '<td>'.$retObj[$i]["ItemName"].'</td>';
								echo '<td>'.$retObj[$i]["ItemID"].'</td>';
								echo '<td>'.$retObj[$i]["Bag"].'</td>';
								echo '<td>'.$retObj[$i]["Slot"].'</td>';
								echo '<td>'.$retObj[$i]["Count"].'</td>';
#								echo '<td>'.$retObj[$i]["ItemUID"].'</td>';
#								echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis1"]].'</td>';
#								echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis2"]].'</td>';
#								echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis3"]].'</td>';
#								echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis4"]].'</td>';
#								echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis5"]].'</td>';
#								echo '<td>'.$SH_CHARITEMS->Lapis_Array[$retObj[$i]["Lapis6"]].'</td>';
							echo '</tr>';
						}
						echo '</tbody>';
					echo '</table>';
				echo '</div>';
			}
*/
	#	echo $this->BossRecord->get_Record();
		echo '</div>';
		echo '</div>';
#	}
#	else{
#		echo 'You are not authorized to view this content.';
		#header("Location: ?".$this->Setting->PAGE_PREFIX."=HOME");
#	}
?>