<?php

require("../functions.php");

require("../class/Helper.class.php");
$Helper = new Helper();

require("../class/Event.class.php");
$Event = new Event($mysqli);

//kui ei ole sisseloginud, suunan login lehele
if (!isset($_SESSION["userId"])) {
  header("Location: login.php");
  exit();
}

//kas aadressireal on logout
if (isset($_GET["logout"])) {

  session_destroy();

  header("Location: login.php");
  exit();

}
?>
