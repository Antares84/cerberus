<div class="pojemnik">
<?php
if (strlen(session_id()) < 1) {  header("location:index.php"); die(); }
/* error_reporting(E_ALL); */
if (isset($_REQUEST['action'])) {
	switch ($_GET['action']) {
/* Tier Level 1 */
		case 'fl_memberinfo': ?><?php include('./member.info/fleet.roster.php')?><?php break;
		case 'fl_kickable': ?><?php include('./member.info/fleet.kickable.php')?><?php break;
		case 'fl_staff': ?><?php include('./member.info/fleet.staff.php')?><?php break;
		case 'fl_promo': ?><?php include('./member.info/fleet.promo.php')?><?php break;
		case 'fl_srch': ?><?php include('./member.info/fleet.srch.php')?><?php break;

/* Tier Level 2 */

/* Tier Level 3 */

		default: echo "Choose one of the available menu options to continue.";
	}
} else
	echo "Choose one of the available menu options to continue.";
?>
</div>