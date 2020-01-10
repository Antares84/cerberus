<?php
	# Plugin Information
	$this->MODULE_NAME			=	'UserInfo';
	$this->MODULE_MASTERFILE	=	'module.UserInfo.php';
	$this->MODULE_PHP			=	'UserInfo.php';
	$this->MODULE_AJAX			=	NULL;
	$this->MODULE_JS			=	NULL;
	$this->MODULE_VERSION		=	'1.0';
	$this->MODULE_DATE			=	'05.05.2018';

	if($this->MODE == "INSTALL"){
		echo $Tpl_Cards->_build(
										'module',
										'Module Installation',
										'<div class="alert alert-success" role="alert"><b>'.$this->MODULE_NAME.'</b> module found, installing...</div>'
		);

		$sql	=	("INSERT INTO ".$this->MSSQL->_table_list("SETTINGS_MODULES")."
						(MODULE_NAME,MODULE_MASTERFILE,MODULE_PHP,MODULE_AJAX,MODULE_JS,MODULE_VERSION,MODULE_DATE)
					VALUES
						(?,?,?,?,?,?,?)
		");
		$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
		$args	=	array($this->MODULE_NAME,$this->MODULE_MASTERFILE,$this->MODULE_PHP,$this->MODULE_AJAX,$this->MODULE_JS,$this->MODULE_VERSION,$this->MODULE_DATE);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			echo $Tpl_Cards->_build(
											'module',
											'Module Installation',
											'<div class="alert alert-success" role="alert"><b>'.$this->MODULE_NAME.'</b> module has been installed.</div>'
			);
		}else{
			echo $Tpl_Cards->_build(
											'module',
											'Module Installation',
											'<div class="alert alert-success" role="alert"><b>'.$this->MODULE_NAME.'</b> module installation failed.</div>'
			);
		}
	}
	elseif($this->MODE == "DISPLAY"){
		$sql	=	('
						SELECT *
						FROM '.$this->MSSQL->_table_list("SETTINGS_MODULES").'
						WHERE MODULE_NAME=?
		');
		$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
		$args	=	array($this->MODULE_NAME);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			while($data=odbc_fetch_array($stmt)){
				if($data["MODULE_PHP"]		!==	NULL){
					require_once($data["MODULE_NAME"]."/php/".$data["MODULE_PHP"]);
				}
				elseif($data["MODULE_AJAX"]	!==	NULL){
					require_once($data["MODULE_NAME"]."/ajax/".$data["MODULE_AJAX"]);
				}
				if($data["MODULE_JS"]		!==	NULL){
					require_once($data["MODULE_NAME"]."/js/".$data["MODULE_JS"]);
					echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_array[22].$data["MODULE_NAME"]."/js/".$data["MODULE_JS"].'"></script>';
				}
			}
		}
	}
?>