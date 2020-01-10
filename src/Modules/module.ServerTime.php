<?php
	# Plugin Information
	$this->MOD_NAME			=	"ServerTime";
	$this->MOD_MASTERFILE	=	"module.ServerTime.php";
	$this->MOD_PHP			=	"ServerTime.php";
	$this->MOD_AJAX			=	NULL;
	$this->MOD_JS			=	"ServerTime.js";
	$this->MOD_VERSION		=	"1.1";
	$this->MOD_DATE			=	"1.1.2020";

	if($this->MODE == "INSTALL"){
		$this->mod_output.=$this->Cards->_build(
			'module',
			'Module Installation',
			'<div class="alert alert-primary" role="alert"><b>'.$this->MODULE_NAME.'</b> module found, installing...</div>'
		);

		if($this->_write("insert")==true){
			$this->mod_output.=$this->Cards->_build(
				'module',
				'Module Installation',
				'<div class="alert alert-success" role="alert"><b>'.$this->MODULE_NAME.'</b> module has been installed.</div>',
			);
		}else{
			$this->mod_output.=$this->Cards->_build(
				'module',
				'Module Installation',
				'<div class="alert alert-danger" role="alert"><b>'.$this->MODULE_NAME.'</b> module installation failed.</div>',
			);
		}
	}
	elseif($this->MODE == "DISPLAY"){
		$this->_get();
	}
?>