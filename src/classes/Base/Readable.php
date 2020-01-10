<?php
	class Readable{
		# Required for PayPal IPN plugin

		public $GW_STATUS;
		public $IPN_STATUS;
		public $Status;

		function __construct($db){
			$this->db		=	$db;
//			$this->PPo		=	$PayPalObj;
		}
		public function get_readable_gateway(){
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
		public function get_readable_ipn(){
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
		public function _read_pages($source,$filename){
			$ret = false;

			$file = $source.$filename;
			$msg = "File is writeable\n";

			if(is_writable($file)){
				if(!$handle = fopen($file,'a')) {
					$this->Status	=	"Unable to open $file for writing...";
				}
				if(fwrite($handle,$msg) === false){
					$this->Status	=	"Unable to write to file $file...";
				}else{
					$this->Status	=	"Success, $msg was written to $file...";
					$ret = true;
				}
				
				fclose($handle);
			}else{
				$this->Status	=	"$file is not writable...";
			}
		#	return $ret;
		}
	}
?>