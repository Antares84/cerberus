<?php
	namespace Classes\Display\Templates\CMS;

	class Content{

		public $container_type;
		private $target;
		private $dev_block=false;
		private $page;

		# Output
		private $output;

		# Template Placeholders
		private $Wrapper;
		private $Nav;
		private $Header;
		private $Sidebar;
		private $Footer;

		public function __construct($Dirs,$Modal,$Modules,$MSSQL,$Paging,$Setting,$SQL,$Stats,$Theme,$Tpl,$User){
			$this->Dirs		=	$Dirs;
			$this->Modules	=	$Modules;
			$this->MSSQL	=	$MSSQL;
			$this->Paging	=	$Paging;
			$this->Setting	=	$Setting;
			$this->SQL		=	$SQL;
			$this->Stats	=	$Stats;
			$this->Theme	=	$Theme;
			$this->Tpl		=	$Tpl;
			$this->User		=	$User;

			$this->_security();
			$this->_content();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>: unauthorized access detected, exiting...';
				exit;
			}
		}
		private function _content(){
		#	$this->Setting->_do_maint_chk($this->Paging->PAGE_INDEX);

			# Load Wrapper
			$this->_load_wrapper();
			# Load Nav
			$this->_load_nav();
			# Load Sidebar
		#	$this->_load_sidebar();
			# Load body && background + styling
			$this->output.=$this->Tpl->_get_bg($this->Paging->_arr["PageZone"]);
			# Debug
	#		$this->_debug();
			# Load header/logo
			$this->_load_header();
			# Load Breadcrumb
			$this->_load_bc();
			# Get page resources
			$this->_get_page();
			# Load content
			$this->output.='<div class="container-fluid page-wrapper">';

			# Check if current page is a standalone page
			if($this->Paging->_arr["Standalone"]===1){
				if($this->Paging->_arr["Columns"]===1){
					# Load messenger/error container
				#	$this->Content->_get_MESSENGER();
				#	echo $this->Tpl->Separator('10');
					$this->output.='<div id="content" class="container"';
						if($this->Theme->_arr["PANE_BG_COLOR"] && $this->Theme->_arr["PANE_BG_TRANS"]){
							$this->output.=' style="background-color:rgba('.$this->Theme->_arr["PANE_BG_COLOR"].','.$this->Theme->_arr["PANE_BG_TRANS"].');"';
						}
						else{
							$this->output.='>';
						}
						$this->output.='<div class="row">';
						if($this->Theme->_arr["SIDEBAR_POS"] == "0" || $this->Theme->_arr["MODULES_STATUS"] ==  false){
							# Content full-width + no sidebar
							$this->output.='<div class="col-md-12">';
								require_once($this->Paging->_arr["Page"]);
							$this->output.='</div>';
						}
						else{
							# Sidebar Left
							if($this->Theme->_arr["SIDEBAR_POS"] === "1"){
								$this->output.='<div class="col-md-12">';
									$this->output.='<div class="row">';
										$this->output.='<div class="col-md-3">';
											$this->_sidebar();
										$this->output.='</div>';
										$this->output.='<div class="col-md-9">';
											require_once($this->Paging->_arr["Page"]);
										$this->output.='</div>';
									$this->output.='</div>';
								$this->output.='</div>';
							}
							# Sidebar Right
							elseif($this->Theme->_arr["SIDEBAR_POS"] === "2"){
								$this->output.='<div class="col-md-12">';
									$this->output.='<div class="row">';
										$this->output.='<div class="col-md-9">';
											require_once($this->Paging->_arr["Page"]);
										$this->output.='</div>';
										$this->output.='<div class="col-md-3">';
											$this->_sidebar();
										$this->output.='</div>';
									$this->output.='</div>';
								$this->output.='</div>';
							}
						}
						$this->output.='</div>';
					$this->output.='</div>';
				}
				else{
					# Load header/logo
				#	$Tpl_Header->PageZone	=	$this->Paging->_arr["PageZone"];
				#	$Tpl_Header->_run();
					# Load Dev Block
				#	if($this->dev_block){
				#		$this->_dev_block();
				#	}
					# Load page content
				#	require_once($this->_arr["Page"]);
					# Load Sidebar
				#	$Tpl_Sidebar->output;
				}
			}
			else{
				# Load Dev Block
				if($this->dev_block===true){$this->_dev_block();}
/*
				# Load messenger/error container
				$this->Content->_get_MESSENGER();
				$this->output.=$this->Tpl->Separator('10');
*/

/*
				# Set column && container properties
				$this->_set("id","content");
				$this->_set("data",$this->page);
				$this->_set("size","md");
				$this->_set("width","9");

				# Get contents in sequence for visualization
				$this->_get("col",true);
				$this->_get("row",true);
				$this->_get("container");

*/
				if($this->Theme->_arr["SIDEBAR_POS"] == "0" || $this->Theme->_arr["MODULES_STATUS"]==false){
					# Content full-width && no sidebar
						$this->_set("id","content");
						$this->_set("data",$this->page);
						$this->_set("size","md");
						$this->_set("width","12");
						$this->_get("col",true);
				}
				else{
					# Sidebar Left
					if($this->Theme->_arr["SIDEBAR_POS"] === "1"){
						# Sidebar
						$this->_set("size","md");
						$this->_set("width","3");
						$this->_get("col",true);

						# Content
						$this->_set("data",$this->page);
						$this->_set("size","md");
						$this->_set("width","9");
						$this->_get("col",true);
					}
					# Sidebar Right
					elseif($this->Theme->_arr["SIDEBAR_POS"] === "2"){
						# Load content first, so that it is to the left of sidebar
						# Content
						$this->_get_content(true);
						# Sidebar
						$this->_get_sb();
						# Wrap content & sidebar into wrapper
						$this->_get("wrap","base");
					}
				}
				# Set container styling if available
				if(!empty($this->Theme->_arr["PANE_BG_COLOR"]) && !empty($this->Theme->_arr["PANE_BG_TRANS"])){
					$data='background-color:rgba('.$this->Theme->_arr["PANE_BG_COLOR"].','.$this->Theme->_arr["PANE_BG_TRANS"].');';
					$this->_set("style",$data);
				}
			}
			# Wrap content in row
			$this->_get("row",true);
			# Wrap row in container
			$this->_set("id","content");
			$this->_get("container",true);
			# Get output of all loaded visualizations
			$this->output.=$this->_get("output");
			# Close page-wrapper
			$this->output.='</div>';
			$this->output.=$this->Tpl->Separator(100);
			# Load footer resources
			$this->_load_footer();
			# Load modal resources
		#	$this->Modal->_get_MDOAL_LINKS();
		#	$this->Modal->_get_MODAL_SCRIPTS();
			# Close html
		#	$this->_close();
		#	$this->output.=$this->Wrapper->_Props();
		#	$this->output.=$this->Sidebar->_Props();
		#	$this->output.=$this->Modules->_Props();


		}
		private function _close(){
		#	$this->_js_addons_shared();
			$this->output.='</body>';
			$this->output.='</html>';
		}
		# Class::Wrapper Methods
		private function _load_wrapper(){
			$this->Wrapper=new Wrapper;
		}
		private function _set($var,$data){
			try{
				if(!isset($this->Wrapper->$var) && !empty($data)){
					$this->Wrapper->_set($var,$data);
				}
			}
			catch(exception $e){
				throw new \Classes\Exception\SystemException('Error in <b>'.get_class($this).'<br>'.$err,0,0,__FILE__,__LINE__);
			}
		}
		private function _get($method,$set=false){
			$this->Wrapper->_get($method,$set);
		}
		# Class::Nav Methods
		private function _load_nav(){
			$this->Nav		=	new \Classes\Display\Templates\CMS\Nav($this->MSSQL,$this->Paging,$this->Setting,$this->Stats,$this->Theme,$this->Tpl,$this->User);
			$this->Nav->_output();
		}
		# Class::Header Methods
		private function _load_header(){
			$this->Header	=	new \Classes\Display\Templates\CMS\Header($this->Paging,$this->Tpl);
			$this->output.=$this->Header->_output();
		}
		# Class::Breadcrumb Methods
		private function _load_bc(){
			$this->Breadcrumb	=	new \Classes\Display\Templates\CMS\Breadcrumb($this->Paging,$this->Setting,$this->Theme);
			$this->Breadcrumb->bc_output();
		}
		# Class::Sidebar Methods
		private function _load_sidebar(){
			$this->Sidebar	=	new \Classes\Display\Templates\CMS\Sidebar($this->Dirs,$this->Modules,$this->MSSQL,$this->Theme);
		}
		# Class::Footer Methods
		private function _load_footer(){
			$this->Footer	=	new \Classes\Display\Templates\CMS\Footer($this->Paging,$this->Setting,$this->Theme,$this->Tpl,$this->User);
			$this->Footer->_output();
		}
		# Misc
		private function _load_debug(){
			$pre='<pre>';
				$pre.='Standalone: '.$this->Paging->_arr["Standalone"].'<br>';
				$pre.='Columns: '.$this->Paging->_arr["Columns"].'<br>';
				$pre.='Sidebar: '.$this->Theme->_arr["SIDEBAR_POS"];
			$pre.='</pre>';
			$this->_set("pre",$pre);
			$this->output.=$this->_get("container");
		}
		private function _get_content($sb){
			if($sb==true){
				$this->_set("id","content");
				$this->_set("content",$this->page);
				$this->_set("size","md");
				$this->_set("width","9");
				$this->_get("col",true);
			}
			else{
				$this->_set("id","content");
				$this->_set("content",$this->page);
				$this->_set("size","md");
				$this->_set("width","12");
				$this->_get("col",true);
			}
		}
		private function _get_sb(){
		#	$this->_load_sidebar();
		#	$sidebar=$this->Sidebar->_output();
		#	$this->_set("sidebar",$sidebar);


			$this->_set("sidebar","some content");
			$this->_set("sb",true);
			$this->_set("size","md");
			$this->_set("width","3");
			$this->_get("col",true);
		}
		private function _get_page(){
			$this->page=require_once($this->Paging->_arr["Page"]);
		}
		private function _get_col($size,$width,$data=false){
			$Tpl_Columns=new \classes\Display\Templates\CMS\Columns;
			return $Tpl_Columns->_get_col($size,$width,$data);
		}
		public function _output(){
			echo $this->output;
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
		public function _Mthds($_array=false){
			$class_methods	=	get_class_methods($this);

			if($_array){
				echo '<div class="col-md-12">';
					echo '<b>Methods & Details for class ('.get_class($this).'):</b><br>';

				#	$this->_build();

					echo '<pre>';
						var_dump($this->_arr);
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
		private function _update($set=false){
			if($set==true){
				$this->output=$this->data;
				$this->data="";
			}
		}

	}
?>