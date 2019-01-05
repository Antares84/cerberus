<?php
	#############################################################################################
	#	Title: Database.class.php																#
	#	Author: Bradley Sweeten																	#
	#	Rel: CMS Database class, used for loading all database resources						#
	#	Last Update Date: 12.29.2018 1940														#
	#############################################################################################
	class Database{
		
		protected $dns;protected $user;protected $pw;

		# Public Vars
		public $conn				=	NULL;

		function __construct(){
			$this->load_params();
			$this->db_open_conn();
		}
		function load_params(){
			require_once('Db_Info.class.php');
		}
		function db_open_conn(){
			@$this->conn = odbc_connect('Driver={SQL Server};Server='.$this->dns.';',$this->user,$this->pwd);
			if(!is_resource($this->conn)){
				@$this->conn = odbc_pconnect($this->dns,$this->user,$this->pwd);
			}
			if(is_resource($this->conn)){
				return true;
			}else{
				throw new SystemException('Database is <b>unavailable</b> or <b>offline</b>!',0,0,__FILE__,__LINE__);
				return false;
			}
		}
		function db_close_conn(){
			return odbc_close($this->conn);
		}
		function get_TABLE($table){
			switch($table){
				# LOGS
				case "LOG_ACCESS"			:	return "[Cerberus].[dbo].[LOG_ACCESS]";						break;
				case "LOG_BOSS_DEATH"		:	return "[Cerberus].[dbo].[LOG_BOSS_DEATH]";					break;
				case "LOG_DONATE"			:	return "[Cerberus].[dbo].[LOG_DONATE]";						break;
				case "LOG_GM_COMMANDS"		:	return "[Cerberus].[dbo].[LOG_GM_COMMANDS]";				break;
				case "LOG_PAYMENTS"			:	return "[Cerberus].[dbo].[LOG_PAYMENTS]";					break;
				case "LOG_SESSION"			:	return "[Cerberus].[dbo].[LOG_SESSION]";					break;
				# MAIN
				case "HOMEPAGE"				:	return "[Cerberus].[dbo].[HOMEPAGE]";						break;
				case "NEWS"					:	return "[Cerberus].[dbo].[NEWS]";							break;
				case "PATCH_NOTES"			:	return "[Cerberus].[dbo].[PATCH_NOTES]";					break;
				case "DONATE"				:	return "[Cerberus].[dbo].[DONATE]";							break;
				case "DONATE_OPTIONS"		:	return "[Cerberus].[dbo].[DONATE_OPTIONS]";					break;
				case "WEB_PRESENCE"			:	return "[Cerberus].[dbo].[WEB_PRESENCE]";					break;
				# ISSUE TRACKER
				case "IT_ANSWERS"			:	return "[Cerberus].[dbo].[IT_ANSWERS]";						break;
				case "IT_MESSAGES"			:	return "[Cerberus].[dbo].[IT_MESSAGES]";					break;
				# SETTINGS
				case "SETTINGS_COLORS"		:	return "[Cerberus].[dbo].[SETTINGS_COLORS]";				break;
				case "SETTINGS_MAIN"		:	return "[Cerberus].[dbo].[SETTINGS_MAIN]";					break;
				case "SETTINGS_PLUGINS"		:	return "[Cerberus].[dbo].[SETTINGS_PLUGINS]";				break;
				case "SETTINGS_SOCIAL"		:	return "[Cerberus].[dbo].[SETTINGS_SOCIAL]";				break;
				case "SETTINGS_STYLE"		:	return "[Cerberus].[dbo].[SETTINGS_STYLE]";					break;
				case "SETTINGS_THEME"		:	return "[Cerberus].[dbo].[SETTINGS_THEME]";					break;
				case "SETTINGS_PAGES"		:	return "[Cerberus].[dbo].[SETTINGS_PAGES]";					break;
				# SHAIYA
				case "SH_BANNED_PLAYERS"	:	return "[Cerberus].[dbo].[BANNED_PLAYERS]";					break;
				case "SH_ACTIONLOG"			:	return "[NDF_SHAIYA].[PS_GameLog].[dbo].[Actionlog]";			break;
				case "SH_CHATLOG"			:	return "[NDF_SHAIYA].[SDM_ChatLog].[dbo].[Chatlog]";				break;
				case "SH_CHARDATA"			:	return "[NDF_SHAIYA].[SDM_GameData].[dbo].[Chars]"; 				break;
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
				case "SH_USERDATA"			:	return "[NDF_SHAIYA].[PS_UserData].[dbo].[Users_Master]";		break;
				# ENTROPIA UNIVERSE
				case "EU_SHOPS"				:	return "[Cerberus].[dbo].[Shops]";							break;
			}
		}
		function do_QUERY($t1,$t2,$t3,$t4){
			$return = false;

			$sql	=	("
							SELECT ".$t1."
							FROM ".$this->get_TABLE($t2)."
							WHERE ".$t3."=?
			");
			$stmt	=	odbc_prepare($this->conn,$sql);
			$args	=	array($t4);
			$prep	=	odbc_execute($stmt,$args);
			if($prep){
				while($data = odbc_fetch_array($stmt)){
					$return = $data[$t1];
				}
			}

			return $return;
			odbc_free_result($stmt);
			odbc_close($this->conn);
		}
		function Props(){
			echo "<b>Class=>DB Properties:</b> ";
			echo "<pre>";
				print_r(get_object_vars($this));
			echo "</pre>";
		}
	}
?>