<?php
	# Site Security
		if(!defined('SQL_Secure')){die('You have entered a restricted Area. Direct access is not allowed.');}
	# CMS Page System | All CMS Pages Must Be Listed Here Or You Will Get An Error Page
		$p = (!empty($_GET['p'])) ? htmlentities($_GET['p']) : 'index';
		$array_pages = array(
# Main Pages
			'index' => 'assets/content/home.php',
			'home' => 'assets/content/home.php',
			'error' => 'assets/content/error.php',
# PS Database
	# Chatlog
			'ps_chatlog_db_str' => 'assets/content/PS/Chatlog/db/db_structure.php',
			'ps_chatlog_chatlog_tbl' => 'assets/content/PS/Chatlog/tbl/chatlog_tbl.php',
			'usp_Insert_Chat_Log_E' => 'assets/content/PS/Chatlog/sp/Insert_Chat_Log_E.php',
	# GameData
			'ps_gamedata_db_str' => 'assets/content/PS/GameData/db/db_structure.php',
			'banchars' => 'assets/content/PS/GameData/tbl/BanChars.php',
			'charapplyskills' => 'assets/content/PS/GameData/tbl/CharApplySkills.php',
			'charevents' => 'assets/content/PS/GameData/tbl/CharEvents.php',
			'charitems' => 'assets/content/PS/GameData/tbl/CharItems.php',
			'charquests' => 'assets/content/PS/GameData/tbl/CharQuests.php',
			'charquickslots' => 'assets/content/PS/GameData/tbl/CharQuickSlots.php',
			'charrenamelog' => 'assets/content/PS/GameData/tbl/CharRenameLog.php',
			'chars' => 'assets/content/PS/GameData/tbl/Chars.php',
			'charsavepoint' => 'assets/content/PS/GameData/tbl/CharSavePoint.php',
			'charskills' => 'assets/content/PS/GameData/tbl/CharSkills.php',
			'createdchars' => 'assets/content/PS/GameData/tbl/CreatedChars.php',
			'deletedchars' => 'assets/content/PS/GameData/tbl/DeletedChars.php',
			'charskill1' => 'assets/content/PS/GameData/tbl/EventLog_CharSkill1.php',
			'charskill2' => 'assets/content/PS/GameData/tbl/EventLog_CharSkill2.php',
			'charstat' => 'assets/content/PS/GameData/tbl/EventLog_CharStat.php',
			'friendchars' => 'assets/content/PS/GameData/tbl/FriendChars.php',
			'guildchars' => 'assets/content/PS/GameData/tbl/GuildChars.php',
			'guilddetails' => 'assets/content/PS/GameData/tbl/GuildDetails.php',
			'guildnpclevel' => 'assets/content/PS/GameData/tbl/GuildNpcLv.php',
			'guildranklog' => 'assets/content/PS/GameData/tbl/GuildRankLog.php',
			'guildranklog2' => 'assets/content/PS/GameData/tbl/GuildRankLog2.php',
			'guilds' => 'assets/content/PS/GameData/tbl/Guilds.php',
			'guildstoreditems' => 'assets/content/PS/GameData/tbl/GuildStoredItems.php',
			'keeps' => 'assets/content/PS/GameData/tbl/Keeps.php',
			'market' => 'assets/content/PS/GameData/tbl/Market.php',
			'marketcharconcern' => 'assets/content/PS/GameData/tbl/MarketCharConcern.php',
			'marketcharresultitems' => 'assets/content/PS/GameData/tbl/MarketCharResultItems.php',
			'marketcharresultitems_dellog' => 'assets/content/PS/GameData/tbl/MarketCharResultItems_DelLog.php',
			'marketcharresultmoney' => 'assets/content/PS/GameData/tbl/MarketCharResultMoney.php',
			'marketcharresultmoney_dellog' => 'assets/content/PS/GameData/tbl/MarketCharResultMoney_DelLog.php',
			'marketitems' => 'assets/content/PS/GameData/tbl/MarketItems.php',
			'marketitems_dellog' => 'assets/content/PS/GameData/tbl/MarketItems_DelLog.php',
			'pointerrorlog' => 'assets/content/PS/GameData/tbl/PointErrorLog.php',
			'pointgiftnotify' => 'assets/content/PS/GameData/tbl/PointGiftNotify.php',
			'pointlog' => 'assets/content/PS/GameData/tbl/PointLog.php',
			'usermaxgrow' => 'assets/content/PS/GameData/tbl/UserMaxGrow.php',
			'userstoreditems' => 'assets/content/PS/GameData/tbl/UserStoredItems.php',
			'userstoredmoney' => 'assets/content/PS/GameData/tbl/UserStoredMoney.php',
			'userstoredpointitems' => 'assets/content/PS/GameData/tbl/UserStoredPointItems.php',
			'users_product' => 'assets/content/PS/GameData/tbl/Users_Product.php',
			'worldinfo' => 'assets/content/PS/GameData/tbl/WorldInfo.php'
		);
	if(!array_key_exists($p, $array_pages)) $page = 'assets/content/error.php';
	elseif(!is_file($array_pages[$p])) $page = 'assets/content/error.php';
	else $page = $array_pages[$p];
?>