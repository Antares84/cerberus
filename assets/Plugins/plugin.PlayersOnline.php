<?php
	# Plugin Information
	$this->PLUGIN_NAME			=	'PlayersOnline';
	$this->PLUGIN_MASTERFILE	=	'plugin.PlayersOnline.php';
	$this->PLUGIN_PHP			=	'PlayersOnline.php';
	$this->PLUGIN_AJAX			=	 NULL;
	$this->PLUGIN_JS			=	 NULL;
	$this->PLUGIN_VERSION		=	'1.0';
	$this->PLUGIN_DATE			=	'7.14.2018';

	if($this->MODE == "INSTALL"){
		$this->Tpl->PAGE_CARD('Plugin Installation','','<div class="alert alert-success" role="alert"><b>'.$this->PLUGIN_NAME.'</b> plugin found, installing...</div>','');

		$sql	=	("INSERT INTO ".$this->db->get_TABLE("SETTINGS_PLUGINS")."
						(PLUGIN_NAME,PLUGIN_MASTERFILE,PLUGIN_PHP,PLUGIN_AJAX,PLUGIN_JS,PLUGIN_VERSION,PLUGIN_DATE)
					VALUES
						(?,?,?,?,?,?,?)
		");
		$stmt	=	odbc_prepare($this->db->conn,$sql);
		$args	=	array($this->PLUGIN_NAME,$this->PLUGIN_MASTERFILE,$this->PLUGIN_PHP,$this->PLUGIN_AJAX,$this->PLUGIN_JS,$this->PLUGIN_VERSION,$this->PLUGIN_DATE);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			$this->Tpl->PAGE_CARD('Plugin Installation','','<div class="alert alert-success" role="alert"><b>'.$this->PLUGIN_NAME.'</b> plugin has been installed.</div>','');
		}else{
			$this->Tpl->PAGE_CARD('Plugin Installation','','<div class="alert alert-success" role="alert"><b>'.$this->PLUGIN_NAME.'</b> plugin installation failed.</div>','');
		}
	}
	elseif($this->MODE == "DISPLAY"){
		$sql	=	('
						SELECT *
						FROM '.$this->db->get_TABLE("SETTINGS_PLUGINS").'
						WHERE PLUGIN_NAME=?
		');
		$stmt	=	odbc_prepare($this->db->conn,$sql);
		$args	=	array($this->PLUGIN_NAME);
		$prep	=	odbc_execute($stmt,$args);

		if($prep){
			while($data=odbc_fetch_array($stmt)){
				if($data["PLUGIN_PHP"]	!==	NULL){
					require_once($data["PLUGIN_NAME"]."/php/".$data["PLUGIN_PHP"]);
				}
				if($data["PLUGIN_AJAX"]	!==	NULL){
				#	require_once($data["PLUGIN_NAME"]."/ajax/".$data["PLUGIN_AJAX"]);
				}
				if($data["PLUGIN_JS"]	!==	NULL){
				#	require_once($data["PLUGIN_NAME"]."/js/".$data["PLUGIN_JS"]);
#					echo '<script charset="utf-8" type="text/javascript" src="'.$this->get_PLUGINS_DIR().$data["PLUGIN_NAME"]."/js/".$data["PLUGIN_JS"].'"></script>';
				}
			}
		}
	}
?>