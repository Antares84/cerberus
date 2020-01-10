<?php
	# Plugin Information
	$this->MODULE_NAME			=	"StorageMonitor";
	$this->MODULE_MASTERFILE	=	"module.StorageMonitor.php";
	$this->MODULE_PHP			=	"StorageMonitor.php";
	$this->MODULE_AJAX			=	NULL;
	$this->MODULE_JS			=	NULL;
	$this->MODULE_VERSION		=	"1.0";
	$this->MODULE_DATE			=	"11.18.2018";

	if($this->MODE == "INSTALL"){
		$this->output.=$this->Cards->_build(
										'module',
										'Module Installation',
										'<div class="alert alert-success" role="alert"><b>'.$this->MODULE_NAME.'</b> module found, installing...</div>'
		);

		$sql	=	("
						INSERT INTO ".$this->MSSQL->_table_list("SETTINGS_MODULES")."
							(MODULE_NAME,MODULE_MASTERFILE,MODULE_PHP,MODULE_AJAX,MODULE_JS,MODULE_VERSION,MODULE_DATE)
						VALUES
							(?,?,?,?,?,?,?)
		");
		$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
		$args	=	array(
							$this->MODULE_NAME,
							$this->MODULE_MASTERFILE,
							$this->MODULE_PHP,
							$this->MODULE_AJAX,
							$this->MODULE_JS,
							$this->MODULE_VERSION,
							$this->MODULE_DATE
		);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$this->output.=$this->Cards->_build(
											'module',
											'Module Installation',
											'<div class="alert alert-success" role="alert"><b>'.$this->MODULE_NAME.'</b> module has been installed.</div>'
			);
		}else{
			$this->output.=$this->Cards->_build(
											'module',
											'Module Installation',
											'<div class="alert alert-success" role="alert"><b>'.$this->MODULE_NAME.'</b> module installation failed.</div>'
			);
		}
	}
	elseif($this->MODE == "DISPLAY"){
		if($this->MODULE_PHP!==NULL){
			require_once($this->Dirs->_arr["MODULES"].$this->MODULE_NAME."/php/".$this->MODULE_PHP);
		}
		if($this->MODULE_AJAX!==NULL){
			require_once($this->Dirs->_arr["MODULES"].$this->MODULE_NAME."/ajax/".$this->MODULE_AJAX);
		}
		if($this->MODULE_JS!==NULL){
			require_once($this->MODULE_NAME."/js/".$this->MODULE_JS);
			$this->output.='<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr["MODULES"].$this->MODULE_NAME."/js/".$this->MODULE_JS.'"></script>';
		}
	}
?>