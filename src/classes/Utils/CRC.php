<?php
	namespace Classes\Utils;

	class CRC{

		private $fn;
		private $fn_path;
		private $fn_full;
		private $crc_md5;
		private $crc_sha_1;

		private $output;

		public function __construct($Dirs,$LogSys,$MSSQL,$Tpl){
			$this->Dirs			=	$Dirs;
			$this->LogSys		=	$LogSys;
			$this->MSSQL		=	$MSSQL;
			$this->Tpl			=	$Tpl;

			$this->_security();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _run(){
			$path=$this->Dirs->_arr["MODULES"];
			$files = scandir($path);

			foreach($files as $file){
				$ext = pathinfo($file,PATHINFO_EXTENSION);

				if($ext=='php' || $ext=='css'){
					$this->fn=$file;
					$this->_set_filename_path($path,$file);

					if(!$this->_read()){
						$this->_crc_md5();
						$this->_crc_sha_1();

						$this->_write();
					}
				}
			}
		}
		private function _read(){
			$sql	=	('SELECT TOP 1 FileName FROM '.$this->MSSQL->_table_list("SETTINGS_CRC").' WHERE FileName=?');
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array($this->fn);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt)==1){
					$text='MSG: '.$this->fn.' already exists, skipping...<br>';
					$this->output.=$this->Tpl->BADGE_AJAX('primary',$text);

					return true;
				}
			}
		}
		private function _write(){
			$sql	=	('
				INSERT INTO '.$this->MSSQL->_table_list("SETTINGS_CRC").'
					(FileName,FileNamePath,MD5,SHA1)
				VALUES
					(?,?,?,?)
			');
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array($this->fn,$this->fn_full,$this->crc_md5,$this->crc_sha_1);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				$text='MSG: Attempt to add '.$this->fn.' to database succeeded.<br>';
				$this->output.=$this->Tpl->BADGE_AJAX('primary',$text);

				return true;
			}
			else{
				$text='MSG: Attempt to add '.$this->fn.' to database failed.<br>';
				$this->output.=$this->Tpl->BADGE_AJAX('danger',$text);

				return false;
			}
		}
		private function _set_filename_path($dir,$file){
			$this->fn_path=$dir;
			$this->fn_full=$dir.$file;
		}
		private function _crc_md5(){
			$this->crc_md5=md5(file_get_contents($this->fn_full));
		}
		private function _crc_sha_1(){
			$this->crc_sha_1=sha1(file_get_contents($this->fn_full));
		}
		public function _output(){
			echo $this->output;
		}
	}
?>