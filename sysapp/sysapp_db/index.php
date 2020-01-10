<?php
#	Site Security
	define('SQL_Secure',true);
#	Fix PHP Extensions On Files	
	$SQL_Root=(defined('SQL_ROOT')) ? CMS_ROOT : './';
	$phpEx=substr(strrchr(__FILE__, '.'), 1);
#	Required for Config loading
	include($SQL_Root.'assets/init/core.conf.'.$phpEx);
	ob_start();
# Required for CMS Initialization
	if ($page == 'assets/content/home.'.$phpEx){$page_title_sb = "Home";}
# PS_Chatlog	
	elseif ($page == 'assets/content/PS/Chatlog/db/db_structure.'.$phpEx){$page_title_sb = "PS_ChatLog DB Structure";}
	elseif ($page == 'assets/content/PS/Chatlog/tbl/chatlog_tbl.'.$phpEx){$page_title_sb = "ChatLog Table";}
	elseif ($page == 'assets/content/PS/Chatlog/sp/Insert_Chat_Log_E.'.$phpEx){$page_title_sb = "Insert_Chat_Log_E";}
# PS_GameData
	elseif ($page == 'assets/content/PS/GameData/tbl/BanChars.'.$phpEx){$page_title_sb = "BanChars";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CharApplySkills.'.$phpEx){$page_title_sb = "CharApplySkills";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CharEvents.'.$phpEx){$page_title_sb = "CharEvents";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CharItems.'.$phpEx){$page_title_sb = "CharItems";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CharQuests.'.$phpEx){$page_title_sb = "CharQuests";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CharQuickSlots.'.$phpEx){$page_title_sb = "CharQuickSlots";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CharRenameLog.'.$phpEx){$page_title_sb = "CharRenameLog";}
	elseif ($page == 'assets/content/PS/GameData/tbl/Chars.'.$phpEx){$page_title_sb = "Chars";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CharSavePoint.'.$phpEx){$page_title_sb = "CharSavePoint";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CharSkills.'.$phpEx){$page_title_sb = "CharSkills";}
	elseif ($page == 'assets/content/PS/GameData/tbl/CreatedChars.'.$phpEx){$page_title_sb = "CreatedChars";}
	elseif ($page == 'assets/content/PS/GameData/tbl/DeletedChars.'.$phpEx){$page_title_sb = "DeletedChars";}
	elseif ($page == 'assets/content/PS/GameData/tbl/EventLog_CharSkill1.'.$phpEx){$page_title_sb = "EventLog_CharSkill1";}
	elseif ($page == 'assets/content/PS/GameData/tbl/EventLog_CharSkill2.'.$phpEx){$page_title_sb = "EventLog_CharSkill2";}
	elseif ($page == 'assets/content/PS/GameData/tbl/EventLog_CharStat.'.$phpEx){$page_title_sb = "EventLog_CharStat";}
	elseif ($page == 'assets/content/PS/GameData/tbl/FriendChars.'.$phpEx){$page_title_sb = "FriendChars";}
	elseif ($page == 'assets/content/PS/GameData/tbl/GuildChars.'.$phpEx){$page_title_sb = "GuildChars";}
	elseif ($page == 'assets/content/PS/GameData/tbl/GuildDetails.'.$phpEx){$page_title_sb = "GuildDetails";}
	elseif ($page == 'assets/content/PS/GameData/tbl/GuildNpcLv.'.$phpEx){$page_title_sb = "GuildNpcLv";}
	elseif ($page == 'assets/content/PS/GameData/tbl/GuildRankLog.'.$phpEx){$page_title_sb = "GuildRankLog";}
	elseif ($page == 'assets/content/PS/GameData/tbl/GuildRankLog2.'.$phpEx){$page_title_sb = "GuildRankLog2";}
	elseif ($page == 'assets/content/PS/GameData/tbl/Guilds.'.$phpEx){$page_title_sb = "Guilds";}
	elseif ($page == 'assets/content/PS/GameData/tbl/GuildStoredItems.'.$phpEx){$page_title_sb = "GuildStoredItems";}
	elseif ($page == 'assets/content/PS/GameData/tbl/Keeps.'.$phpEx){$page_title_sb = "Keeps";}
	elseif ($page == 'assets/content/PS/GameData/tbl/Market.'.$phpEx){$page_title_sb = "Market";}
	elseif ($page == 'assets/content/PS/GameData/tbl/MarketCharConcern.'.$phpEx){$page_title_sb = "MarketCharConcern";}
	elseif ($page == 'assets/content/PS/GameData/tbl/MarketCharResultItems.'.$phpEx){$page_title_sb = "MarketCharResultItems";}
	elseif ($page == 'assets/content/PS/GameData/tbl/MarketCharResultItems_DelLog.'.$phpEx){$page_title_sb = "MarketCharResultItems_DelLog";}
	elseif ($page == 'assets/content/PS/GameData/tbl/MarketCharResultMoney.'.$phpEx){$page_title_sb = "MarketCharResultMoney";}
	elseif ($page == 'assets/content/PS/GameData/tbl/MarketCharResultMoney_DelLog.'.$phpEx){$page_title_sb = "MarketCharResultMoney_DelLog";}
	elseif ($page == 'assets/content/PS/GameData/tbl/MarketItems.'.$phpEx){$page_title_sb = "MarketItems";}
	elseif ($page == 'assets/content/PS/GameData/tbl/MarketItems_DelLog.'.$phpEx){$page_title_sb = "MarketItems_DelLog";}
	elseif ($page == 'assets/content/PS/GameData/tbl/PointErrorLog.'.$phpEx){$page_title_sb = "PointErrorLog";}
	elseif ($page == 'assets/content/PS/GameData/tbl/PointGiftNotify.'.$phpEx){$page_title_sb = "PointGiftNotify";}
	elseif ($page == 'assets/content/PS/GameData/tbl/PointLog.'.$phpEx){$page_title_sb = "PointLog";}
	elseif ($page == 'assets/content/PS/GameData/tbl/UserMaxGrow.'.$phpEx){$page_title_sb = "UserMaxGrow";}
	elseif ($page == 'assets/content/PS/GameData/tbl/UserStoredItems.'.$phpEx){$page_title_sb = "UserStoredItems";}
	elseif ($page == 'assets/content/PS/GameData/tbl/UserStoredMoney.'.$phpEx){$page_title_sb = "UserStoredMoney";}
	elseif ($page == 'assets/content/PS/GameData/tbl/UserStoredPointItems.'.$phpEx){$page_title_sb = "UserStoredPointItems";}
	elseif ($page == 'assets/content/PS/GameData/tbl/Users_Product.'.$phpEx){$page_title_sb = "Users_Product";}
	elseif ($page == 'assets/content/PS/GameData/tbl/WorldInfo.'.$phpEx){$page_title_sb = "WorldInfo";}
# Load SQL Template...
	include($SQL_Style.'head.'.$phpEx);
	include($SQL_Style.'header.'.$phpEx);
	include($SQL_Style.'menu.'.$phpEx);
	include($SQL_Style.'divider.'.$phpEx);
	include($page);
	include($SQL_Style.'footer.'.$phpEx);
?>