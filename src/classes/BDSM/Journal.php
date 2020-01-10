<?php
	namespace classes\bdsm;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Journal{
		# Public Methods
		public function __construct($Data,$db,$Tpl,$User){
			$this->Data	=	$Data;
			$this->db	=	$db;
			$this->Tpl	=	$Tpl;
			$this->User	=	$User;
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
		public function _do_journal($eid){
			if($eid){
				$this->_get_eid_data($eid);
			}
			else{
				$this->_ds_journal();
			}
		}
		# Private Methods
		private function _get_eid_data($eid){
			$sql	=	('
							SELECT TOP 1 *
							FROM '.$this->db->get_TABLE("JOURNAL").'
							WHERE MemberID=? AND RowID=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($this->User->MemberID,$EntryID);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					while($data = odbc_fetch_array($stmt)){
						$this->Cards->_do_build_card('page',$data["Title"],$data["Detail"]);
					}
				}
				else{
					echo '<div class="card no_bg no_border no_radius">';
						echo '<div class="card-header card_border tac title pTitle show no_radius">';
							echo 'Uh oh, I wasn\'t able to find the entry that you requested. How unfortunate...';
						echo '</div>';
					echo '</div>';
				}
			}
		}
		private function _get_DisplayName($data){
			$ret	=	false;

			$sql	=	('
							SELECT DisplayName
							FROM '.$this->db->_table_list("USER_DATA").'
							WHERE MemberID=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($data);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					$ret	.=	$data["DisplayName"];
				}
			}

			return $ret;
		}
		private function _get_partnerid_search(){
			$this->_get_partnerid_0();
			if(!empty($this->User->_get_data('PartnerID_1'))){
				$this->_get_partnerid_1($this->_get_DisplayName($this->User->_get_data('PartnerID_1')));
			}
			if(!empty($this->User->_get_data('PartnerID_2'))){
				$this->_get_partnerid_2($this->_get_DisplayName($this->User->_get_data('PartnerID_2')));
			}
			if(!empty($this->User->_get_data('PartnerID_3'))){
				$this->_get_partnerid_3($this->_get_DisplayName($this->User->_get_data('PartnerID_3')));
			}
		}
		private function _get_partnerid_0(){
			$sql	=	("
							SELECT Title,Detail,Date
							FROM ".$this->db->_table_list("JOURNAL")."
							WHERE MemberID IN (?)
							ORDER BY Date DESC
			");
			$stmt		=	odbc_prepare($this->db->conn,$sql);
			$args		=	array($this->User->_get_data("MemberID"));
			$prep		=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$this->Tpl->TitleBar("My Entries","w_100_p");
					$this->Tpl->Separator(10);
					while($data = odbc_fetch_array($stmt)){
						$this->_ds_partner_success(
													$data["Title"].'<br>Written '.$this->Data->_do('getDateDiff',$data["Date"]).' ago',
													$data["Detail"],
													""
						);
					}
					echo '<div class="separator_20"></div>';
				}
				else{
					$this->_ds_partner_err();
				}
			}
		}
		private function _get_partnerid_1($DisplayName){
			$sql	=	("
							SELECT U.MemberID,U.DisplayName,J.Title,J.Detail,J.Date
							FROM ".$this->db->_table_list("JOURNAL")." AS J
							INNER JOIN ".$this->db->_table_list("USER_DATA")." AS U on U.MemberID = J.MemberID
							WHERE U.MemberID IN (?)
							ORDER BY Date DESC
			");
			$stmt		=	odbc_prepare($this->db->conn,$sql);
			$args		=	array($this->User->_get_data("PartnerID_1"));
			$prep		=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$this->Tpl->TitleBar('Entries from '.$DisplayName,"w_100_p");
					$this->Tpl->Separator(10);
					while($data = odbc_fetch_array($stmt)){
						$this->_ds_partner_success(
													$data["Title"].'<br>Written '.$this->Data->_do('getDateDiff',$data["Date"]).' ago',
													$data["Detail"],
													""
						);
					}
					echo '<div class="separator_20"></div>';
				}
				else{
					$this->_ds_partner_err();
				}
			}
		}
		private function _get_partnerid_2($DisplayName){
			$sql	=	("
							SELECT U.MemberID,U.DisplayName,J.Title,J.Detail,J.Date
							FROM ".$this->db->_table_list("JOURNAL")." AS J
							INNER JOIN ".$this->db->_table_list("USER_DATA")." AS U on U.MemberID = J.MemberID
							WHERE U.MemberID IN (?)
							ORDER BY Date DESC
			");
			$stmt		=	odbc_prepare($this->db->conn,$sql);
			$args		=	array($this->User->_get_data("PartnerID_2"));
			$prep		=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$this->Tpl->TitleBar('Entries from '.$DisplayName,"w_100_p");
					$this->Tpl->Separator(10);
					while($data = odbc_fetch_array($stmt)){
						$this->_ds_partner_success(
													$data["Title"].'<br>Written '.$this->Data->_do('getDateDiff',$data["Date"]).' ago',
													$data["Detail"],
													""
						);
					}
					echo '<div class="separator_20"></div>';
				}
				else{
					$this->_ds_partner_err();
				}
			}
		}
		private function _get_partnerid_3($DisplayName){
			$sql	=	("
							SELECT U.MemberID,U.DisplayName,J.Title,J.Detail,J.Date
							FROM ".$this->db->_table_list("JOURNAL")." AS J
							INNER JOIN ".$this->db->_table_list("USER_DATA")." AS U on U.MemberID = J.MemberID
							WHERE U.MemberID IN (?)
							ORDER BY Date DESC
			");
			$stmt		=	odbc_prepare($this->db->conn,$sql);
			$args		=	array($this->User->_get_data("PartnerID_3"));
			$prep		=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$this->Tpl->TitleBar('Entries from '.$DisplayName,"w_100_p");
					$this->Tpl->Separator(10);
					while($data = odbc_fetch_array($stmt)){
						$this->_ds_partner_success(
													$data["Title"].'<br>Written '.$this->Data->_do('getDateDiff',$data["Date"]).' ago',
													$data["Detail"],
													""
						);
					}
					echo '<div class="separator_20"></div>';
				}
				else{
					$this->_ds_partner_err();
				}
			}
		}
		private function _ds_partner_success($Title,$Detail,$Date){
			echo '<div class="card no_bg no_border no_radius">';
				echo '<div class="card-header card_border tac title pTitle show no_radius">'.$Title.'</div>';
			if(!empty($Detail)){
				echo '<div class="card-block card_border content_bg content no_radius pContent">';
					echo '<div class="card-text">'.$Detail.'</div>';
				echo '</div>';
			}
			if(!empty($Date)){
				echo '<div class="card-footer card_border content_bg footer no_radius pContent">';
					echo '<div class="tac b_i">';
						echo 'Posted on <font class="red">'.Date("m/d/y",strtotime($Date)).'</font> at <font class="red">'.Date("h:iA ",strtotime($Date)).'</font>';
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';
			echo '<div class="separator_10"></div>';
		}
		private function _ds_partner_err(){
			echo '<div class="card no_bg no_border no_radius">';
				echo '<div class="card-header card_border tac title pTitle show no_radius">';
					echo 'Doesn\'t look like you\'ve added any entries yet. What are you waiting for?';
				echo '</div>';
			echo '</div>';
		}
		private function _ds_journal(){
			$this->Tpl->Titlebar('Welcome To Your Journal, <span class="b_i">'.$this->User->_get_UserInfo('DisplayName').'</span>','w_100_p');
			$this->Tpl->Separator(10);

			echo '<div class="card no_bg no_border no_radius">';
				echo '<div class="card-block card_border content_bg content no_radius">';
					echo '<div class="card-text">';
						echo '<div class="tar m_all_5">';
							echo '<button class="btn btn-sm btn-primary m_r_5" id="isJournalCreate">Create A New Entry</button>';
							echo '<button class="btn btn-sm btn-primary" id="isJournalOpen">View Entries</button>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			$this->Tpl->Separator(10);

			echo '<div class="hide" id="isJournalCreating">';
				echo '<div class="card no_bg no_border no_radius">';
					echo '<div class="card-block card_border content_bg content no_radius">';
						echo '<div class="card-text p_all_10">';
							echo '<form id="New_Entry">';
								echo '<div class="form-group">';
									echo '<input type="text" class="form-control" id="input-Title" name="Title" placeholder="Entry Title" />';
								echo '</div>';

								echo '<div class="form-group">';
									echo '<div class="mce_standard_textbox"></div>';
								echo '</div>';
								$this->Tpl->Separator(10);

								echo '<div class="form-group tac">';
									echo '<button class="btn btn-sm btn-primary open_journal_modal" data-id="" data-target="#journal_modal" data-toggle="modal"><i class="fa fa-pencil"></i> Save</button>';
								echo '</div>';
							echo '</form>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

			echo '<div class="hide" id="isJournalOpened">';
					$this->_get_partnerid_search();
			echo '</div>';
		}
	}
?>