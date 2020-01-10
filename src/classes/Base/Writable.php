<?php
	class Writable{
		public function __construct($db){
			$this->db	=	$db;
		}
		public function is_Writable_Shaiya(){
			$newFileName = '/temp.txt';
			if(!is_writable(dirname($newFileName))){
				echo dirname($newFileName).' must writable!!!';
			}
			else{
				echo dirname($newFileName).' is writable.';
			}
		}
		public function _is_writable_pages($source,$filename){
			$file		=	$source.$filename;

			if(is_writable(dirname($file))){
				return '<badge class="badge badge-success m_t_2">Yes</badge>';
			}
			return '<badge class="badge badge-danger m_t_2">No</badge>';
		}
		public function _write_colors($source,$filename){
			$ret		=	false;

			$file		=	$source.$filename;

			$success	=	'File is writeable\n';
			$success_1	=	'';
			$error		=	'';
			$text		=	false;

			$sql		=	('
								SELECT *
								FROM '.$this->db->get_TABLE("SETTINGS_COLORS").'
								ORDER BY COLOR ASC
			');
			$stmt		=	odbc_prepare($this->db->conn,$sql);
			$args		=	array();
			$prep		=	odbc_execute($stmt,$args);

			$msg_0		=	'Unable to open $file for writing...';
			$msg_1		=	'Unable to write to '.$filename.'...';
			$msg_2		=	'Colors data has been successfully written to <b>'.$filename.'</b>.';
			$msg_3		=	''.$filename.' is not writable...';

			if(is_writable($file)){
				if(!$handle = fopen($file,'a')){
					$ret	.=	$msg_0;
				}
				if(fwrite($handle,$success_1) === false){
					$ret	.=	$msg_1;
				}
				else{
					if($prep){
						while($data = odbc_fetch_array($stmt)){
							#fwrite($handle,"case '".$data['COLOR']."'\t\t:\treturn '".$data['RGB']."';\tbreak;\n");
							#fwrite($handle,"case '".$data['COLOR']."'\t\t:\treturn '".$data['RGB']."';\tbreak;\n");
							fwrite($handle,"\t\t\t\t<option class=\"badge badge-white tac\" style=\"background-color:#".$data['HEX']."\" value=\"".$data['RGB']."\">".$data["COLOR"]."</option>\r\n");
						}
						$ret	.=	$msg_2;
					}
					else{
						$ret	.=	$msg_1;
					}
				}
				fclose($handle);
			}else{
				$ret	.=	$msg_3;
			}
			return $ret;
		}
		public function _write_pages($source,$filename){
			$file		=	$source.$filename;

			$success	=	'File is writeable\n';
			$success_1	=	'';
			$error		=	'';
			$text		=	false;

			$sql		=	('
								SELECT *
								FROM '.$this->db->_table_list("SETTINGS_PAGES").'
								ORDER BY PAGE_INDEX ASC
			');
			$stmt		=	odbc_prepare($this->db->conn,$sql);
			$args		=	array();
			$prep		=	odbc_execute($stmt,$args);

			$msg_0		=	'Unable to open '.$file.' for writing...';
			$msg_1		=	'Unable to write to '.$filename.'...';
			$msg_2		=	'Paging array data has been successfully written to <b>'.$filename.'</b>.';
			$msg_3		=	'Error: '.$filename.' is not writable.<br>File Location: '.$file;

			if(is_writable($file)){
				if(!$handle = fopen($file,'c+')){
					return $msg_0;
				}
				if(fwrite($handle,$success_1) === false){
					return $msg_1;
				}
				else{
					if($prep){
						while($data = odbc_fetch_array($stmt)){
							fwrite($handle,"\t\t\t\t\t\t\t\t\t\t\t'".$data["PAGE_INDEX"]."'=>'pages_modal',\r\n");
						}
						return $msg_2;
					}
					else{
						return $msg_1;
					}
				}
				fclose($handle);
			}else{
				return $msg_3;
			}
		}
	}
?>