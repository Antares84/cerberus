<?php
	namespace Classes\Modules;

	class Modules{

		# Arrays
		private $MODULE_ARRAY;private $MODULE_ID_ARR;private $MODULE_MF_ARR;
		# Settings
		private $crc_type;private $path;private $module;
		# Module Values
		private $MOD_NAME;private $MOD_MASTERFILE;private $MOD_AJAX;private $MOD_JS;private $MOD_PHP;
		private $MOD_OPT_0;private $MOD_OPT_1;private $MOD_OPT_2;private $MOD_OPT_3;private $MOD_OPT_4;private $MOD_OPT_5;private $MOD_OPT_6;private $MOD_OPT_7;private $MOD_OPT_8;private $MOD_OPT_9;
		private $MOD_VERSION;private $MOD_DATE;
		private $MOD_MD5;private $MOD_SHA1;
		# Display Mode
		private $MODE;
		# Checksums
		private $md5_db;private $sha1_db;private $md5_module;private $sha1_module;
		# Output
		private $data;private $mod_output;
		# Template Placeholders
		private $Cards;

		public function __construct($Dirs,$MSSQL){
			$this->Dirs		=	$Dirs;
			$this->MSSQL	=	$MSSQL;

			$this->_security();
		#	$this->_build_arrays();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}

		# Module Methods
		public function _run($crc=false){
			if(!$crc || empty($crc)){exit(get_class($this).': CRC type must be specified.');}
			else{$this->crc_type=$crc;}

			$this->path=$this->Dirs->_arr["MODULES"];
			$modules = scandir($this->path);

			foreach($modules as $module){
				$ext = pathinfo($module,PATHINFO_EXTENSION);
				$this->module=$module;

				if($ext=='php'){
					if(!$this->_read('crc')){
						$this->_load_crc();
					#	$this->_load_module("2");

						$this->_write("update");
					}
					elseif(!$this->_read("module")){
						$this->_write("module");
					}
					else{
						# validate checksums
						$this->crc_compare($this->crc_type);

						if($this->crc_type=="MD5"){
							if($this->md5_module==$this->md5_db){
								$this->_load_module("1");
							}
							else{
								$this->LogSys->_write_err_log('MD5 signature mismatch in module: '.$module,__FILE__,__LINE__);
							}
						}
						elseif($this->crc_type=="SHA1"){
							if($this->sha1_module==$this->sha1_db){
								$this->_load_module("1");
							}
							else{
								$this->LogSys->_write_err_log('SHA1 signature mismatch in module: '.$module,__FILE__,__LINE__);
							}
						}
						elseif($this->crc_type=="BOTH"){
							if($this->md5_module==$this->md5_db && $this->sha1_module==$this->sha1_db){
								$this->_load_module("1");
							}
							else{
								$this->LogSys->_write_err_log('MD5 & SHA1 signature mismatch in module: '.$module,__FILE__,__LINE__);
							}
						}

					#	$this->MODE="DISPLAY";
					#	$this->_get_module();
					}
				}
			}
		}
		private function _get_module(){
			require_once($this->path.$this->module);
		}
		private function _validate($crc_type){
			switch($crc_type){
				case	"md5"	:
				break;
				case	"sha1"	:
				break;
				case	"both"	:
				
			}
		}
		private function _load_crc(){
			switch($this->crc_type){
				case	"md5"	:	$this->_crc_md5();						break;
				case	"sha1"	:	$this->_crc_sha1();						break;
				case	"both"	:	$this->_crc_md5();$this->_crc_sha1();	break;
			}
		}
		private function _crc_md5(){
			$this->md5_module=md5(file_get_contents($this->path.$this->module));
		}
		private function _crc_sha1(){
			$this->sha1_module=sha1(file_get_contents($this->path.$this->module));
		}
		private function _crc_compare(){
			if($this->crc_type=='md5'){}
			elseif($this->crc_type=='sha1'){}
			elseif($this->crc_type=='both'){}
		}
		private function _load_module($param){
			switch($param){
				case	"1"	:	$this->MODE="DISPLAY";	break;
				case	"2"	:	$this->MODE="INSTALL";	break;

				$this->_get_module();
			}
		}
		private function _read($case){
			$cmd=$case;
			switch($case){
				case	'read'	:
					$sql	=	('SELECT * FROM '.$this->MSSQL->_table_list("SETTINGS_MODULES").' WHERE MODULE_ENABLED=?');
					$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
					$args	=	array(1);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						if(odbc_num_rows($stmt)>0){
							while($data=odbc_fetch_array($stmt)){
								$this->MODULE_ARRAY[]=$data["MODULE_NAME"];
								$this->MODULE_ARRAY[]=$data["RowID"];
								$this->MODULE_ARRAY[]=$data["MODULE_MASTERFILE"];
								$this->MODULE_ARRAY[]=$data["MODULE_ENABLED"];
							}
						}
					}
				break;
				case	'crc'	:
					$sql	=	('SELECT MOD_MD5,MOD_SHA1 FROM '.$this->MSSQL->_table_list("SETTINGS_MODULES").' WHERE MOD_NAME=?');
					$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
					$args	=	array($this->module);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						if(odbc_num_rows($stmt)>0){
							while($data=odbc_fetch_array($stmt)){
								if(!empty($data["MOD_MD5"]) && $data["MOD_MD5"]!==NULL){
									$this->md5_db	=	$data["MOD_MD5"];
								}
								if(!empty($data["MOD_SHA1"]) && $data["MOD_SHA1"]!==NULL){
									$this->sha1_db	=	$data["MOD_SHA1"];
								}

								return true;
							}
						}
						else{
							$this->_write("update",$cmd);
						}
					}
					else{
						return false;
					}
				break;
			}
		}
		private function _write($case,$cmd=false){
			switch($case){
				case	'insert'	:
					$sql	=	('INSERT INTO '.$this->MSSQL->_table_list("SETTINGS_MODULES").'
									(MOD_NAME,MOD_MASTERFILE,MOD_AJAX,MOD_JS,MOD_PHP,
									MOD_OPT_0,MOD_OPT_1,MOD_OPT_2,MOD_OPT_3,MOD_OPT_4,MOD_OPT_5,MOD_OPT_6,MOD_OPT_7,MOD_OPT_8,MOD_OPT_9
									MOD_VERSION,MOD_DATE,
									MOD_MD5,MOD_SHA1)
								VALUES
									(
									some,some,some,some,some,
									some,some,some,some,some,some,some,some,some,some,
									some,some,
									some,some,
									)
									');
					$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
					$args	=	array($this->md5_module,$this->sha1_module,$this->module);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						$this->_read($cmd);
					}
				break;
				case	'update'	:
					$sql	=	('UPDATE '.$this->MSSQL->_table_list("SETTINGS_MODULES").' SET MOD_MD5=?,MOD_SHA1=? WHERE MOD_NAME=?');
					$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
					$args	=	array($this->md5_module,$this->sha1_module,$this->module);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						$this->_read($cmd);
					}
				break;
			}
		}
