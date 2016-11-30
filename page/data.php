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

//Check if forms are filled
$start_location = "";
$start_time = "";
$arrival_location = "";
$arrival_time = "";
$free_seats = "";
$price = "";

$emptyStartL = "*";
$emptyStartT = "*";
$emptyArrivalL = "*";
$emptyArrivalT = "*";
$emptySeats = "*";

if (isset ($_POST["start_location"])) {
    if (empty ($_POST["start_location"])) {
        $emptyStartL = "* Please fill in starting location!";
    } else {
        $start_location = $Helper->cleanInput($_POST["start_location"]);
    }
}

if (isset ($_POST["start_time"])) {
    if (empty ($_POST["start_time"])) {
        $emptyStartT = "* Please fill in start time!";
    } else {
        $start_time = $Helper->cleanInput($_POST["start_time"]);
    }
}

if (isset ($_POST["arrival_location"])) {
    if (empty ($_POST["arrival_location"])) {
        $emptyArrivalL = "* Please fill in arrival location!";
    } else {
        $arrival_location = $Helper->cleanInput($_POST["arrival_location"]);
    }
}

if (isset ($_POST["arrival_time"])) {
    if (empty ($_POST["arrival_time"])) {
        $emptyArrivalT = "* Please fill in arrival time!";
    } else {
        $arrival_time = $Helper->cleanInput($_POST["arrival_time"]);
    }
}

if (isset ($_POST["free_seats"])) {
    if (empty ($_POST["free_seats"])) {
        $emptySeats = "* Please fill in number of seats!";
    } else {
        $free_seats = $Helper->cleanInput($_POST["free_seats"]);
    }
}


  $price = $Helper->cleanInput($_POST["price"]);

//If forms are filled
if (isset($_POST["start_location"]) &&
isset($_POST["start_time"]) &&
isset($_POST["arrival_location"]) &&
isset($_POST["arrival_time"]) &&
isset($_POST["free_seats"]) &&

!empty($_POST["start_location"]) &&
!empty($_POST["start_time"]) &&
!empty($_POST["arrival_location"]) &&
!empty($_POST["arrival_time"]) &&
!empty($_POST["free_seats"])
)


{
    //echo = "Saved";
    $Rides->save($start_location, $start_time, $arrival_location,
    $arrival_time, $free_seats, $price);
 }


?>

<h1>Data</h1>

<p>

    Welcome <?=$_SESSION["userEmail"];?>!
    <br><br>
    <a href="?logout=1">Log out</a>
    <br><br>
    <a href="user.php">User page</a>
</p>


<h2>Register a ride</h2>
<form method="POST" >

    <label>Start location</label><br>
    <input name="start_location" type="text">

    <br><br>
    <label>Start time</label><br>
    <input name="start_time" type="date">

    <br><br>
    <label>Arrival location</label><br>
    <input name="arrival_location" type="text">

    <br><br>
    <label>Arrival time</label><br>
    <input name="arrival_time" type="date">

    <br><br>
    <label>Free seats</label><br>
    <input name="free_seats" type="number">

    <br><br>
    <label>Price</label><br>
    <input name="price" type="number">

    <br><br>
    <input type="submit" value="Submit">

</form>
