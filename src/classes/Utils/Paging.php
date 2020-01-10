<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){exit('PAGING: unauthorized access detected, exiting...');}

	class Paging{

		public $_arr;
		public $SITE_TYPE;

		public function __construct($Arrays,$db,$Dirs,$Setting){
			$this->Arrays	=	$Arrays;
			$this->db		=	$db;
			$this->Dirs		=	$Dirs;
			$this->Setting	=	$Setting;

			$this->SITE_TYPE	=	$this->Setting->_arr["SITE_TYPE"];

			$this->_security();
			$this->_class_info();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}		
		public function _class_info($level=false){
			if($level){
				echo '<b>ClassInfo Level: '.$level.'<br>';
			}
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
				default	:	return $this->_build();		break;
			}
		}
		public function _page_stats(){
			echo '<div class="container-fluid page-wrapper">';
				echo '<div id="content" class="container">';
					echo '<div class="row">';
						echo '<div class="col-md-4"></div>';
						echo '<div class="col-md-4">';
							echo '<div class="table-responsive">';
								echo '<table class="table table-sm table-bordered table-striped acp_table tac">';
									echo '<tr>';
										echo '<td>Page</td>';
										echo '<td>'.$this->_arr["PAGE"].'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page Index</td>';
										echo '<td>'.$this->_arr["PAGE_INDEX"].'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page Sub</td>';
									if(empty($this->_arr["PAGE_SUB"])){echo '<td>NULL</td>';}
									else{echo '<td>'.$this->_arr["PAGE_SUB"].'</td>';}
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page Title</td>';
										echo '<td>'.$this->_arr["PAGE_TITLE"].'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page URI</td>';
										echo '<td>'.$this->_arr["PAGE_URI"].'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Page Zone</td>';
										echo '<td>'.$this->_arr["PAGE_ZONE"].'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Standalone</td>';
										echo '<td>'.$this->_arr["STANDALONE"].'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<td>Columns</td>';
										echo '<td>'.$this->_arr["COLUMNS"].'</td>';
									echo '</tr>';
								echo '</table>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			exit;
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
		private function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

					$this->_build();

					if(!empty($this->_arr)){
						echo '<pre>';
							echo 'Pre Node (_arr)<br>';
							var_dump($this->_arr);
						echo '</pre>';
					}

					if(!empty($this->_a)){
						echo '<pre>';
							echo 'Pre Node (_a)<br>';
							var_dump($this->_a);
						echo '</pre>';
					}
					
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

		private function _build(){
			if($this->_arr){$this->_arr=null;}
			$this->_a=array();

			$class_methods	=	get_class_methods($this);

			foreach($class_methods as $method_name){
				if(!in_array($method_name,$this->Arrays->no_index)){
					try{
						$this->$method_name();
					#	echo $method_name.'<br>';
					}
					catch(exception $e){
						throw new SystemException('Error in <b>'.get_class($this),0,0,__FILE__,__LINE__);
					}
				}
			}

			$this->_do_close(true);
		}
		private function _load_page($page_req=''){
			if(!empty($page_req)){
				$this->_a["PageLink"]=$page_req;
			}
			elseif($_SERVER["REQUEST_URI"] === "/" || $_SERVER["REQUEST_URI"] === ""){
				$this->_a["PageLink"]="HOME";
			}
			else{
				$this->_a["PageLink"]=isset($_GET[$this->Setting->_arr["PAGE_PREFIX"]]) ? $_GET[$this->Setting->_arr["PAGE_PREFIX"]] : false;
			}
			$this->_do_close();

			$sql	=	('
							SELECT TOP 1 *
							FROM '.$this->db->_table_list("SETTINGS_PAGES").'
							WHERE PAGE_INDEX=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($this->_a["PageLink"]);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					$array_pages = array($data["PAGE_INDEX"]=>$data["PAGE_URI"]);

					$this->_a["PageZone"]	=	$data["PAGE_ZONE"];
					$this->_a["PageTitle"]	=	$data["PAGE_TITLE"];
					$this->_a["PageURI"]	=	$data["PAGE_URI"];
					$this->_a["PageIndex"]	=	$data["PAGE_INDEX"];
					$this->_a["PageSub"]	=	$data["PAGE_SUB"];
					$this->_a["Standalone"]	=	$data["STANDALONE"];
					$this->_a["Columns"]	=	$data["COLUMNS"];
					$this->_do_close();
				}
			}
			if(@!array_key_exists($this->_a["PageLink"],$array_pages) || @!is_file($this->Dirs->_arr["CONTENT"].$array_pages[$this->_a["PageLink"]])){
			#	$this->_load_page('ERROR');
				$this->_a["Page"]	=	$this->Dirs->_arr["CONTENT"].$array_pages[$this->_a["PageLink"]];
			}else{
				$this->_a["Page"]	=	$this->Dirs->_arr["CONTENT"].$array_pages[$this->_a["PageLink"]];
			}
			$this->_do_close();
		}
		public function _update_page_show($RowID,$data){
			$sql	=	('
							UPDATE '.$db->_table_list('SETTINGS_PAGES').'
							SET PAGE_SHOW=?
							WHERE SITE_TYPE!=?
			');
			$stmt	=	odbc_prepare($db->conn,$sql);
			$args	=	array($RowID,$data);
			odbc_execute($stmt,$args);
		}
		public function _update_page_standalone($RowID,$data){
			$sql	=	('
							UPDATE '.$db->_table_list('SETTINGS_PAGES').'
							SET PAGE_SHOW=?
							WHERE SITE_TYPE!=?
			');
			$stmt	=	odbc_prepare($db->conn,$sql);
			$args	=	array($RowID,$data);
			odbc_execute($stmt,$args);
		}
		public function _update_page_columns($RowID,$data){
			$sql	=	('
							UPDATE '.$db->_table_list('SETTINGS_PAGES').'
							SET STANDALONE=?
							WHERE SITE_TYPE!=?
			');
			$stmt	=	odbc_prepare($db->conn,$sql);
			$args	=	array($RowID,$data);
			odbc_execute($stmt,$args);
		}
		# MISC
		private function _do_close($push=false){
			$this->_arr=$this->_a;

			if($push){
				unset($this->_a);
			}
		}
	}