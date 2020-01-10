<?php
	namespace classes\db;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title			:	SQL.php																#
	#	Author			:	Bradley Sweeten														#
	#	Rel				:	CMS SQL class, used for running database queries					#
	#	Modified Date	:	10.27.2019	1528													#
	#############################################################################################
	class SQL{

		private $sql;
		private $stmt;
		private $args;

		private $LogType;
		private $UserUID;
		private $UserID;
		private $AcctStatus;
		private $OS;
		private $Browser;
		private $UserAgent;
		private $UserIP;
		private $SessID;
		private $RequestURI;
		private $Type;

		private $target;
		public $output;

		public function __construct($Arrays,$Colors,$Data,$db,$Setting,$Template,$User){
			$this->Arrays	=	$Arrays;
			$this->Colors	=	$Colors;
			$this->Data		=	$Data;
			$this->db		=	$db;
			$this->Setting	=	$Setting;
			$this->Tpl		=	$Template;
			$this->User		=	$User;

			$this->_class_info();
		}
		public function _class_info($level=false){
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
			}
		}

		# THEME FUNCTIONS
		function _get_Options($DB,$TITLEBAR,$SECTION=false,$SHOWHEAD=false,$S1=false,$S2=false,$S3=false,$S4=false){
			if($DB == "SETTINGS_MAIN"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->_table_list($DB).'
								WHERE [TYPE]=? AND [SHOW]=?
								ORDER BY [DESC] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($SECTION,1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					$this->Tpl->TitleBar($TITLEBAR,'w_100_p');
					echo '<div class="table-responsive">';
						echo '<table class="table table-sm acp_table">';
						if($SHOWHEAD == true){
							echo '<thead>';
								echo '<tr>';
									echo '<th>Description</th>';
									echo '<th>Setting</th>';
									echo '<th>Value</th>';
									echo '<th>Modify</th>';
									echo '<th>Access</th>';
									echo '<th>Info</th>';
								echo '</tr>';
							echo '</thead>';
						}
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								$this->target	=	$this->Arrays->_get_index_data('btn',$data['SETTING']);
								echo '<tr>';
									echo '<td class="col-2 tac">'.$data["DESC"].'</td>';
									echo '<td class="col-1 tac">'.$data["SETTING"].'</td>';
								if(in_array($data["SETTING"],$this->Arrays->_get_index_data('bg_color'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['SETTING']);
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_index_data('select'))){
									echo '<td class="col-6">'.$this->Data->_do('bit_2_text_string',$data["VALUE"]).'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['SETTING']);
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_index_data('enabled'))){
									echo '<td class="col-6">'.$this->Data->_do('ENABLE',$data["VALUE"]).'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['SETTING']);
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_index_data('sidebar'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['SETTING']);
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_index_data('textual'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['SETTING']);
								}
								else{
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['SETTING']);
								}
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
			}
			elseif($DB == "SETTINGS_PAGES"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->_table_list($DB).'
								WHERE SITE_TYPE=?
								ORDER BY [PAGE_CAT] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($SECTION);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					$this->Tpl->TitleBar($TITLEBAR,'w_100_p');
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
						if($SHOWHEAD == true){
							echo '<thead>';
								echo '<tr>';
									echo '<th>Site Type</th>';
									echo '<th>Page Category</th>';
									echo '<th>Page Zone</th>';
									echo '<th>Page Index</th>';
									echo '<th>Page URI</th>';
									echo '<th>Visible</th>';
									echo '<th>Modify</th>';
									echo '<th>Access</th>';
									echo '<th>Info</th>';
								echo '</tr>';
							echo '</thead>';
						}
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								$this->target	=	$this->Arrays->_get_index_data('btn',$data['PAGE_INDEX']);
								echo '<tr>';
									echo '<td class="tac">'.$this->Data->_do('conv_site_type',$data["SITE_TYPE"]).'</td>';
									echo '<td class="tac">'.$data["PAGE_CAT"].'</td>';
									echo '<td class="tac">'.$data["PAGE_ZONE"].'</td>';
									echo '<td class="tac">'.$data["PAGE_INDEX"].'</td>';
									echo '<td>'.$data["PAGE_URI"].'</td>';
									echo '<td class="tac">'.$this->Data->_do('bit_2_text_int',$data["PAGE_SHOW"]).'</td>';

								if(in_array($data["PAGE_INDEX"],$this->Arrays->_get_index_data('bg_color'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['SETTING']
									);
								}
								elseif(in_array($data["PAGE_INDEX"],$this->Arrays->_get_index_data('select'))){
									echo '<td class="col-6">'.$this->Data->_do('bit_2_text_string',$data["VALUE"]).'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['SETTING']);
								}
								elseif(in_array($data["PAGE_INDEX"],$this->Arrays->_get_index_data('enabled'))){
									echo '<td class="col-6">'.$this->Data->_do('ENABLE',$data["PAGE_INDEX"]).'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['PAGE_TITLE'],
																	$data['PAGE_URI'],
																	$data['PAGE_INDEX']
									);
								}
								elseif(in_array($data["PAGE_INDEX"],$this->Arrays->_get_index_data('sidebar'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['SETTING']
									);
								}
								elseif(in_array($data["PAGE_INDEX"],$this->Arrays->_get_index_data('textual'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['SETTING']
									);
								}
								else{
								#	echo '<td class="col-6">'.$data["PAGE_URI"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['PAGE_TITLE'],
																	$data['PAGE_URI'],
																	$data['PAGE_INDEX']
									);
								}
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
			}
			elseif($DB == "SETTINGS_PLUGINS"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->_table_list($DB).'
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
								echo '<td class="tac align-middle">'.$this->Data->_do_data('bit_2_text',$data["PLUGIN_ENABLED"]).'</td>';
								echo '<td class="tac">'.$data["PLUGIN_ORDER"].'</td>';
							if($data["EDIT"] === "0"){
								echo '<td class="tac badge-danger b_i"><i class="fa fa-lock"></i> Locked</td>';
							}
							else{
								echo '<td class="tac badge-primary align-middle"><button class="badge badge-info b_i open_pl_editor_modal" data-id="'.$data['RowID'].'~'.$data["PLUGIN_ORDER"].'~'.$data["PLUGIN_ENABLED"].'" data-target="#pl_stng_modal" data-toggle="modal"><i class="fa fa-gear"></i> Modify</button></td>';
							}
							if($data["EDIT"] === "0"){
								echo '<td class="tac badge-warning align-middle"><button class="badge badge-warning b_i open_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'~'.$DB.'" data-target="#unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
							}
							else{
								echo '<td class="tac badge-danger align-middle"><button class="badge badge-warning b_i open_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'~'.$DB.'" data-target="#lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
							}
								echo '<td class="tac align-middle"><button class="tac badge-pill badge-info open_plugin_info_modal" data-id="'.$data['RowID'].'~'.$data['PLUGIN_VERSION'].'~'.$data['PLUGIN_DATE'].'~'.$data['PLUGIN_ORDER'].'~'.$data['PLUGIN_OPT_0'].'~'.$data['PLUGIN_OPT_1'].'~'.$data['PLUGIN_OPT_2'].'~'.$data['PLUGIN_OPT_3'].'~'.$data['PLUGIN_OPT_4'].'~'.$data['PLUGIN_OPT_5'].'~'.$data['PLUGIN_OPT_6'].'~'.$data['PLUGIN_OPT_7'].'~'.$data['PLUGIN_OPT_8'].'~'.$data['PLUGIN_OPT_9'].'" data-target="#plugin_info_modal" data-toggle="modal"><i class="fa fa-info-circle"></i></button></td>';
							echo '</tr>';
						}
						echo '</tbody>';
					echo '</table>';
				}
			}elseif($DB == "SETTINGS_STYLE"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->_table_list($DB).'
								WHERE [SHOW]=?
								ORDER BY [RowID] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					$this->Tpl->TitleBar($TITLEBAR,'w_100_p');
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
						if($SHOWHEAD == true){
							echo '<thead>';
								echo '<tr>';
									echo '<th>Description</th>';
								#	echo '<th>Style</th>';
									echo '<th>Value</th>';
									echo '<th>Modify</th>';
									echo '<th>Access</th>';
									echo '<th>Info</th>';
								echo '</tr>';
							echo '</thead>';
						}
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								$this->target	=	$this->Arrays->_get_index_data('btn',$data['STYLE']);
								echo '<tr>';
									echo '<td class="col-2 tac">'.$data["DESC"].'</td>';
								#	echo '<td class="col-1 tac">'.$data["STYLE"].'</td>';
								if(in_array($data["STYLE"],$this->Arrays->_get_index_data('bg_color'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['STYLE']
									);
								}
								elseif(in_array($data["STYLE"],$this->Arrays->_get_index_data('select'))){
									echo '<td class="col-6">'.$this->Data->_do_data('bit_2_text_string',$data["VALUE"]).'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['STYLE']);
								}
								elseif(in_array($data["STYLE"],$this->Arrays->_get_index_data('enabled'))){
									echo '<td class="col-6">'.$this->Data->_do_data('ENABLE',$data["VALUE"]).'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['STYLE']
									);
								}
								elseif(in_array($data["STYLE"],$this->Arrays->_get_index_data('sidebar'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['STYLE']
									);
								}
								elseif(in_array($data["STYLE"],$this->Arrays->_get_index_data('textual'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['STYLE']
									);
								}
								else{
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['STYLE']
									);
								}
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
			}
			elseif($DB == "SETTINGS_THEME"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->_table_list($DB).'
								WHERE [SECTION]=? AND [SHOW]=?
								ORDER BY [DESC] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($SECTION,1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					$this->Tpl->TitleBar($TITLEBAR,'w_100_p');
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
						if($SHOWHEAD == true){
							echo '<thead>';
								echo '<tr>';
									echo '<th>Description</th>';
									echo '<th>Setting</th>';
									echo '<th>Value</th>';
									echo '<th>Modify</th>';
									echo '<th>Access</th>';
									echo '<th>Info</th>';
								echo '</tr>';
							echo '</thead>';
						}
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								$this->target	=	$this->Arrays->_get_index_data('btn',$data['SETTING']);
								echo '<tr>';
									echo '<td class="col-2 tac">'.$data["DESC"].'</td>';
									echo '<td class="col-1 tac">'.$data["SETTING"].'</td>';
								if(in_array($data["SETTING"],$this->Arrays->_get_index_data('bg_color'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['SETTING']
									);
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_index_data('select'))){
									echo '<td class="col-6">'.$this->Data->_do('bit_2_text_string',$data["VALUE"]).'</td>';
									$this->Tpl->_do_table_options($data['RowID'],$data['EDIT'],$DB,$this->target,$data['DESC'],$data['VALUE'],$data['SETTING']);
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_index_data('enabled'))){
									echo '<td class="col-6">'.$this->Data->_do('ENABLE',$data["VALUE"]).'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['SETTING']
									);
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_index_data('sidebar'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['SETTING']
									);
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_index_data('textual'))){
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['SETTING']
									);
								}
								else{
									echo '<td class="col-6">'.$data["VALUE"].'</td>';
									$this->Tpl->_do_table_options(
																	$data['RowID'],
																	$data['EDIT'],
																	$DB,
																	$this->target,
																	$data['DESC'],
																	$data['VALUE'],
																	$data['SETTING']
									);
								}
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
/*
				if($prep){
					$this->Tpl->TitleBar($TITLEBAR,'w_100_p');
					echo '<div class="table-responsive nContent">';
						echo '<table id="mytable" class="table table-sm acp_table">';
						if($SHOWHEAD){
							echo '<thead>';
								echo '<tr>';
									echo '<th style="width:20%">Description</th>';
									echo '<th style="width:50%">Value</th>';
									echo '<th style="width:10%">Access</th>';
									echo '<th style="width:10%">Modify</th>';
								echo '</tr>';
							echo '</thead>';
						}
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								echo '<tr>';
									echo '<td style="width:30%">'.$data["DESC"].'</td>';
								if(in_array($data["SETTING"],$this->Arrays->_get_array('enabled'))){
									echo '<td style="width:50%">'.$this->Data->_do('ENABLE',$data["VALUE"]).'</td>';
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_array('textual'))){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_array('bg_color'))){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_array('pane'))){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif(in_array($data["SETTING"],$this->Arrays->_get_array('sidebar'))){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif($data["SETTING"] == "CMS_THEME_NAME"){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								else{
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								if($data["EDIT"] == 0){
									echo '<td class="tac badge-warning align-middle" style="width:10%"><button class="badge badge-warning open_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'~'.$DB.'" data-target="#unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
									echo '<td class="tac badge-danger align-middle" style="width:10%"><i class="fa fa-lock"></i> Locked</td>';
								}
								elseif($data["EDIT"] == 1){
									echo '<td class="tac badge-success align-middle" style="width:10%"><button class="badge badge-warning open_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'~'.$DB.'" data-target="#lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
									echo '<td class="tac badge-success align-middle" style="width:10%"><button class="badge badge-primary open_editor_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'~'.$data["SETTING"].'~'.$DB.'" data-target="#settings_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
								}
								else{
									echo '<td class="tac badge-secondary" style="width:10%"><i class="fa fa-times"></i> Disabled</td>';
									echo '<td class="tac badge-secondary" style="width:10%"><i class="fa fa-times"></i> Disabled</td>';
								}
								echo '</tr>';
							}
							echo '</tbody>';
						echo '</table>';
					echo '</div>';
				}
*/
			}

			odbc_free_result($stmt);
			odbc_close($this->db->conn);
		}

		# SETTINGS FUNCTIONS
		function _get_SettingsCards($v1,$v2){
			$sql	=	('
							SELECT *
							FROM '.$this->db->_table_list("SETTINGS_PAGES").'
							WHERE PAGE_CAT=? AND PAGE_SHOW=?
							ORDER BY PAGE_DESC ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($v1,$v2);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					echo '<div class="col-md-4 m_b_30">';
						echo '<div class="card card-inverse" style="background-color:#333;border-color:#333;">';
							echo '<div class="card-header badge-secondary tac">'.$data["METATAG_DESC"].'</div>';
							echo '<div class="card-body tac">';
								echo '<p class="card-text">'.$data["PAGE_DESC"].'</p>';
								echo '<a class="badge badge-pill badge-warning f_16" href="?'.$this->Setting->_arr["PAGE_PREFIX"].'='.$data["PAGE_INDEX"].'">Modify</a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
			odbc_free_result($stmt);
			odbc_close($this->db->conn);
		}

		# REGISTRATION FUNCTIONS
		function _do_REGISTER_USER_GAME($UserID,$Pw,$Email,$UserIP){
			$ret	=	false;

			$sql	=	('
							INSERT INTO '.$this->db->_table_list('SH_USERDATA').'
								(UserID,Pw,Email,UserIP)
							VALUES
								(?,?,?,?)
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($UserID,$Pw,$Email,$UserIP);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$_SESSION["MESSAGES"]["type"][].='3';
				$_SESSION["MESSAGES"]["head"][].='3';
				$_SESSION["MESSAGES"]["body"][].='R-0x18';

				$ret	=	true;
			}else{
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x17';
			}

			return $ret;
		}
		function _do_REGISTER_USER_WEB($UserID,$Pw,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$RegIP,$UserIP){
			$ret	=	false;

			$sql	=	('
							INSERT INTO '.$this->db->_table_list('WEB_PRESENCE').'
								(UserID,Pw,DisplayName,DateOfBirth,Gender,Referer,SecQuestion,SecAnswer,ActivationKey,Email,RegIP,UserIP)
							VALUES
								(?,?,?,?,?,?,?,?,?,?,?,?)
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($UserID,$Pw,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP,$UserIP);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$ret	=	true;
			}

			return $ret;
		}

		# HOMEPAGE FUNCTIONS
		public function _load_hp(){
			$sql	=	('
							SELECT TOP 25 *
							FROM '.$this->db->_table_list("HOMEPAGE").'
							ORDER BY RowID ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					while($row = odbc_fetch_array($stmt)){
						return $row['Title'].'~'.html_entity_decode($row['Detail']);
					}
				}else{
					return array('Site Information','There is currently nothing to see here.<br>Please check back later and see what has been added.','tac');
				}
			}
		}
		function _do_playersOnline($variant=false,$usecolors=false,$customTh=false,$customTd=false){
			$return='';

			if($customTh && $customTd){
				$customTd = 'defaultTd';
			}
			if($variant == ''){
				$sql	=	"SELECT COUNT(*) AS 'Currently Online',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_USERDATA")." WHERE [Status]=0)AS 'Active Accounts',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE Del=0 AND CharName NOT LIKE '%]%')AS 'Living Characters',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_USERDATA")." WHERE [Status]='-5')AS 'Banned Accounts',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)) AS 'Alliance of Light',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)) AS 'Union of Fury',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=0) AS Fighter, 
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=1) AS Defender,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=2) AS Ranger,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=3) AS Archer,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=4) AS Mage,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=5) AS Priest,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=0) AS Warrior,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=1) AS Guardian,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=2) AS Assassin,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=3) AS Hunter,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=4) AS Pagan,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=5) AS Oracle 
							FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1
				";
			}
			elseif($variant=='1'){
				$sql	=	"SELECT COUNT(*) AS 'Alliance of Light',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=0) AS Fighter,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=1) AS Defender,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=2) AS Ranger,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=3) AS Archer,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=4) AS Mage,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=5) AS Priest
							FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)
				";
			}
			elseif($variant=='2'){
				$sql	=	"SELECT COUNT(*) AS 'Union of Fury',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=0) AS Warrior,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=1) AS Guardian,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=2) AS Assassin,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=3) AS Hunter,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=4) AS Pagan,
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=5) AS Oracle
							FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)
				";
			}
			elseif($variant=='3'){
				$sql	=	"SELECT COUNT(*) AS 'Currently Online',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_USERDATA")." WHERE [Status]=0)AS 'Active Accounts',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE Del=0 AND CharName NOT LIKE '%]%')AS 'Living Characters',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_USERDATA")." WHERE [Status]='-5')AS 'Banned Accounts',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)) AS 'Alliance of Light',
							(SELECT COUNT(*) FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)) AS 'Union of Fury'
							FROM ".$this->db->_table_list("SH_CHARDATA")." WHERE LoginStatus=1
				";
			}
			elseif($variant=='4'){
				$sql="
						SELECT COUNT(*) AS 'Currently Online'
						FROM ".$this->db->_table_list("SH_CHARDATA")."
						WHERE LoginStatus=1
				";
			}

			$execSql=odbc_exec($this->db->conn,$sql);
			$results=odbc_fetch_array($execSql);

			for($i=0;$i<odbc_num_fields($execSql);$i++){
				$fieldName=odbc_field_name($execSql,($i+1));
				$fieldValue=odbc_result($execSql,($i+1));

				if($usecolors){
					if($fieldName == 'Currently Online'){
						$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
						$fieldValue	=	'<span style="color:rgba(0,253,0,1);">'.$fieldValue.'</span>';
					}
					elseif($fieldName == 'Banned Accounts'){
						$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
						$fieldValue	=	'<span style="color:rgba(255,0,0,1);">'.$fieldValue.'</span>';
					}
					elseif($fieldName == 'Active Accounts'){
						$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
					}
					elseif($fieldName == 'Living Characters'){
						$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
					}
					elseif($fieldName == 'Alliance of Light'){
						if($variant > 0){
							$fieldName	=	'<th colspan="3" class="tac '.$customTh.'"><span style="font-size:18px;">'.$fieldName.'</span></th>';
							$fieldValue	=	'<span style="color:rgba(0,253,0,1);">'.$fieldValue.'</span>';
						}
						else{
							$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
						}
					}
					elseif($fieldName == 'Union of Fury'){
						if($variant > 0){
							$fieldName	=	'<th colspan="3" class="tac '.$customTh.'"><span style="font-size:18px;">'.$fieldName.'</span></th>';
							$fieldValue	=	'<span style="color:rgba(255,0,0,1);">'.$fieldValue.'</span>';
						}
						else{
							$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
						}
					}
					elseif($fieldName == 'Total Accounts'){
						$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
					}
					elseif($fieldName == 'Total Characters'){
						$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
					}
					else{
						$fieldName	=	'<th colspan="3" class="tac '.$customTh.'">'.$fieldName.'</th>';
					}
					$return .= '<tr>';
						$return .= $fieldName;
						$return .= '<td width="50" class="tac '.$customTd.'">'.$fieldValue.'</td>';
					$return .= '</tr>';
				}
				else{
					$return .= '<tr>';
						$return .= '<th colspan="3" align="left" class="'.$customTh.'"> '.$fieldName.' </th>';
						$return .= '<td width="50" class="'.$customTd.' tac">'.$fieldValue.'</td>';
					$return .= '</tr>';
				}
			}

			return $return;
			odbc_free_result($execSql);
		#	odbc_close($dbConn);
		}

		# BDSM MEMBERS LIST FUNCTIONS
		public function _get_members_list($begin,$max,$PageIndex){
			$sql	=	('
							SELECT top '.$max.' *
							FROM '.$this->db->_table_list("USER_DATA").'
							ORDER BY UserUID ASC
			');
			$res	=	odbc_exec($this->db->conn,$sql);

			$this->output	.=	'<div class="table-responsive">';
				$this->output	.=	'<table class="table table-sm table-inverse acp_table">';
					$this->output	.=	'<thead>';
						$this->output	.=	'<tr>';
							$this->output	.=	'<th class="tac">Name</th>';
						if($this->User->_is_ADM()){
							$this->output	.=	'<th class="tac">Member ID</th>';
						}
							$this->output	.=	'<th class="tac">Status</th>';
						$this->output	.=	'</tr>';
					$this->output	.=	'</thead>';
					$this->output	.=	'<tbody>';

					for($i=1;$data=odbc_fetch_array($res);$i++){
						if($i>=$begin){
							# online status
							if(isset($data['Leave'])){
								if($data['Leave']==0){$online=$this->Tpl->badge_pill(3,'Offline');}
								else{$online=$this->Tpl->badge_pill(2,'Online');}
							}
							else{$online=$this->Tpl->badge_pill(4,'Unknown');}

							$this->output	.=	'<tr>';
								$this->output	.=	'<td class="tac">'.$data["DisplayName"].'</td>';
							if($this->User->_is_ADM()){
								$this->output	.=	'<td class="tac">'.$data["MemberID"].'</td>';
							}
								$this->output	.=	'<td class="tac">'.$online.'</td>';
							$this->output	.=	'</tr>';
						}
					}
					$this->output	.=	'</tbody>';
				$this->output	.=	'</table>';
			$this->output	.=	'</div>';

			return $this->output;
		}
		public function _get_members_cnt($persite,$page,$PageIndex){
			$csql	=	('
						SELECT Count(UserUID) AS [Count]
						FROM '.$this->db->_table_list("USER_DATA")
			);
			$cres	=	odbc_exec($this->db->conn,$csql);

			$cfet	=	odbc_fetch_array($cres);
			$ccount	=	$cfet['Count'];
			$cpages	=	$ccount/$persite;

			return $this->Data->pagination($page,ceil($cpages),$url='?'.$this->Setting->_stng_array[0].'='.$PageIndex);
		}

		# BDSM Resources
		function _get_res($max,$PageIndex){
			$sql	=	('
							SELECT top '.$max.' *
							FROM '.$this->db->_table_list("FORUM").'
							ORDER BY TopicID ASC'
			);
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$this->output	.=	'<div class="table-responsive">';
					$this->output	.=	'<table id="myTable" class="table table-sm table-inverse acp_table">';
						$this->output	.=	'<thead>';
							$this->output	.=	'<tr>';
								$this->output	.=	'<th class="tac">Resource</th>';
								$this->output	.=	'<th class="tac"></th>';
							$this->output	.=	'</tr>';
						$this->output	.=	'</thead>';
						$this->output	.=	'<tbody>';
						while($data = odbc_fetch_array($stmt)){
							$this->output	.=	'<tr>';
								$this->output	.=	'<td class="tac">'.$data["TopicTitle"].'</td>';
								$this->output	.=	'<td class="tac"><a class="btn btn-sm btn-secondary center-block tac" href="?'.$this->Setting->_arr[0].'='.$PageIndex.'&res_id='.$data["TopicID"].'"><i class="fa fa-eye"></i> View</a></td>';
							$this->output	.=	'</tr>';
						}
						$this->output	.=	'</tbody>';
					$this->output	.=	'</table>';
				$this->output	.=	'</div>';

				return $this->output;
			}
		}
		function _get_res_cnt($persite,$page,$PageIndex){
			$csql	=	('
							SELECT Count(TopicID) AS [Count]
							FROM '.$this->db->_table_list("FORUM")
			);
			$cres	=	odbc_exec($this->db->conn,$csql);

			$cfet	=	odbc_fetch_array($cres);
			$ccount	=	$cfet['Count'];
			$cpages	=	$ccount/$persite;

			return $this->Data->pagination($page,ceil($cpages),$url='?'.$this->Setting->_arr[0].'='.$PageIndex);
		}
		function _get_res_show_post($TopicID){
			$sql	=	('
							SELECT top 1 TopicTitle,TopicBody
							FROM '.$this->db->_table_list("FORUM").'
							WHERE TopicID=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($TopicID);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					return $data["TopicTitle"].'~'.$data["TopicBody"];
				}
			}
		}

		# PAGING FUNCTIONS
		function _do_paging(){
			$data	=	array();

			$sql	=	("
							SELECT *
							FROM ".$this->db->_table_list("SETTINGS_PAGES")."
							ORDER BY ZONE DESC
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$data["head"][]	=	"Page Zone";
				$data["head"][]	=	"Page Index";
				$data["head"][]	=	"Page URI";
				$data["head"][]	=	"Show Page";
				$data["head"][]	=	"Edit";

				while($results = odbc_fetch_array($stmt)){
					if($results["SHOW"]){
						$data["body"][$results["RowID"]][]	=	$results["ZONE"];
						$data["body"][$results["RowID"]][]	=	$results["PAGE_INDEX"];
						$data["body"][$results["RowID"]][]	=	$results["PAGE_URI"];
						$data["body"][$results["RowID"]][]	=	$this->Data->_do_data('bit_2_text',$results["PAGE_SHOW"]);
						
						$data["body"][$results["RowID"]][]	=	'<button class="badge badge-primary open_editor_modal" data-id="'.$results["RowID"].'~'.$results["PAGE_INDEX"].'~'.$results["PAGE_URI"].'~'.$results["PAGE_SHOW"].'~'.$results["METATAG_TITLE"].'~'.$results["METATAG_DESC"].'~'.$results["METATAG_KEYWORDS"].'" data-target="#pages_modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</button>';
					#	$data["body"][$results["RowID"]][]	=	$results["SHOW"];
					}
				}

			#	$this->Tpl->OUTPUT_TABLE_HEAD($this->output["head"]);
			#	if($prep){
			#		while($RowID = odbc_fetch_array($stmt)){
			#			echo $this->Tpl->OUTPUT_TABLE_BODY($this->output["body"][$RowID["RowID"]]);
			#		}
			#	}
			}
			else{
				$this->output	=	"An error has occured!";
			}
			$this->output	=	$data;
		}
		public function _update_stng_modals($ARR,$ARR_MSG,$ARRAY,$DB,$DEBUG,$QUERY){
			$sql	=	('
							SELECT SETTING
							FROM '.$this->db->_table_list('SETTINGS_MAIN').'
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			echo '<div class="badge badge-pill f_16 badge-info">Array type: <b>'.$ARRAY.'</b></div><br><br>';

			if($prep){
				if(odbc_num_rows($stmt)>0){
					echo '<div class="badge badge-pill f_16 badge-info">Settings located</div><br><br>';
					while($data=odbc_fetch_array($stmt)){
						if($DEBUG){echo '<div class="badge badge-pill f_16 badge-info">Entered stmt...</div><br>';}
						foreach($data as $SETTING){
							if($DEBUG){echo '<div class="badge badge-pill f_16 badge-info">Entered foreach for <b>'.$SETTING.'</b>...</div><br>';}
							if($ARR){
								if($DEBUG){echo '<div class="badge badge-pill f_16 badge-info">Entered ARR for <b>'.$SETTING.'</b>...</div><br>';}
								if(in_array($SETTING,$this->Arrays->_get_index_data($ARRAY))){
									echo '<div class="badge badge-pill f_16 badge-success">Located setting: <b>'.$SETTING.'</b></div><br>';
									if($QUERY){
										if($DEBUG){echo '<div class="badge badge-pill f_16 badge-info">Entered QUERY...</div><br>';}
										$sql1	=	('
														UPDATE '.$this->db->_table_list($DB).'
														SET MODAL=?
														WHERE SETTING=?
										');
										$stmt1	=	odbc_prepare($this->db->conn,$sql1);
										$args1	=	array($ARRAY.'_modal',$SETTING);
										odbc_execute($stmt1,$args1);

										echo '<div class="badge badge-pill f_16 badge-success">Settings updated for setting: '.$SETTING.'</div><br><br>';
									}
									else{
										echo '<div class="badge badge-pill f_16 badge-danger">QUERY update locked...</div><br>';
									}
								}
								else{
									if($ARR_MSG){
										echo '<div class="badge badge-pill f_16 badge-danger"><b>'.$SETTING.'</b> not found in ARR...</div><br>';
										echo $ARRAY.'<br>';

										echo '<pre>';
											var_dump($this->Arrays->_get_index_data('textual'));
										echo '</pre>';
										exit;
									}
									echo '<div class="badge badge-pill f_16 badge-danger">Unable to locate the following setting for update: '.$SETTING.'<br>Maybe it\'s located in a different array..?</div><br><br>';
								}
							}
							else{
								echo '<pre>';
									var_dump($this->Arrays->_get_index_data('textual'));
								echo '</pre>';

								echo '<pre>';
									var_dump($data);
								echo '</pre>';
							}
						}
					}
				}
				else{
					echo '<div class="badge badge-pill f_16 badge-danger">Unable to locate settings...</div><br><br>';
				}
			}
		}

		# LOGIN
		public function _insert_sess_log(){
			if($this->Type===1){
				$sql	=	("
								INSERT INTO ".$this->db->_table_list("LOG_SESSION")."
									(LogType,UserUID,UserID,AcctStatus,OS,Browser,UserAgent,UserIP,SID,RequestURI)
								VALUES
									(?,?,?,?,?,?,?,?,?,?)
				");
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(
				$this->LogType,
				$this->UserUID,
				$this->UserID,
				$this->AcctStatus,
				$this->OS,
				$this->Browser,
				$this->UserAgent,
				$this->UserIP,
				$this->SessID,
				$this->RequestURI
			);
				odbc_execute($stmt,$args);

				$this->_upd_acct_status();
			}
			elseif($this->Type===2){
				$sql	=	("
								INSERT INTO ".$this->db->_table_list("LOG_SESSION")."
									(LogType,OS,Browser,UserAgent,UserIP,SID,RequestURI)
								VALUES
									(?,?,?,?,?,?,?)
				");
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($this->LogType,$this->OS,$this->Browser,$this->UserAgent,$this->UserIP,$this->SessID,$this->RequestURI);
				odbc_execute($stmt,$args);
			}
			elseif($this->Type===3){}
			else{
				exit(__FUNCTION__ .'<br>Type invalid for specified action!<br>Type: '.$this->Type);
			}

		#	$this->_free_res();
			$this->_close();
		#	$this->_unset();
		}
		public function _upd_acct_status(){
			$sql	=	("
							UPDATE ".$this->db->_table_list("WEB_PRESENCE")."
							SET LoginStatus=?
							WHERE UserUID=?
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array(true,$this->UserUID);
			odbc_execute($stmt,$args);
		}
		public function _set_params($data){
			# SESSION
			if(isset($data["LogType"]) && !empty($data["LogType"])){$this->LogType=$data["LogType"];}
			if(isset($data["UserUID"]) && !empty($data["UserUID"])){$this->UserUID=$data["UserUID"];}
			if(isset($data["UserID"]) && !empty($data["UserID"])){$this->UserID=$data["UserID"];}
			if(isset($data["Status"]) && !empty($data["Status"])){$this->AcctStatus=$data["Status"];}
			if(isset($data["OS"]) && !empty($data["OS"])){$this->OS=$data["OS"];}
			if(isset($data["Browser"]) && !empty($data["Browser"])){$this->Browser=$data["Browser"];}
			if(isset($data["UA"]) && !empty($data["UA"])){$this->UserAgent=$data["UA"];}
			if(isset($data["IP"]) && !empty($data["IP"])){$this->UserIP=$data["IP"];}
			if(isset($data["SID"]) && !empty($data["SID"])){$this->SessID=$data["SID"];}
			if(isset($data["REQUEST_URI"]) && !empty($data["REQUEST_URI"])){$this->REQUEST_URI=$data["REQUEST_URI"];}
			if(isset($data["Type"]) && !empty($data["Type"])){$this->Type=$data["Type"];}
		}
		# MISC
		private function _free_res(){
			odbc_free_result($this->stmt);
		}
		private function _close(){
			odbc_close($this->db->conn);
		}
		private function _return($value){
			if($value===true){
				return 1;
			}
			else{
				return 0;
			}
		}
		private function _unset(){
			$method	=	get_class_methods($this);

			foreach($method as $method_name){
				$this->$method_name=false;
			}
		}
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		public function _Mthds(){
			$class_methods	=	get_class_methods($this);
			echo '<div class="col-md-12">';
				echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
				echo '<pre>';
				foreach($class_methods as $method_name){
					echo $method_name.'<br>';
				}
				echo '</pre>';
			echo '</div>';
			exit();
		}
		
	}
?>