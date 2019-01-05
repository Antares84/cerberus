<?php
	class SQL{

		# ARRAYS
		public $BG_COLOR_ARRAY;public $BIT_ARRAY;public $ENABLED_ARRAY;public $TXT_ARRAY;public $SB_ARRAY;public $PANE_ARRAY;
		public $output;

		function __construct($Data,$db,$Setting,$Template){
			$this->db			=	$db;
			$this->Data			=	$Data;
			$this->Setting		=	$Setting;
			$this->Tpl			=	$Template;

			# Launch Array Builder
			$this->_array_builder();
		}
		# ARRAYS
		function _array_builder(){
			$this->BG_COLOR_ARRAY	=	array(
												'NAV_BG_COLOR',
												'CARD_BG_COLOR',
												'TITLE_BG_COLOR',
												'BREAD_BG_COLOR'
			);

			$this->ENABLED_ARRAY	=	array(
											'DEBUG',
											'FOOTER_BLOCK_A',
											'FOOTER_BLOCK_B',
											'FOOTER_BLOCK_C',
											'HTTPS_SSL',
											'LOGGING',
											'MAINTENANCE',
											'NAV_SERVER_STATUS',
											'SETUP',
											'SHOW_SIDE_NAV',
											'USE_PLUGINS'
			);

			$this->PANE_ARRAY	=	array(
											'PANE_BG_COLOR',
											'PANE_BG_TRANS'
			);

			$this->SB_ARRAY		=	array(
											'SIDEBAR_POS'
			);

			$this->TXT_ARRAY	=	array(
											'CMS_BG',
											'ACP_BG',
											'LOGO_IMG',
											'FAVICON_IMAGE',
											'FOOTER'
			);
			$this->THEME_ARRAY	=	array(
											'CMS_THEME_NAME'
			);
		}
		# THEME FUNCTIONS
		function _get_Options($DB,$TITLEBAR,$SECTION=false,$SHOWHEAD=false){
			if($DB == "SETTINGS_MAIN"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->get_TABLE($DB).'
								WHERE [TYPE]=? AND [SHOW]=?
								ORDER BY [DESC] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($SECTION,1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					$this->Tpl->TitleBar($TITLEBAR);
					echo '<div class="table-responsive">';
						echo '<table id="mytable" class="table table-sm acp_table">';
						if($SHOWHEAD == true){
							echo '<thead>';
								echo '<tr>';
									echo '<th>Description</th>';
									echo '<th>Value</th>';
									echo '<th>Access</th>';
									echo '<th>Modify</th>';
								echo '</tr>';
							echo '</thead>';
						}
							echo '<tbody>';
							while($data = odbc_fetch_array($stmt)){
								echo '<tr>';
									echo '<td style="width:30%">'.$data["DESC"].'</td>';
								if(in_array($data["SETTING"],$this->BG_COLOR_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif(in_array($data["SETTING"],$this->BIT_ARRAY)){
									echo '<td style="width:50%">'.$this->Data->bit_2_text2($data["VALUE"]).'</td>';
								}
								elseif(in_array($data["SETTING"],$this->ENABLED_ARRAY)){
									echo '<td style="width:50%">'.$this->Data->ENABLE($data["VALUE"]).'</td>';
								}
								elseif(in_array($data["SETTING"],$this->SB_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								elseif(in_array($data["SETTING"],$this->TXT_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}
								else{
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
								}

								if($data["EDIT"] == 0){
									echo '<td class="tac badge-warning"><button class="badge badge-warning open_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'~'.$DB.'" data-target="#unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
									echo '<td class="tac badge-danger"><i class="fa fa-lock"></i> Locked</td>';
								}
								elseif($data["EDIT"] == 1){
									echo '<td class="tac badge-success"><button class="badge badge-warning open_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'~'.$DB.'" data-target="#lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
									echo '<td class="tac badge-success"><button class="badge badge-warning open_editor_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'~'.$data["SETTING"].'~'.$DB.'" data-target="#settings_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
								}
								else{
									echo '<td class="tac badge-secondary"><i class="fa fa-times"></i> Disabled</td>';
									echo '<td class="tac badge-secondary"><i class="fa fa-times"></i> Disabled</td>';
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
								FROM '.$this->db->get_TABLE($DB).'
								WHERE [SECTION]=? AND [SHOW]=?
								ORDER BY [DESC] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($SECTION,1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					$this->Tpl->TitleBar($TITLEBAR);
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
								if(in_array($data["SETTING"],$this->ENABLED_ARRAY)){
									echo '<td style="width:50%">'.$this->Data->ENABLE($data["VALUE"]).'</td>';
									if($data["EDIT"] == 0){
						#				echo '<td class="tac badge-warning align-middle" style="width:10%"><button class="badge badge-warning open_theme_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
						#				echo '<td class="tac badge-danger align-middle" style="width:10%"><i class="fa fa-lock"></i> Locked</td>';
									}
									elseif($data["EDIT"] == 1){
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="badge badge-warning open_theme_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="btn btn-sm btn-primary open_theme_enable_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#theme_enable_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
									}
								}
								elseif(in_array($data["SETTING"],$this->TXT_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
									if($data["EDIT"] == 0){
						#				echo '<td class="tac badge-warning align-middle" style="width:10%"><button class="badge badge-warning open_theme_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
						#				echo '<td class="tac badge-danger align-middle" style="width:10%"><i class="fa fa-lock"></i> Locked</td>';
									}
									elseif($data["EDIT"] == 1){
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="badge badge-warning open_theme_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="btn btn-sm btn-primary open_text_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#text_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
									}
								}
								elseif(in_array($data["SETTING"],$this->BG_COLOR_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
									if($data["EDIT"] == 0){
						#				echo '<td class="tac badge-warning align-middle" style="width:10%"><button class="badge badge-warning open_theme_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
						#				echo '<td class="tac badge-danger align-middle" style="width:10%"><i class="fa fa-lock"></i> Locked</td>';
									}
									elseif($data["EDIT"] == 1){
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="badge badge-warning open_theme_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="btn btn-sm btn-primary open_bgcolor_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#bgcolor_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
									}
								}
								elseif(in_array($data["SETTING"],$this->PANE_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
									if($data["EDIT"] == 0){
						#				echo '<td class="tac badge-warning align-middle" style="width:10%"><button class="badge badge-warning open_theme_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
						#				echo '<td class="tac badge-danger align-middle" style="width:10%"><i class="fa fa-lock"></i> Locked</td>';
									}
									elseif($data["EDIT"] == 1){
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="badge badge-warning open_theme_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="btn btn-sm btn-primary open_pane_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'~'.$data["SETTING"].'" data-target="#pane_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
									}
								}
								elseif(in_array($data["SETTING"],$this->SB_ARRAY)){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
									if($data["EDIT"] == 0){
						#				echo '<td class="tac badge-warning align-middle" style="width:10%"><button class="badge badge-warning open_theme_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
						#				echo '<td class="tac badge-danger align-middle" style="width:10%"><i class="fa fa-lock"></i> Locked</td>';
									}
									elseif($data["EDIT"] == 1){
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="badge badge-warning open_theme_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="btn btn-sm btn-primary open_sb_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#sb_modal" data-toggle="modal"><i class="fa fa-eye"></i> Edit</button></td>';
									}
								}
								elseif($data["SETTING"] == "CMS_THEME_NAME"){
									echo '<td style="width:50%">'.$data["VALUE"].'</td>';
									if($data["EDIT"] == 0){
						#				echo '<td class="tac badge-warning align-middle" style="width:10%"><button class="badge badge-warning open_theme_unlock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_unlock_modal" data-toggle="modal"><i class="fa fa-unlock"></i> Un-lock</button></td>';
						#				echo '<td class="tac badge-danger align-middle" style="width:10%"><i class="fa fa-lock"></i> Locked</td>';
									}
									elseif($data["EDIT"] == 1){
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="badge badge-warning open_theme_lock_modal" data-id="'.$data['RowID'].'~'.$data['EDIT'].'" data-target="#theme_lock_modal" data-toggle="modal"><i class="fa fa-lock"></i> Lock</button></td>';
						#				echo '<td class="tac badge-success align-middle" style="width:10%"><button class="btn btn-sm btn-primary open_theme_modal" data-id="'.$data['RowID'].'~'.$data['DESC'].'~'.$data['VALUE'].'" data-target="#theme_modal" data-toggle="modal"><i class="fa fa-eye"></i> Modify</button></td>';
									}
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
			}
			elseif($DB == "SETTINGS_PLUGINS"){
				$sql	=	('
								SELECT *
								FROM '.$this->db->get_TABLE($DB).'
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
			}

			odbc_free_result($stmt);
			odbc_close($this->db->conn);
		}
		# SETTINGS FUNCTIONS
		function _get_SettingsCards($v1,$v2){
			$sql	=	('
							SELECT *
							FROM '.$this->db->get_TABLE("SETTINGS_PAGES").'
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
								echo '<a class="badge badge-pill badge-warning f_16" href="?'.$this->Setting->PAGE_PREFIX.'='.$data["PAGE_INDEX"].'">Modify</a>';
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
							INSERT INTO '.$this->db->get_TABLE('SH_USERDATA').'
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
		function _do_REGISTER_USER_WEB($UserID,$Pw,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP){
			$ret	=	false;

			$sql	=	('
							INSERT INTO '.$this->db->get_TABLE('WEB_PRESENCE').'
								(UserID,Pw,DisplayName,DOB,Gender,Referer,SecQuestion,SecAnswer,ActivationKey,Email,UserIP)
							VALUES
								(?,?,?,?,?,?,?,?,?,?,?)
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($UserID,$Pw,$DisplayName,$DOB,$Gender,$Referer,$SecQuestion,$SecAnswer,$ActivationKey,$Email,$UserIP);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$_SESSION["MESSAGES"]["type"][].='3';
				$_SESSION["MESSAGES"]["head"][].='3';
				$_SESSION["MESSAGES"]["body"][].='R-0x20';

				$ret	=	true;
			}
			else{
				$_SESSION["MESSAGES"]["type"][].='0';
				$_SESSION["MESSAGES"]["head"][].='0';
				$_SESSION["MESSAGES"]["body"][].='R-0x19';
			}

			return $ret;
		}
		# HOMEPAGE FUNCTIONS
		function _do_LOAD_HP(){
			$sql	=	('
							SELECT TOP 25 *
							FROM '.$this->db->get_TABLE("HOMEPAGE").'
							ORDER BY RowID ASC
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array();
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					while($row = odbc_fetch_array($stmt)){
						echo $this->Tpl->PAGE_CARD($row['Title'],'',html_entity_decode($row['Detail']),'');
						
					}
				}else{
					echo $this->Tpl->PAGE_CARD('Site Information','tac','There is currently nothing to see here. Please check back later and see what has been added.','');
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
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE [Status]=0)AS 'Active Accounts',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE Del=0 AND CharName NOT LIKE '%]%')AS 'Living Characters',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE [Status]='-5')AS 'Banned Accounts',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)) AS 'Alliance of Light',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)) AS 'Union of Fury',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=0) AS Fighter, 
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=1) AS Defender,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=2) AS Ranger,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=3) AS Archer,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=4) AS Mage,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=5) AS Priest,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=0) AS Warrior,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=1) AS Guardian,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=2) AS Assassin,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=3) AS Hunter,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=4) AS Pagan,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=5) AS Oracle 
							FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1
				";
			}
			elseif($variant=='1'){
				$sql	=	"SELECT COUNT(*) AS 'Alliance of Light',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=0) AS Fighter,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=1) AS Defender,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=2) AS Ranger,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=3) AS Archer,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=4) AS Mage,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1) AND Job=5) AS Priest
							FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)
				";
			}
			elseif($variant=='2'){
				$sql	=	"SELECT COUNT(*) AS 'Union of Fury',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=0) AS Warrior,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=1) AS Guardian,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=2) AS Assassin,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=3) AS Hunter,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=4) AS Pagan,
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3) AND Job=5) AS Oracle
							FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)
				";
			}
			elseif($variant=='3'){
				$sql	=	"SELECT COUNT(*) AS 'Currently Online',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE [Status]=0)AS 'Active Accounts',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE Del=0 AND CharName NOT LIKE '%]%')AS 'Living Characters',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_USERDATA")." WHERE [Status]='-5')AS 'Banned Accounts',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (0,1)) AS 'Alliance of Light',
							(SELECT COUNT(*) FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1 AND Family IN (2,3)) AS 'Union of Fury'
							FROM ".$this->db->get_TABLE("SH_CHARDATA")." WHERE LoginStatus=1
				";
			}
			elseif($variant=='4'){
				$sql="
						SELECT COUNT(*) AS 'Currently Online'
						FROM ".$this->db->get_TABLE("SH_CHARDATA")."
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
		# PAGING FUNCTIONS
		function _do_paging(){
			$data	=	array();

			$sql	=	("
							SELECT *
							FROM ".$this->db->get_TABLE("SETTINGS_PAGES")."
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
						$data["body"][$results["RowID"]][]	=	$this->Data->bit_2_text($results["PAGE_SHOW"]);
						$data["body"][$results["RowID"]][]	=	'<button class="badge badge-primary open_editor_modal" data-id="'.$results["RowID"].'~'.$results["PAGE_INDEX"].'~'.$results["PAGE_URI"].'~'.$results["PAGE_SHOW"].'~'.$results["METATAG_TITLE"].'~'.$results["METATAG_DESC"].'~'.$results["METATAG_KEYWORDS"].'" data-target="#pages_modal" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</button>';
#						$data["body"][$results["RowID"]][]	=	$results["SHOW"];
					}
				}

#				$this->Tpl->OUTPUT_TABLE_HEAD($this->output["head"]);
#				if($prep){
#					while($RowID = odbc_fetch_array($stmt)){
#						echo $this->Tpl->OUTPUT_TABLE_BODY($this->output["body"][$RowID["RowID"]]);
#					}
#				}
			}
			else{
				$this->output	=	"An error has occured!";
			}
			$this->output	=	$data;
		}
	}
?>