<?php
	class Social{

		public $SOCIAL_URL_FACEBOOK;
		public $SOCIAL_URL_GOOGLEPLUS;
		public $SOCIAL_URL_PINTEREST;
		public $SOCIAL_URL_TWITTER;

		function __construct($DatabaseObj){
			$this->db = $DatabaseObj;

			$this->fetch_SOCIAL_URL_FACEBOOK();
			$this->fetch_SOCIAL_URL_GOOGLEPLUS();
			$this->fetch_SOCIAL_URL_PINTEREST();
			$this->fetch_SOCIAL_URL_TWITTER();
		}
		function fetch_SOCIAL_URL_FACEBOOK(){
			$this->SOCIAL_URL_FACEBOOK = $this->db->do_QUERY("VALUE","SETTINGS_SOCIAL","SETTING","SOCIAL_URL_FACEBOOK");
		}
		function fetch_SOCIAL_URL_GOOGLEPLUS(){
			$this->SOCIAL_URL_GOOGLEPLUS = $this->db->do_QUERY("VALUE","SETTINGS_SOCIAL","SETTING","SOCIAL_URL_GOOGLEPLUS");
		}
		function fetch_SOCIAL_URL_PINTEREST(){
			$this->SOCIAL_URL_PINTEREST = $this->db->do_QUERY("VALUE","SETTINGS_SOCIAL","SETTING","SOCIAL_URL_PINTEREST");
		}
		function fetch_SOCIAL_URL_TWITTER(){
			$this->SOCIAL_URL_TWITTER = $this->db->do_QUERY("VALUE","SETTINGS_SOCIAL","SETTING","SOCIAL_URL_TWITTER");
		}
		function listMyProperties(){
			echo "<b>Class=>Settings Properties:</b> ";
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}