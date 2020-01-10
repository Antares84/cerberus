<?php
	namespace classes\sys;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class FileSys{

		private $database;private $fn;private $method_name;private $mode;private $src;

		private $err	=	array();
		private $error	=	false;
		private $output;

		public function __construct($db,$Dirs,$Tpl){
			$this->db	=	$db;
			$this->Dirs	=	$Dirs;
			$this->Tpl	=	$Tpl;
		}
		public function _class_info($level=false){
			if($level){
				echo '<b>ClassInfo Level: '.$level.'<br>';
			}
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
			}
		}
		public function _do($action,$method_name,$source,$fn,$db=false,$mode=false){
			if($db){$this->database = $db;}
			$this->fn	=	$fn;
			$this->method_name	=	$method_name;
			if($mode){$this->mode = $mode;}
			$this->src	=	$source;
			
			$error		=	'Specified method not found.';

			switch($action){
				case	'read'	:
					$method = '_read_'.$method_name;

					if(method_exists($this,$method)){
						return $this->$method();
					}
					return $error;
				break;
				case	'write'	:
					$method = '_write_'.$method_name;

					if(method_exists($this,$method)){
						return $this->$method();
					}
					return $error;
				break;
				case	'validate'	:
					$method = '_validate'.$method_name;

					if(method_exists($this,$method)){
						return $this->$method();
					}
					return $error;
				break;
				default			:
					return 'An action is required!';
			}
		}
		public function _return(){
			$ret = $this->output;
			$this->mode		=	NULL;
			return $ret;
		}
		public function _Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
		public function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

				#	$this->_build();

					echo '<pre>';
						echo 'Pre Node<br>';
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

		# Private Methods
		private function _do_close(){
			if(isset($this->database) && !empty($this->database)){unset($this->database);}
			if(isset($this->fn) && !empty($this->fn)){unset($this->fn);}
			if(isset($this->source) && !empty($this->source)){unset($this->source);}
		}
		private function _get_img($dir,$width,$height=false){
			$ret = NULL;
			$contents = scandir($dir);

			foreach($contents as $file){
				$ext = pathinfo($file,PATHINFO_EXTENSION);

				@list($filename,$f_width,$f_height) = explode("_",$file);

				$h	=	$f_height;
				$w	=	substr($f_width,0,3);

				if($ext == "jpg" || $ext == "png"){
					if($h == $height){
						if($w == $width){
							$ret.=$file;
						}
					}
					elseif($w == $width){
						$ret.=$file;
					}
				}
			}
			return $ret;
		}
		private function _get_img_diag($dir,$width,$height=false){
			$ret = NULL;
			$contents = scandir($dir);

			echo '<ul>';
			foreach ($contents as $file){
				$ext = pathinfo($file,PATHINFO_EXTENSION);

				@list($filename,$f_width,$f_height) = explode("_",$file);

				$h	=	$f_height;
				$w	=	substr($f_width,0,3);

				if($ext == "jpg" || $ext == "png"){
					if($height == $h){
						$ret.='entered height check';
						if($h == $height && $h !== NULL && $h !== ""){
							if($w == $width && $w !== NULL && $w !== ""){
								$ret.=$file;
							}
						}
					}
					elseif($width == $w){
						$ret.='entered width check';
						if($w == $width && $w !== NULL && $w !== ""){
							$ret.=$file;
						}
					}
					else{
						$ret.='<li>Image width is invalid.</li>';
						$ret.='<li>Valid image height for this component is <b>'.$height.'</b>.</li>';
						$ret.='<li>Valid image width for this component is <b>'.$width.'</b>.</li>';
						$ret.='<li>Detected height <b>'.$h.'</b> and width <b>'.$w.'</b>.</li>';
						$ret.='<li>Targeted dir is <b>'.$dir.'</b>.</li>';
					}
				}
			}
			echo '</ul>';
			return $ret;
		}
		# Upcoming Events Image (Home Page)
		private function _ds_img_via_dir($dir){
			$height	=	"370";
			$width	=	"275";

			return $this->_get_img($dir,$width,$height);
			//return $this->get_IMAGE($dir,$height,$width);
			//return $this->get_IMG_DIAG($dir,$height,$width);
		}
		# Topic Image (Blog)
		private function ds_T_IMG($dir){
			$height	=	"350";
			$width	=	"850";

			return $this->get_IMAGE($dir,$width);
			//return $this->get_IMAGE($dir,$height,$width);
			//return $this->get_IMG_DIAG($dir,$width);
		}
		private function list_zipfiles($mydirectory){
			// directory we want to scan
			$dircontents = scandir($mydirectory);

			// list the contents
			echo '<ul>';
			foreach ($dircontents as $file) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if ($extension == 'zip') {
					echo "<li>$file </li>";
				}
			}
			echo '</ul>';
		}
		private function list_php_files($mydirectory){
			// directory we want to scan
			$files = scandir($mydirectory);

			// list the contents
			echo '<ul>';
			foreach ($files as $file) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if($extension == 'php'){
					echo "<li>$file </li>";
				}
			}
			echo '</ul>';
		}

		public function _validate(){
			$file	=	$this->src.$this->fn;

			switch($this->mode){
				case	1	:
					# Validate
					if(is_file($file)){
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('2','FSRW-0x01').'</td>';
						return true;
					}
					else{
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('3','FSRW-0x02').'</td>';
						return false;
					}
				break;
				case	2	:
					# Read Test
					if(is_readable($file)){
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('2','FSRW-0x01').'</td>';
						return true;
					}
					else{
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('3','FSRW-0x02').'</td>';
						return false;
					}
				break;
				case	3	:
					# Write Test
					if(is_file($file) && is_writable($file)){
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('2','FSRW-0x01').'</td>';
						return true;
					}
					else{
						$this->output	=	'<td class="tac">'.$this->Tpl->_do_alert_text('3','FSRW-0x02').'</td>';
						return false;
					}
				break;
			}
		}
		# READABLE METHODS
		public function _read_gateway(){
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
		public function _read_ipn(){
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
		public function _read_pages_2($source,$filename){
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
		private function _read_pages(){
			$file = $this->src.$this->fn;

			if(is_file($file) && is_readable($file)){
				return $this->Tpl->_do_alert_text('2','FSR-0x01');
			}
			else{
				return $this->Tpl->_do_alert_text('3','FSR-0x02');
			}
		}

		# WRITABLE METHODS
		private function _write_pages_test(){
			$file = $this->src.$this->fn;

			if(is_file($file) && is_writable($file)){
				return $this->Tpl->_do_alert_text('2','FSW-0x01');
			}
			else{
				return $this->Tpl->_do_alert_text('3','FSW-0x02');
			}
		}
		public function _write_shaiya(){
			$newFileName = '/temp.txt';
			if(!is_writable(dirname($newFileName))){
				echo dirname($newFileName).' must writable!!!';
			}
			else{
				echo dirname($newFileName).' is writable.';
			}
		}
		public function _write_colors(){
			$ret		=	false;

			$file		=	$this->source.$this->fn;

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
		public function _write_pages(){
			$file		=	$this->src.$this->fn;

			$success	=	'File is writeable\n';
			$success_1	=	'';
			$error		=	'';
			$text		=	false;

			$sql		=	('
								SELECT *
								FROM '.$this->db->_table_list("SETTINGS_PAGES").'
								ORDER BY PAGE_INDEX ASC
			');
			$stmt		=	odbc_prepare($this->db->conn,$sql);
			$args		=	array();
			$prep		=	odbc_execute($stmt,$args);

			$msg_0		=	'Unable to open '.$file.' for writing...';
			$msg_1		=	'Unable to write to '.$filename.'...';
			$msg_2		=	'Paging array data has been successfully written to <b>'.$filename.'</b>.';
			$msg_3		=	'Error: '.$filename.' is not writable.<br>File Location: '.$file;

			if(is_writable($file)){
				if(!$handle = fopen($file,'c+')){
					$this->_do_close();
					return $msg_0;
				}
				if(fwrite($handle,$success_1) === false){
					$this->_do_close();
					return $msg_1;
				}
				else{
					if($prep){
						while($data = odbc_fetch_array($stmt)){
							fwrite($handle,"\t\t\t\t\t\t\t\t\t\t\t'".$data["PAGE_INDEX"]."'=>'pages_modal',\r\n");
						}
						$this->_do_close();
						return $msg_2;
					}
					else{
						$this->_do_close();
						return $msg_1;
					}
				}
				fclose($handle);
			}else{
				$this->_do_close();
				return $msg_3;
			}
		}
		public function _write_theme(){
			$file		=	$this->src.$this->fn;

			$success	=	'File is writeable\n';
			$success_1	=	'';
			$error		=	'';
			$text		=	false;

			$sql		=	('
								SELECT *
								FROM '.$this->db->_table_list("SETTINGS_THEME").'
								ORDER BY SETTING ASC
			');
			$stmt		=	odbc_prepare($this->db->conn,$sql);
			$args		=	array();
			$prep		=	odbc_execute($stmt,$args);

			$msg_0		=	'Unable to open '.$file.' for writing...';
			$msg_1		=	'Unable to write to '.$this->fn.'...';
			$msg_2		=	'Theme array data has been successfully written to <b>'.$this->fn.'</b>.';
			$msg_3		=	'Error: '.$this->fn.' is not writable.<br>File Location: '.$file;

			if(is_writable($file)){
				if(!$handle = fopen($file,'c+')){
					return $msg_0;
				}
				if(fwrite($handle,$success_1) === false){
					return $msg_1;
				}
				else{
					if($prep){
						while($data = odbc_fetch_array($stmt)){
							fwrite($handle,"\t\t\t\t\t\t\t\t\t\t\t'".$data["SETTING"]."'=>'pages_modal',\r\n");
						}
						return $msg_2;
					}
					else{
						return $msg_1;
					}
				}
				fclose($handle);
			}else{
				return $msg_3;
			}
		}
	}
?>