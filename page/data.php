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

if ( isset($_POST["start_location"]) &&
isset($_POST["start_time"]) &&
isset($_POST["arrival_location"]) &&
isset($_POST["arrival_time"]) &&
isset($_POST["free_seats"]) &&
!empty($_POST["age"]) &&
!empty($_POST["start_location"]) &&
!empty($_POST["start_time"]) &&
!empty($_POST["arrival_location"]) &&
!empty($_POST["arrival_time"]) &&
!empty($_POST["free_seats"]))

/*
 {
    $color = $Helper->cleanInput($_POST["start_location"]);
    $Rides->saveEvent($Helper->cleanInput($_POST["price"]), $start_location);
}

{
    echo "Saved.";
    saveEvent(($_SESSION["userEmail"]),($_POST["datestamp"]),($_POST["exercise"]), ($_POST["sets"]), ($_POST["reps"]), ($_POST["weight"]));
}
*/


?>

<h1>Data</h1>

<p>

    Welcome <?=$_SESSION["userEmail"];?>!
    <a href="?logout=1">log out</a>

</p>


<h2>Register a ride</h2>
<form method="POST" >

    <label>Start location</label><br>
    <input name="start_location" type="text">

    <br><br>
    <label>Start time</label><br>
    <input name="start_time" type="text">

    <br><br>
    <label>Arrival location</label><br>
    <input name="arrival_location" type="text">

    <br><br>
    <label>Arrival time</label><br>
    <input name="arrival_time" type="text">

    <br><br>
    <label>Free seats</label><br>
    <input name="free_seats" type="number">

    <br><br>
    <label>Price</label><br>
    <input name="price" type="number">

    <br><br>
    <input type="submit" value="Submit">

</form>