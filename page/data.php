<?php

require("../functions.php");

require("../class/Helper.class.php");
$Helper = new Helper();

require("../class/Rides.class.php");
$Rides = new Rides($mysqli);

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

<h1>Data</h1>

<p>

    Tere tulemast <?=$_SESSION["userEmail"];?>!
    <a href="?logout=1">logi välja</a>

</p>
