<?php
	class Readable{
		# Required for PayPal IPN plugin

		public $GW_STATUS;
		public $IPN_STATUS;

		function __construct($DatabaseObj){
			$this->db		=	$DatabaseObj;
//			$this->PPo		=	$PayPalObj;
		}
		function get_readable_gateway(){
			$return = false;

			$file = $this->PPo->GW_LOGFILE();
			$msg = "File is writeable\n";

			if(is_writable($file)){
				if(!$handle = fopen($file,'a')){
					$this->GW_STATUS	=	"Unable to open $file for writing...";
					return false;
				}
				if(fwrite($handle,$msg) === false){
					$this->GW_STATUS	=	"Unable to write to file $file...";
					return false;
				}else{
					$this->GW_STATUS	=	"Success, $msg was written to $file...";
					return true;
				}
				fclose($handle);
			}else{
				$this->GW_STATUS	=	"$file is not writable...";
				return false;
			}
		#	return $return;
		}
		function get_readable_ipn(){
			$return = false;

			$file = $this->PPo->IPN_LOGFILE();
			$msg = "File is writeable\n";

			if(is_writable($file)){
				if(!$handle = fopen($file,'a')) {
					$this->IPN_STATUS	=	"Unable to open $file for writing...";
					return false;
				}
				if(fwrite($handle,$msg) === false){
					$this->IPN_STATUS	=	"Unable to write to file $file...";
					return false;
				}else{
					$this->IPN_STATUS	=	"Success, $msg was written to $file...";
					return true;
				}
				
				fclose($handle);
			}else{
				$this->IPN_STATUS	=	"$file is not writable...";
				return false;
			}
			#return $return;
		}
		function Read_File($source,$filename){
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
	}
?>