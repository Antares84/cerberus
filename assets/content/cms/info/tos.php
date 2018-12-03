<?php
	echo '<div class="card no_bg no_border no_radius wow bounceInUp" data-wow-duration="5s" data-wow-delay="2s">';
		echo '<div class="card-header card_border tac title pTitle show no_radius f_20">'.$this->Setting->SITE_TITLE.' Rules &amp; Guidelines</div>';
		echo '<div class="card-block card_border content_bg content no_radius pContent">';
			echo '<div class="card-text">';
				echo '<div class="badge badge-info f_16 b_i text-center tac m_t_5 p_b_5 m_l_10">General Game Usage</div>';
				echo '<div class="col-md-12 m_b_10">';
					echo '- Players who are playing in an Internet Café should report any suspicious player activity such as cheating, or any form of exploits, involved in hacking/scamming scheming and creating fraudulent accounts.<br>';
					echo '- If a player or group of players that share the same IP and are violating our rules, they will also be held responsible for any violations and penalties in our TOS. Your IP address might be banned temporarily or permanently without any prior notices or warnings.<br>';
					echo '- You may not improperly use in-game support, forums or tickets.<br>';
					echo '- The use of any third party programs such as Bots, Duping, speed hacks, game bugs, Terrain exploits will result in negative consequences.<br>';
					echo '- You should report immediately if you accidentally triggered a bug.<br>';
					echo '- Game Modification or Exploits and bug abuse is strictly prohibited in the server.<br>';
					echo '- GRB Exploit: You are not allowed to kill any GRB boss more than once.<br>';
					echo '- English is the only language allowed in trade chat. As for raid/guild chats, that is up to the raid or guild leader to decide on language preferences.<br>';
					echo '- English is the only language allowed in the Auction House normal, area, and yelling chats.<br>';
					echo '- You are not allowed to spam chat with text, or emotions from the sub skills.<br>';
					echo '- You are not allowed to impersonate any staff member or player.<br>';
					echo '- If you advertise any other games or websites in any chat you will be banned permanently.<br>';
					echo '- You are not allowed to harass or threaten any players or groups under any circumstances.<br>(Harassment: to annoy persistently or to create an unpleasant or hostile situation when it has been made clear that it is unwelcome.)<br>';
					echo '- Racism, sexism, etc will be considered as harassment and addressed accordingly.<br>';
					echo '- Harassment or disrespecting of staff members will not be tolerated.<br>';
					echo '- Begging is not allowed.';
				echo '</div>';

				echo '<div class="badge badge-info f_16 b_i text-center tac m_t_5 p_b_5 m_l_10">Character Usage & PvE Rules</div>';
				echo '<div class="col-md-12 m_b_10">';
					echo '- Any form of scamming, hacking, or exploiting is prohibited.<br>';
					echo '- We are not responsible for any lost or stolen items.<br>';
					echo '- You are not allowed to sell anything for any currency other than in-game currency.<br>';
					echo '- Guild raids are allowed.<br>';
					echo '- KS\'ing is allowed for bosses, however it is not allowed for mobs.<br>';
					echo '- You are not allowed to reset a PVE boss.';
				echo '</div>';

				echo '<div class="badge badge-info f_16 b_i text-center tac m_t_5 p_b_5 m_l_10">PvE Map Raid Rules</div>';
				echo '<div class="col-md-12 m_b_10">';
					echo '- CT Raids- When there is a CT raid the raid must be lead by a GS or a GM. The GS or GM is allowed to kick players if they spam chat or do not listen to the instruction.<br>';
					echo '- CTI drops will be voted upon and the GS or GM will be the one in charge of the voting.<br>';
					echo '- CT raids must be closed once the CT boss has hit 50%<br>';
					echo '- Normal boss raids are not required to be advertised in trade; bosses are a first come first serve basis.<br>';
					echo '- Guild raids are allowed.<br>';
					echo '- KSing is allowed for bosses, but not for mobs.';
				echo '</div>';

				echo '<div class="badge badge-info f_16 b_i text-center tac m_t_5 p_b_5 m_l_10">PvP Rules</div>';
				echo '<div class="col-md-12 m_b_10">';
					echo '- You are not allowed to stat pad or leech.<br>';
					echo '- You are not allowed to spawn kill.<br>';
					echo '- You are not allowed to go inside your enemy’s base.';
				echo '</div>';

				echo '<div class="badge badge-info f_16 b_i text-center tac m_t_5 p_b_5 m_l_10">PVP Map Raid Rules</div>';
				echo '<div class="col-md-12 m_b_10">';
					echo '- Under-leveled toons are not allowed in a PVP raid.<br>';
					echo '- PVP raids must be open. However if you\'re hunting a PVP boss, and there is no PVP, you may have the raid closed.<br>';
					echo '- Cross faction KSing of a boss or resetting of a boss is allowed. For instance, if a UoF raid is taking a boss and an AoL raid appears the AoL raid would be permitted to reset the boss, or to KS the boss.<br>';
					echo '- Raid leaders may not kick players without adequate reasoning (stat padding, leeching, not following directions, etc).';
				echo '</div>';

				echo '<div class="badge badge-info f_16 b_i text-center tac m_t_5 p_b_5 m_l_10">Voting Fraud/Exploits</div>';
				echo '<div class="col-md-12 m_b_10">';
					echo '- Creating multiple accounts to spam vote in order to gain excessive “free” Donation Points is considered as vote fraud.<br>';
					echo '- Dummy accounts that are receiving a string of unevenly timed votes will be permanently banned.<br>';
					echo '- Players\' main account that is involved in vote fraud will also be held accountable.';
				echo '</div>';

				echo '<div class="badge badge-info f_16 b_i text-center tac m_t_5 p_b_5 m_l_10">Modifying and/or Terminating Our Services</div>';
				echo '<div class="col-md-12">';
					echo '- We are constantly observing and improving the game, as well as its features, as we determine to be necessary.<br>';
					echo '- We may add or remove functions or features, and we may suspend or stop the Game Service altogether at any time, with or without, notice.<br>';
					echo '- We have the right to block, remove, or ban any registered accounts. We may, in our discretion, choose to monitor or record your interaction, behavior and activities with or without notice.<br>';
					echo '- All accounts and items are property of '.$this->Setting->SITE_TITLE.'.<br>';
					echo '- These Terms of Service, as well as all content &amp; features of the game, are subject to change at any given time with or without notice.';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
?>