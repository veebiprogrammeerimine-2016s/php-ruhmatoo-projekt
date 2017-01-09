<?php
    require("../functions.php");

    if(isset ($_GET["logout"])) {

        session_destroy();
        header("Location:login.php");
        exit();
    }

?>

<?php require("../header.php"); ?>

<link href="calendar.css" type="text/css" rel="stylesheet" />
<br>
<input type="button" value="My profile" onclick="location='myprofile'" />
<br>
<a href="?logout=2"> Log out</a>

<?php
include '../class/Calendar.class.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>

<?php require("../footer.php"); ?>