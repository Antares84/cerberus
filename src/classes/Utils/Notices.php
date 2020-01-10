<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Notices{
		public function __construct($Data,$db,$Dirs){
			$this->Data		=	$Data;
			$this->db		=	$db;
			$this->Dirs		=	$Dirs;
		}
		public function get_Notices_Comments(){
			$return = false;

			$sql	=	("SELECT COUNT(*) AS cnt FROM ".$this->db->get_TABLE("CUSTINFO")." WHERE Status=?");
			$stmt	=	@odbc_prepare($this->db->conn,$sql);
			$args	=	array(0);
			$prep	=	@odbc_execute($stmt,$args);

			if($prep){
				$arr = @odbc_fetch_array($stmt);
				$return = $arr['cnt'];
			}else{
				$return = "Loading failed...";
			}

			return $return;
			odbc_free_result($sql);
			odbc_close($this->db->conn);
		}
		public function get_Notices_Tasks(){
			$return = false;

			$sql	=	("SELECT COUNT(*) AS cnt FROM ".$this->db->get_TABLE("CUSTINFO")." WHERE Status=?");
			$stmt	=	@odbc_prepare($this->db->conn,$sql);
			$args	=	array(1);
			$prep	=	@odbc_execute($stmt,$args);

			if($prep){
				$arr = @odbc_fetch_array($stmt);
				$return = $arr['cnt'];
			}
			else{
				$return = "Loading failed...";
			}

			return $return;
			odbc_free_result($sql);
			odbc_close($this->db->conn);
		}
		public function get_Notices_Orders(){
			$return = false;

			$sql	=	("SELECT COUNT(*) AS cnt FROM ".$this->db->get_TABLE("CUSTINFO")." WHERE Status=?");
			$stmt	=	@odbc_prepare($this->db->conn,$sql);
			$args	=	array(2);
			$prep	=	@odbc_execute($stmt,$args);

			if($prep){
				$arr = @odbc_fetch_array($stmt);
				$return = $arr['cnt'];
			}else{
				$return = "Loading failed...";
			}

			return $return;
			odbc_free_result($sql);
			odbc_close($this->db->conn);
		}
		public function get_Notices_Tickets(){
			$return = false;

			$sql	=	("SELECT COUNT(*) AS cnt FROM ".$this->db->get_TABLE("CUSTINFO")." WHERE Status=?");
			$stmt	=	@odbc_prepare($this->db->conn,$sql);
			$args	=	array(0);
			$prep	=	@odbc_execute($stmt,$args);

			if($prep){
				$arr = @odbc_fetch_array($stmt);
				$return = $arr['cnt'];
			}else{
				$return = "Loading failed...";
			}

			return $return;
			odbc_free_result($sql);
			odbc_close($this->db->conn);
		}
		public function _sql_updates(){
			$dir_path = $this->Dirs->_array[67];
			if(file_exists($dir_path) && is_dir($dir_path) && !empty($dir_path)){
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						echo '<div id="sb_content">';
							echo '<div class="badge-danger">';
								echo '<p class="p_all_5">';
									echo 'New SQL updates are available in <b>'.$dir_path.'</b>.<br>';
									echo 'Please run the SQL files, then <b>delete the folder</b> before continuing.<br>';
									echo 'Failing to do so will cause parts of this CMS to not function.<br><br>';
								
									echo 'The following files are ready for updating:<br>';
									echo $this->Data->_do('dir_lister_data',$dir_path);
								echo '</p>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
			else{
				echo '<div class="row">';
					echo '<div class="col-lg-12">';
						echo '<div class="badge-success">';
							echo '<p class="p_all_5">';
								echo 'No database updates found.';
							echo '</p>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}
		public function _sql_update_files($dir){
			$update_files	=	scandir($dir);
			$data			=	false;

			$data	.=	'<ul class="list-group">';
			foreach($update_files as $file){
				$ext = pathinfo($file,PATHINFO_EXTENSION);

				if($ext == 'sql'){
					$data	.=	'<li class="list-group-item d-flex list-group-item-dark no_padding"><span class="nav-link" href="#">'.$file.'</a></li>';

				}
			}
			$data	.=	'</ul>';

			return $data;
		}
	}
?>