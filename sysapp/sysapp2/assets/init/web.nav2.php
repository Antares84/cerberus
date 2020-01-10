<!-- BEGIN PULL OUT CONTENT PANEL -->
<div id="pocp1" class="pocp_left">
<!-- BEGIN PANEL CONTAINER -->
    <div class="pocp">
<!-- BEGIN CAROUSEL BUTTONS -->
		<ul class="carousel_buttons">
            <li><a href="#" id="carousel_next"></a></li>
            <li><a href="#" id="carousel_prev"></a></li>
        </ul>
<!-- END CAROUSEL BUTTONS -->

<!-- BEGIN PANEL CAROUSEL -->
        <div class="pocp_carousel">
<!-- BEGIN PANEL 4 INNER CONTENT -->
            <div class="pocp_content">
                <h2>cPanel Command</h2>
                <p class="blackbox">This menu is completely interactive, and will get you to the resources that you need on order to manage your Shaiya Server quickly and efficiently.</p>
                <p class="blackbox">If you resize the browser, you should see custom scrollbars appearing on the right side of this panel.</p>
                <h2>Resources</h2>
                <ul class="pocp_toggle">
                    <li>
                        <span class="pocp_toggle_title"><i class="icon-plus"></i>Player-Related Tools</span>
                        <div class="pocp_panel">
								<?php if(returnPageRank("pl_stat_edit.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=pl_stat_edit">Edit Player</a><br> <?php } ?>
									<!--<a href="panel.php?action=pl_edit_admin">Edit Player ADMIN</a>-->
								<?php if(returnPageRank("pl_fc.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=pl_faction_ch">Faction Change</a><br> <?php } ?>
								<?php if(returnPageRank("pl_item_view.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=pl_links_view">View Player Linked Gear</a><br> <?php } ?>
								<?php if(returnPageRank("pl_um_res.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=pl_um_res">UM Resurrection</a><br> <?php } ?>
								<?php if(returnPageRank("pl_srch.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=pl_srch">Character Search</a><br> <?php } ?>
								<?php if(returnPageRank("pl_guild_search.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=pl_guild_srch">Guild Member Search</a><br> <?php } ?>
								<?php if(returnPageRank("pl_buff_view.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=pl_buff_view">View Player's Buffs</a><br> <?php } ?>
								<?php if(returnPageRank("staff.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=staff_list">View Staff</a><br> <?php } ?>
                        </div>
                    </li>
                    <li>
                        <span class="pocp_toggle_title"><i class="icon-plus"></i>Account-Related Tools</span>
                        <div class="pocp_panel">
								<?php if(returnPageRank("account_search.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=acc_ban">Account Ban</a><br> <?php } ?>
								<?php if(returnPageRank("unban_account.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=acc_unban">Account Un-Ban</a><br> <?php } ?>
								<?php if(returnPageRank("account_search.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=account_search">Account Search</a><br> <?php } ?>
								<?php if(returnPageRank("bansearch.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=banned">Banned Accounts</a> <?php } ?>
                        </div>
                    </li>
                    <li>
                        <span class="pocp_toggle_title"><i class="icon-plus"></i>Other Tools</span>
                        <div class="pocp_panel">
								<?php if(returnPageRank("guild_leader_change.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=guild_lead_change">Change Guild Leader</a><br> <?php } ?>
								<?php if(returnPageRank("login_status.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=login_status">Current Players</a><br> <?php } ?>
								<?php if(returnPageRank("pnl_log.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=log">View Panel Log</a><br> <?php } ?>
								<?php if(returnPageRank("rank_req.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=rankreq">Page Rank Requirements</a><br> <?php } ?>
								<?php if(returnPageRank("global_chat.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=global_chat">View In-Game Chats</a><br> <?php } ?>
								<?php if(returnPageRank("gmcomsrch.php") <= returnUserRank($_SESSION['UserID'])) { ?> <a href="panel.php?action=gmcomsrch">View GM Command Log</a><br> <?php } ?>
								<a href="panel.php">Return To the Index</a><br><br>
								<a href="logout.php"><img src="./assets/images/logout.png"></a>
                        </div>
                    </li>
                </ul>
            </div>
<!-- END PANEL 4 INNER CONTENT -->

<!-- BEGIN PANEL 2 INNER CONTENT -->
            <div class="pocp_content">
                <h2>About Us</h2>
                <p class="blackbox">Nexus Development Central has been in the Shaiya Private Server sector for over 5 years, and has helped coordinate, develop, and manage multiple servers during their startup &amp; production stages.
									We hope to continue to assist the Shaiya Private Server community for many years to come with whatever they may need to continue to grow and expand.</p>
                <img src="./assets/img/html.png" class="inline_img" alt="" />
                <img src="./assets/img/css.png" class="inline_img" alt="" />
                <img src="./assets/img/php.png" class="inline_img" alt="" />
            </div>
<!-- END PANEL 2 INNER CONTENT -->

<!-- BEGIN PANEL 5 INNER CONTENT -->
            <div class="pocp_content">
                <h2>Support</h2>
                <p class="blackbox">For assistance with this Shaiya Server Admin Panel, fill out the fields below and submit the requested information. Once we receive your message, we will reply to see how we may be able to assist you.</p>
                <div class="pocp_form">
                    <form method="POST" id="pocp_form" action="contact.php">
						<label for="name">Name<span class="required"> *</span></label><br />
						<input class="form_element" type="text" name="name" id="name" />
						<label for="email">Email<span class="required"> *</span></label><br />
						<input class="form_element" type="text" name="email" id="email" />
						<label for="subject">Choose an option</label><br />
							<select name="subject" id="subject" class="form_element select_element">
								<option value="General">General</option>
								<option value="Support">Support</option>
								<option value="Sales">Comment</option>
							</select>
                        <label for="message">Message<span class="required"> *</span></label><br />
                        <textarea name="message" class="form_element" id="message"></textarea>
                        <div class="form_buttons">
                            <input type="submit" class="button" id="submit" value="Submit" />
                            <input type="reset" class="button" id="reset" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
<!-- END PANEL 5 INNER CONTENT -->
        </div>
<!-- END PANEL CAROUSEL -->
    </div>
<!-- END PANEL CONTAINER -->
</div>
<!-- END PULL OUT CONTENT PANEL -->