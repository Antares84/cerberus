<?php
	class Paging{

		public $PAGE_TITLE;public $PAGE_SUB;public $PAGE_URI;public $PAGE_INDEX;public $PAGE;public $PAGE_ZONE;public $PAGE_LINK;

		function __construct($db,$Setting){
			$this->db		=	$db;
			$this->Setting	=	$Setting;
		}
		function _do_LAUNCH_PAGE(){
			if($_SERVER["REQUEST_URI"] === "/" || $_SERVER["REQUEST_URI"] === ""){
				$this->PAGE_LINK	=	"HOME";
			}
			else{
				$this->PAGE_LINK	=	isset($_GET[$this->Setting->PAGE_PREFIX]) ? $_GET[$this->Setting->PAGE_PREFIX] : false;
			}

			$_SESSION["RequestedPage"] = $this->PAGE_LINK;

			$sql	=	('
							SELECT TOP 1 *
							FROM '.$this->db->get_TABLE("SETTINGS_PAGES").'
							WHERE PAGE_INDEX=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($this->PAGE_LINK);
			$prep	=	odbc_execute($stmt,$args);

			if($prep){
				while($data = odbc_fetch_array($stmt)){
					$array_pages = array($data["PAGE_INDEX"]=>$data["PAGE_URI"]);

					$this->PAGE_ZONE	=	$data["ZONE"];
					$this->PAGE_TITLE	=	$data["PAGE_TITLE"];
					$this->PAGE_URI		=	$data["PAGE_URI"];
					$this->PAGE_INDEX	=	$data["PAGE_INDEX"];
					$this->PAGE_SUB		=	$data["PAGE_SUB"];
				}
			}
			if(@!array_key_exists($this->PAGE_LINK,$array_pages)){
				$this->PAGE				=	"assets/content/cms/main/error.php";
			}
			elseif(@!is_file($array_pages[$this->PAGE_LINK])){
				$this->PAGE				=	"assets/content/cms/main/error.php";
			}
			else{
				$this->PAGE				=	$array_pages[$this->PAGE_LINK];
			}
		}
		function Props(){
			echo '<div class="col-md-12">';
				echo '<b>Properties for class ('.get_class($this).'):</b><br>';
				echo '<pre>';
					echo print_r(get_object_vars($this));
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}