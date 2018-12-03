<?php
	class Version{

		public $UPDATER_KEY;
		public $UPDATER_URI;

		public $VERSION;
		public $CODENAME;
		public $RELEASE_DATE;
		public $CHANGELOG;
		public $VERSION_KEY;
		public $PATCH_DATA;

		function __construct($db,$Data,$Setting){
			$this->db		=	$db;
			$this->Data		=	$Data;
			$this->Setting	=	$Setting;

			$this->UPDATER_URI();
			$this->UPDATER_KEY();

			$this->Load_Version_XML();
		}
		function QUERY($DB,$DATA,$ALERT){
			$this->QUERY = $this->db->do_QUERY("VALUE",$DB,"SETTING",$DATA);

			if($ALERT){
				if(!$this->QUERY){
					throw new SystemException('Unable to load var <b>'.$DATA.'</b> from database!',0,0,__FILE__,__LINE__);
				}
				else{
					return $this->QUERY;
				}
			}
			else{
				return $this->QUERY;
			}
		}
		function UPDATER_KEY(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","UPDATER_KEY",1);
			$this->UPDATER_KEY			=	$this->QUERY;
		}
		function UPDATER_URI(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","UPDATER_URI",1);
			$this->UPDATER_URI			=	$this->QUERY;
		}
		function do_VersionCheck(){
			file_get_contents('http://fileserve.ndf-innovations.net/versioning/NHMzbFqcAFaFzSNH9MQO3VqB.pkey');
		}
		function ValidateVersion(){
			$ret	=	false;

			if($this->Setting->VERSION != $this->VERSION){
				$ret	=	'<div class="btn-warning">A new update is available: Version <font class="b_i>">'.$this->VERSION.'</font></div>';
			}
			else{
				$ret	=	'<div class="btn-success">Up To Date</div>';
			}

			return $ret;
		}
		function Load_Version_XML(){
			$UPDATER_URI	=	$this->Data->urlsafe_b64decode($this->UPDATER_URI);
			$VersionInfo	=	simplexml_load_file($this->Data->urlsafe_b64decode($this->UPDATER_URI)) or die('XMLParser: Failed to read object!');

			foreach($VersionInfo as $vi){

				$this->CODENAME		=	$vi->codename;
				$this->VERSION		=	$vi->version;
				$this->RELEASE_DATE	=	$vi->reldate;
				$this->CHANGELOG	=	$vi->changelog;
				$this->VERSION_KEY	=	$vi['versionkey'];

				if($vi['versionkey'] == $this->UPDATER_KEY){
					$this->PATCH_DATA = '<div class="table-responsive">';
						$this->PATCH_DATA	.=	'<table class="table table-sm table-bordered table-striped acp_table tac">';
							$this->PATCH_DATA	.=	'<thead>';
								$this->PATCH_DATA	.=	'<tr>';
									$this->PATCH_DATA	.=	'<th>Codename</th>';
									$this->PATCH_DATA	.=	'<th>Version</th>';
									$this->PATCH_DATA	.=	'<th>Release Date</th>';
								$this->PATCH_DATA	.=	'</tr>';
							$this->PATCH_DATA	.=	'</thead>';
							$this->PATCH_DATA	.=	'<tbody>';
								$this->PATCH_DATA	.=	'<tr>';
									$this->PATCH_DATA	.=	'<td>'.$this->CODENAME.'</td>';	
									$this->PATCH_DATA	.=	'<td>'.$this->VERSION.'</td>';
									$this->PATCH_DATA	.=	'<td>'.$this->RELEASE_DATE.'</td>';
								$this->PATCH_DATA	.=	'</tr>';
							$this->PATCH_DATA	.=	'</tbody>';
						$this->PATCH_DATA	.=	'</table>';
					$this->PATCH_DATA	.=	'</div>';

					$this->PATCH_DATA	.=	$this->CHANGELOG->subone->title.'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->one).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->two).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->three).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->four).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->five).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->six).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->seven).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->eight).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->nine).'<br>';
					$this->PATCH_DATA	.=	$this->Data->xml_parser($this->CHANGELOG->subone->ten).'<br>';
				}
				else{
					$this->PATCH_DATA	.=	'Your key is invalid! Please contact your developer for a valid key.';
				}
			}
		}
		function Props(){
			echo "<b>Class=>Version Properties:</b> ";
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}
?>