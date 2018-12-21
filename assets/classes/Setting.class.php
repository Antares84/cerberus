<?php
	class Setting{

		public $PAGE_PREFIX;public $SETUP;
		public $ADDRESS_1;public $ADDRESS_2;public $ADDRESS_3;
		public $EMAIL_SALES;public $EMAIL_SUPPORT;
		public $PHONE_PRIMARY;public $PHONE_SECONDARY;
		public $AUTHOR;public $WEBMASTER;public $SITE_TITLE;public $ACP_SITE_TITLE;public $SITE_DOMAIN;public $METATAG_TITLE;public $METATAG_DESC;public $METATAG_KEYWORDS;
		public $DEBUG;public $LOGGING;public $HTTPS_SSL;public $SITE_TYPE;
		public $RECAPTCHA_SITE_KEY;public $RECAPTCHA_SEC_KEY;
		public $VERSION;public $UPDATER_KEY;
		public $MAINTENANCE;

		# SQL
		private $QUERY;

		function __construct($Data,$db){
			$this->Data	=	$Data;
			$this->db	=	$db;

			$this->PAGE_PREFIX();
			$this->SETUP();
			$this->ADDRESS_1();
			$this->ADDRESS_2();
			$this->ADDRESS_3();
			$this->EMAIL_SALES();
			$this->EMAIL_SUPPORT();
			$this->PHONE_PRIMARY();
			$this->PHONE_SECONDARY();
			$this->AUTHOR();
			$this->WEBMASTER();
			$this->SITE_TITLE();
			$this->ACP_SITE_TITLE();
			$this->SITE_DOMAIN();
#			$this->METATAG_TITLE();
#			$this->METATAG_DESC();
#			$this->METATAG_KEYWORDS();
			$this->DEBUG();
			$this->LOGGING();
			$this->HTTPS_SSL();
			$this->SITE_TYPE();
			$this->RECAPTCHA_SITE_KEY();
			$this->RECAPTCHA_SEC_KEY();
			$this->VERSION();
			$this->UPDATER_KEY();
			$this->MAINTENANCE();
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
		function SET_DEFAULTS(){
			$sql	=	('
							UPDATE '.$this->db->get_TABLE("SETTINGS_MAIN").'
							SET EDIT=?
			');
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array(0);
			odbc_execute($stmt,$args);
		}
		# MAIN
		function LOAD_SETTINGS_XML(){
			$Settings = @simplexml_load_file("http://cdn.ndf-innovations.net/cms/version.xml") or die('XMLParser: Failed to read object!');

			foreach($Settings as $STNG){
				$Site		=	$STNG->site;
				$Meta		=	$STNG->meta;
				$SiteType	=	$STNG['type'];

				if($SiteType == $this->SITE_TYPE){
					
				}
			}
		}
		function PAGE_PREFIX(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","PAGE_PREFIX",1);
			$this->PAGE_PREFIX			=	$this->QUERY;
		}
		function SETUP(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","SETUP",0);
			$this->SETUP				=	$this->QUERY;
		}
		# ADDRESS
		function ADDRESS_1(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","ADDRESS_1",1);
			$this->ADDRESS_1			=	$this->QUERY;
		}
		function ADDRESS_2(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","ADDRESS_2",1);
			$this->ADDRESS_2			=	$this->QUERY;
		}
		function ADDRESS_3(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","ADDRESS_3",1);
			$this->ADDRESS_3			=	$this->QUERY;
		}
		function ADDRESS_COMP(){
			return $this->ADDRESS_1.'<br>'.$this->ADDRESS_2.'<br>'.$this->ADDRESS_3;
		}
		# E-MAIL
		function EMAIL_SALES(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","EMAIL_SALES",1);
			$this->EMAIL_SALES			=	$this->QUERY;
		}
		function EMAIL_SUPPORT(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","EMAIL_SUPPORT",1);
			$this->EMAIL_SUPPORT		=	$this->QUERY;
		}
		# PHONE
		function PHONE_PRIMARY(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","PHONE_PRIMARY",1);
			$this->PHONE_PRIMARY		=	$this->QUERY;
		}
		function PHONE_SECONDARY(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","PHONE_SECONDARY",1);
			$this->PHONE_SECONDARY		=	$this->QUERY;
		}
		# META
		function AUTHOR(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","AUTHOR",1);
			$this->AUTHOR				=	$this->QUERY;
		}
		function WEBMASTER(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","WEBMASTER",1);
			$this->WEBMASTER			=	$this->QUERY;
		}
		function SITE_TITLE(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","SITE_TITLE",1);
			$this->SITE_TITLE			=	$this->QUERY;
		}
		function ACP_SITE_TITLE(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","ACP_SITE_TITLE",1);
			$this->ACP_SITE_TITLE		=	$this->QUERY;
		}
		function SITE_DOMAIN(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","SITE_DOMAIN",1);
			$this->SITE_DOMAIN			=	$this->QUERY;
		}
		function METATAG_TITLE(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","METATAG_TITLE",1);
			$this->METATAG_TITLE		=	$this->QUERY;
		}
		function METATAG_DESC(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","METATAG_DESC",1);
			$this->METATAG_DESC			=	$this->QUERY;
		}
		function METATAG_KEYWORDS(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","METATAG_KEYWORDS",1);
			$this->METATAG_KEYWORDS		=	$this->QUERY;
		}
		# DEV
		function DEBUG(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","DEBUG",0);
			$this->DEBUG				=	$this->QUERY;
		}
		function LOGGING(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","LOGGING",0);
			$this->LOGGING				=	$this->QUERY;
		}
		function HTTPS_SSL(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","HTTPS_SSL",0);
			$this->HTTPS_SSL			=	$this->QUERY;
		}
		function SITE_TYPE(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","SITE_TYPE",1);
			$this->SITE_TYPE			=	$this->QUERY;
		}
		# RECAPTCHA
		function RECAPTCHA_SITE_KEY(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","RECAPTCHA_SITE_KEY",1);
			$this->RECAPTCHA_SITE_KEY	=	$this->QUERY;
		}
		function RECAPTCHA_SEC_KEY(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","RECAPTCHA_SEC_KEY",1);
			$this->RECAPTCHA_SEC_KEY	=	$this->QUERY;
		}
		# VERSIONING
		function VERSION(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","VERSION",1);
			$this->VERSION				=	$this->QUERY;
		}
		function UPDATER_KEY(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","UPDATER_KEY",1);
			$this->UPDATER_KEY			=	$this->QUERY;
		}
		# MAINTENANCE
		function MAINTENANCE(){
			$this->QUERY				=	$this->QUERY("SETTINGS_MAIN","MAINTENANCE",0);
			$this->MAINTENANCE			=	$this->QUERY;
		}
		function MAINTENANCE_CHECK(){
			if($this->MAINTENANCE){
				header("location: ?".$this->PAGE_PREFIX."=MAINTENANCE");
			}
		}
		# OTHER
		function Props(){
			echo "<b>Class > Settings Properties:</b> "; 
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}
?>