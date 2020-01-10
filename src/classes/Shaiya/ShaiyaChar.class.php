<?php
	# require_once (INC_DIR.'lib/data/char/CharItems.class.php');

	class ShaiyaChar{
		private $CharID;private $sql;private $res;private $stmt;private $fet;private $info;private $user;private $i;private $CharClass;private $Mode;private $Race;private $retArray;

		public function __construct($db,$Data,$Setting,$Template){
			$this->db			=	$db;
			$this->Data			=	$Data;
			$this->Setting		=	$Setting;
			$this->Tpl			=	$Template;
		}
		public function LOAD_CHAR($CharID){
			$this->CharID		=	$CharID;

			$this->sql			=	("
										SELECT *
										FROM ".$this->db->get_TABLE("SH_CHARDATA")."
										WHERE [CharID] = ".$this->CharID
			);
			$this->stmt			=	odbc_prepare($this->db->conn,$this->sql);
			$this->info			=	odbc_fetch_array($this->stmt);
		}
		public function LOAD_ACCT_CHARS_UID($UserID){
			$this->UserID	=	$UserID;
			$sql	=	("
							SELECT *
							FROM ".$this->db->get_TABLE("SH_CHARDATA")."
							WHERE [UserID] = '".$this->UserID."'
			");
			$stmt	=	odbc_prepare($this->db->conn,$sql);
			$args	=	array($UserID);
			$prep	=	odbc_execute($stmt,$args);

		#	$this->stmt			=	odbc_prepare($this->db->conn,$this->sql);
		#	$this->info			=	odbc_fetch_array($this->stmt);

			if($prep){
				echo '<div class="table-responsive">';
					echo '<table class="table table-sm table-bordered table-inverse acp_table text-center">';
						echo '<thead>';
							echo '<tr>';
								echo '<th>Server ID</th>';
								echo '<th>Character Name(s)</th>';
								echo '<th>Level</th>';
								echo '<th>Race</th>';
								echo '<th>CharClass</th>';
								echo '<th>Vitals</th>';
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
						while($data = odbc_fetch_array($stmt)){
							echo '<tr>';
								echo '<td>'.$data["ServerID"].'</td>';
								echo '<td><a href="?'.$this->Setting->_stng_array[0].'=PLR_SEARCH&CharID='.$data['CharID'].'&CharName='.$data['CharName'].'" target="_blank">'.$data['CharName'].'</a></td>';
								echo '<td>'.$data["Level"].'</td>';
								echo '<td>'.$this->get_Char_Race($data["Family"]).'</td>';
								echo '<td>'.$this->get_Char_CharClass($data["Job"]).'</td>';
								echo '<td>'.$this->get_Char_Del($data["Del"]).'</td>';
							echo '</tr>';
						}
						echo '</tbody>';
					echo '</table>';
				echo '</div>';
			}
		}
		function SEARCH_PLAYER($CharID,$CharName){
			if(strlen($CharName) < 1){
				echo '<div id="sb_content">';
					echo 'Character name is too short!';
				echo '</div>';
			}
			else{
				$sql	=	('
								SELECT [UM].[UserUID],[UM].[UserID],[UM].[Email],[C].[CharName],[C].[CharID],[C].[Level]
								FROM '.$this->db->get_TABLE("SH_CHARDATA").' AS [C]
								INNER JOIN '.$this->db->get_TABLE("SH_USERDATA").' AS [UM] ON [C].[UserUID] = [UM].[UserUID]
								WHERE [C].[CharName]=?
				');
				$stmt = odbc_prepare($this->db->conn,$sql);
				$args = array($CharName);
				$prep = odbc_execute($stmt,$args);

				if($prep){
					if(!odbc_num_rows($stmt)){
						echo '<div id="sb_content">';
							echo '<form action="" method="post">';
								echo '<div class="form-group row tac">';
									echo 'A character with the name <font class="b_i">'.$CharName.'</font> couldn\'t be located.';
								echo '</div>';
								$this->Tpl->Separator('10');
								echo '<div class="form-group btn_center">';
									echo '<a class="badge badge-pill badge-primary" href="?'.$this->Setting->_stng_array[0].'=Search" />Try Again</a>';
								echo '</div>';
							echo '</form>';
						echo '</div>';
					}
					else{
						$this->Tpl->TitleBar('Search results for: '.$CharName.'');
						echo '<div id="sb_content">';
							echo '<div class="table-responsive">';
								echo '<table class="table table-sm table-bordered table-inverse acp_table text-center">';
									echo '<thead>';
										echo '<tr>';
											echo '<th>UserUID</th>';
											echo '<th>UserName</th>';
											echo '<th>E-Mail</th>';
											echo '<th>CharID</th>';
											echo '<th>CharName</th>';
											echo '<th>CharLevel</th>';
											echo '<th>View Buffs</th>';
											echo '<th>View Items</th>';
											echo '<th>View Stats</th>';
										echo '</tr>';
									echo '</thead>';
									echo '<tbody>';
									while($data = odbc_fetch_array($stmt)){
										echo '<tr>';
											echo '<td>'.$data['UserUID'].'</td>';
											echo '<td>'.$data['UserID'].'</td>';
											echo '<td>'.$data['Email'].'</td>';
											echo '<td>'.$data['CharID'].'</td>';
											echo '<td>'.$data['CharName'].'</td>';
											echo '<td>'.$data['Level'].'</td>';
											echo '<td><a class="badge badge-pill badge-primary m_t_5" target="_blank" href="?'.$this->Setting->_stng_array[0].'=PLR_BUFF_VIEW&CharName='.$CharName.'&CharID='.$data["CharID"].'" target="_blank">Go</a></td>';
											echo '<td><a class="badge badge-pill badge-primary m_t_5" target="_blank" href="?'.$this->Setting->_stng_array[0].'=PLR_ITEM_VIEW&CharName='.$CharName.'&CharID='.$data["CharID"].'" target="_blank">Go</a></td>';
											echo '<td><a class="badge badge-pill badge-primary m_t_5" target="_blank" href="?'.$this->Setting->_stng_array[0].'=PLR_STATS_EDITOR&CharName='.$CharName.'&CharID='.$data["CharID"].'" target="_blank">Go</a></td>';
										echo '</tr>';
									}
									echo '<tbody>';
								echo '</table>';
							echo '</div>';

							echo '<div class="text-center f_20 p_b_15">';
								echo '<a class="badge badge-primary" href="?'.$this->Setting->_stng_array[0].'=PLR_SEARCH">New Search <i class="fa fa-search"></i></a>';
							echo '</div>';
						echo '</div>';
					}
				}
			}
		}
		public function get_Char_CharClass($data){
			switch($data){
				case 0	:	return "Fighter";	break;
				case 1	:	return "Defender";	break;
				case 2	:	return "Ranger";	break;
				case 3	:	return "Archer";	break;
				case 4	:	return "Mage";		break;
				case 5	:	return "Priest";	break;
				case 6	:	return "Warrior";	break;
				case 7	:	return "Guardian";	break;
				case 8	:	return "Assassin";	break;
				case 9	:	return "Hunter";	break;
				case 10	:	return "Animist";	break;
				case 11	:	return "Oracle";	break;
			}
		}
		public function get_Char_Mode($data){
			switch($data){
				case 0	:	return "Easy";		break;
				case 1	:	return "Normal";	break;
				case 2	:	return "Hard";		break;
				case 3	:	return "Ultimate";	break;
			}
		}
		public function get_Char_Race($data){
			switch($data){
				case 0	:	return "Human";			break;
				case 1	:	return "Elf";			break;
				case 2	:	return "Vail";			break;
				case 3	:	return "Deatheater";	break;
			}
		}
		public function getCharID(){
			return $this->CharID;
		}
		public function getUserUID(){
			return $this->info['UserUID'];
		}
		public function getName(){
			return Parser::specialChars($this->info['CharName']);
		}
		public function get_Char_Del($data){
			switch($data){
				case 0	:	return "Alive";	break;
				case 1	:	return "Dead";	break;
			}
		}
		public function getDel(){
			if($this->info['Del'] == 0){return false;}
			else{return true;}
		}
		public function getSlot(){
			return $this->info['Slot'];
		}
		public function getFamily(){
			return $this->info['Family'];
		}
		public function getGrow(){
			return $this->info['Grow'];
		}
		public function getHair(){
			return $this->info['Hair'];
		}
		public function getFace(){
			return $this->info['Face'];
		}
		public function getSize(){
			return $this->info['Size'];
		}
		public function getJob(){
			return $this->info['Job'];
		}
		public function getSex(){
			return $this->info['Sex'];
		}
		public function getLevel(){
			return $this->info['Level'];
		}
		public function getStatPoint(){
			return $this->info['StatPoint'];
		}
		public function getSkillPoint(){
			return $this->info['SkillPoint'];
		}
		public function getStr(){
			return $this->info['Str'];
		}
		public function getDex(){
			return $this->info['Dex'];
		}
		public function getRec(){
			return $this->info['Rec'];
		}
		public function getInt(){
			return $this->info['Int'];
		}
		public function getLuc(){
			return $this->info['Luc'];
		}
		public function getWis(){
			return $this->info['Wis'];
		}
		public function getHP(){
			return $this->info['HP'];
		}
		public function getMP(){
			return $this->info['MP'];
		}
		public function getSP(){
			return $this->info['SP'];
		}
		public function getMap(){
			return $this->info['Map'];
		}
		public function getExp(){
			return $this->info['Exp'];
		}
		public function getPosX(){
			return $this->info['PosX'];
		}
		public function getPosY(){
			return $this->info['PosY'];
		}
		public function getPosZ(){
			return $this->info['Posz'];
		}
		public function getKills(){
			return $this->info['K1'];
		}
		public function getTode(){
			return $this->info['K2'];
		}
		public function getDKills(){
			return $this->info['K3'];
		}
		public function getDTode(){
			return $this->info['K4'];
		}
		public function getKillLevel(){
			return $this->info['KillLevel'];
		}
		public function getDeadLevel(){
			return $this->info['DeadLevel'];
		}
		public function getRenameCnt(){
			return $this->info['RenameCnt'];
		}
		public function getOldCharName(){
			return $this->info['OldCharName'];
		}
		public function getLastLogin(){
			return strtotime($this->info['JoinDate']);
		}
		public function getLastLogout(){
			return strtotime($this->info['LeaveDate']);
		}
		public function getLastLoginTime(){
			return $this->getLastLogout() - $this->getLastLogin();
		}
		public function getLoginStatus(){
			return $this->info['LoginStatus'];
		}
		public function getGuild(){
			$this->sql = "SELECT [GuildID] FROM [PS_GameData].[dbo].[GuildChars] WHERE [CharID] = '".$this->CharID."' AND [Del] = 0";
			$this->res = mssql_query($this->sql);

			if(mssql_num_rows($this->res) != 1){
				return false;
			}

			$this->fet = mssql_fetch_array($this->res);
			return $this->fet[0];
		}
		public function getCharClassName(){
			if($this->getFamily() < 2){
				return $this->CharClass[$this->getJob() + 6];
			}
			else{
				return $this->CharClass[$this->getJob()];
			}
		}
		public function getModeName(){
			return $this->Mode[$this->getGrow()];
		}
		public function getRaceName(){
			return $this->Race[$this->getFamily()];
		}
		public function isBanned(){
			return $this->user->isBanned();
		}
		public function ban(){
			$this->user->ban();
		}
		public function unban(){
			$this->user->unban();
		}
		public function getFriends(){
			$this->sql = "SELECT [FriendID] FROM [PS_GameData].[dbo].[FriendChars] WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			if(mssql_num_rows($this->res) == 0){
				return false;
			}

			$this->count = 0;

			while($this->fet = mssql_fetch_array($this->res)){
				$this->retArray[$this->count] = $this->fet[0];
				$this->count++;
			}

			return $this->retArray;
		}
		public function kill(){
			if($this->getLoginStatus()){
				return 'The character is currently logged in.';
			}

			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [Del] = 1 WHERE [CharID] = '".$this->CharID."'";
			$this->res = mssql_query($this->sql);

			if($this->res){
				return true;
			}
			else{
				return 'Error in the SQL query';
			}
		}
		public function res(){
			if(!$this->getDel()){
				return 'This character is not death.';
			}

			for($this->i=0;$this->i<6;$this->i++){
				$this->sql = "SELECT [CharID] FROM [PS_GameData].[dbo].[Chars] WHERE [UserUID] = '".$this->getUserUID()."' AND [Slot] = '".$this->i."' AND [Del] = 0";
				$this->res = mssql_query($this->sql);

				if(mssql_num_rows($this->res) == 0){
					break;
				}
			}
			if($this->i == 5){
				return 'No free slot.';
			}

			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [Del] = 0, [Slot] = '".$this->i."', [Map] = 42, [PosX] = 63, [PosZ] = 57, [DeleteDate] = NULL WHERE [CharID] = '".$this->CharID."'";
			$this->res = mssql_query($this->sql);

			if($this->res){
				return true;
			}
			else{
				return 'Error in the SQL query';
			}
		}
		public function resetKills(){
			if($this->getLoginStatus()){
				return 'The character is currently logged in.';
			}

			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [k1] = 0, [k2] = 0, [k3] = 0, [k4] = 0 WHERE [CharID] = '".$this->CharID."'";
			$this->res = mssql_query($this->sql);

			if($this->res){
				return 1;
			}
			else{
				return 'Error in the SQL query';
			}
		}
		public function changeName($name){
			if($this->getLoginStatus()){
				return 'The character is currently logged in.';
			}

			if(strlen($name)<1){
				return 'The name is too small.';
			}

			$this->sql = "SELECT [CharID] FROM [PS_GameData].[dbo].[Chars] WHERE [CharName] = '".Parser::validate($name)."' AND [Del] = 0";
			$this->res = mssql_query($this->sql);

			if(mssql_num_rows($this->res)!=0){
				return 'The name is already in use';
			}

			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [CharName] = '".Parser::validate($name)."' WHERE [CharID] = '".$this->CharID."'";
			$this->res = mssql_query($this->sql);

			$this->sql = "UPDATE [PS_GameData].[dbo].[Guilds] SET [MasterName] = '".Parser::validate($name)."' WHERE [MasterCharID] = '".$this->CharID."'";
			$this->res = mssql_query($this->sql);

			$this->sql = "UPDATE [PS_GameData].[dbo].[FriendChars] SET [FriendName] = '".Parser::validate($name)."' WHERE [FriendID] = '".$this->CharID."'";
			$this->res = mssql_query($this->sql);

			$this->sql = "UPDATE [PS_GameData].[dbo].[BanChars] SET [BanName] = '".Parser::validate($name)."' WHERE [BanID] = '".$this->CharID."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeLevel($level){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [Level] = '".Parser::validate($level)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeGrow($grow){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [Grow] = '".Parser::validate($grow)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeSex($sex){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [Sex] = '".Parser::validate($sex)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeStat($statpoint){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [statpoint] = '".Parser::validate($statpoint)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeSkill($skillpoint){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [skillpoint] = '".Parser::validate($skillpoint)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeKill($kills){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [k1] = '".Parser::validate($kills)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeTod($tod){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [k2] = '".Parser::validate($tod)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeDKill($kills){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [k3] = '".Parser::validate($kills)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function changeDTod($tod){
			$this->sql = "UPDATE [PS_GameData].[dbo].[Chars] SET [k4] = '".Parser::validate($tod)."' WHERE [CharID] = '".$this->getCharID()."'";
			$this->res = mssql_query($this->sql);

			return true;
		}
		public function leaveGuild(){
			$this->sql = "UPDATE [PS_GameData].[dbo].[GuildChars] SET [Del] = 1 WHERE [CharID] = '".$this->getCharID()."' AND [Del] = 0";
			$this->res = mssql_query($this->sql);

			if($this->res){
				return true;
			}
			else{
				return 'Error in the SQL query';
			}
		}
		public function createCI(){
			$this->ci = new CharItems($this->CharID);
			return true;
		}
		public function leseCI(){
			if (!$this->ciExists())
				$this->createCI();

			return $this->ci->readItems();
		}
		public function CIslot($slot){
			if(!$this->ciExists()){
				$this->createCI();
			}

			return $this->ci->getItemOnSlot($slot);
		}
		public function delCIslot($slot){
			if(!$this->ciExists()){
				$this->createCI();
			}

			return $this->ci->deleteItemOnSlot($slot);
		}
		public function delCIall(){
			if(!$this->ciExists()){
				$this->createCI();
			}

			return $this->ci->deleteAll();
		}
		private function ciExists(){
			if(isset($this->ci)){
				return true;
			}
			else{
				return false;
			}
		}
	}
?>