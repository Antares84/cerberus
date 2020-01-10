<?php
session_start();
require("./assets/init/config.inc.php");
require("./assets/init/functions.php");
/*
if(!checkSession($_SESSION['UserID'], $_SESSION['SessID'])) { header("location:index.php"); die(); }
$textRank = array("Game Sage", "Game Master", "Developer", "Administrator")
*/
?>
<!DOCTYPE html>
<html>  
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<?php include('./assets/init/load.assets.php')?>
<!--	<?php include('./assets/js/head.js.php') ?> -->
	<title>Admin Control Panel</title>
</head>
<body>
	<div id="panel_info">
		<p class="panel_info_left">
			<?php echo "Welcome to your cPanel, ".returnName($_SESSION['UserID'])."! (".$textRank[returnUserRank($_SESSION['UserID'])].", Rank ".returnUserRank($_SESSION['UserID']).")"; ?>
		</p>
		<p class="panel_info_right">
			<!--<a href="logout.php"><img src="./assets/images/logout.jpg"></a>-->
		</p>
	</div>
	<div id="main_panel">
	<div id="lewy_panel">
		<?php include('./assets/init/web.nav.php')?>
	</div>
	<div id="prawy_panel">
		<?php include('./assets/init/main_panel.php')?>
	</div>
	</div>
</body>
</html>