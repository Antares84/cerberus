<?php
	class Notices{
		function __construct($DatabaseObj){
			$this->db	=	$DatabaseObj;
		}
		function get_Notices_Comments(){
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
		function get_Notices_Tasks(){
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
		function get_Notices_Orders(){
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
		function get_Notices_Tickets(){
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
		function get_SQL_UPDATES($dir){
			$dir_path = $dir."updates/SQL/";
			if(file_exists($dir_path) && is_dir($dir_path) && !empty($dir_path)){
				echo '<div class="badge-danger">';
					echo '<p class="p_all_5">';
						echo 'New SQL updates are available in <b>'.$dir_path.'</b>.<br>';
						echo 'Please run the SQL files, then <b>delete the folder</b> before continuing.<br>';
						echo 'Failing to do so will cause parts of this CMS to not function.';
					echo '</p>';
				echo '</div>';
			}
			else{
				echo '<div class="badge-success">';
					echo '<p class="p_all_5">';
						echo 'No database updates found.';
					echo '</p>';
				echo '</div>';
			}
		}
	}
?>