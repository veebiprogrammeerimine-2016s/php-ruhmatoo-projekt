<?php
require("header.php");
require("../class/class_login.php");
$login = new User($dbconn);
if (isset($_SESSION["id"])) {
  $login->logout();
}
header("Location: home.php");
exit();
?>
