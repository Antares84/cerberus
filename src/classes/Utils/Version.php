<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	class Version{

		# From Settings class
		public $updater_key;
		public $updater_uri;

		# From XML class
		public $codename;
		public $rel_date;
		public $c_version;
		public $c_versionID;
		public $n_version;
		public $n_versionID;

		function __construct($db,$XML){
			$this->db		=	$db;
			$this->XML		=	$XML;

			$this->_get_version_data();
		}
		function _get_version_data(){
			# Load data from XML class
			$this->updater_key=$this->XML->updater_key;
			$this->updater_uri=$this->XML->updater_uri;

			$this->codename=$this->XML->codename;
			$this->rel_date=$this->XML->rel_date;
			$this->c_version=$this->XML->c_version;
			$this->c_versionID=$this->XML->c_versionID;
			$this->n_version=$this->XML->n_version;
			$this->n_versionID=$this->XML->n_versionID;
		}
		function _do_validate_version($vi=false){
			if($this->c_version!=$this->n_version){
				if($vi){return false;}
				if(!$this->n_version){
					$ret	=	'<div class="badge-success">Up To Date</div>';
				}
				else{
					$ret	=	'<div class="badge-danger">A new update is available: Version <font class="b_i>">'.$this->n_version.'</font></div>';
				}
			}
			else{
				if($vi){return true;}
				else{
					$ret	=	'<div class="badge-success">Up To Date</div>';
				}
			}

			return $ret;
		}
		function Props(){
			echo "<b>Class=>Version Properties:</b> ";
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
		function _get_class_methods(){
			$class_methods	=	get_class_methods($this);
			echo '<div class="col-md-12">';
				echo '<b>Class ('.get_class($this).') Methods:</b> <br>';
				echo '<pre>';
				foreach($class_methods as $method_name){
					echo $method_name.'<br>';
				}
				echo '</pre>';
			echo '</div>';
			exit();
		}
	}
?>