###
		public function _run1($exec=false){
			switch($exec){
				case	"some"	:
				break;
				case	"scan"	:	$this->_scan_modules();	break;
				default			:
					if($this->_read()==true){
						$this->_load();
					}
					else{
						$this->_run("scan");
					}
				break;
			}

			$this->_output();
			# _read => _load || _scan_modules
		}
		private function _set(){}
		private function _get($status,$module=false){
			$sql	=	("
							SELECT *
							FROM ".$this->MSSQL->_table_list("SETTINGS_MODULES")."
							WHERE MODULE_NAME=?
			");
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);

			switch($status){
				case	'validate'	:
					list($mod_pre,$mod_name,$mod_ext) = explode(".",$module);

					$args	=	array($mod_name);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						if(odbc_num_rows($stmt)>0){
							$this->MODE="INSTALL";
						}
						else{
							$this->MODE="DISPLAY";
							echo $module.'<br>';
						}

						$this->_do_module_load($module);
					}
				break;
				case	'exec'		:
					$args	=	array($this->MODULE_NAME);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						while($data=odbc_fetch_array($stmt)){
							if($data["MODULE_PHP"]	!==	NULL){
								require_once($data["MODULE_NAME"]."/php/".$data["MODULE_PHP"]);
							}
							if($data["MODULE_AJAX"]	!==	NULL){
								require_once($data["MODULE_NAME"]."/ajax/".$data["MODULE_AJAX"]);
							}
							if($data["MODULE_JS"]	!==	NULL){
								require_once($data["MODULE_NAME"]."/js/".$data["MODULE_JS"]);
								echo '<script charset="utf-8" type="text/javascript" src="'.$this->Dirs->_arr["MODULES"].$data["MODULE_NAME"]."/js/".$data["MODULE_JS"].'"></script>';
							}
						}
					}
				break;
			}
		}
		private function _scan_modules($mode=false){
			$modules = scandir($this->Dirs->_arr["MODULES"]);

			foreach($modules as $module){
				$ext = pathinfo($module,PATHINFO_EXTENSION);

				if($ext == 'php'){
					$this->MODE=="INSTALL";
					$this->_load();
				}
			}

			# _load
		}
		private function _read1($case=false){
			switch($case){
				case	"_load"	:
				break;
				case	"all"	:
					
				default			:
					$sql	=	("
									SELECT *
									FROM ".$this->MSSQL->_table_list("SETTINGS_MODULES")."
									WHERE MODULE_ENABLED=?
									ORDER BY MODULE_ORDER ASC
					");
					$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
					$args	=	array(1);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						if(odbc_num_rows($stmt)>0){
							while($data=odbc_fetch_array($stmt)){
								$this->MODULE_ARRAY[]=$data["MODULE_NAME"];
								$this->MODULE_ARRAY[]=$data["RowID"];
								$this->MODULE_ARRAY[]=$data["MODULE_MASTERFILE"];
								$this->MODULE_ARRAY[]=$data["MODULE_ENABLED"];
							}
						}
					}
				break;
			}
		}
		private function _write1(){
			$sql	=	("INSERT INTO ".$this->MSSQL->_table_list("SETTINGS_MODULES")."
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

			if($prep){return true;}
			else{return false;}
		}
		
		private function _load1($module=false){
		#	if($module==false || empty($module)){
		#		die('Module is empty. This can\'t happen. _load');
		#	}

			switch($this->MODE){
				case	"DISPLAY"	:
					$sql	=	('
									SELECT *
									FROM '.$this->MSSQL->_table_list("SETTINGS_MODULES").'
									WHERE [MODULE_MASTERFILE]=? AND [MODULE_ENABLED]=?
									ORDER BY [MODULE_ORDER] ASC
					');
					$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
					$args	=	array($module,1);
					$prep	=	odbc_execute($stmt,$args);

					if($prep){
						if(odbc_num_rows($stmt)>0){
							$this->_load_cards();

							while($data = odbc_fetch_array($stmt)){
								if($data["MODULE_ENABLED"] == 1){
									require_once($this->Dirs->_arr["MODULES"].$data["MODULE_MASTERFILE"]);
								}
							}
						}else{die('Module not found. Exec shouldn\'t have made it this far. _load');}
					}
				break;
				case	"INSTALL"	:	$this->_install();	break;
			}
		}
		private function _install($module){
			if($module==false || empty($module)){
				die('Module is empty. This can\'t happen. _install');
			}

			require_once($this->Dirs->_arr["MODULES"].$module);
		}
		private function _load_cards(){
			$this->Cards=new \Classes\Display\Templates\CMS\Cards;
		}
		private function _build_arrays(){
			$this->MODULE_ID_ARR=array();
			$this->MODULE_ID_ARR["MODULE_NAME"]=array();
			$this->MODULE_ID_ARR["MODULE_NAME"]["RowID"]=array();
			$this->MODULE_ID_ARR["MODULE_NAME"]["MODULE_MASTERFILE"]=array();
			$this->MODULE_ID_ARR["MODULE_NAME"]["MODULE_ENABLED"]=array();

			$this->MODULE_MF_ARR=array();
		}

		# MISC
		public function _output(){
			echo $this->mod_output;
		}
		public function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

				#	$this->_build();

					echo '<pre>';
						var_dump($this->_array);
					echo '</pre>';
				echo '</div>';
			}
			else{
				echo '<div class="col-md-12">';
					echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
					echo '<pre>';
					foreach($class_methods as $method_name){
						echo $method_name.'<br>';
					}
					echo '</pre>';
				echo '</div>';
				exit;
			}
		}
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit;
		}
	}
?>