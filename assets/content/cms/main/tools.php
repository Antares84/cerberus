<?php
	$key	=	isset($_REQUEST["key"])	?	$this->Data->escData(trim($_REQUEST["key"])) : false;

	$debug	=	0;
#	if(isset($_SESSION["Status"]) && $_SESSION["Status"] == 16){
		$this->Messenger->setSystemMessage(
			'danger',
			'some text'
		);
		echo '<div style="background-color:#000;">';
			$this->SQL->_get_paging();
		#	$this->Tpl->OUTPUT_TABLE_BODY();
			$data = $this->SQL->output;
#			echo $this->Tbl->array_depth($data);
#			echo $this->Tbl->array_depth($data["head"]);
#			$this->Tbl->test($data);
			echo '<div class="col-md-12">';
#			$this->Tbl->test_v2($data);
			$this->Tbl->_build($data);
			echo '</div>';
#			echo $this->Tbl->_ds_level_1($this->Tbl->head,'head');
#			$this->Tbl->Props();
#			echo $this->Tbl->test($data["head"]);
#			echo $this->Tbl->test($data["body"]);
#			echo $this->Tbl->_ds_level_1($data["head"],'th');
#			echo $this->Tbl->_ds_level_2($data["head"],'th');
#			echo $this->Tbl->_ds_level_3($data["head"],'th');

#			$this->Tbl->_ds_level_1($data["body"]);
#			$this->Tbl->_ds_level_2($data["body"]);
#			$this->Tbl->_ds_level_3($data["body"]);


			# PRE BLOCK

#			echo '<pre>';
				#var_dump($this->Tbl->head);
#				var_dump($data);
#			echo '</pre>';
#			exit();


			#$data	=	$this->Theme->_theme_array;
			#$data	=	$this->Style->_style_array;
			#echo $data	=	$this->Colors->_colors_array[0][1];
			#echo $this->Read->Read_File('./assets/','colors.txt');
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
			#echo @$data[2].'<br>';

#			foreach($data as $key => $value){
#				echo "[".$key."] = ".$value."<br>";
#			}
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

	#	echo $this->Version->do_VersionCheck();
	#	list($Codename,$Version,$Key,$VersionDate) = explode("_",$this->Version->do_VersionCheck());
	#	echo $this->Read->Read_File('assets/test/','test.php');
	#	echo $this->Tpl->PAGE_CARD("","",$this->PayPal->PAYPAL_URI,"");
	#	echo $this->db->do_QUERY("VALUE","SETTINGS_MAIN","SETTING","PAYPAL_LOG_TO_DB");
	#	echo $this->BossRecord->get_Record();
		
	#	echo 'Paging: '.$this->Paging->PageLink.'<br>';
	#	echo 'Landing CSS: '.$this->Style->UNI_CSS($this->Paging->PageZone,"STYLE","LANDING_CSS").'<br>';
	#	echo 'PageZone: '.$this->Paging->PageZone.'<br>';
	#	echo 'Master CSS: '.$this->Style->UNI_CSS($this->Paging->PageZone,"STYLE","MASTER_CSS").'<br>';
#			$this->Version->Load_Version_XML();
#		@simplexml_load_file("file.xml") or die('XMLParser: Failed to read object!');
*/
		echo '</div>';
#	}
#	else{
#		header("Location: ?".$this->Setting->PAGE_PREFIX."=HOME");
#	}
?>