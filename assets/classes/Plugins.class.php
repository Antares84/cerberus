<?php
	class Plugins{

		public $PLUGIN_ARR=array();public $PLUGIN_NAME;public $PLUGIN_MASTERFILE;public $PLUGIN_PHP;public $PLUGIN_AJAX;public $PLUGIN_JS;public $PLUGIN_VERSION;public $PLUGIN_DATE;
		public $MODE='void';public $OPT_A='DISPLAY';public $OPT_B='INSTALL';
		public $PageZone;

		function __construct($db,$Dirs,$Modal,$SQL,$Style,$Template){
			$this->db		=	$db;
			$this->Dirs		=	$Dirs;
			$this->Modal	=	$Modal;
			$this->SQL		=	$SQL;
			$this->Style	=	$Style;
			$this->Tpl		=	$Template;
		}
		# PLUGINS
		function plugin_search(){
			$sql	=	("
							SELECT *
							FROM ".$this->db->get_TABLE("SETTINGS_PLUGINS")."
							WHERE PLUGIN_ENABLED=?
							ORDER BY PLUGIN_ORDER ASC
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array(1);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					while($data = odbc_fetch_array($stmt)){
						$this->MODE = $this->OPT_A;
						$this->plugin_load($data["PLUGIN_MASTERFILE"]);
					}
				}
				else{
					$this->get_PLUGIN_FILES($this->Dirs->DIR_PLUGINS);
				}
			}
			$this->get_PLUGIN_FILES($this->Dirs->DIR_PLUGINS);
		}
		function get_PLUGIN_FILES($dir){
			$plugins = scandir($dir);

			foreach($plugins as $plugin){
				$ext = pathinfo($plugin,PATHINFO_EXTENSION);

				if($ext == 'php'){
					$this->PLUGIN_MASTERFILE = $plugin;
					$this->plugin_validate($plugin);
				}
			}
		}
		function plugin_validate($plugin){
			$sql	=	("SELECT * FROM ".$this->db->get_TABLE("SETTINGS_PLUGINS")." WHERE [PLUGIN_MASTERFILE]=?");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($plugin);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				if(odbc_num_rows($stmt) > 0){
					$this->MODE = $this->OPT_A;
				}else{
					$this->MODE = $this->OPT_B;
				}
				$this->plugin_load($plugin);
			}
		}
		function plugin_load($plugin=false){
			if($plugin == false || empty($plugin)){
				$sql	=	('
								SELECT [PLUGIN_MASTERFILE]
								FROM '.$this->db->get_TABLE("SETTINGS_PLUGINS").'
								WHERE [PLUGIN_ENABLED]=?
								ORDER BY [PLUGIN_ORDER] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array(1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					while($data = odbc_fetch_array($stmt)){
						require_once($this->Dirs->DIR_PLUGINS.$data["PLUGIN_MASTERFILE"]);
					}
				}
			}
			else{
				$sql	=	('
								SELECT *
								FROM '.$this->db->get_TABLE("SETTINGS_PLUGINS").'
								WHERE [PLUGIN_MASTERFILE]=? AND [PLUGIN_ENABLED]=?
								ORDER BY [PLUGIN_ORDER] ASC
				');
				$stmt	=	odbc_prepare($this->db->conn,$sql);
				$args	=	array($plugin,1);
				$prep	=	odbc_execute($stmt,$args);

				if($prep){
					if(odbc_num_rows($stmt) > 0){
						while($data = odbc_fetch_array($stmt)){
							if($data["PLUGIN_ENABLED"] == 1){
								require_once($this->Dirs->DIR_PLUGINS.$data["PLUGIN_MASTERFILE"]);
							}
						}
					}
					else{
						if($this->MODE == "INSTALL"){
							require_once($this->Dirs->DIR_PLUGINS.$plugin);
						}
					}
				}
			}
		}
		function formatSize($bytes){
			# Get Drive Space Stats
			$types=array('B','KB','MB','GB','TB');
			for($i=0;$bytes>=1024&&$i<(count($types)-1);$bytes/=1024,$i++);
			return(round($bytes,2)." ".$types[$i]);
		}
		function Storage_Meter($data){
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

			echo $this->Tpl->PLUGIN_CARD($Title,'',$Body,'');
		}
		# PROPS LIST
		function Props(){
			# Debugging
			echo "<b>Class=>Settings Properties:</b> ";
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}
?>