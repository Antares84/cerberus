<?php
require("./assets/init/config.inc.php");
require("./assets/init/functions.php");
session_start();
if(!checkSession($_SESSION['UserID'], $_SESSION['SessID'])) { header("location:index.php"); die(); }
$UserID = $_SESSION['UserID'];
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();
header("location:index.php");
?>