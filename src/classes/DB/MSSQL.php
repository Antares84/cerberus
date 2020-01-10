<?php
	namespace Classes\DB;

	#############################################################################################
	#	Title: Database.class.php																#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS MSSQL database class, used for loading all MSSQL database resources			#
	#	Last Update Date: 09.29.2019	1129													#
	#############################################################################################
	class MSSQL{

		protected $dsn;protected $user;protected $pwd;

		# Public Vars
		public $conn	=	NULL;

		private $build	=	NULL;

		public function __construct(){
			$this->_security();
			$this->load_params();
			$this->_open_conn();
		}
		private function _security(){
			if(!defined('IN_CMS')){
				echo '<b>'.__NAMESPACE__.'</b>:<br>Unauthorized access detected, exiting...';
				exit;
			}
		}
		private function load_params(){
			require_once('Db_Info.php');
		}
		public function _open_conn(){
			$this->conn = @odbc_connect('Driver={SQL Server};Server='.$this->dsn.';',$this->user,$this->pwd);

			if(!is_resource($this->conn)){
				$this->conn = @odbc_pconnect($this->dsn,$this->user,$this->pwd);
			}

			if(is_resource($this->conn)){
				return true;
			}
			else{
				throw new \Classes\Exception\SystemException('Database is <b>unavailable</b> or <b>offline</b>!',0,0,__FILE__,__LINE__);

				return false;
			}
		}
		public function _close_conn(){
			return odbc_close($this->conn);
		}
		public function _table_list($table){
			switch($table){
				# LOGS
				case "LOG_ACCESS"			:	return "[Cerberus].[dbo].[LOG_ACCESS]";							break;
				case "LOG_BOSS_DEATH"		:	return "[Cerberus].[dbo].[LOG_BOSS_DEATH]";						break;
				case "LOG_DONATE"			:	return "[Cerberus].[dbo].[LOG_DONATE]";							break;
				case "LOG_ERRORS"			:	return "[Cerberus].[dbo].[LOG_ERRORS]";							break;
				case "LOG_GM_COMMANDS"		:	return "[Cerberus].[dbo].[LOG_GM_COMMANDS]";					break;
				case "LOG_PAYMENTS"			:	return "[Cerberus].[dbo].[LOG_PAYMENTS]";						break;
				case "LOG_SESSION"			:	return "[Cerberus].[dbo].[LOG_SESSION]";						break;
				# MAIN
				case "HOMEPAGE"				:	return "[Cerberus].[dbo].[HOMEPAGE]";							break;
				case "NEWS"					:	return "[Cerberus].[dbo].[NEWS]";								break;
				case "PATCH_NOTES"			:	return "[Cerberus].[dbo].[PATCH_NOTES]";						break;
				case "DONATE"				:	return "[Cerberus].[dbo].[DONATE]";								break;
				case "DONATE_OPTIONS"		:	return "[Cerberus].[dbo].[DONATE_OPTIONS]";						break;
				case "WEB_PRESENCE"			:	return "[Cerberus].[dbo].[WEB_PRESENCE]";						break;
				# ISSUE TRACKER
				case "IT_ANSWERS"			:	return "[Cerberus].[dbo].[IT_ANSWERS]";							break;
				case "IT_MESSAGES"			:	return "[Cerberus].[dbo].[IT_MESSAGES]";						break;
				# BDSM
				case "FORUM"				:	return "[BDSM].[dbo].[FORUM]";									break;
				case "JOURNAL"				:	return "[BDSM].[dbo].[JOURNAL]";								break;
				case "STORIES"				:	return "[BDSM].[dbo].[STORIES]";								break;
				case "USER_DATA"			:	return "[BDSM].[dbo].[USER_DATA]";								break;
				# SETTINGS
				case "SETTINGS_CRC"			:	return "[Cerberus].[dbo].[SETTINGS_CRC]";						break;
				case "SETTINGS_COLORS"		:	return "[Cerberus].[dbo].[SETTINGS_COLORS]";					break;
				case "SETTINGS_MAIN"		:	return "[Cerberus].[dbo].[SETTINGS_MAIN]";						break;
				case "SETTINGS_MODULES"		:	return "[Cerberus].[dbo].[SETTINGS_MODULES]";					break;
				case "SETTINGS_SOCIAL"		:	return "[Cerberus].[dbo].[SETTINGS_SOCIAL]";					break;
				case "SETTINGS_STYLE"		:	return "[Cerberus].[dbo].[SETTINGS_STYLE]";						break;
				case "SETTINGS_THEME"		:	return "[Cerberus].[dbo].[SETTINGS_THEME]";						break;
				case "SETTINGS_PAGES"		:	return "[Cerberus].[dbo].[SETTINGS_PAGES]";						break;
				# SHAIYA
				case "SH_BANNED_PLAYERS"	:	return "[Cerberus].[dbo].[BANNED_PLAYERS]";						break;
				case "SH_ACTIONLOG"			:	return "[NDF_SHAIYA].[PS_GameLog].[dbo].[Actionlog]";			break;
				case "SH_CHATLOG"			:	return "[NDF_SHAIYA].[SDM_ChatLog].[dbo].[Chatlog]";			break;
				case "SH_CHARDATA"			:	return "[NDF_SHAIYA].[PS_GameData].[dbo].[Chars]"; 				break;
				case "SH_CHARSKILLS"		:	return "[NDF_SHAIYA].[PS_GameData].[dbo].[CharSkills]"; 		break;
				case "SH_CHARAPPSKILLS"		:	return "[NDF_SHAIYA].[PS_GameData].[dbo].[CharApplySkills]"; 	break;
				case "SH_CHARITEMS"			:	return "[NDF_SHAIYA].[PS_GameData].[dbo].[CharItems]"; 			break;
				case "SH_GUILDS"			:	return "[NDF_SHAIYA].[PS_GameData].[dbo].[Guilds]";				break;
				case "SH_GUILD_CHARS"		:	return "[NDF_SHAIYA].[PS_GameData].[dbo].[GuildChars]";			break;
				case "SH_GUILD_DETAILS"		:	return "[NDF_SHAIYA].[PS_GameData].[dbo].[GuildDetails]"; 		break;
				case "SH_ITEMS"				:	return "[NDF_SHAIYA].[PS_GameDefs].[dbo].[Items]";				break;
				case "SH_MAPS"				:	return "[NDF_SHAIYA].[PS_GameDefs].[dbo].[MapNames]";			break;
				case "SH_MOBS"				:	return "[NDF_SHAIYA].[PS_GameDefs].[dbo].[Mobs]";				break;
				case "SH_MOBITEMS"			:	return "[NDF_SHAIYA].[PS_GameDefs].[dbo].[MobItems]";			break;
				case "SH_SKILLS"			:	return "[NDF_SHAIYA].[PS_GameDefs].[dbo].[Skills]"; 			break;
				case "SH_UMG"				:	return "[NDF_SHAIYA].[PS_GameData].[dbo].[UserMaxGrow]";		break;
				case "SH_USERDATA"			:	return "[SDM_UserData].[dbo].[Users_Master]";		break;
				# ENTROPIA UNIVERSE
				case "EU_SHOPS"				:	return "[Cerberus].[dbo].[Shops]";							break;
			}
		}
		public function _do_query($t1,$t2,$t3){
			$ret = false;

			switch($t2){
				case	0	:	$t2	=	'SETTING';	break;
				case	1	:	$t2	=	'STYLE';	break;
				default		:	$t2;				break;
			}

			$sql	=	("SELECT VALUE FROM ".$this->_table_list($t1)." WHERE ".$t2."=?");
			$stmt	=	odbc_prepare($this->conn,$sql);
			$args	=	array($t3);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				while($data = odbc_fetch_array($stmt)){
					$ret = $data["VALUE"];
				}
			}

			odbc_free_result($stmt);
			odbc_close($this->conn);

			return $ret;
		}

		public function select($columns = '*', $table){
			$this->build = 'SELECT ';

			if(is_array($columns) == TRUE){
				$this->build .= implode(',', $columns);
			}
			else{
				$this->build .= $columns;
			}
			$this->build .= ' FROM `'. $table .'`';

			return $this;
		}
		public function delete($table){
			$this->build = 'DELETE FROM `'. $table .'`';

			return $this;
		}
		public function update($table){
			$this->build = 'UPDATE `'. $table .'`';

			return $this;
		}
		public function insert($table){
			$this->build = 'INSERT INTO `'. $table .'`';

			return $this;
		}
		public function values($data){
			$dataKeys = array_keys($data);
			$dataValues = array_values($data);

			$this->build .= ' ('. implode(',', $dataKeys) .') VALUES (';

			$newValues = array();

			foreach($dataValues as $value){
				$newValues[] = '\''. $value .'\'';
			}

			$this->build .= implode(',', $newValues) .')';

			return $this;
		}
		public function set($data){
			$this->build .= ' SET ';
			$dataArray = array();

			foreach($data as $key => $value) {
				$dataArray[] = '`'. $key .'`=\''. $value .'\'';
			}

			$this->build .= implode(',', $dataArray);

			return $this;
		}
		public function where($data){
			$this->build .= ' WHERE ';

			if(is_array($data) == TRUE){
				$dataKeys = array_keys($data);
				$dataValues = array_values($data);

				$i = 0;

				foreach($dataValues as $value){
					if(empty($value[2]) == FALSE){
						$this->build .= $value[2] .' `'. $dataKeys[$i] .'` '. $value[0] .' \''. $value[1] .'\' ';
					}
					else{
						$this->build .= '`'. $dataKeys[$i] .'` '. $value[0] .' \''. $value[1] .'\' ';
					}

					++$i;
				}
			}
			else{
				$this->build .= $data;
			}

			return $this;
		}
		public function orderBy($field,$dir){
			$this->build .= ' ORDER BY `'. $field .'` '. strtoupper($dir);

			return $this;
		}
		public function limit($max, $min = '0'){
			$this->build .= ' LIMIT '. $min .', '. $max;

			return $this;
		}
		public function run() {
			$query = $this->mysqli->query($this->build);

			return $query;
		}

		# MISC
		public function _class_info($level=false){
			if($level){
				echo '<b>ClassInfo Level: '.$level.'<br>';
			}
			switch($level){
				case 1	:	return $this->_Props($level);	break;
				case 2	:	return $this->_Mthds($level);	break;
			}
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
		public function _Mthds(){
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