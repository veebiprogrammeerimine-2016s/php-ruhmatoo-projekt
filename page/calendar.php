<?php
    require("../functions.php");

    if(isset ($_GET["logout"])) {

        session_destroy();
        header("Location:login.php");
        exit();
    }

?>

<?php require("../header.php"); ?>
<br>
<h3>Save some of your TV shows here</h3>
        <form method="POST">
            <input name="seriesname" placeholder="Name of the series" type="text">

        <input type="submit" value="Save">
        <br><br><br>

<link href="calendar.css" type="text/css" rel="stylesheet" />
<br>
<input type="button" value="My profile" onclick="location='myprofile'" />
<br><br>
<a href="?logout=2"> Log out</a>

<?php
include '../class/Calendar.class.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>

<?php require("../footer.php"); ?>