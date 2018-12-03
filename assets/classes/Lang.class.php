<?php
	class Lang{

		#Address
		public $ADDRESS_1;public $ADDRESS_2;public $ADDRESS_3;public $ADDRESS_COMP;
		# Email
		public $EMAIL_SALES;public $EMAIL_SUPPORT;
		# MISC
		public $FOOTER;public $AUTHOR;public $SITE_TITLE;public $SITE_TITLE_EXT;public $URL;public $WEBMASTER;
		# PHONE
		public $PHONE_PRIMARY;public $PHONE_SECONDARY;

		function __construct($DatabaseObj){
			$this->db	=	$DatabaseObj;

			# ADDRESS
			$this->ADDRESS_1();$this->ADDRESS_2();$this->ADDRESS_3();$this->ADDRESS_COMP();
			# EMAIL
			$this->EMAIL_SALES();$this->EMAIL_SUPPORT();
			# MISC
			$this->FOOTER();$this->AUTHOR();$this->SITE_TITLE();//	$this->SITE_TITLE_EXT();
			$this->URL();$this->WEBMASTER();
			# PHONE
			$this->PHONE_PRIMARY();$this->PHONE_SECONDARY();
		}
		# ADDRESS
		function ADDRESS_1(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","ADDRESS_1");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>ADDRESS_1</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->ADDRESS_1	=	$this->QUERY;
		}
		function ADDRESS_2(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","ADDRESS_2");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>ADDRESS_2</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->ADDRESS_2	=	$this->QUERY;
		}
		function ADDRESS_3(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","ADDRESS_3");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>ADDRESS_3</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->ADDRESS_3	=	$this->QUERY;
		}
		function ADDRESS_COMP(){
			$this->ADDRESS_COMP	=	$this->ADDRESS_1."<br>".$this->ADDRESS_2."<br>".$this->ADDRESS_3;
		}
		# E-MAIL
		function EMAIL_SALES(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","EMAIL_SALES");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>EMAIL_SALES</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->EMAIL_SALES	=	$this->QUERY;
		}
		function EMAIL_SUPPORT(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","EMAIL_SUPPORT");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>EMAIL_SUPPORT</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->EMAIL_SUPPORT	=	$this->QUERY;
		}
		# MISC
		function FOOTER(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","FOOTER");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>FOOTER</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->FOOTER	=	$this->QUERY;
		}
		function AUTHOR(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","AUTHOR");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>AUTHOR</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->AUTHOR	=	$this->QUERY;
		}
		function SITE_TITLE(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","SITE_TITLE");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>SITE_TITLE</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->SITE_TITLE	=	$this->QUERY;
		}
		function SITE_TITLE_EXT(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","SITE_TITLE_EXT");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>SITE_TITLE_EXT</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->SITE_TITLE_EXT	=	$this->QUERY;
		}
		function URL(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","URL");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>URL</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->URL	=	$this->QUERY;
		}
		function WEBMASTER(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","WEBMASTER");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>WEBMASTER</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->WEBMASTER	=	$this->QUERY;
		}
		# PHONE
		function PHONE_PRIMARY(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","PHONE_PRIMARY");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>PHONE_PRIMARY</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->PHONE_PRIMARY	=	$this->QUERY;
		}
		function PHONE_SECONDARY(){
			$this->QUERY	=	$this->db->do_QUERY("VALUE","SETTINGS_LANG","SETTING","PHONE_SECONDARY");

			if(!$this->QUERY){
				throw new SystemException('Unable to load <b>PHONE_SECONDARY</b> from database!', 0, 0, __FILE__, __LINE__);
			}
			$this->PHONE_SECONDARY	=	$this->QUERY;
		}
		function Props(){
			echo "<b>Class=>Settings Properties:</b> ";
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}
?>
