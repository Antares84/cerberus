<?php
	namespace classes\utils;
	if(!defined('IN_CMS')){
		exit('AUTOLOADER: unauthorized access detected, exiting...');
	}

	#############################################################################################
	#	Title				:	Visitors.class.php												#
	#	Author				:	Bradley Sweeten													#
	#	Rel					:	CMS Visitors API												#
	#	Last Update Date	:	06.14.2019	1827												#
	#																							#
	#	Dependencies:		:	Browser.class.php												#
	#############################################################################################

	class Visitors{

		# Browser Variables
		protected $OS;protected $BrowserType;protected $UA;protected $IP;

		# API Variables
		protected $data;
		protected $dbfile; # path to data file
		protected $db_arr;
		protected $db_arr_new;
		protected $expire; # average time in seconds to consider someone online before removing from the list
		protected $output;
		protected $store;
		protected $type;

		public function __construct($Browser){
			$this->Browser	=	$Browser;

			# Browser API Data
			$this->OS			=	$this->Browser->OS;
			$this->BrowserType	=	$this->Browser->Browser;
			$this->UA			=	$this->Browser->UA;
			$this->IP			=	$this->Browser->IP;

			$this->_init();
		}
		private function _init(){
			# API Data
			$this->expire		=	300;
			$this->type			=	1;

			$this->_set_storage();
		#	$this->_validate_source();
		#	$this->_output();
		}
		private function _set_storage(){
			switch($this->type){
				# File Source
				case	1	:
					$this->dbfile	=	dirname(__FILE__).'/db/Visitors.db';
					$this->data		=	unserialize(file_get_contents($this->dbfile));
				break;
				# Database Source
				case	2	:
					//	do something
				break;
			}
		}
		private function _validate_source(){
			if($this->type === 1){
				$err	=	false;

				if(!file_exists($this->dbfile)){$err=1;die();}
				if(!is_writable($this->dbfile)){$err=2;die();}

				switch($err){
					case	1	:	return 'Error: Data file '.$this->dbfile.' NOT FOUND!';	break;
					case	2	:	return 'Error: Data file '.$this->dbfile.' is NOT writable!<br>
											If using Linux: CHMOD db/Visitors.db to 666<br>
											If using Windows, add IUSR perms & set to MODIFY';	break;
				}

				if($err){die($err);}
			}
			elseif($this->type === 2){
				
			}
			
		}
		private function _store($IP,$Time){
			$arr	=	array();

			$arr[]	=	$this->OS;
			$arr[]	=	$this->BrowserType;
			$arr[]	=	$this->UA;
			$arr[]	=	$this->IP;
			$arr[]	=	$Time;

			$this->store			=	$arr;
			$this->db_arr_new[$IP]	=	$arr;

			$fp=fopen($this->dbfile,"w");
			fputs($fp,serialize($this->db_arr_new));
			fclose($fp);
		}
		public function _count(){
			$cur_ip		=	$this->IP;
			$cur_time	=	time();

			if(is_array($this->data)){
				while(list($user_ip,$os,$browser,$ua,$ip,$user_time)=each($this->data)){
					if(($user_ip!=$cur_ip)&&(($user_time+$this->expire)>$cur_time)){$this->_store($user_ip,$user_time);}
				}
			}
			else{
				$this->_store($cur_ip,$cur_time);
			}
		}
		public function _output(){
			$this->output=sprintf("%01d",count($this->db_arr_new));
		}
		public function _show_contents(){
			echo '<pre>';
				var_dump($this->db_arr);
			echo '</pre>';
			echo '<br><br>';
			echo '<pre>';
				var_dump($this->store);
			echo '</pre>';
			echo '<br><br>';
			echo '<pre>';
				var_dump($this->db_arr_new);
			echo '</pre>';

			$this->_Props();
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
	}
?>