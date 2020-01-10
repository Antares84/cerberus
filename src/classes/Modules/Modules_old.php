<?php
	namespace classes\modules;
	
	class Modules{

		public $MODULE_ARR=array();
		public $MODULE_NAME;
		public $MODULE_MASTERFILE;
		public $MODULE_PHP;
		public $MODULE_AJAX;
		public $MODULE_JS;
		public $MODULE_VERSION;
		public $MODULE_DATE;

		public $MODE	=	'void';
		public $OPT_A	=	'DISPLAY';
		public $OPT_B	=	'INSTALL';

		public $PageZone;
		public $output;

		public function __construct($Data,$Dirs,$Modal,$MSSQL,$Setting,$Tpl){
			$this->Data		=	$Data;
			$this->Dirs		=	$Dirs;
			$this->Modal	=	$Modal;
			$this->MSSQL	=	$MSSQL;
			$this->Setting	=	$Setting;
			$this->Tpl		=	$Tpl;

			$this->_security();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		public function _output(){
			echo $this->output;
		}
		# PLUGINS
		public function module_search(){
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
				if(odbc_num_rows($stmt) > 0){
					while($data = odbc_fetch_array($stmt)){
						$this->MODE = $this->OPT_A;
						$this->_do_module_load($data["MODULE_MASTERFILE"]);
					}
				}else{
					$this->_get_module_files($this->Dirs->_arr["MODULES"]);
				}
			}else{
				$this->_get_module_files($this->Dirs->_arr["MODULES"]);
			}
		}
		private function _get_module_files($dir){
			$modules = scandir($dir);

			foreach($modules as $module){
				$ext = pathinfo($plugin,PATHINFO_EXTENSION);

				if($ext == 'php'){
					$this->MODULE_MASTERFILE = $module;
					$this->_do_module_validate($module);
				}
			}
		}
		private function _do_module_validate($module){
			list($pl,$module_name,$ext) = explode(".",$module);
			$sql	=	('
							SELECT *
							FROM '.$this->MSSQL->_table_list("SETTINGS_MODULES").'
							WHERE [MODULE_NAME]=?'
			);
			$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
			$args	=	array($module_name);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$this->MODE = $this->OPT_A;
				}
				else{
					$this->MODE = $this->OPT_B;
					echo $plugin.'<br>';
				}

				$this->_do_module_load($plugin);
			}
		}
		private function _do_module_load($module=false){
			$Tpl_Cards=new \classes\Display\Templates\CMS\Cards;
			if($module==false || empty($module)){
				$sql	=	('
								SELECT [MODULE_MASTERFILE]
								FROM '.$this->MSSQL->_table_list("SETTINGS_MODULES").'
								WHERE [MODULE_ENABLED]=?
								ORDER BY [MODULE_ORDER] ASC
				');
				$stmt	=	odbc_prepare($this->MSSQL->conn,$sql);
				$args	=	array(1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					while($data = odbc_fetch_array($stmt)){
						require($this->Dirs->_arr["MODULES"].$data["MODULE_MASTERFILE"]);
					}
				}
			}
			else{
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
					if(odbc_num_rows($stmt) > 0){
						while($data = odbc_fetch_array($stmt)){
							if($data["MODULE_ENABLED"] == 1){
								require_once($this->Dirs->_arr["MODULES"].$data["MODULE_MASTERFILE"]);
							}
						}
					}
					else{
						if($this->MODE == "INSTALL"){
							require_once($this->Dirs->_arr["MODULES"].$module);
						}
					}
				}
			}
		}
		private function formatSize($bytes){
			# Get Drive Space Stats
			$types=array('B','KB','MB','GB','TB');
			for($i=0;$bytes>=1024&&$i<(count($types)-1);$bytes/=1024,$i++);
			return(round($bytes,2)." ".$types[$i]);
		}
		private function Storage_Meter($data){
			$Tpl_Cards=new \classes\Display\Templates\CMS\Cards;
			$Title	=	NULL;
			$Body	=	NULL;

			# Get disk space free (in bytes)
			$Drive	=	$data;
			$df = disk_free_space($Drive);

			# Get disk space total (in bytes)
			$dt = disk_total_space($Drive);

			# Calculate the disk space used (in bytes)
			$du=$dt-$df;
			$da=$dt+$df;

			# Percentage of disk used
			$dp=sprintf('%.2f',($du/$dt)*100);
			$dr=sprintf('%.2f',100-$dp);
			$d_gb=(round($dt/(1024*1024*1024)));
			$d_gbu=(round($df/(1024*1024*1024)));
			$d_gbr=round(($dt-$df)/(1024*1024*1024));

			# Content
			$Title	.=	'System Storage';
			$Body	.=	'<div class="tac">';
				$Body	.=	'<font class="b_i">'.$Drive.' '.$this->formatSize($dt).'</font><br>';
				$Body	.=	'<font class="b_i">Used: '.$dp.'% ('.$this->formatSize($du).')</font><br>';
				$Body	.=	'<font class="b_i">Free: '.$dr.'% ('.$this->formatSize($dt-$du).')</font>';
			$Body	.=	'</div>';
			$Body	.=	$this->Tpl->Separator('10');

			$Body	.=	'<div class="bar-outer">';
				$Body	.=	'<div class="bar-inner1" style="width:'.$dp.'%"></div>';
				$Body	.=	'<div class="bar-label b_i">'.$dp.'%</div>';
			$Body	.=	'</div>';
			$Body	.=	$this->Tpl->Separator('10');

			$Body	.=	'<div class="bar-outer">';
				$Body	.=	'<div class="bar-inner2" style="width:'.$dr.'%"></div>';
				$Body	.=	'<div class="bar-label b_i">'.$dr.'%</div>';
			$Body	.=	'</div>';

			$Tpl_Cards->_build('module',$Title,$Body);
			return $Tpl_Cards->_output();
		}
		# MISC
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